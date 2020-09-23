<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Http\Requests\StudentRequest;
use DB;
class StudentController extends Controller
{
    public function insert(StudentRequest $request){
        $student=new Student;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save();
        return "ok";
    }
    public function search($searchQuery){
        $result = Student::where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('email', 'like', '%' . $searchQuery . '%')
                ->orWhere('phone', 'like', '%' . $searchQuery . '%')
                ->paginate(5);
                return response()->json($result);
    }

    public function show(){
        $student=Student::orderBy('name','ASC')->paginate(5);
        return response()->json($student);
    }
    public function edit($id){
        $student=Student::find($id);
        return response()->json($student);
    }
    public function update($id){
        $student=Student::find($id);
        $student->name = request()->name;
        $student->email = request()->email;
        $student->phone = request()->phone;
        $student->save();
    }
    public function destroy($id){
        $student=Student::find($id)->delete();
    }
    public function addpageIndex(){
        return view('project.panelCenter');
    }
}
