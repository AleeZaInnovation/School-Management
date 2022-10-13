<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\FeeCategory;
use App\Model\StudentClass;
use DB;

class feeCategoryController extends Controller
{
    //
    public function view(){
        //dd('ok');
        $data['data'] = FeeCategory::all();
        //dd($users->toArray());
        
      return view('backend.layouts.setup.fee_category.view', $data);
    }
    //---- users Add ----//
    public function add(){
        return view('backend.layouts.setup.fee_category.add-edit');
    }
    //---- users Store ----//
    public function store(Request $request){
        //dd('ok');
        $request->validate([
            'name'    => 'required|unique:fee_categories,name',
          ]);
        
       $data = new FeeCategory;
       $data->name = $request->name;
       $data->save();

       // Redirect 
      return redirect()->route('setups.student.fee.category.view')->with('success', 'Fee Category Added Successfully');

    }
    //---- users Edit ----//
    public function edit($id){
        //dd('ok');
        $data['edits'] = FeeCategory::find($id);
        return view('backend.layouts.setup.fee_category.add-edit', $data);
    }
    //---- users Update ----//
    public function update($id, Request $request){
         // Validation 
        // update
        $data = FeeCategory::find($id);
        $request->validate([
            'name'    => 'required|unique:fee_categories,name,'.$data->id
          ]);
       $data->name = $request->name;
       $data->save();
       // Redirect
       return redirect()->route('setups.student.fee.category.view')->with('success', 'Fee Category Updated Successfully');
    }
    //---- users Delete ----//
    public function delete(Request $request){
        $data = StudentClass::find($request->id);
        $data->delete();
        return redirect()->route('setups.student.class.view')->with('success', 'Student Class Deleted Successfully');

    }
}
