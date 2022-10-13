<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\StudentClass;
use Hash;
use DB;

class studentController extends Controller
{
    //
    public function view(){
        //dd('ok');
        $data['classes'] = StudentClass::all();
        //dd($users->toArray());
        
      return view('backend.layouts.setup.student_class.view', $data);
    }
    //---- users Add ----//
    public function add(){
        return view('backend.layouts.setup.student_class.add-edit');
    }
    //---- users Store ----//
    public function store(Request $request){
        //dd('ok');
        $request->validate([
            'name'    => 'required|unique:student_classes,name',
          ]);
        
       $data = new StudentClass;
       $data->name = $request->name;
       $data->save();

       // Redirect 
      return redirect()->route('setups.student.class.view')->with('success', 'Student Class Added Successfully');

    }
    //---- users Edit ----//
    public function edit($id){
        //dd('ok');
        $data['edits'] = StudentClass::find($id);
        return view('backend.layouts.setup.student_class.add-edit', $data);
    }
    //---- users Update ----//
    public function update($id, Request $request){
         // Validation 
        // update
        $data = StudentClass::find($id);
        $request->validate([
            'name'    => 'required|unique:student_classes,name,'.$data->id
          ]);
       $data->name = $request->name;
       $data->save();
       // Redirect
       return redirect()->route('setups.student.class.view')->with('success', 'Student Class Updated Successfully');
    }
    //---- users Delete ----//
    public function delete(Request $request){
        $data = StudentClass::find($request->id);
        $data->delete();
        return redirect()->route('setups.student.class.view')->with('success', 'Student Class Deleted Successfully');

    }
}
