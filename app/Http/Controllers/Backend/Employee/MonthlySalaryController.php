<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
use PDF;
use App\Model\Designation;
use App\Model\EmployeeSalary;
use App\Model\EmployeeLeave;
use App\Model\LeavePurpose;
use App\Model\EmployeeAttendance;

class MonthlySalaryController extends Controller
{
    //
    public function view(){               
      return view('backend.layouts.employee.monthly_salary.view');
    }

    public function getMonthlySalary(Request $request){
        //dd('ok');
        $date = date('Y-m',strtotime($request->date));
  
        if($date != ''){
          $where[] = ['date','like',$date.'%'];
        }
  
        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        $html['thsource']  ='<th>SL</th>';
        $html['thsource'] .='<th>Employee Name</th>';
        $html['thsource'] .='<th>Basic Salary</th>';
        $html['thsource'] .='<th>Salary (This Month)</th>';
        $html['thsource'] .='<th>Action</th>';
  
        foreach( $data as $key=> $attend ){
            $totalattend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$attend->employee_id)->get();
            $absentcount=count($totalattend->where('attend_status','Absent'));
          $color='success';
          $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
          $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
          $html[$key]['tdsource'] .= '<td>'.number_format($attend['user']['salary'],2).'TK'.'</td>';          
          
          $salary = (float)$attend['user']['salary'];
          $perdaysalary = (float)$salary/30;
          $totalsalarydeduct = (int)$absentcount*(float)$perdaysalary;
          $totalsalary = (int)$salary-(int)$totalsalarydeduct;
          $html[$key]['tdsource'] .= '<td>'.number_format($totalsalary,2).'Tk'.'</td>';
          $html[$key]['tdsource'] .= '<td>';
          $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="Payslip" target="_blank" href="'.route("employee.monthly.salary.payslip",$attend->employee_id).'"> Pay Slip </a>';
          $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json($html);
        
    }

    public function salaryPayslip($employee_id,Request $request){
      $id = EmployeeAttendance::where('employee_id',$employee_id)->first();
      $date = date('Y-m',strtotime($id->date));
  
        if($date != ''){
          $where[] = ['date','like',$date.'%'];
        }  
      $data['details']= EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$id->employee_id)->get();
      $pdf = PDF::loadView('backend.layouts.pdf.monthly-salary-payslip', $data);
      //$pdf->SetProtection(['copy', 'print'], '', 'pass');
      return $pdf->stream('Employee_Monthly-Salary_Pay_Slip.pdf');
  
    }
}
