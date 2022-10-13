<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\Group;
use DB;

class groupController extends Controller
{
    //
    public function view(){
        //dd('ok');
        $data['data'] = Group::all();
        //dd($users->toArray());
        
      return view('backend.layouts.setup.group.view', $data);
    }
    //---- users Add ----//
    public function add(){
        return view('backend.layouts.setup.group.add-edit');
    }
    //---- users Store ----//
    public function store(Request $request){
        //dd('ok');
        $request->validate([
            'name'    => 'required|unique:groups,name',
          ]);
        
       $data = new Group;
       $data->name = $request->name;
       $data->save();

       // Redirect 
      return redirect()->route('setups.student.group.view')->with('success', 'Student Group Added Successfully');

    }
    //---- users Edit ----//
    public function edit($id){
        //dd('ok');
        $data['edits'] = Group::find($id);
        return view('backend.layouts.setup.group.add-edit', $data);
    }
    //---- users Update ----//
    public function update($id, Request $request){
         // Validation 
        // update
        $data = Group::find($id);
        $request->validate([
            'name'    => 'required|unique:groups,name,'.$data->id
          ]);
       $data->name = $request->name;
       $data->save();
       // Redirect
       return redirect()->route('setups.student.group.view')->with('success', 'Student Group Updated Successfully');
    }
    //---- users Delete ----//
    public function delete(Request $request){
        $data = StudentClass::find($request->id);
        $data->delete();
        return redirect()->route('setups.student.class.view')->with('success', 'Student Class Deleted Successfully');

    }
}

