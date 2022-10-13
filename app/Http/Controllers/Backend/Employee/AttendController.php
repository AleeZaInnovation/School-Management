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


class AttendController extends Controller
{
    //
    public function view(){        
        $data['data'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('date','desc')->get();
        
      return view('backend.layouts.employee.attend.view', $data);
    }
    //---- employee Add ----//
    public function add(){
        $data['employee'] = User::where('usertype','employee')->get();
        $data['purpose'] = LeavePurpose::all();
        return view('backend.layouts.employee.attend.add-edit', $data);
    }
    //---- users Store ----//
    public function store(Request $request){
      EmployeeAttendance::where('date',date('Y-m-d',strtotime($request->date)))->delete();
      $countEmployee = count($request->employee_id);
      for($i=0; $i < $countEmployee; $i++){
          $attend_status = 'attend_status'.$i;
          $attend = new EmployeeAttendance();
          $attend->date = date('Y-m-d',strtotime($request->date));
          $attend->employee_id = $request->employee_id[$i];
          $attend->attend_status = $request->$attend_status;
          $attend->save();
      }
        
      return redirect()->route('employee.attend.view')->with('success', 'Employee Attended Stored Successfully');
  
    }
    //---- users Edit ----//
    public function edit($date){
      //dd('ok');
        $data['edits'] = EmployeeAttendance::where('date',$date)->get();
        $data['employee'] = User::where('usertype','employee')->get();
        $data['purpose'] = LeavePurpose::all();
        return view('backend.layouts.employee.attend.add-edit', $data);
    
    }
    //---- users Update ----//

  public function details($date){
        $data['details'] = EmployeeAttendance::where('date',$date)->get();
        return view('backend.layouts.employee.attend.details', $data);
  }

  
  //
}
