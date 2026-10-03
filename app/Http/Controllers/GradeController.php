<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with('student')->get();
        $students = Student::all();
        return view('grades.index', compact('grades', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id'   => 'required|exists:students,id',
            'subject_name' => 'required',
            'score'        => 'required|numeric|min:0|max:10',
        ]);

        Grade::create($request->all());
        return redirect()->back()->with('success', 'Thêm điểm thành công!');
    }

    public function destroy($id)
    {
        Grade::destroy($id);
        return redirect()->back()->with('success', 'Xóa điểm thành công!');
    }
}
