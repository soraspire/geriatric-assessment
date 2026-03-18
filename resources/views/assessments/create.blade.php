<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phiếu Đánh Giá Lão Khoa Toàn Diện</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text: #1e293b;
            --text-light: #64748b;
            --border: #e2e8f0;
            --radius: 12px;
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            line-height: 1.6;
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        header {
            text-align: center;
            margin-bottom: 40px;
        }

        header h1 {
            font-size: 2.25rem;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 10px;
        }

        header p {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 32px;
            box-shadow: var(--shadow);
            margin-bottom: 24px;
            border: 1px solid var(--border);
        }

        .card h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 24px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--bg);
            color: #1e40af;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            font-weight: 500;
            margin-bottom: 6px;
            font-size: 0.95rem;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .custom-select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='black'%3E%3Cpath d='M5 7l5 5 5-5'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 8px center;
            background-size: 20px;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .is-invalid {
            border-color: #ef4444 !important;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 4px;
            font-weight: 500;
        }

        .section-title {
            background: #eff6ff;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #1d4ed8;
        }

        /* Mini-Cog Specific Styles */
        .minicog-memory-row {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 20px 0;
            gap: 20px;
        }

        .memory-item {
            text-align: center;
        }

        .memory-item img {
            width: 100%;
            height: 160px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .minicog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin: 20px 0;
        }

        .grid-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #f8fafc;
            padding: 15px;
            border-radius: 12px;
            border: 1px solid var(--border);
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }

        .grid-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border-color: var(--primary);
        }

        .grid-item:has(input:checked) {
            background: #eff6ff;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .grid-item img {
            width: 100%;
            height: 120px;
            object-fit: contain;
            margin-bottom: 12px;
        }

        .cfs-grid .grid-item img {
            height: 220px;
        }

        /* Other Details Table */
        .other-details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .other-details-table td {
            padding: 12px;
            border: 1px solid var(--border);
            vertical-align: middle;
        }
        .other-details-table tr:hover {
            background-color: #f8fafc;
        }
        .check-icon {
            color: #10b981;
            font-weight: bold;
            margin-right: 8px;
        }
        .radio-group {
            display: flex;
            gap: 15px;
        }

        .grid-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .grid-item input[type="radio"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        /* Questionnaire Styles */
        .question-block {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 16px 0;
            border-bottom: 1px solid var(--border);
        }

        .question-block:last-child {
            border-bottom: none;
        }

        .question-label {
            margin-bottom: 12px;
            font-weight: 600;
            color: var(--text);
            font-size: 1rem;
        }

        .radio-vertical {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        .radio-vertical .checkbox-item {
            width: 100%;
            justify-content: flex-start;
        }

        .checkbox-group {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 12px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            background: #fbfcfd;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid var(--border);
            cursor: pointer;
            transition: background 0.2s;
        }

        .checkbox-item:hover {
            background: #f1f5f9;
        }

        .checkbox-item input {
            margin-right: 12px;
            width: 18px;
            height: 18px;
        }

        .question-list {
            list-style: none;
            padding: 0;
        }

        .question-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
        }

        .question-item:last-child {
            border-bottom: none;
        }

        .radio-options {
            display: flex;
            gap: 20px;
        }

        .btn {
            background: var(--primary);
            color: white;
            padding: 14px 28px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            width: 100%;
            margin-top: 20px;
        }

        .btn:hover {
            background: var(--primary-hover);
        }

        /* Responsive */
        @media (max-width: 640px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Bệnh Viện Đà Nẵng - Khoa Lão</h1>
            <p>PHIẾU ĐÁNH GIÁ LÃO KHOA TOÀN DIỆN</p>
        </header>

        <form action="{{ route('assessments.store') }}" method="POST">
            @csrf
            <!-- I. THÔNG TIN BỆNH NHÂN -->
            <div class="card">
                <h2>I. Thông tin bệnh nhân</h2>
                <div class="grid">
                    <div class="form-group">
                        <label for="patient_name">Họ và tên bệnh nhân</label>
                        <input type="text" id="patient_name" name="main[patient_name]" value="{{ old('main.patient_name') }}" class="@error('main.patient_name') is-invalid @enderror" placeholder="Nhập họ tên...">
                        @error('main.patient_name') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="birth_year">Năm sinh</label>
                        <input type="number" id="birth_year" name="main[birth_year]" value="{{ old('main.birth_year') }}" class="@error('main.birth_year') is-invalid @enderror" placeholder="VD: 1950">
                        @error('main.birth_year') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender">Giới tính</label>
                        <select id="gender" name="main[gender]" class="custom-select @error('main.gender') is-invalid @enderror">
                            <option value="">Chọn giới tính</option>
                            <option value="1" {{ old('main.gender') == '1' ? 'selected' : '' }}>Nam</option>
                            <option value="2" {{ old('main.gender') == '2' ? 'selected' : '' }}>Nữ</option>
                        </select>
                        @error('main.gender') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="grid">
                    <div class="form-group">
                        <label for="phone">Số điện thoại người nhà cần liên lạc</label>
                        <input type="text" id="phone" name="main[phone_number]" value="{{ old('main.phone_number') }}" class="@error('main.phone_number') is-invalid @enderror">
                        @error('main.phone_number') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="job">Công việc trước đây</label>
                        <input type="text" id="job" name="main[previous_job]" value="{{ old('main.previous_job') }}" class="@error('main.previous_job') is-invalid @enderror">
                        @error('main.previous_job') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="grid">
                    <div class="form-group">
                        <label for="height">Chiều cao (m)</label>
                        <input type="number" step="0.01" id="height" name="main[height]" value="{{ old('main.height') }}" class="@error('main.height') is-invalid @enderror" placeholder="VD: 1.65">
                        @error('main.height') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="weight">Cân nặng (kg)</label>
                        <input type="number" step="0.1" id="weight" name="main[weight]" value="{{ old('main.weight') }}" class="@error('main.weight') is-invalid @enderror" placeholder="VD: 60">
                        @error('main.weight') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="bmi">BMI</label>
                        <input type="number" step="0.1" id="bmi" name="main[bmi]" value="{{ old('main.bmi', '0') }}" class="@error('main.bmi') is-invalid @enderror" readonly>
                        @error('main.bmi') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="question-list">
                    <table class="other-details-table">
                        <tr>
                            <td style="width: 25%; font-weight: 600;"><span class="check-icon">✓</span> Dị ứng thuốc:</td>
                            <td style="width: 45%;">Có tiền sử dị ứng thuốc hay không?</td>
                            <td style="width: 30%;">
                                <div class="radio-group @error('other.has_drug_allergy') is-invalid @enderror">
                                    <label class="checkbox-item"><input type="radio" name="other[has_drug_allergy]" value="1" {{ old('other.has_drug_allergy') === '1' ? 'checked' : '' }}> Có</label>
                                    <label class="checkbox-item"><input type="radio" name="other[has_drug_allergy]" value="0" {{ old('other.has_drug_allergy') === '0' ? 'checked' : '' }}> Không</label>
                                </div>
                                @error('other.has_drug_allergy') <div class="error-message">{{ $message }}</div> @enderror
                            </td>
                        </tr>
                        <tr id="drug-allergy-detail-row" style="{{ old('other.has_drug_allergy') === '1' ? '' : 'display: none;' }}">
                            <td colspan="2" style="text-align: right; padding-right: 20px; font-style: italic; color: var(--text-light);">Nếu có: loại thuốc dị ứng:</td>
                            <td>
                                <input type="text" name="other[drug_allergy_detail]" value="{{ old('other.drug_allergy_detail') }}" placeholder="Nhập tên thuốc..." style="width: 100%;" class="@error('other.drug_allergy_detail') is-invalid @enderror">
                                @error('other.drug_allergy_detail') <div class="error-message">{{ $message }}</div> @enderror
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;"><span class="check-icon">✓</span> Giác quan:</td>
                            <td>Nghe kém hoặc nhìn kém?</td>
                            <td>
                                <div class="radio-group @error('other.has_sensory_impairment') is-invalid @enderror">
                                    <label class="checkbox-item"><input type="radio" name="other[has_sensory_impairment]" value="1" {{ old('other.has_sensory_impairment') === '1' ? 'checked' : '' }}> Có</label>
                                    <label class="checkbox-item"><input type="radio" name="other[has_sensory_impairment]" value="0" {{ old('other.has_sensory_impairment') === '0' ? 'checked' : '' }}> Không</label>
                                </div>
                                @error('other.has_sensory_impairment') <div class="error-message">{{ $message }}</div> @enderror
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;"><span class="check-icon">✓</span> Tiểu không tự chủ:</td>
                            <td>Khó kiểm soát tiểu tiện?</td>
                            <td>
                                <div class="radio-group @error('other.has_incontinence') is-invalid @enderror">
                                    <label class="checkbox-item"><input type="radio" name="other[has_incontinence]" value="1" {{ old('other.has_incontinence') === '1' ? 'checked' : '' }}> Có</label>
                                    <label class="checkbox-item"><input type="radio" name="other[has_incontinence]" value="0" {{ old('other.has_incontinence') === '0' ? 'checked' : '' }}> Không</label>
                                </div>
                                @error('other.has_incontinence') <div class="error-message">{{ $message }}</div> @enderror
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;"><span class="check-icon">✓</span> Nguy cơ loét:</td>
                            <td>Hạn chế vận động, nằm nhiều hoặc đang loét?</td>
                            <td>
                                <div class="radio-group @error('other.has_pressure_ulcer_risk') is-invalid @enderror">
                                    <label class="checkbox-item"><input type="radio" name="other[has_pressure_ulcer_risk]" value="1" {{ old('other.has_pressure_ulcer_risk') === '1' ? 'checked' : '' }}> Có</label>
                                    <label class="checkbox-item"><input type="radio" name="other[has_pressure_ulcer_risk]" value="0" {{ old('other.has_pressure_ulcer_risk') === '0' ? 'checked' : '' }}> Không</label>
                                </div>
                                @error('other.has_pressure_ulcer_risk') <div class="error-message">{{ $message }}</div> @enderror
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;"><span class="check-icon">✓</span> Hoàn cảnh xã hội:</td>
                            <td>Có người chăm sóc khi cần thiết?</td>
                            <td>
                                <div class="radio-group @error('other.has_caregiver') is-invalid @enderror">
                                    <label class="checkbox-item"><input type="radio" name="other[has_caregiver]" value="1" {{ old('other.has_caregiver') === '1' ? 'checked' : '' }}> Có</label>
                                    <label class="checkbox-item"><input type="radio" name="other[has_caregiver]" value="0" {{ old('other.has_caregiver') === '0' ? 'checked' : '' }}> Không</label>
                                </div>
                                @error('other.has_caregiver') <div class="error-message">{{ $message }}</div> @enderror
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- II. TIỀN SỬ BẢN THÂN (CCI) -->
            <div class="card">
                <h2>II. Tiền sử bản thân (CCI)</h2>
                <p class="section-title">Các bệnh hiện mắc</p>
                <div class="checkbox-group">
                    <label class="checkbox-item"><input type="checkbox" name="cci[nhoi_mau_co_tim]" value="1" {{ old('cci.nhoi_mau_co_tim') ? 'checked' : '' }}>Nhồi máu cơ tim (1đ)</label>
                    <label class="checkbox-item"><input type="checkbox" name="cci[suy_tim]" value="1" {{ old('cci.suy_tim') ? 'checked' : '' }}> Suy tim (1đ)</label>
                    <label class="checkbox-item"><input type="checkbox" name="cci[benh_mach_mau_ngoai_vi]" value="1" {{ old('cci.benh_mach_mau_ngoai_vi') ? 'checked' : '' }}>Bệnh mạch máu ngoại vi (1đ)</label>
                    <label class="checkbox-item"><input type="checkbox" name="cci[benh_mach_nao]" value="1" {{ old('cci.benh_mach_nao') ? 'checked' : '' }}>Bệnh mạch não (CVA hoặc TIA) (1đ)</label>
                    <label class="checkbox-item"><input type="checkbox" name="cci[hen_phe_quan_copd]" value="1" {{ old('cci.hen_phe_quan_copd') ? 'checked' : '' }}>Hen phế quản, COPD (1đ)</label>
                    <label class="checkbox-item"><input type="checkbox" name="cci[dai_thao_duong_chua_bien_chung]" value="1" {{ old('cci.dai_thao_duong_chua_bien_chung') ? 'checked' : '' }}>Đái tháo đường (chưa biến chứng) (1đ)</label>
                    <label class="checkbox-item"><input type="checkbox" name="cci[tram_cam]" value="1" {{ old('cci.tram_cam') ? 'checked' : '' }}>Trầm cảm (1đ)</label>
                    <label class="checkbox-item"><input type="checkbox" name="cci[dung_thuoc_chong_dong_mau]" value="1" {{ old('cci.dung_thuoc_chong_dong_mau') ? 'checked' : '' }}>Dòng thuốc chống đông máu (1đ)</label>
                    <label class="checkbox-item"><input type="checkbox" name="cci[alzheimer_suy_giam_tri_nho]" value="1" {{ old('cci.alzheimer_suy_giam_tri_nho') ? 'checked' : '' }}>Alzheimer hay suy giảm trí nhớ (1đ)</label>
                    <label class="checkbox-item"><input type="checkbox" name="cci[benh_mo_lien_ket]" value="1" {{ old('cci.benh_mo_lien_ket') ? 'checked' : '' }}>Bệnh mô liên kết (1đ)</label>
                    <label class="checkbox-item"><input type="checkbox" name="cci[tang_huyet_ap]" value="1" {{ old('cci.tang_huyet_ap') ? 'checked' : '' }}>Tăng huyết áp (1đ)</label>
                    <label class="checkbox-item"><input type="checkbox" name="cci[liet_nua_nguoi]" value="2" {{ old('cci.liet_nua_nguoi') ? 'checked' : '' }}>Liệt nửa người (2đ)</label>
                    <label class="checkbox-item"><input type="checkbox" name="cci[dai_thao_duong_co_bien_chung]" value="2" {{ old('cci.dai_thao_duong_co_bien_chung') ? 'checked' : '' }}>Đái tháo đường có biến chứng (2đ)</label>
                    <label class="checkbox-item"><input type="checkbox" name="cci[benh_than_trung_binh_nang]" value="2" {{ old('cci.benh_than_trung_binh_nang') ? 'checked' : '' }}>Bệnh thận mức độ trung bình/nặng (2đ)</label>
                    <label class="checkbox-item"><input type="checkbox" name="cci[ung_thu_tai_cho]" value="2" {{ old('cci.ung_thu_tai_cho') ? 'checked' : '' }}>Ung thư (khối u tại chỗ chưa di căn) (2đ)</label>
                    <label class="checkbox-item"><input type="checkbox" name="cci[benh_gan_man_tinh_vua_nang]" value="3" {{ old('cci.benh_gan_man_tinh_vua_nang') ? 'checked' : '' }}>Bệnh gan mạn tính vừa đến nặng (3đ)</label>
                    <label class="checkbox-item"><input type="checkbox" name="cci[ung_thu_di_can]" value="6" {{ old('cci.ung_thu_di_can') ? 'checked' : '' }}>Ung thư di căn (6đ)</label>
                    <label class="checkbox-item"><input type="checkbox" name="cci[hiv_aids]" value="6" {{ old('cci.hiv_aids') ? 'checked' : '' }}>HIV hoặc AIDS (6đ)</label>
                </div>
            </div>

            <!-- III. MINI-COG -->
            <div class="card">
                <h2>III. Đánh giá sàng lọc sa sút trí tuệ (Mini-Cog)</h2>
                <div class="form-group">
                    <p class="section-title">1. Hãy nhớ 3 từ sau:</p>
                    <div id="minicog-memory-content">
                        <div class="minicog-memory-row">
                            <div class="memory-item">
                                <img src="{{ asset('images/banana.png') }}" alt="Chuối">
                                <p>Trái chuối</p>
                            </div>
                            <div class="memory-item">
                                <img src="{{ asset('images/dog.png') }}" alt="Chó">
                                <p>Con chó</p>
                            </div>
                            <div class="memory-item">
                                <img src="{{ asset('images/cyclebike.png') }}" alt="Xe đạp">
                                <p>Xe đạp</p>
                            </div>
                        </div>
                        <button type="button" id="btn-remembered" class="btn" style="background: #10b981; margin: 0 auto; display: block; width: auto; padding: 10px 24px;">Đã nhớ</button>
                    </div>
                    <button type="button" id="btn-show-memory" class="btn" style="background: #6366f1; margin: 10px auto 0; display: none; width: auto; padding: 10px 24px;">Xem lại hình ảnh</button>
                </div>

                <div class="form-group">
                    <p class="section-title">2. Đâu là cái đồng hồ chỉ 11 giờ 10 phút (chọn chính xác 2 điểm)</p>
                    <div class="minicog-grid @error('minicog.clock_selected') is-invalid @enderror">
                        @for ($i = 1; $i <= 9; $i++)
                        <label class="grid-item">
                            <img src="{{ asset('images/clock-' . $i . '.png') }}" alt="Clock {{ $i }}">
                            <input type="radio" name="minicog[clock_selected]" value="{{ $i }}" {{ old('minicog.clock_selected') == $i ? 'checked' : '' }}>
                        </label>
                        @endfor
                    </div>
                    @error('minicog.clock_selected') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <p class="section-title">3. Nhắc lại 3 từ đã nhớ lúc đầu (Mỗi câu đúng 1 điểm)</p>
                    <div class="minicog-grid @error('minicog.recall') is-invalid @enderror">
                        @php
                            $recallItems = [
                                ['id' => 'cat', 'name' => 'Con mèo', 'file' => 'cat.png'],
                                ['id' => 'orange', 'name' => 'Trái cam', 'file' => 'orange.png'],
                                ['id' => 'cyclo', 'name' => 'Xích lô', 'file' => 'cyclo.png'],
                                ['id' => 'tiger', 'name' => 'Con hổ', 'file' => 'tiger.png'],
                                ['id' => 'banana', 'name' => 'Trái chuối', 'file' => 'banana.png'],
                                ['id' => 'dog', 'name' => 'Con chó', 'file' => 'dog.png'],
                                ['id' => 'motorbike', 'name' => 'Xe máy', 'file' => 'motorbike.png'],
                                ['id' => 'apple', 'name' => 'Trái táo', 'file' => 'apple.png'],
                                ['id' => 'cyclebike', 'name' => 'Xe đạp', 'file' => 'cyclebike.png'],
                            ];
                        @endphp
                        @foreach ($recallItems as $item)
                        <label class="grid-item">
                            <img src="{{ asset('images/' . $item['file']) }}" alt="{{ $item['name'] }}">
                            <p style="font-size: 0.8rem; margin: 5px 0;">{{ $item['name'] }}</p>
                            <input type="checkbox" name="minicog[recall][]" value="{{ $item['id'] }}" {{ is_array(old('minicog.recall')) && in_array($item['id'], old('minicog.recall')) ? 'checked' : '' }}>
                        </label>
                        @endforeach
                    </div>
                    @error('minicog.recall') <div class="error-message">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- IV. MNA -->
            <div class="card">
                <h2>IV. Bảng đánh giá Tầm soát dinh dưỡng tối thiểu dành cho bệnh nhân lớn tuổi MNA (Mini Nutritional Assessment)</h2>
                
                <div class="question-list">
                    <div class="question-block">
                        <label class="question-label">1. Giảm khả năng ăn uống/3 tháng qua do chán ăn, vấn đề tiêu hóa, nhai, nuốt khó</label>
                        <div class="radio-vertical @error('mna.giam_an_uong') is-invalid @enderror">
                            <label class="checkbox-item"><input type="radio" name="mna[giam_an_uong]" value="0" {{ old('mna.giam_an_uong') === '0' ? 'checked' : '' }}> Chán ăn nghiêm trọng (0đ)</label>
                            <label class="checkbox-item"><input type="radio" name="mna[giam_an_uong]" value="1" {{ old('mna.giam_an_uong') === '1' ? 'checked' : '' }}> Trung bình (1đ)</label>
                            <label class="checkbox-item"><input type="radio" name="mna[giam_an_uong]" value="2" {{ old('mna.giam_an_uong') === '2' ? 'checked' : '' }}> Không chán ăn (2đ)</label>
                        </div>
                        @error('mna.giam_an_uong') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="question-block">
                        <label class="question-label">2. Sút cân trong 3 tháng qua</label>
                        <div class="radio-vertical @error('mna.sut_can') is-invalid @enderror">
                            <label class="checkbox-item"><input type="radio" name="mna[sut_can]" value="0" {{ old('mna.sut_can') === '0' ? 'checked' : '' }}> Giảm > 3kg (0đ)</label>
                            <label class="checkbox-item"><input type="radio" name="mna[sut_can]" value="1" {{ old('mna.sut_can') === '1' ? 'checked' : '' }}> Không biết (1đ)</label>
                            <label class="checkbox-item"><input type="radio" name="mna[sut_can]" value="2" {{ old('mna.sut_can') === '2' ? 'checked' : '' }}> Giảm 1-3 kg (2đ)</label>
                            <label class="checkbox-item"><input type="radio" name="mna[sut_can]" value="3" {{ old('mna.sut_can') === '3' ? 'checked' : '' }}> Không giảm (3đ)</label>
                        </div>
                        @error('mna.sut_can') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="question-block">
                        <label class="question-label">3. Khả năng vận động</label>
                        <div class="radio-vertical @error('mna.kha_nang_van_dong') is-invalid @enderror">
                            <label class="checkbox-item"><input type="radio" name="mna[kha_nang_van_dong]" value="0" {{ old('mna.kha_nang_van_dong') === '0' ? 'checked' : '' }}> Tại giường/ghế (0đ)</label>
                            <label class="checkbox-item"><input type="radio" name="mna[kha_nang_van_dong]" value="1" {{ old('mna.kha_nang_van_dong') === '1' ? 'checked' : '' }}> Trong nhà (1đ)</label>
                            <label class="checkbox-item"><input type="radio" name="mna[kha_nang_van_dong]" value="2" {{ old('mna.kha_nang_van_dong') === '2' ? 'checked' : '' }}> Ra ngoài được (2đ)</label>
                        </div>
                        @error('mna.kha_nang_van_dong') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="question-block">
                        <label class="question-label">4. Stress thể chất hoặc bệnh lý cấp tính trong 3 tháng qua</label>
                        <div class="radio-vertical @error('mna.stress_tam_ly') is-invalid @enderror">
                            <label class="checkbox-item"><input type="radio" name="mna[stress_tam_ly]" value="0" {{ old('mna.stress_tam_ly') === '0' ? 'checked' : '' }}> Có (0đ)</label>
                            <label class="checkbox-item"><input type="radio" name="mna[stress_tam_ly]" value="2" {{ old('mna.stress_tam_ly') === '2' ? 'checked' : '' }}> Không (2đ)</label>
                        </div>
                        @error('mna.stress_tam_ly') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="question-block">
                        <label class="question-label">5. Vấn đề về tâm thần kinh</label>
                        <div class="radio-vertical @error('mna.van_de_tam_than_kinh') is-invalid @enderror">
                            <label class="checkbox-item"><input type="radio" name="mna[van_de_tam_than_kinh]" value="0" {{ old('mna.van_de_tam_than_kinh') === '0' ? 'checked' : '' }}> Sa sút/Trầm cảm nặng (0đ)</label>
                            <label class="checkbox-item"><input type="radio" name="mna[van_de_tam_than_kinh]" value="1" {{ old('mna.van_de_tam_than_kinh') === '1' ? 'checked' : '' }}> Sa sút nhẹ (1đ)</label>
                            <label class="checkbox-item"><input type="radio" name="mna[van_de_tam_than_kinh]" value="2" {{ old('mna.van_de_tam_than_kinh') === '2' ? 'checked' : '' }}> Không có vấn đề (2đ)</label>
                        </div>
                        @error('mna.van_de_tam_than_kinh') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="question-block">
                        <label class="question-label">6. Chỉ số BMI (Điểm số tự động dựa trên BMI ở Phần I)</label>
                        <div class="radio-vertical @error('mna.bmi_score') is-invalid @enderror">
                            <label class="checkbox-item"><input type="radio" name="mna[bmi_score]" value="0" {{ old('mna.bmi_score') === '0' ? 'checked' : '' }}> BMI < 19 (0đ)</label>
                            <label class="checkbox-item"><input type="radio" name="mna[bmi_score]" value="1" {{ old('mna.bmi_score') === '1' ? 'checked' : '' }}> 19 ≤ BMI < 21 (1đ)</label>
                            <label class="checkbox-item"><input type="radio" name="mna[bmi_score]" value="2" {{ old('mna.bmi_score') === '2' ? 'checked' : '' }}> 21 ≤ BMI < 23 (2đ)</label>
                            <label class="checkbox-item"><input type="radio" name="mna[bmi_score]" value="3" {{ old('mna.bmi_score') === '3' ? 'checked' : '' }}> BMI ≥ 23 (3đ)</label>
                        </div>
                        @error('mna.bmi_score') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <!-- V. CFS -->
            <div class="card">
                <h2>V. Thang điểm đánh giá suy yếu lâm sàng</h2>
                <div class="form-group">
                    <p class="section-title">Hãy nhìn các ảnh, chọn 1 tấm ảnh mô tả tình hình sức khỏe của bệnh nhân hiện tại</p>
                    <div class="minicog-grid cfs-grid @error('cfs.cfs_level') is-invalid @enderror">
                        @for ($i = 1; $i <= 9; $i++)
                        <label class="grid-item">
                            <img src="{{ asset('images/level-' . $i . '.png') }}" alt="Level {{ $i }}">
                            <p style="font-size: 0.8rem; font-weight: 600; margin-bottom: 8px;">Mức {{ $i }}</p>
                            <input type="radio" name="cfs[cfs_level]" value="{{ $i }}" {{ old('cfs.cfs_level') == $i ? 'checked' : '' }}>
                        </label>
                        @endfor
                    </div>
                    @error('cfs.cfs_level') <div class="error-message">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- VI. MORSE -->
            <div class="card">
                <h2>VI. Đánh giá nguy cơ ngã (Morse)</h2>
                <div class="question-list">
                    <div class="question-item" style="flex-direction: column; align-items: flex-start;">
                        <label style="margin-bottom: 10px; font-weight: 600;">1. Tiền sử té ngã: vừa mới xảy ra hoặc trong vòng 3 tháng gần đây</label>
                        <div class="radio-options @error('morse.tien_su_te_nga') is-invalid @enderror" style="flex-direction: column; gap: 8px; width: 100%;">
                            <label class="checkbox-item" style="width: 100%;"><input type="radio" name="morse[tien_su_te_nga]" value="0" {{ old('morse.tien_su_te_nga') === '0' ? 'checked' : '' }}> Không (0đ)</label>
                            <label class="checkbox-item" style="width: 100%;"><input type="radio" name="morse[tien_su_te_nga]" value="25" {{ old('morse.tien_su_te_nga') === '25' ? 'checked' : '' }}> Có (25đ)</label>
                        </div>
                        @error('morse.tien_su_te_nga') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="question-item" style="flex-direction: column; align-items: flex-start;">
                        <label style="margin-bottom: 10px; font-weight: 600;">2. Có bệnh lý đi kèm</label>
                        <div class="radio-options @error('morse.benh_ly_di_kem') is-invalid @enderror" style="flex-direction: column; gap: 8px; width: 100%;">
                            <label class="checkbox-item" style="width: 100%;"><input type="radio" name="morse[benh_ly_di_kem]" value="0" {{ old('morse.benh_ly_di_kem') === '0' ? 'checked' : '' }}> Không (0đ)</label>
                            <label class="checkbox-item" style="width: 100%;"><input type="radio" name="morse[benh_ly_di_kem]" value="15" {{ old('morse.benh_ly_di_kem') === '15' ? 'checked' : '' }}> Có (15đ)</label>
                        </div>
                        @error('morse.benh_ly_di_kem') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="question-item" style="flex-direction: column; align-items: flex-start;">
                        <label style="margin-bottom: 10px; font-weight: 600;">3. Đang có đường truyền dịch/catheter</label>
                        <div class="radio-options @error('morse.duong_truyen_dich') is-invalid @enderror" style="flex-direction: column; gap: 8px; width: 100%;">
                            <label class="checkbox-item" style="width: 100%;"><input type="radio" name="morse[duong_truyen_dich]" value="0" {{ old('morse.duong_truyen_dich') === '0' ? 'checked' : '' }}> Không (0đ)</label>
                            <label class="checkbox-item" style="width: 100%;"><input type="radio" name="morse[duong_truyen_dich]" value="20" {{ old('morse.duong_truyen_dich') === '20' ? 'checked' : '' }}> Có (20đ)</label>
                        </div>
                        @error('morse.duong_truyen_dich') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="question-item" style="flex-direction: column; align-items: flex-start;">
                        <label style="margin-bottom: 10px; font-weight: 600;">4. Sử dụng hỗ trợ đi lại</label>
                        <div class="radio-options @error('morse.ho_tro_di_lai') is-invalid @enderror" style="flex-direction: column; gap: 8px; width: 100%;">
                            <label class="checkbox-item" style="width: 100%;"><input type="radio" name="morse[ho_tro_di_lai]" value="0" {{ old('morse.ho_tro_di_lai') === '0' ? 'checked' : '' }}> Đi lại không cần hỗ trợ/nghỉ ngơi tại giường/ điều dưỡng hỗ trợ (0đ)</label>
                            <label class="checkbox-item" style="width: 100%;"><input type="radio" name="morse[ho_tro_di_lai]" value="15" {{ old('morse.ho_tro_di_lai') === '15' ? 'checked' : '' }}> Xe lăn/nạng chống/khung tập đi (15đ)</label>
                            <label class="checkbox-item" style="width: 100%;"><input type="radio" name="morse[ho_tro_di_lai]" value="30" {{ old('morse.ho_tro_di_lai') === '30' ? 'checked' : '' }}> Phải vịn vào bàn ghế/tường/thành giường (30đ)</label>
                        </div>
                        @error('morse.ho_tro_di_lai') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="question-item" style="flex-direction: column; align-items: flex-start;">
                        <label style="margin-bottom: 10px; font-weight: 600;">5. Bất thường khi di chuyển</label>
                        <div class="radio-options @error('morse.bat_thuong_di_chuyen') is-invalid @enderror" style="flex-direction: column; gap: 8px; width: 100%;">
                            <label class="checkbox-item" style="width: 100%;"><input type="radio" name="morse[bat_thuong_di_chuyen]" value="0" {{ old('morse.bat_thuong_di_chuyen') === '0' ? 'checked' : '' }}> Bình thường/nằm trên giường/bất động (0đ)</label>
                            <label class="checkbox-item" style="width: 100%;"><input type="radio" name="morse[bat_thuong_di_chuyen]" value="10" {{ old('morse.bat_thuong_di_chuyen') === '10' ? 'checked' : '' }}> Yếu (10đ)</label>
                            <label class="checkbox-item" style="width: 100%;"><input type="radio" name="morse[bat_thuong_di_chuyen]" value="20" {{ old('morse.bat_thuong_di_chuyen') === '20' ? 'checked' : '' }}> Không thăng bằng (20đ)</label>
                        </div>
                        @error('morse.bat_thuong_di_chuyen') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="question-item" style="flex-direction: column; align-items: flex-start;">
                        <label style="margin-bottom: 10px; font-weight: 600;">6. Tình trạng tinh thần</label>
                        <div class="radio-options @error('morse.tinh_trang_tinh_than') is-invalid @enderror" style="flex-direction: column; gap: 8px; width: 100%;">
                            <label class="checkbox-item" style="width: 100%;"><input type="radio" name="morse[tinh_trang_tinh_than]" value="0" {{ old('morse.tinh_trang_tinh_than') === '0' ? 'checked' : '' }}> Định hướng được bản thân (0đ)</label>
                            <label class="checkbox-item" style="width: 100%;"><input type="radio" name="morse[tinh_trang_tinh_than]" value="15" {{ old('morse.tinh_trang_tinh_than') === '15' ? 'checked' : '' }}> Quên, lú lẫn (15đ)</label>
                        </div>
                        @error('morse.tinh_trang_tinh_than') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn">LƯU PHIẾU ĐÁNH GIÁ</button>
        </form>
    </div>

    <script>
        const heightInput = document.getElementById('height');
        const weightInput = document.getElementById('weight');
        const bmiInput = document.getElementById('bmi');

        function calculateBMI() {
            const h = parseFloat(heightInput.value);
            const w = parseFloat(weightInput.value);
            if (h > 0 && w > 0) {
                const bmi = w / (h * h);
                bmiInput.value = bmi.toFixed(1);
                
                // Auto-select MNA BMI score
                let mnaBmiValue = "0";
                if (bmi >= 23) mnaBmiValue = "3";
                else if (bmi >= 21) mnaBmiValue = "2";
                else if (bmi >= 19) mnaBmiValue = "1";
                
                const bmiRadios = document.querySelectorAll('input[name="mna[bmi_score]"]');
                bmiRadios.forEach(radio => {
                    if (radio.value === mnaBmiValue) radio.checked = true;
                });
            }
        }

        heightInput.addEventListener('input', calculateBMI);
        weightInput.addEventListener('input', calculateBMI);

        // Mini-Cog toggle logic
        const memoryContent = document.getElementById('minicog-memory-content');
        const btnRemembered = document.getElementById('btn-remembered');
        const btnShowMemory = document.getElementById('btn-show-memory');

        btnRemembered.addEventListener('click', function() {
            memoryContent.style.display = 'none';
            btnShowMemory.style.display = 'block';
        });

        btnShowMemory.addEventListener('click', function() {
            memoryContent.style.display = 'block';
            btnShowMemory.style.display = 'none';
        });

        // Drug allergy toggle
        const drugAllergyRadios = document.querySelectorAll('input[name="other[has_drug_allergy]"]');
        const drugAllergyRow = document.getElementById('drug-allergy-detail-row');
        
        drugAllergyRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === '1') {
                    drugAllergyRow.style.display = 'table-row';
                } else {
                    drugAllergyRow.style.display = 'none';
                }
            });
        });

        // Auto-scroll to first validation error
        window.addEventListener('load', function() {
            const firstError = document.querySelector('.is-invalid, .error-message');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    </script>
</body>
</html>
