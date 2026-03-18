<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssessmentStoreRequest;
use App\Services\AssessmentService;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    protected $service;

    public function __construct(AssessmentService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['name', 'age', 'gender']);
        $assessments = $this->service->getPaginatedAssessments($filters);
        
        return view('assessments.index', compact('assessments'));
    }

    public function create()
    {
        return view('assessments.create');
    }

    public function store(AssessmentStoreRequest $request)
    {
        $assessment = $this->service->storeAssessment($request->validated());

        return redirect()->route('assessments.show', $assessment->uuid)
            ->with('success', 'Phiếu đánh giá đã được lưu thành công.');
    }

    public function show($uuid)
    {
        $assessment = $this->service->getAssessment($uuid);
        if (!$assessment) {
            return redirect()->route('assessments.create')->with('error', 'Không tìm thấy phiếu đánh giá.');
        }

        $results = $this->service->getInterpretations($assessment);

        return view('assessments.show', compact('assessment', 'results'));
    }
}
