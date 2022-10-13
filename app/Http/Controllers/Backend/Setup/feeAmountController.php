<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\FeeAmount;
use App\Model\FeeCategory;
use App\Model\StudentClass;
use DB;

class feeAmountController extends Controller
{
    //
    public function view(){
        //dd('ok');
        $data['data'] = FeeAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        //dd($users->toArray());
        
      return view('backend.layouts.setup.fee_amount.view', $data);
    }
    //---- users Add ----//
    public function add(){
        $data['feecategory'] = FeeCategory::all();
        $data['studentclass'] = StudentClass::all();
        return view('backend.layouts.setup.fee_amount.add', $data);
    }
    //---- users Store ----//
    public function store(Request $request){
        //dd('ok');
        $countClass = count($request->class_id);
        if($countClass !=NULL){
            for($i=0; $i < $countClass; $i++){
                $feeamount = new FeeAmount();
                $feeamount->fee_category_id = $request->fee_category_id;
                $feeamount->class_id = $request->class_id[$i];
                $feeamount->amount = $request->amount[$i];
                $feeamount->save();
            }
        }

       // Redirect 
      return redirect()->route('setups.student.fee.amount.view')->with('success', 'Student Fee Added Successfully');

    }
    //---- users Edit ----//
    public function edit($fee_category_id){
        //dd('ok');
        $data['edits'] = FeeAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        $data['feecategory'] = FeeCategory::all();
        $data['studentclass'] = StudentClass::all();
        return view('backend.layouts.setup.fee_amount.add-edit', $data);
    }
    //---- users Update ----//
    public function update($fee_category_id, Request $request){
         // Validation 
        // update
        if($request->class_id==NULL){
            return redirect()->back()->with('error', 'Sorry, There in no item selected!!');
        }else{
            FeeAmount::where('fee_category_id',$fee_category_id)->delete();
                $countClass = count($request->class_id);
                    for($i=0; $i < $countClass; $i++){
                        $feeamount = new FeeAmount();
                        $feeamount->fee_category_id = $request->fee_category_id;
                        $feeamount->class_id = $request->class_id[$i];
                        $feeamount->amount = $request->amount[$i];
                        $feeamount->save();
                    }
        }
       return redirect()->route('setups.student.fee.amount.view')->with('success', 'Student Fee Updated Successfully');
    }

    //---- users Details ----//
    public function details($fee_category_id){
        //dd('ok');
        $data['items'] = FeeAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        $data['feecategory'] = FeeCategory::find($fee_category_id);
        //dd($data['feecategory'] );
        $data['studentclass'] = StudentClass::all();
        return view('backend.layouts.setup.fee_amount.details', $data);
    }
    //---- users Delete ----//
    public function delete(Request $request){
        $data = StudentClass::find($request->id);
        $data->delete();
        return redirect()->route('setups.student.class.view')->with('success', 'Student Class Deleted Successfully');

    }
}
