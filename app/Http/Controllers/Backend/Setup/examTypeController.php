<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ExamType;
use App\Model\StudentClass;
use DB;

class examTypeController extends Controller
{
    //
    public function view(){
        //dd('ok');
        $data['data'] = ExamType::all();
        //dd($users->toArray());
        
      return view('backend.layouts.setup.exam_type.view', $data);
    }
    //---- users Add ----//
    public function add(){
        return view('backend.layouts.setup.exam_type.add-edit');
    }
    //---- users Store ----//
    public function store(Request $request){
        //dd('ok');
        $request->validate([
            'name'    => 'required|unique:exam_types,name',
          ]);
        
       $data = new ExamType;
       $data->name = $request->name;
       $data->save();

       // Redirect 
      return redirect()->route('setups.exam.type.view')->with('success', 'Fee Category Added Successfully');

    }
    //---- users Edit ----//
    public function edit($id){
        //dd('ok');
        $data['edits'] = ExamType::find($id);
        return view('backend.layouts.setup.exam_type.add-edit', $data);
    }
    //---- users Update ----//
    public function update($id, Request $request){
         // Validation 
        // update
        $data = ExamType::find($id);
        $request->validate([
            'name'    => 'required|unique:exam_types,name,'.$data->id
          ]);
       $data->name = $request->name;
       $data->save();
       // Redirect
       return redirect()->route('setups.exam.type.view')->with('success', 'Fee Category Updated Successfully');
    }
    //---- users Delete ----//
    public function delete(Request $request){
        $data = StudentClass::find($request->id);
        $data->delete();
        return redirect()->route('setups.student.class.view')->with('success', 'Student Class Deleted Successfully');

    }
}
