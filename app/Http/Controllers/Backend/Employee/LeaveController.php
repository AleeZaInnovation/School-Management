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

class LeaveController extends Controller
{
    //
    public function view(){        
        $data['data'] = EmployeeLeave::orderBy('id','desc')->get();
        
      return view('backend.layouts.employee.leave.view', $data);
    }
    //---- employee Add ----//
    public function add(){
        $data['employee'] = User::where('usertype','employee')->get();
        $data['purpose'] = LeavePurpose::all();
        return view('backend.layouts.employee.leave.add-edit', $data);
    }
    //---- users Store ----//
    public function store(Request $request){
      if($request->leave_purpose_id =="0"){
        $leavepurpose = new LeavePurpose;
        $leavepurpose->name = $request->name;
        $leavepurpose->save();
        $leave_purpose_id = $leavepurpose->id;
      }else{
        $leave_purpose_id = $request->leave_purpose_id;
      }
  
      $data = new EmployeeLeave;
      $data->employee_id = $request->employee_id;
      $data->start_date = date('Y-m-d',strtotime($request->start_date));
      $data->end_date = date('Y-m-d',strtotime($request->end_date));
      $data->leave_purpose_id = $leave_purpose_id;
      $data->save();
      return redirect()->route('employee.leave.view')->with('success', 'Employee Leave Stored Successfully');
  
    }
    //---- users Edit ----//
    public function edit($id){
        $data['edits'] = EmployeeLeave::find($id);
        $data['employee'] = User::where('usertype','employee')->get();
        $data['purpose'] = LeavePurpose::all();
        return view('backend.layouts.employee.leave.add-edit', $data);
    
    }
    //---- users Update ----//
    public function update($id, Request $request){
    
      if($request->leave_purpose_id =="0"){
        $leavepurpose = new LeavePurpose;
        $leavepurpose->name = $request->name;
        $leavepurpose->save();
        $leave_purpose_id = $leavepurpose->id;
      }else{
        $leave_purpose_id = $request->leave_purpose_id;
      }
  
      $data = EmployeeLeave::find($id);
      $data->employee_id = $request->employee_id;
      $data->start_date = date('Y-m-d',strtotime($request->start_date));
      $data->end_date = date('Y-m-d',strtotime($request->end_date));
      $data->leave_purpose_id = $leave_purpose_id;
      $data->save();
      return redirect()->route('employee.leave.view')->with('success', 'Employee Leave Updated Successfully');

    }

  public function details($id){
    $data['details'] = User::find($id);
    $pdf = PDF::loadView('backend.layouts.pdf.employee-details', $data);
    //$pdf->SetProtection(['copy', 'print'], '', 'pass');
    return $pdf->stream('Employee_Registration_Card.pdf');
  }

  
  //
}