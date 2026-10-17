<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('studentClass')->get();
        $classes = StudentClass::all();

        return view('students.index', compact('students', 'classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_code' => ['required', 'string', 'max:50', 'regex:/^[A-Za-z0-9_-]+$/', 'unique:students,student_code'],
            'fullname' => ['required', 'string', 'max:255'],
            'class_id' => ['required', 'integer', 'exists:student_classes,id'],
        ]);

        Student::create($validated);

        return redirect()->back()->with('success', 'Thêm sinh viên thành công!');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->back()->with('success', 'Xóa sinh viên thành công!');
    }
}
