<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\Shift;
use DB;

class shiftController extends Controller
{
    //
    public function view(){
        //dd('ok');
        $data['data'] = Shift::all();
        //dd($users->toArray());
        
      return view('backend.layouts.setup.shift.view', $data);
    }
    //---- users Add ----//
    public function add(){
        return view('backend.layouts.setup.shift.add-edit');
    }
    //---- users Store ----//
    public function store(Request $request){
        //dd('ok');
        $request->validate([
            'name'    => 'required|unique:shifts,name',
          ]);
        
       $data = new Shift;
       $data->name = $request->name;
       $data->save();

       // Redirect 
      return redirect()->route('setups.student.shift.view')->with('success', 'Student Shift Added Successfully');

    }
    //---- users Edit ----//
    public function edit($id){
        //dd('ok');
        $data['edits'] = Shift::find($id);
        return view('backend.layouts.setup.shift.add-edit', $data);
    }
    //---- users Update ----//
    public function update($id, Request $request){
         // Validation 
        // update
        $data = Shift::find($id);
        $request->validate([
            'name'    => 'required|unique:shifts,name,'.$data->id
          ]);
       $data->name = $request->name;
       $data->save();
       // Redirect
       return redirect()->route('setups.student.shift.view')->with('success', 'Student Shift Updated Successfully');
    }
    //---- users Delete ----//
    public function delete(Request $request){
        $data = StudentClass::find($request->id);
        $data->delete();
        return redirect()->route('setups.student.class.view')->with('success', 'Student Class Deleted Successfully');

    }
}
