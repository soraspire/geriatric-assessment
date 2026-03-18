<?php

namespace App\Services;

use App\Interfaces\AssessmentRepositoryInterface;
use App\Models\Assessment;

class AssessmentService
{
    protected $repository;

    public function __construct(AssessmentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAssessment(string $uuid)
    {
        return $this->repository->findByUuid($uuid);
    }

    public function getPaginatedAssessments(array $filters)
    {
        $paginator = $this->repository->paginateWithFilters($filters);
        
        $paginator->getCollection()->transform(function($assessment) {
            $assessment->results = $this->getInterpretations($assessment);
            return $assessment;
        });

        return $paginator;
    }

    public function storeAssessment(array $rawData)
    {
        $processedData = $this->prepareData($rawData);
        return $this->repository->create($processedData);
    }

    protected function prepareData(array $data)
    {
        $cciScore = $this->calculateCCIScore($data['cci'] ?? []);
        $miniCogScore = $this->calculateMinicogScore($data['minicog'] ?? []);
        $mnaScore = array_sum($data['mna'] ?? []);
        $morseScore = array_sum($data['morse'] ?? []);

        return [
            'main' => array_merge($data['main'], [
                'cci_total_score' => $cciScore,
                'minicog_total_score' => $miniCogScore,
                'mna_total_score' => $mnaScore,
                'cfs_total_score' => $data['cfs']['cfs_level'] ?? 1,
                'morse_total_score' => $morseScore,
            ]),
            'cci' => $data['cci'] ?? [],
            'minicog' => $data['minicog'] ?? [],
            'mna' => $data['mna'] ?? [],
            'cfs' => $data['cfs'] ?? [],
            'morse' => $data['morse'] ?? [],
            'other' => $data['other'] ?? [],
        ];
    }

    public function getInterpretations(Assessment $assessment)
    {
        $cciScore = $assessment->cci_total_score ?? 0;
        $cciInterpretation = "";
        if ($cciScore >= 5) {
            $cciInterpretation = "Người bệnh có bệnh lý đồng thời nghiêm trọng, điều trị cần được xem xét cẩn thận và có thể phải đối mặt với nguy cơ tử vong cao";
        } elseif ($cciScore >= 3) {
            $cciInterpretation = "Người bệnh có nguy cơ cao hơn về tử vong trong 10 năm tới do các bệnh lý đồng thời nghiêm trọng hơn";
        } elseif ($cciScore >= 1) {
            $cciInterpretation = "Người bệnh có một số bệnh lý đồng thời nhẹ và có thể kiểm soát được tình trạng bệnh";
        } else {
            $cciInterpretation = "Người bệnh không có bệnh lý đồng thời đáng kể hoặc có ít bệnh lý đồng thời và tình trạng sức khỏe tương đối tốt";
        }

        return [
            'cci' => [
                'score' => $cciScore,
                'max' => 34,
                'interpretation' => $cciInterpretation,
                'is_risk' => $cciScore > 0,
                'status' => $cciScore > 0 ? "Đa bệnh lý" : "Bình thường"
            ],
            'minicog' => [
                'score' => $assessment->minicog_total_score ?? 0,
                'max' => 5,
                'normal' => '>=3',
                'interpretation' => ($assessment->minicog_total_score < 3) ? "Khả năng cao có sa sút trí tuệ" : "Khả năng thấp mắc sa sút trí tuệ (nhận thức bình thường)",
                'is_risk' => ($assessment->minicog_total_score < 3),
                'status' => ($assessment->minicog_total_score < 3) ? "Có nguy cơ sa sút trí tuệ" : "Bình thường"
            ],
            'mna' => [
                'score' => $assessment->mna_total_score ?? 0,
                'max' => 14,
                'normal' => '>=12',
                'interpretation' => ($assessment->mna_total_score >= 12) ? "Tình trạng dinh dưỡng bình thường" : (($assessment->mna_total_score >= 8) ? "Có nguy cơ suy dinh dưỡng" : "Suy dinh dưỡng"),
                'is_risk' => ($assessment->mna_total_score < 12),
                'status' => ($assessment->mna_total_score < 12) ? "Có nguy cơ suy dinh dưỡng" : "Bình thường"
            ],
            'cfs' => [
                'score' => $assessment->cfs_total_score ?? 1,
                'max' => 9,
                'normal' => '<4',
                'interpretation' => ($assessment->cfs_total_score >= 7) ? "Suy yếu nặng" : (($assessment->cfs_total_score >= 5) ? "Nhẹ đến vừa" : "Không suy yếu"),
                'is_risk' => ($assessment->cfs_total_score > 4),
                'status' => ($assessment->cfs_total_score > 4) ? "Có nguy cơ suy giảm chức năng" : "Bình thường"
            ],
            'morse' => [
                'score' => $assessment->morse_total_score ?? 0,
                'max' => 125,
                'normal' => '<24',
                'interpretation' => ($assessment->morse_total_score >= 45) ? "Nguy cơ ngã cao" : (($assessment->morse_total_score >= 25) ? "Nguy cơ ngã trung bình" : "Nguy cơ ngã thấp"),
                'is_risk' => ($assessment->morse_total_score >= 25),
                'status' => ($assessment->morse_total_score >= 25) ? "Có nguy cơ ngã" : "Bình thường"
            ]
        ];
    }

    protected function calculateMinicogScore(array $minicog)
    {
        $score = 0;
        // Clock drawing score: User specified Clock-8 is correct
        if (($minicog['clock_selected'] ?? null) == 8) {
            $score += 2;
        }

        // Recall items score (banana, dog, cyclebike) are correct
        $correctRecall = ['banana', 'dog', 'cyclebike'];
        $selectedRecall = $minicog['recall'] ?? [];
        foreach ($selectedRecall as $item) {
            if (in_array($item, $correctRecall)) {
                $score += 1;
            }
        }
        return $score;
    }



    protected function calculateCCIScore(array $cci)
    {
        $score = 0;
        $weights = [
            'nhoi_mau_co_tim' => 1,
            'suy_tim' => 1,
            'benh_mach_mau_ngoai_vi' => 1,
            'benh_mach_nao' => 1,
            'hen_phe_quan_copd' => 1,
            'dai_thao_duong_chua_bien_chung' => 1,
            'tram_cam' => 1,
            'dung_thuoc_chong_dong_mau' => 1,
            'alzheimer_suy_giam_tri_nho' => 1,
            'benh_mo_lien_ket' => 1,
            'tang_huyet_ap' => 1,
            'liet_nua_nguoi' => 2,
            'dai_thao_duong_co_bien_chung' => 2,
            'benh_than_trung_binh_nang' => 2,
            'ung_thu_tai_cho' => 2,
            'benh_gan_man_tinh_vua_nang' => 3,
            'ung_thu_di_can' => 6,
            'hiv_aids' => 6,
        ];

        foreach ($weights as $key => $weight) {
            if (!empty($cci[$key])) {
                $score += $weight;
            }
        }
        return $score;
    }
}
