@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Form Thêm Sinh Viên -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold text-primary">
                <i class="fa-solid fa-user-plus me-1"></i> Thêm Sinh Viên Mới
            </div>
            <div class="card-body">
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Mã Sinh Viên</label>
                        <input type="text" name="student_code" class="form-control" placeholder="VD: SV001" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Họ và Tên</label>
                        <input type="text" name="fullname" class="form-control" placeholder="VD: Nguyễn Văn A" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lớp Học</label>
                        <select name="class_id" class="form-select" required>
                            <option value="">-- Chọn lớp --</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }} ({{ $class->class_code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-save me-1"></i> Thêm Sinh Viên</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bảng Danh Sách Sinh Viên -->
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold text-dark">
                <i class="fa-solid fa-users me-1"></i> Danh Sách Sinh Viên
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Mã SV</th>
                            <th>Họ và Tên</th>
                            <th>Lớp</th>
                            <th class="text-center">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td><span class="badge bg-info text-dark">{{ $student->student_code }}</span></td>
                                <td class="fw-bold">{{ $student->fullname }}</td>
                                <td>{{ $student->studentClass->class_name ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa sinh viên này?')">
                                            <i class="fa-solid fa-trash"></i> Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Chưa có dữ liệu sinh viên.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
