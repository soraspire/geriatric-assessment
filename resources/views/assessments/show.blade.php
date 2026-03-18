<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả Đánh Giá Lão Khoa</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text: #1e293b;
            --border: #e2e8f0;
            --radius: 12px;
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
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

        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 32px;
            box-shadow: var(--shadow);
            margin-bottom: 24px;
            border: 1px solid var(--border);
        }

        h1, h2, h3 {
            color: #1e3a8a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        th {
            background-color: #f1f5f9;
            font-weight: 600;
        }

        .status-risk {
            color: #dc2626;
            font-weight: 600;
        }

        .status-normal {
            color: #16a34a;
            font-weight: 600;
        }

        .patient-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px 15px;
            margin-bottom: 20px;
        }

        .patient-info p {
            margin: 0;
        }

        .btn {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
        }

        .section-interpretation {
            margin-top: 30px;
            padding-top: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Kết Quả Đánh Giá Lão Khoa Toàn Diện</h1>
            <div class="patient-info">
                <p><strong>Bệnh nhân:</strong> {{ $assessment->patient_name }}</p>
                <p><strong>Năm sinh:</strong> {{ $assessment->birth_year }}</p>
                <p><strong>Giới tính:</strong> {{ $assessment->gender == 1 ? 'Nam' : 'Nữ' }}</p>
                <p><strong>Điện thoại:</strong> {{ $assessment->phone_number ?? 'N/A' }}</p>
                <p><strong>Nghề nghiệp:</strong> {{ $assessment->previous_job ?? 'N/A' }}</p>
                <p><strong>BMI:</strong> {{ $assessment->bmi }}</p>
            </div>

            <h2>KẾT QUẢ TEST</h2>
            <table>
                <thead>
                    <tr>
                        <th>Lĩnh vực (Domains)</th>
                        <th>Điểm bình thường / Tối đa</th>
                        <th>Điểm bệnh nhân</th>
                        <th>Kết quả</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Đa bệnh lý (CCI)</td>
                        <td>0 / {{ $results['cci']['max'] }}</td>
                        <td>{{ $results['cci']['score'] }}</td>
                        <td class="{{ $results['cci']['is_risk'] ? 'status-risk' : 'status-normal' }}">
                            {{ $results['cci']['status'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>Sàng lọc sa sút trí tuệ (Mini-Cog)</td>
                        <td>{{ $results['minicog']['normal'] }} / {{ $results['minicog']['max'] }}</td>
                        <td>{{ $results['minicog']['score'] }}</td>
                        <td class="{{ $results['minicog']['is_risk'] ? 'status-risk' : 'status-normal' }}">
                            {{ $results['minicog']['status'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>Dinh dưỡng bệnh nhân (MNA)</td>
                        <td>{{ $results['mna']['normal'] }} / {{ $results['mna']['max'] }}</td>
                        <td>{{ $results['mna']['score'] }}</td>
                        <td class="{{ $results['mna']['is_risk'] ? 'status-risk' : 'status-normal' }}">
                            {{ $results['mna']['status'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>Suy yếu (CFS)</td>
                        <td>{{ $results['cfs']['normal'] }} / {{ $results['cfs']['max'] }}</td>
                        <td>{{ $results['cfs']['score'] }}</td>
                        <td class="{{ $results['cfs']['is_risk'] ? 'status-risk' : 'status-normal' }}">
                            {{ $results['cfs']['status'] }} <br>
                            Mức độ: {{ $results['cfs']['interpretation'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>Đánh giá nguy cơ té ngã (Morse)</td>
                        <td>{{ $results['morse']['normal'] }} / {{ $results['morse']['max'] }}</td>
                        <td>{{ $results['morse']['score'] }}</td>
                        <td class="{{ $results['morse']['is_risk'] ? 'status-risk' : 'status-normal' }}">
                            {{ $results['morse']['status'] }} <br>
                            Mức độ: {{ $results['morse']['interpretation'] }}
                        </td>
                    </tr>

                </tbody>
            </table>

            <div class="section-interpretation">
                <h2>ĐÁNH GIÁ CHI TIẾT</h2>
                
                <div style="margin-top: 20px;">
                    <h3>1. Tiền sử bản thân (CCI)</h3>
                    <p><strong>Kết luận:</strong> {{ $results['cci']['interpretation'] }}</p>
                    @php
                        $activeCci = [];
                        $cciLabels = [
                            'nhoi_mau_co_tim' => 'Nhồi máu cơ tim',
                            'suy_tim' => 'Suy tim',
                            'benh_mach_mau_ngoai_vi' => 'Bệnh mạch máu ngoại vi',
                            'benh_mach_nao' => 'Bệnh mạch não (CVA hoặc TIA)',
                            'hen_phe_quan_copd' => 'Hen phế quản, COPD',
                            'dai_thao_duong_chua_bien_chung' => 'Đái tháo đường (chưa biến chứng)',
                            'tram_cam' => 'Trầm cảm',
                            'dung_thuoc_chong_dong_mau' => 'Dùng thuốc chống đông máu',
                            'alzheimer_suy_giam_tri_nho' => 'Alzheimer hay suy giảm trí nhớ',
                            'benh_mo_lien_ket' => 'Bệnh mô liên kết',
                            'tang_huyet_ap' => 'Tăng huyết áp',
                            'liet_nua_nguoi' => 'Liệt nửa người',
                            'dai_thao_duong_co_bien_chung' => 'Đái tháo đường có biến chứng',
                            'benh_than_trung_binh_nang' => 'Bệnh thận mức độ trung bình/nặng',
                            'ung_thu_tai_cho' => 'Ung thư (khối u tại chỗ chưa di căn)',
                            'benh_gan_man_tinh_vua_nang' => 'Bệnh gan mạn tính vừa đến nặng',
                            'ung_thu_di_can' => 'Ung thư di căn',
                            'hiv_aids' => 'HIV hoặc AIDS',
                        ];
                        if ($assessment->cciDetail) {
                            foreach ($cciLabels as $key => $label) {
                                if ($assessment->cciDetail->$key) $activeCci[] = $label;
                            }
                        }
                    @endphp
                    @if(count($activeCci) > 0)
                        <p><strong>Các bệnh lý ghi nhận:</strong> {{ implode(', ', $activeCci) }}</p>
                    @else
                        <p><em>Không ghi nhận bệnh lý đồng diễn nào.</em></p>
                    @endif
                </div>

                <div style="margin-top: 20px;">
                    <h3>2. Sàng lọc sa sút trí tuệ (Mini-Cog)</h3>
                    <p><strong>Kết luận:</strong> {{ $results['minicog']['interpretation'] }}</p>
                </div>

                <div style="margin-top: 20px;">
                    <h3>3. Dinh dưỡng (MNA)</h3>
                    <p><strong>Kết luận:</strong> {{ $results['mna']['interpretation'] }}</p>
                </div>

                <div style="margin-top: 20px;">
                    <h3>4. Suy yếu lâm sàng (CFS)</h3>
                    <p><strong>Kết luận:</strong> {{ $results['cfs']['interpretation'] }}</p>
                </div>

                <div style="margin-top: 20px;">
                    <h3>5. Nguy cơ té ngã (Morse)</h3>
                    <p><strong>Kết luận:</strong> {{ $results['morse']['interpretation'] }}</p>
                </div>
            </div>

            <a href="{{ route('assessments.create') }}" class="btn">TẠO PHIẾU MỚI</a>
        </div>
    </div>
</body>
</html>
