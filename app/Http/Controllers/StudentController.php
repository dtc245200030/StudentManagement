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
        $request->validate([
            'student_code' => 'required|unique:students',
            'fullname'     => 'required',
            'class_id'     => 'required|exists:student_classes,id',
        ]);

        Student::create($request->all());
        return redirect()->back()->with('success', 'Thêm sinh viên thành công!');
    }

    public function destroy($id)
    {
        Student::destroy($id);
        return redirect()->back()->with('success', 'Xóa sinh viên thành công!');
    }
}
