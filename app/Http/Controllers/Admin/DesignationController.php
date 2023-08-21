<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    //
    public function index()
    {
        $designation=Designation::get();
         return view('admin.designation.index',['designations'=>$designation]);
    }
    public function store(Request $request)
    {
        
        $request->validate([
            'name'=>'required|unique:designations|max:255',
            'status'=>'required',
        ]);
        //dd($request->all());
        $designation=new Designation;
        $designation->name=$request->input('name');
        $designation->status=$request->input('status');
        //dd($designation->all());
        $designation->save();
        return redirect()->back()->withSuccess('IT WORKS!');
        

    }
   
    public function edit($id)
    {
        $designation=Designation::find($id);
        return response()->json([
            'status'=>200,
            'designation'=>$designation,
        ]);
    }

    public function update(Request $request)
    {
        $des_id=$request->input('designation_id');
        $designation=Designation::find($des_id);
        $designation->name=$request->input('name');
        $designation->status=$request->input('status');
       
        $designation->update();
        return redirect()->back()->withSuccess('IT WORKS!');
    }
    public function destroy($id)
    {
        Designation::find($id)->delete();
  
        return response()->json(['success'=>'Designation Deleted Successfully!']);
    }
    
}
