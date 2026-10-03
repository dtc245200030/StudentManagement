@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Form Nhập Điểm -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold text-primary">
                <i class="fa-solid fa-pen-to-square me-1"></i> Nhập Điểm Số
            </div>
            <div class="card-body">
                <form action="{{ route('grades.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Chọn Sinh Viên</label>
                        <select name="student_id" class="form-select" required>
                            <option value="">-- Chọn sinh viên --</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->student_code }} - {{ $student->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tên Môn Học</label>
                        <input type="text" name="subject_name" class="form-control" placeholder="VD: Triển khai hệ thống" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Điểm Số (Hệ 10)</label>
                        <input type="number" step="0.1" min="0" max="10" name="score" class="form-control" placeholder="VD: 8.5" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-save me-1"></i> Lưu Điểm Số</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bảng Bảng Điểm -->
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold text-dark">
                <i class="fa-solid fa-clipboard-list me-1"></i> Bảng Điểm Tổng Hợp
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Mã SV</th>
                            <th>Họ và Tên</th>
                            <th>Môn Học</th>
                            <th class="text-center">Điểm Số</th>
                            <th class="text-center">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($grades as $grade)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $grade->student->student_code ?? 'N/A' }}</span></td>
                                <td class="fw-bold">{{ $grade->student->fullname ?? 'N/A' }}</td>
                                <td>{{ $grade->subject_name }}</td>
                                <td class="text-center">
                                    <span class="badge bg-success fs-6">{{ $grade->score }}</span>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('grades.destroy', $grade->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa điểm này?')">
                                            <i class="fa-solid fa-trash"></i> Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Chưa có dữ liệu điểm số.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
