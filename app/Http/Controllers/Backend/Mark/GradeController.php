<?php

namespace App\Http\Controllers\Backend\Mark;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\MarksGrade;

class GradeController extends Controller
{
    //
    public function view(){
        $data['data'] = MarksGrade::all();
      
      return view('backend.layouts.mark.grade-view', $data);
    }
    public function add(){
        
      return view('backend.layouts.mark.grade-add');
    }
    
    public function store(Request $request){
        
       $data = new MarksGrade;
       $data->grade_name = $request->grade_name;
       $data->grade_point = $request->grade_point;
       $data->start_marks = $request->start_marks;
       $data->end_marks = $request->end_marks;
       $data->start_point = $request->start_point;
       $data->end_point = $request->end_point;
       $data->remarks = $request->remarks;
       $data->save();

       // Redirect 
      return redirect()->route('mark.grade.view')->with('success', 'Grade Point Added Successfully');

    }

    public function edit($id){
        //dd('ok');
        $data['edits'] = MarksGrade::find($id);
    
        return view('backend.layouts.mark.grade-add', $data);    
    }

    public function update($id, Request $request){
      // Validation 
     // update
     $data = MarksGrade::find($id);
     $data->grade_name = $request->grade_name;
     $data->grade_point = $request->grade_point;
     $data->start_marks = $request->start_marks;
     $data->end_marks = $request->end_marks;
     $data->start_point = $request->start_point;
     $data->end_point = $request->end_point;
     $data->remarks = $request->remarks;
     $data->save();
    // Redirect
    return redirect()->route('mark.grade.view')->with('success', 'Grade Point Updated Successfully');
 }
}
