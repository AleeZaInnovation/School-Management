<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AccountEmlpoyeeSalary;
use App\Model\AccountOtherCost;
use App\Model\AccountStudentFee;
use App\Model\Year;
use App\Model\StudentClass;
use App\Model\StudentMarks;
use App\Model\ExamType;
use App\Model\MarksGrade;
use App\Model\AssignStudent;
use PDF;
use App\User;
use App\Model\EmployeeAttendance;


class ProfitController extends Controller
{
    //
    public function view(){      
      return view('backend.layouts.report.profit-view');
    }

    public function profit(Request $request){
        $start_date = date('Y-m',strtotime($request->start_date));
        $end_date = date('Y-m',strtotime($request->end_date));
        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));

        $student_fee = AccountStudentFee::whereBetween('date',[$start_date,$end_date])->sum('amount');
        $employee_salary = AccountEmlpoyeeSalary::whereBetween('date',[$start_date,$end_date])->sum('amount');
        $other_cost = AccountOtherCost::whereBetween('date',[$sdate,$edate])->sum('amount');
        $total_cost = $employee_salary+$other_cost;
        $profit = $student_fee-$total_cost;
  
        $html['thsource']  ='<th>Student Fee</th>';
        $html['thsource'] .='<th>Employee Salary</th>';
        $html['thsource'] .='<th>Other Costs</th>';
        $html['thsource'] .='<th>Total Cost</th>';
        $html['thsource'] .='<th>Profit or Loss </th>';
        $html['thsource'] .='<th>Action</th>';
        $color='success';
        $html['tdsource']   = '<td>'.$student_fee.'</td>';
        $html['tdsource']  .= '<td>'.$employee_salary.'</td>';
        $html['tdsource']  .= '<td>'.$other_cost.'</td>';
        $html['tdsource']  .= '<td>'.$total_cost.'</td>';
        $html['tdsource']  .= '<td>'.$profit.'</td>';
        $html['tdsource']  .= '<td>';
        $html['tdsource']  .= '<a class="btn btn-sm btn-'.$color.'" title="PDF" target="_blank" href="'.route("reports.profit.pdf").'?start_date='.$sdate.'&end_date='.$edate.'"><i class="fa fa-file"></i></a>';
        $html['tdsource']  .= '</td>';
        return response()->json(@$html);  
        
    }

    public function profitPdf(Request $request){

      $data['sdate'] = date('Y-m-d',strtotime($request->start_date));
      $data['edate'] = date('Y-m-d',strtotime($request->end_date));
      $data['start_date'] = date('Y-m',strtotime($request->start_date));
      $data['end_date'] = date('Y-m',strtotime($request->end_date));
      $data['student_fee'] = AccountStudentFee::whereBetween('date',[$data['start_date'],$data['end_date']])->sum('amount');
      $data['employee_salary'] = AccountEmlpoyeeSalary::whereBetween('date',[$data['start_date'],$data['end_date']])->sum('amount');
      $data['other_cost'] = AccountOtherCost::whereBetween('date',[$data['sdate'],$data['edate']])->sum('amount');
      $data['total_cost'] = $data['employee_salary']+$data['other_cost'] ;
      $data['profit'] = $data['student_fee']-$data['total_cost'];

      $pdf = PDF::loadView('backend.layouts.pdf.profit-report', $data);
      //$pdf->SetProtection(['copy', 'print'], '', 'pass');
      return $pdf->stream('Profit_Report.pdf');
    
    }

    public function marksheetView(){
        
      $data['year'] = Year::orderBy('id','DESC')->get();
      $data['class'] = StudentClass::all();
      $data['exam_types'] = ExamType::all();
      return view('backend.layouts.report.marksheet-view',$data);
    }

    public function marksheetGet(Request $request){     
      $year_id = $request->year_id;
      $class_id = $request->class_id;
      $exam_type_id = $request->exam_type_id;
      $id_no = $request->id_no;
      $data['count_fail'] = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->where('marks','<','33')->get()->count();  

      $singlestudent = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->first();  
      if($singlestudent == true){
        $data['allmarks'] = StudentMarks::with(['assign_subject','year','exam_type'])->where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->get();
        $data['assign_student'] = AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->first();

        //dd($data['allmarks']->toArray() );

        $data['allgreades'] = MarksGrade::all();
        
        $pdf = PDF::loadView('backend.layouts.pdf.marksheet-report', $data);
        //$pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Marks_Sheet_Report.pdf');

      }else{
        return redirect()->back()->with('error','Sorry data not found');
      }
      
    }

    public function attendanceView(){
        
      $data['data'] = User::where('usertype','employee')->get();
      return view('backend.layouts.report.attendance-view',$data);
    }

    public function attendanceGet(Request $request){     
      $employee_id = $request->employee_id;  
      if($employee_id != ''){
        $where[] = ['employee_id',$employee_id];
      } 
      $date = date('Y-m',strtotime($request->date)); 
      if($date != ''){
        $where[] = ['date','like',$date.'%'];
      }
      $singleattendance = EmployeeAttendance::with(['user'])->where($where)->first();
      if($singleattendance == true){
        $data['details'] = EmployeeAttendance::with(['user'])->where($where)->get();
        $data['absent'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status','Absent')->get()->count();
        $data['leave'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status','leave')->get()->count();
        $data['month'] = date('M Y',strtotime($request->date));
        $pdf = PDF::loadView('backend.layouts.pdf.attendance-report', $data);
        //$pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Attendance_Report.pdf');

      }else{
        return redirect()->back()->with('error','Sorry data not found');
      }
      
    }

    public function resultView(){
        
      $data['year'] = Year::orderBy('id','DESC')->get();
      $data['class'] = StudentClass::all();
      $data['exam_types'] = ExamType::all();
      return view('backend.layouts.report.result-view',$data);
    }

    public function resultGet(Request $request){     
      $year_id = $request->year_id;
      $class_id = $request->class_id;
      $exam_type_id = $request->exam_type_id;
      $singleresult = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->first();  
      if($singleresult == true){
        $data['allmarks'] = StudentMarks::select(['year_id','class_id','exam_type_id','student_id'])->where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->groupBy('year_id')->groupBy('class_id')->groupBy('exam_type_id')->groupBy('student_id')->get();
        //dd($data['allmarks']->toArray() );

        $data['allgreades'] = MarksGrade::all();
        
        $pdf = PDF::loadView('backend.layouts.pdf.result-report', $data);
        //$pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Result_Report.pdf');

      }else{
        return redirect()->back()->with('error','Sorry data not found');
      }
      
    }

    public function idCardView(){
        
      $data['year'] = Year::orderBy('id','DESC')->get();
      $data['class'] = StudentClass::all();
      return view('backend.layouts.report.id-card-view',$data);
    }

    public function idCardGet(Request $request){     
      $year_id = $request->year_id;
      $class_id = $request->class_id;
      $checkdata = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)->first();  
      if($checkdata == true){
        $data['details'] = AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->get();

        //dd($data['details']->toArray() );
        
        $pdf = PDF::loadView('backend.layouts.pdf.id-card-report', $data);
        //$pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Result_Report.pdf');

      }else{
        return redirect()->back()->with('error','Sorry data not found');
      }
      
    }

}

