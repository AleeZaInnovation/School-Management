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

class RegController extends Controller
{
    //
    public function view(){        
        $data['data'] = User::where('usertype','employee')->get();
        
      return view('backend.layouts.employee.reg.view', $data);
    }
    //---- employee Add ----//
    public function add(){
      $data['designation'] = Designation::all();
        return view('backend.layouts.employee.reg.add-edit', $data);
    }
    //---- users Store ----//
    public function store(Request $request){
      DB::transaction(function()use($request){
        $checkYear = date('Ym',strtotime($request->join_date));
        $employee = User::where('usertype','employee')->orderBy('id','DESC')->first();
        if($employee == null){
          $firstReg = 0;
          $employeeId = $firstReg+1;
          if($employeeId<10){
            $id_no = '000'.$employeeId;
          }elseif($employeeId<100){
            $id_no = '00'.$employeeId;
          }elseif($employeeId<1000){
            $id_no = '0'.$employeeId;
          }
        }else
        {
          $employee = User::where('usertype','employee')->orderBy('id','DESC')->first()->id;
          $employeeId = $employee+1;
          if($employeeId<10){
            $id_no = '000'.$employeeId;
          }elseif($employeeId<100){
            $id_no = '00'.$employeeId;
          }elseif($employeeId<1000){
            $id_no = '0'.$employeeId;
          }
        }

        $final_id_no = $checkYear.$id_no;
        $code = rand(0000,9999);
        $data = new User();
        $data->id_no = $final_id_no;
        $data->password =bcrypt($code);
        $data->code   = $code;
        $data->usertype = 'employee';
        $data->name = $request->name;
        $data->fname = $request->fname;
        $data->mname = $request->mname;
        $data->mobile = $request->mobile;
        $data->gender = $request->gender;
        $data->address = $request->address;
          if($request->file('image')){
            $file = $request->file('image');
              $fileName = date('YmdHi'). $file->getClientOriginalName();
              $file->move(public_path('assets/backend/images/employee'), $fileName);
          $data['image'] = $fileName;          
          }
        $data->religion = $request->religion;
        $data->salary = $request->salary;
        $data->designation_id = $request->designation_id;
        $data->dob = date('Y-m-d', strtotime($request->dob));
        $data->join_date = date('Y-m-d', strtotime($request->join_date));
        $data->save();

        $emplpyee_salary = new EmployeeSalary();
        $emplpyee_salary->employee_id = $data->id;
        $emplpyee_salary->effected_date = date('Y-m-d', strtotime($request->join_date));
        $emplpyee_salary->previous_salary = $request->salary;
        $emplpyee_salary->present_salary = $request->salary;
        $emplpyee_salary->increment_salary = '0';
        $emplpyee_salary->save();
      });
      return redirect()->route('employee.reg.view')->with('success', 'Employee Registraion Completed Successfully');

    }
    //---- users Edit ----//
    public function edit($id){
        $data['edits'] = User::find($id);
        $data['designation'] = Designation::all();        
        return view('backend.layouts.employee.reg.add-edit', $data);
    }
    //---- users Update ----//
    public function update($id, Request $request){
        $data = User::find($id);
        $data->name = $request->name;
        $data->fname = $request->fname;
        $data->mname = $request->mname;
        $data->mobile = $request->mobile;
        $data->gender = $request->gender;
        $data->address = $request->address;
          if($request->file('image')){
            $file = $request->file('image');
              @unlink(public_path('assets/backend/images/employee/'.$data->image));
              $fileName = date('YmdHi'). $file->getClientOriginalName();
              $file->move(public_path('assets/backend/images/employee'), $fileName);
          $data['image'] = $fileName;          
          }
        $data->religion = $request->religion;
        $data->designation_id = $request->designation_id;
        $data->dob = date('Y-m-d', strtotime($request->dob));
        $data->save();
      
      return redirect()->route('employee.reg.view')->with('success', 'Employee Registraion Updated Successfully');
      
    }
    //---- users Delete ----//
    public function delete($id){
        $slider = Slider::find($id);
        if (file_exists('public/assets/backend/images/sliders/'. $slider->image) AND ! empty($slider->image)){
        unlink('public/assets/backend/images/sliders/'. $slider->image);
        }
        $slider->delete();
        return redirect()->route('sliders.view')->with('success', 'Slider Deleted Successfully');
    }

  public function details($id){
    $data['details'] = User::find($id);
    $pdf = PDF::loadView('backend.layouts.pdf.employee-details', $data);
    //$pdf->SetProtection(['copy', 'print'], '', 'pass');
    return $pdf->stream('Employee_Registration_Card.pdf');
  }

  
  //
}
