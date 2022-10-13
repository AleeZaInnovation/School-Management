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
use App\Model\FeeCategory;
use App\Model\FeeAmount;
use App\Model\ExamType;

class ExamFeeController extends Controller
{
  //

  public function view(){
      
      $data['year'] = Year::orderBy('id','DESC')->get();
      $data['class'] = StudentClass::all();
      $data['exam_type'] = ExamType::all();
      //dd($data['year_id']);
      
    return view('backend.layouts.student.exam_fee.view', $data);
  }

  public function getExamFee(Request $request){
    //dd('ok');
    $year_id = $request->year_id;
    $class_id = $request->class_id;
    $exam_type_id = $request->exam_type_id;

    if($year_id != ''){
      $where[] = ['year_id','like',$year_id.'%'];
    }

    if($class_id != ''){
      $where[] = ['class_id','like',$class_id.'%'];
    }

    $allstudents = AssignStudent::with(['discount'])->where($where)->get();
    $html['thsource']  ='<th>SL</th>';
    $html['thsource'] .='<th>ID No</th>';
    $html['thsource'] .='<th>Student Name</th>';
    $html['thsource'] .='<th>Roll No</th>';
    $html['thsource'] .='<th>Exam Fee</th>';
    $html['thsource'] .='<th>Discount Amount</th>';
    $html['thsource'] .='<th>Fee (This Student) </th>';
    $html['thsource'] .='<th>Action</th>';

    foreach( $allstudents as $key=> $v ){
      $regfee = FeeAmount::where('fee_category_id','3')->where('class_id',$v->class_id)->first();
      $color='success';
      $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
      $html[$key]['tdsource'] .= '<td>'.$v['student']['id_no'].'</td>';
      $html[$key]['tdsource'] .= '<td>'.$v['student']['name'].'</td>';
      $html[$key]['tdsource'] .= '<td>'.$v->roll.'</td>';
      $html[$key]['tdsource'] .= '<td>'.$regfee->amount.'TK'.'</td>';
      $html[$key]['tdsource'] .= '<td>'.$v['discount']['discount'].'%'.'</td>';

      $originalfee = $regfee->amount;
      $discount = $v['discount']['discount'];
      $discountablefee = $discount/100*$originalfee;
      $finalfee = (float)$originalfee-(float)$discountablefee;

      $html[$key]['tdsource'] .= '<td>'.$finalfee.'TK'.'</td>';
      $html[$key]['tdsource'] .= '<td>';
      $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="Payslip" target="_blank" href="'.route("student.exam.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id. '&exam_type_id='.$request->exam_type_id.'"> Fee Slip </a>';
      $html[$key]['tdsource'] .= '</td>';
    }
  return response()->json($html);
  
}

  public function examFeePayslip(Request $request){

  $student_id = $request->student_id;
  $class_id = $request->class_id;
  $data['exam_name']= Examtype::where('id',$request->exam_type_id)->first()['name'];
  $data['details']= AssignStudent::with('discount','student')->where('student_id',$student_id)->where('class_id',$class_id)->first();
  $pdf = PDF::loadView('backend.layouts.pdf.exam-payslip', $data);
  //$pdf->SetProtection(['copy', 'print'], '', 'pass');
  return $pdf->stream('Student_Exam_Pay_Slip.pdf');

  }
}
