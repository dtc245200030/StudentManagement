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
        $request->validate([
            'class_code' => 'required|unique:student_classes',
            'class_name' => 'required',
        ]);

        StudentClass::create($request->all());
        return redirect()->back()->with('success', 'Thêm lớp học thành công!');
    }

    public function destroy($id)
    {
        StudentClass::destroy($id);
        return redirect()->back()->with('success', 'Xóa lớp học thành công!');
    }
}
