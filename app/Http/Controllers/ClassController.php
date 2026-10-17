<?php

namespace App\Http\Controllers;

use App\Models\StudentClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = StudentClass::all();

        return view('classes.index', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_code' => ['required', 'string', 'max:50', 'regex:/^[A-Za-z0-9_-]+$/', 'unique:student_classes,class_code'],
            'class_name' => ['required', 'string', 'max:255'],
        ]);

        StudentClass::create($validated);

        return redirect()->back()->with('success', 'Thêm lớp học thành công!');
    }

    public function destroy(StudentClass $class)
    {
        $class->delete();

        return redirect()->back()->with('success', 'Xóa lớp học thành công!');
    }
}
