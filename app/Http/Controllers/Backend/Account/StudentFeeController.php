<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Group;
use App\Model\Year;
use App\Model\StudentClass;
use App\User;
use App\Model\FeeCategory;
use App\Model\FeeAmount;
use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use App\Model\AccountStudentFee;

class StudentFeeController extends Controller
{
    //
    public function view(){
      
        $data['data'] = AccountStudentFee::all();
      return view('backend.layouts.account.student.view', $data);
    }
    
    public function add(){
      
        $data['year'] = Year::orderBy('id','DESC')->get();
        $data['class'] = StudentClass::all();
        $data['fee_category'] = FeeCategory::all();
        //dd($data['year_id']);
        
      return view('backend.layouts.account.student.add-edit', $data);
    }

    
    public function feeGetStudent(Request $request){
      //dd('ok');
      $year_id = $request->year_id;
      $class_id = $request->class_id;
      $date = date('Y-m',strtotime($request->date));
      $fee_category_id = $request->fee_category_id;

      if($year_id != ''){
        $where[] = ['year_id','like',$year_id.'%'];
      }

      if($class_id != ''){
        $where[] = ['class_id','like',$class_id.'%'];
      }

      $allstudents = AssignStudent::with(['discount'])->where($where)->get();
      $html['thsource']  ='<th>ID No</th>';
      $html['thsource'] .='<th>Student Name</th>';
      $html['thsource'] .='<th>Father Name</th>';
      $html['thsource'] .='<th>Original Fee</th>';
      $html['thsource'] .='<th>Discount Amount</th>';
      $html['thsource'] .='<th>Fee (This Student) </th>';
      $html['thsource'] .='<th>Select</th>';
      foreach( $allstudents as $key=> $v ){
        $student_fee = FeeAmount::where('fee_category_id',$fee_category_id)->where('class_id',$v->class_id)->first();
        $accountsstudentfees = AccountStudentFee::where('student_id',$v->student_id)->where('year_id',$v->year_id)->where('class_id',$v->class_id)->where('fee_category_id',$fee_category_id)->where('date',$date)->first();
        if($accountsstudentfees != Null){
          $checked = 'checked';
        }else{
          $checked = '';
        }
        $color='success';
        $html[$key]['tdsource']  = '<td>'.$v['student']['id_no'].'<input type="hidden" name="fee_category_id" value="'.$fee_category_id.'">'.'</td>';
        $html[$key]['tdsource'] .= '<td>'.$v['student']['name'].'<input type="hidden" name="year_id" value="'.$v->year_id.'">'.'</td>';
        $html[$key]['tdsource'] .= '<td>'.$v['student']['fname'].'<input type="hidden" name="class_id" value="'.$v->class_id.'">'.'</td>';
        $html[$key]['tdsource'] .= '<td>'.$student_fee->amount.'TK'.'<input type="hidden" name="date" value="'.$date.'">'.'</td>';
        $html[$key]['tdsource'] .= '<td>'.$v['discount']['discount'].'%'.'</td>';

        

        $originalfee = $student_fee->amount;
        $discount = $v['discount']['discount'];
        $discountablefee = $discount/100*$originalfee;
        $finalfee = (float)$originalfee-(float)$discountablefee;

        $html[$key]['tdsource'] .= '<td>'.'<input type="text" name="amount[]" value="'.$finalfee.'" class="form-control" readonly>'.'</td>';
        $html[$key]['tdsource'] .= '<td>' .'<input type="hidden" name="student_id[]" value="'.$v->student_id.'">'.'<input type="checkbox" name="checkmanage[]" vlaue="'.$key.'" '.$checked.' style="transform: scale(1.5);margin-left: 10px;">'.'</td>';
      }
    return response()->json(@$html);    
    }

    public function store(Request $request){
      //dd('ok');
      $year_id = $request->year_id;
      $class_id = $request->class_id;
      $date = date('Y-m',strtotime($request->date));
      $fee_category_id = $request->fee_category_id;

      AccountStudentFee::where('year_id',$year_id)->where('class_id',$class_id)->where('fee_category_id',$fee_category_id)->where('date',$date)->delete();

      $checkdata = $request->checkmanage;
      if($checkdata !=NULL){
          for($i=0; $i < count($checkdata); $i++){
              $data = new AccountStudentFee();
              $data->year_id = $year_id;
              $data->class_id = $class_id;
              $data->fee_category_id = $fee_category_id;
              $data->date = $date;
              $data->student_id = $request->student_id[$i];
              $data->amount = $request->amount[$i];
              $data->save();
          }
      }

        if(!empty(@$data) || empty($checkdata)){
          return redirect()->route('accounts.student.fee.view')->with('success', 'Student Fee Received Successfully');
        }else{
          return redirect()->back()->with('error', 'Sorry No data saved');
        }

    }

}

