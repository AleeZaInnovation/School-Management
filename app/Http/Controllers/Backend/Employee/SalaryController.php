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

class SalaryController extends Controller
{
    //
    public function view(){        
        $data['data'] = User::where('usertype','employee')->get();
        
      return view('backend.layouts.employee.salary.view', $data);
    }
    //---- employee Edit ----//
    public function increment($id){
        $data['edits'] = User::find($id);       
        return view('backend.layouts.employee.salary.add-edit', $data);
    }
    //---- users Update ----//
    public function store($id, Request $request){
      
        $user = User::find($id);
        $previous_salary = $user->salary;
        $present_salary = (float)$previous_salary + (float)$request->increment_salary;
        $user->salary = $present_salary;
        $user->save();
        $salaryData = new EmployeeSalary;
        $salaryData->employee_id = $id;
        $salaryData->previous_salary = $previous_salary;
        $salaryData->increment_salary = $request->increment_salary;
        $salaryData->present_salary = $present_salary;
        $salaryData->effected_date = date('Y-m-d',strtotime($request->effected_date));
        $salaryData->save();
      return redirect()->route('employee.salary.view')->with('success', 'Employee Salary Increment Successfully');
      
    }
    //---- Employee Salary Details ----//


  public function details($id){
    $data['details'] = User::find($id);
    $data['salary'] = EmployeeSalary::where('employee_id',$data['details']->id)->get();       
    return view('backend.layouts.employee.salary.details', $data);
  }

  
  //
}
