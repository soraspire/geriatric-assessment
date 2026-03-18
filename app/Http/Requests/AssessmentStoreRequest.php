<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssessmentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // I. Thông tin bệnh nhân
            'main.patient_name' => 'required|string|max:255',
            'main.birth_year' => 'required|integer|min:1900|max:' . date('Y'),
            'main.gender' => 'required|in:1,2',
            'main.phone_number' => 'required|string|max:20',
            'main.previous_job' => 'required|string|max:255',
            'main.height' => 'required|numeric|min:0.5|max:3',
            'main.weight' => 'required|numeric|min:10|max:500',
            'main.bmi' => 'required|numeric',

            // II. Tiền sử bản thân (CCI) - Although they are checkboxes, user wants "all fields"
            // If they are not checked, they don't appear in the request. 
            // However, CCI items are usually optional to check. 
            // If the user means "all sections must be answered", then for sections like MNA/Morse it makes sense.
            // For CCI, if none are checked, it's 0 points. 
            // I will assume for CCI that it's okay to have none checked, or I can validate the array exists.
            'cci' => 'nullable|array',

            // III. Mini-Cog
            'minicog.clock_selected' => 'required|integer|between:1,9',
            'minicog.recall' => 'required|array|min:1',
            'minicog.recall.*' => 'string',

            // IV. MNA
            'mna.giam_an_uong' => 'required|integer',
            'mna.sut_can' => 'required|integer',
            'mna.kha_nang_van_dong' => 'required|integer',
            'mna.stress_tam_ly' => 'required|integer',
            'mna.van_de_tam_than_kinh' => 'required|integer',
            'mna.bmi_score' => 'required|integer',

            // V. CFS
            'cfs.cfs_level' => 'required|integer|between:1,9',

            // VI. Morse
            'morse.tien_su_te_nga' => 'required|integer',
            'morse.benh_ly_di_kem' => 'required|integer',
            'morse.duong_truyen_dich' => 'required|integer',
            'morse.ho_tro_di_lai' => 'required|integer',
            'morse.bat_thuong_di_chuyen' => 'required|integer',
            'morse.tinh_trang_tinh_than' => 'required|integer',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => 'Trường này là bắt buộc nhập.',
            'main.patient_name.required' => 'Vui lòng nhập họ tên bệnh nhân.',
            'main.birth_year.required' => 'Vui lòng nhập năm sinh.',
            'main.gender.required' => 'Vui lòng chọn giới tính.',
            'main.phone_number.required' => 'Vui lòng nhập số điện thoại người nhà.',
            'main.previous_job.required' => 'Vui lòng nhập công việc trước đây.',
            'main.height.required' => 'Vui lòng nhập chiều cao.',
            'main.weight.required' => 'Vui lòng nhập cân nặng.',
            'minicog.clock_selected.required' => 'Vui lòng chọn hình ảnh đồng hồ.',
            'minicog.recall.required' => 'Vui lòng chọn ít nhất một từ nhớ lại.',
            'mna.giam_an_uong.required' => 'Vui lòng chọn mức độ ăn uống.',
            'mna.sut_can.required' => 'Vui lòng chọn mức độ sút cân.',
            'mna.kha_nang_van_dong.required' => 'Vui lòng chọn khả năng vận động.',
            'mna.stress_tam_ly.required' => 'Vui lòng chọn stress tâm lý.',
            'mna.van_de_tam_than_kinh.required' => 'Vui lòng chọn vấn đề tâm thần kinh.',
            'mna.bmi_score.required' => 'Vui lòng chọn điểm BMI (tự động khi nhập chiều cao/cân nặng).',
            'cfs.cfs_level.required' => 'Vui lòng chọn mức độ suy yếu lâm sàng.',
            'morse.tien_su_te_nga.required' => 'Vui lòng chọn tiền sử té ngã.',
            'morse.benh_ly_di_kem.required' => 'Vui lòng chọn bệnh lý đi kèm.',
            'morse.duong_truyen_dich.required' => 'Vui lòng chọn đường truyền dịch.',
            'morse.ho_tro_di_lai.required' => 'Vui lòng chọn hỗ trợ đi lại.',
            'morse.bat_thuong_di_chuyen.required' => 'Vui lòng chọn bất thường di chuyển.',
            'morse.tinh_trang_tinh_than.required' => 'Vui lòng chọn tình trạng tinh thần.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'main.patient_name' => 'Họ và tên',
            'main.birth_year' => 'Năm sinh',
            'main.gender' => 'Giới tính',
            'main.phone_number' => 'Số điện thoại',
            'main.previous_job' => 'Công việc',
            'main.height' => 'Chiều cao',
            'main.weight' => 'Cân nặng',
            'minicog.clock_selected' => 'Hình ảnh đồng hồ',
            'minicog.recall' => 'Từ nhớ lại',
            'mna.giam_an_uong' => 'Khả năng ăn uống',
            'mna.sut_can' => 'Sút cân',
            'mna.kha_nang_van_dong' => 'Khả năng vận động',
            'mna.stress_tam_ly' => 'Stress tâm lý',
            'mna.van_de_tam_than_kinh' => 'Vấn đề tâm thần kinh',
            'mna.bmi_score' => 'Điểm BMI',
            'cfs.cfs_level' => 'Mức độ suy yếu',
            'morse.tien_su_te_nga' => 'Tiền sử té ngã',
            'morse.benh_ly_di_kem' => 'Bệnh lý đi kèm',
            'morse.duong_truyen_dich' => 'Đường truyền dịch',
            'morse.ho_tro_di_lai' => 'Hỗ trợ đi lại',
            'morse.bat_thuong_di_chuyen' => 'Bất thường di chuyển',
            'morse.tinh_trang_tinh_than' => 'Tình trạng tinh thần',
        ];
    }
}
