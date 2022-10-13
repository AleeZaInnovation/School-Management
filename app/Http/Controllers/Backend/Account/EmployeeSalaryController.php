<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\EmployeeSalary;
use App\Model\EmployeeAttendance;
use App\Model\AccountEmlpoyeeSalary;

class EmployeeSalaryController extends Controller
{
    //
    public function view(){
      
        $data['data'] = AccountEmlpoyeeSalary::all();
      return view('backend.layouts.account.employee.view', $data);
    }
    
    public function add(){
      
        //dd('ok');
        
      return view('backend.layouts.account.employee.add-edit');
    }

    
    public function feeGetEmployee(Request $request ){
      //dd('ok');
      $date = date('Y-m',strtotime($request->date));
  
        if($date != ''){
          $where[] = ['date','like',$date.'%'];
        }
  
        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        $html['thsource']  ='<th>SL</th>';
        $html['thsource']  .='<th>ID No </th>';
        $html['thsource'] .='<th>Employee Name</th>';
        $html['thsource'] .='<th>Basic Salary</th>';
        $html['thsource'] .='<th>Salary (This Month)</th>';
        $html['thsource'] .='<th>Select</th>';
        foreach( $data as $key=> $attend ){
        $employee_salary = AccountEmlpoyeeSalary::where($where)->where('employee_id',$attend->employee_id)->first();
        if($employee_salary != Null){
          $checked = 'checked';
        }else{
          $checked = '';
        }
        $totalattend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$attend->employee_id)->get();
        $absentcount=count($totalattend->where('attend_status','Absent'));
        $color='success';
        $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
        $html[$key]['tdsource']  .= '<td>'.$attend['user']['id_no'].'<input type="hidden" name="date" value="'.$date.'">'.'</td>';
        $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
        $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'</td>';
        $salary = (float)$attend['user']['salary'];
        $perdaysalary = (float)$salary/30;
        $totalsalarydeduct = (int)$absentcount*(float)$perdaysalary;
        $totalsalary = (int)$salary-(int)$totalsalarydeduct;

        $html[$key]['tdsource'] .= '<td>'.'<input type="text" name="amount[]" value="'.$totalsalary.'" class="form-control" readonly>'.'</td>';
        $html[$key]['tdsource'] .= '<td>' .'<input type="hidden" name="employee_id[]" value="'.$attend->employee_id.'">'.'<input type="checkbox" name="checkmanage[]" vlaue="'.$key.'" '.$checked.' style="transform: scale(1.5);margin-left: 10px;">'.'</td>';
      }
    return response()->json(@$html);    
    }

    public function store(Request $request){
      //dd('ok');

      $date = date('Y-m',strtotime($request->date));

      AccountEmlpoyeeSalary::where('date',$date)->delete();

      $checkdata = $request->checkmanage;
      if($checkdata !=NULL){
          for($i=0; $i < count($checkdata); $i++){
              $data = new AccountEmlpoyeeSalary();
              $data->date = $date;
              $data->employee_id = $request->employee_id[$i];
              $data->amount = $request->amount[$i];
              $data->save();
          }
      }

        if(!empty(@$data) || empty($checkdata)){
          return redirect()->route('accounts.employee.salary.view')->with('success', 'Employee Salary Paid Successfully');
        }else{
          return redirect()->back()->with('error', 'Sorry No data saved');
        }

    }

}
