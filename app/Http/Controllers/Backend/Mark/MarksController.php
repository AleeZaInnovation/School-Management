<?php

namespace App\Http\Controllers\Backend\Mark;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use Hash;
use App\Model\Year;
use App\Model\StudentClass;
use App\Model\StudentMarks;
use App\Model\ExamType;
use App\User;
use DB;
use PDF;
class MarksController extends Controller
{
    //
    public function add(){
        $data['year'] = Year::orderBy('id','DESC')->get();
        $data['class'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();
        
        //dd($data['year_id']);
        
      return view('backend.layouts.mark.add', $data);
    }

    public function store(Request $request){
      //dd('ok');
      if($request->student_id !=null){
        for($i=0; $i<count($request->student_id); $i++){
        $data = New StudentMarks();
        $data->year_id = $request->year_id;
        $data->class_id = $request->class_id;
        $data->assign_subject_id = $request->assign_subject_id;
        $data->exam_type_id = $request->exam_type_id;
        $data->student_id = $request->student_id[$i];        
        $data->id_no = $request->id_no[$i];
        $data->marks = $request->marks[$i];
        $data->save();
        }
      }else{
        return redirect()->back()->with('error', 'Sorry! There is no student!');
      }
      return redirect()->route('mark.add')->with('success', 'Student Mark Generated Successfully');
    }

    public function edit(){
      $data['year'] = Year::orderBy('id','DESC')->get();
      $data['class'] = StudentClass::all();
      $data['exam_types'] = ExamType::all();
      
      //dd($data['year_id']);
      
    return view('backend.layouts.mark.edit', $data);
  }

  public function getMarks(Request $request){
    //dd('ok');
    $data = StudentMarks::with(['student'])->where('year_id',$request->year_id)->where('class_id',$request->class_id)->where('assign_subject_id',$request->assign_subject_id)->where('exam_type_id',$request->exam_type_id)->get();

    return response()->json($data);
  }

  public function update(Request $request){
    //dd('ok');
    StudentMarks::where('year_id',$request->year_id)->where('class_id',$request->class_id)->where('assign_subject_id',$request->assign_subject_id)->where('exam_type_id',$request->exam_type_id)->delete();
    if($request->student_id !=null){
      for($i=0; $i<count($request->student_id); $i++){
      $data = New StudentMarks();
      $data->year_id = $request->year_id;
      $data->class_id = $request->class_id;
      $data->assign_subject_id = $request->assign_subject_id;
      $data->exam_type_id = $request->exam_type_id;
      $data->student_id = $request->student_id[$i];        
      $data->id_no = $request->id_no[$i];
      $data->marks = $request->marks[$i];
      $data->save();
      }
    }else{
      return redirect()->back()->with('error', 'Sorry! There is no student!');
    }
    return redirect()->route('mark.edit')->with('success', 'Student Mark Generated Successfully');
  }
}