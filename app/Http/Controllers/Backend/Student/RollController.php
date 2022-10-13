<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use Hash;
use App\Model\Group;
use App\Model\Shift;
use App\Model\Year;
use App\Model\StudentClass;
use App\User;
use DB;
use PDF;

class RollController extends Controller
{
    //

    public function view(){
        
        $data['year'] = Year::orderBy('id','DESC')->get();
        $data['class'] = StudentClass::all();
        //dd($data['year_id']);
        
      return view('backend.layouts.student.roll.view', $data);
    }

    public function getStudent(Request $request){
      //dd('ok');
      $data = AssignStudent::with(['student'])->where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();

      return response()->json($data);
    }

    public function store(Request $request){
      //dd('ok');
      $year_id = $request->year_id;
      $class_id = $request->class_id;
      if($request->student_id !=null){
        for($i=0; $i<count($request->student_id); $i++)
        {
          AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->where('student_id',$request->student_id[$i])->update(['roll'=>$request->roll[$i]]);
        }
      }else{
        return redirect()->back()->with('error', 'Sorry! There is no student!');
      }
      return redirect()->route('student.roll.view')->with('success', 'Student Roll Generated Successfully');
    }
}
