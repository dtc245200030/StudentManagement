@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Form Thêm Lớp -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold text-primary">
                <i class="fa-solid fa-plus-circle me-1"></i> Thêm Lớp Học Mới
            </div>
            <div class="card-body">
                <form action="{{ route('classes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Mã Lớp</label>
                        <input type="text" name="class_code" class="form-control" placeholder="VD: CNTT_K61" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tên Lớp</label>
                        <input type="text" name="class_name" class="form-control" placeholder="VD: Công nghệ thông tin K61" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-save me-1"></i> Lưu Lớp Học</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bảng Danh Sách Lớp -->
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold text-dark">
                <i class="fa-solid fa-list me-1"></i> Danh Sách Lớp Học
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Mã Lớp</th>
                            <th>Tên Lớp</th>
                            <th class="text-center">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($classes as $index => $class)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><span class="badge bg-secondary">{{ $class->class_code }}</span></td>
                                <td class="fw-bold">{{ $class->class_name }}</td>
                                <td class="text-center">
                                    <form action="{{ route('classes.destroy', $class->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa lớp này?')">
                                            <i class="fa-solid fa-trash"></i> Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Chưa có dữ liệu lớp học.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
