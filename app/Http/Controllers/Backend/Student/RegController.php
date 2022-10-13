<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
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

class RegController extends Controller
{
    //
    public function view(){
        
        $data['year'] = Year::orderBy('id','DESC')->get();
        $data['year_id'] = Year::orderBy('id','DESC')->first()->id;
        $data['class_id'] = StudentClass::orderBy('id','ASC')->first()->id;
        //dd($data['year_id']);
        $data['data'] = AssignStudent::where('year_id',$data['year_id'])->where('class_id',$data['class_id'])->get();
        $data['class'] = StudentClass::all();
        //dd($users->toArray());
        
      return view('backend.layouts.student.reg.view', $data);
    }

    public function yearClassWise(Request $request){
      //dd('ok');

        $data['class'] = StudentClass::all();
        $data['year'] = Year::orderBy('id','DESC')->get();
        $data['year_id'] = $request->year_id;
        //dd($data['year_id']);
        $data['class_id'] = $request->class_id;
        //dd($data['year_id']);
        $data['data'] = AssignStudent::where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
        
        //dd($users->toArray());
        
        return view('backend.layouts.student.reg.view', $data);
    }
    //---- users Add ----//
    public function add(){
      $data['group'] = Group::all();
      $data['shift'] = Shift::all();
      $data['year'] = Year::orderBy('id','DESC')->get();
      $data['class'] = StudentClass::all();
        return view('backend.layouts.student.reg.add-edit', $data);
    }
    //---- users Store ----//
    public function store(Request $request){
      DB::transaction(function()use($request){
        $checkYear = Year::find($request->year_id)->name;
        $student = User::where('usertype','student')->orderBy('id','DESC')->first();
        if($student == null){
          $firstReg = 0;
          $studentId = $firstReg+1;
          if($studentId<10){
            $id_no = '000'.$studentId;
          }elseif($studentId<100){
            $id_no = '00'.$studentId;
          }elseif($studentId<1000){
            $id_no = '0'.$studentId;
          }
        }else
        {
          $student = User::where('usertype','student')->orderBy('id','DESC')->first()->id;
          $studentId = $student+1;
          if($studentId<10){
            $id_no = '000'.$studentId;
          }elseif($studentId<100){
            $id_no = '00'.$studentId;
          }elseif($studentId<1000){
            $id_no = '0'.$studentId;
          }
        }

        $final_id_no = $checkYear.$id_no;
        $code = rand(0000,9999);
        $data = new User();
        $data->id_no = $final_id_no;
        $data->password =bcrypt($code);
        $data->code   = $code;
        $data->usertype = 'Student';
        $data->name = $request->name;
        $data->fname = $request->fname;
        $data->mname = $request->mname;
        $data->mobile = $request->mobile;
        $data->gender = $request->gender;
        $data->address = $request->address;
          if($request->file('image')){
            $file = $request->file('image');
              $fileName = date('YmdHi'). $file->getClientOriginalName();
              $file->move(public_path('assets/backend/images/student'), $fileName);
          $data['image'] = $fileName;          
          }
        $data->religion = $request->religion;
        $data->dob = $request->dob;
        $data->save();

        $assign_student = new AssignStudent();
        $assign_student->student_id = $data->id;
        $assign_student->class_id = $request->class_id;
        $assign_student->year_id = $request->year_id;
        $assign_student->shift_id = $request->shift_id;
        $assign_student->group_id = $request->group_id;
        $assign_student->save();

        $discount_student = new DiscountStudent();
        $discount_student->assign_student_id = $assign_student->id;
        $discount_student->fee_category_id = '1';
        $discount_student->discount = $request->discount;
        $discount_student->save();
      
        
        
        
      });
      return redirect()->route('student.reg.view')->with('success', 'Student Registraion Completed Successfully');

    }
    //---- users Edit ----//
    public function edit($student_id){
        $data['edits'] = AssignStudent::with('student','discount')->where('student_id',$student_id)->first();
        //dd($data['edits'])->toArray();
        $data['group'] = Group::all();
        $data['shift'] = Shift::all();
        $data['year'] = Year::orderBy('id','DESC')->get();
        $data['class'] = StudentClass::all();
        return view('backend.layouts.student.reg.add-edit', $data);
    }
    //---- users Update ----//
    public function update($student_id, Request $request){
      DB::transaction(function()use($request, $student_id){
        $data = User::where('id',$student_id)->first();
        $data->name = $request->name;
        $data->fname = $request->fname;
        $data->mname = $request->mname;
        $data->mobile = $request->mobile;
        $data->gender = $request->gender;
        $data->address = $request->address;
          if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('assets/backend/images/student/'.$data->image));
              $fileName = date('YmdHi'). $file->getClientOriginalName();
              $file->move(public_path('assets/backend/images/student'), $fileName);
          $data['image'] = $fileName;          
          }
        $data->religion = $request->religion;
        $data->dob = $request->dob;
        $data->save();

        $assign_student =AssignStudent::where('id',$request->id)->where('student_id',$student_id)->first();
        $assign_student->class_id = $request->class_id;
        $assign_student->year_id = $request->year_id;
        $assign_student->shift_id = $request->shift_id;
        $assign_student->group_id = $request->group_id;
        $assign_student->save();

        $discount_student = DiscountStudent::where('assign_student_id',$request->id)->first();
        $discount_student->discount = $request->discount;
        $discount_student->save();
      });
      return redirect()->route('student.reg.view')->with('success', 'Student Registraion Updated Successfully');
      
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

    public function promotion($id){
      $data['edits'] = AssignStudent::with('student','discount')->find($id);
      //dd($data['edits'])->toArray();
      $data['group'] = Group::all();
      $data['shift'] = Shift::all();
      $data['year'] = Year::orderBy('id','DESC')->get();
      $data['class'] = StudentClass::all();
      return view('backend.layouts.student.reg.promotion', $data);
  }

  public function promotionStore($student_id, Request $request){
    DB::transaction(function()use($request, $student_id){
      $data = User::where('id',$student_id)->first();
      $data->name = $request->name;
      $data->fname = $request->fname;
      $data->mname = $request->mname;
      $data->mobile = $request->mobile;
      $data->gender = $request->gender;
      $data->address = $request->address;
        if($request->file('image')){
          $file = $request->file('image');
          @unlink(public_path('assets/backend/images/student/'.$data->image));
            $fileName = date('YmdHi'). $file->getClientOriginalName();
            $file->move(public_path('assets/backend/images/student'), $fileName);
        $data['image'] = $fileName;          
        }
      $data->religion = $request->religion;
      $data->dob = $request->dob;
      $data->save();

      $assign_student =new AssignStudent;
      $assign_student->student_id = $student_id;
      $assign_student->class_id = $request->class_id;
      $assign_student->year_id = $request->year_id;
      $assign_student->shift_id = $request->shift_id;
      $assign_student->group_id = $request->group_id;
      $assign_student->save();

      $discount_student = new DiscountStudent;
      $discount_student->assign_student_id = $assign_student->id;
      $discount_student->fee_category_id = '1';
      $discount_student->discount = $request->discount;
      $discount_student->save();
    });
    return redirect()->route('student.reg.view')->with('success', 'Student Promoted Successfully');
    
  }  


  public function details($student_id){
    $data['details'] = AssignStudent::with('student','discount')->where('student_id',$student_id)->first();
    $pdf = PDF::loadView('backend.layouts.pdf.student-details', $data);
    //$pdf->SetProtection(['copy', 'print'], '', 'pass');
    return $pdf->stream('Student_Registration_Card.pdf');
  }

  
  //
}

