@extends('layouts.dashboard')

@section('title', 'Quản lý phiếu đánh giá')

@section('styles')
<style>
    .filter-section {
        margin-bottom: 24px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        align-items: end;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group label {
        font-size: 14px;
        font-weight: 500;
        color: #64748b;
    }

    .form-group input, .form-group select {
        padding: 10px;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-family: inherit;
    }

    .custom-select {
        width: 120px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='black'%3E%3Cpath d='M5 7l5 5 5-5'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 8px center;
        background-size: 20px;
    }

    .btn-filter {
        background: var(--primary);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-reset {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid var(--border);
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 16px;
        text-align: left;
        border-bottom: 1px solid var(--border);
        font-size: 14px;
    }

    th {
        background: #f8fafc;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    tr:hover {
        background: #f8fafc;
    }

    .badge {
        padding: 4px 8px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-risk {
        background: #fee2e2;
        color: #dc2626;
    }

    .badge-normal {
        background: #f0fdf4;
        color: #16a34a;
    }

    .pagination {
        margin-top: 24px;
        display: flex;
        justify-content: center;
        gap: 8px;
    }
    
    /* Simple pagination styling override */
    .pagination nav {
        display: flex;
        gap: 4px;
    }
    .pagination span, .pagination a {
        padding: 8px 12px;
        border: 1px solid var(--border);
        border-radius: 6px;
        text-decoration: none;
        color: var(--text);
    }
    .pagination .active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1>Quản lý phiếu đánh giá</h1>
</div>

<div class="card">
    <form action="{{ route('assessments.index') }}" method="GET" class="filter-section">
        <div style="display: flex; gap: 20px;">
            <div class="form-group" style="width: 250px;">
                <label>Tên bệnh nhân</label>
                <input type="text" name="name" value="{{ request('name') }}" placeholder="Nhập tên...">
            </div>
            <div class="form-group">
                <label>Tuổi trên</label>
                <input type="number" name="age" value="{{ request('age') }}" placeholder="Ví dụ: 60">
            </div>
            <div class="form-group">
                <label>Giới tính</label>
                <select name="gender" class="custom-select">
                    <option value="">Tất cả</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>Nam</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>Nữ</option>
                </select>
            </div>
        </div>
        <div style="display: flex; gap: 8px; margin: 20px 0;">
            <button type="submit" class="btn-filter">TÌM KIẾM</button>
            <a href="{{ route('assessments.index') }}" class="btn-reset">LÀM MỚI</a>
        </div>
        <hr>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Bệnh nhân</th>
                <th>Tuổi</th>
                <th>Giới tính</th>
                <th>CCI</th>
                <th>Mini-Cog</th>
                <th>MNA</th>
                <th>CFS</th>
                <th>Morse</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($assessments as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td><strong>{{ $item->patient_name }}</strong></td>
                <td>{{ date('Y') - $item->birth_year }}</td>
                <td>{{ $item->gender == 1 ? 'Nam' : 'Nữ' }}</td>
                <td>
                    <span class="badge {{ $item->cci_total_score > 0 ? 'badge-risk' : 'badge-normal' }}">
                        {{ $item->cci_total_score }}đ
                    </span>
                </td>
                <td>
                    <span class="badge {{ $item->results['minicog']['is_risk'] ? 'badge-risk' : 'badge-normal' }}">
                        {{ $item->minicog_total_score }}đ
                    </span>
                </td>
                <td>
                    <span class="badge {{ $item->results['mna']['is_risk'] ? 'badge-risk' : 'badge-normal' }}">
                        {{ $item->mna_total_score }}đ
                    </span>
                </td>
                <td>
                    <span class="badge {{ $item->results['cfs']['is_risk'] ? 'badge-risk' : 'badge-normal' }}">
                        {{ $item->cfs_total_score }}đ
                    </span>
                </td>
                <td>
                    <span class="badge {{ $item->results['morse']['is_risk'] ? 'badge-risk' : 'badge-normal' }}">
                        {{ $item->morse_total_score }}đ
                    </span>
                </td>
                <td>
                    <a href="{{ route('assessments.show', $item->uuid) }}" target="_blank" style="color: var(--primary); font-weight: 600; text-decoration: none;">Xem chi tiết</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="text-align: center; color: #64748b; padding: 40px;">Không tìm thấy phiếu nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $assessments->appends(request()->query())->links() }}
    </div>
</div>
@endsection
