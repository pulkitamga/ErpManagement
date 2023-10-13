<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\Staff;
class StaffController extends Controller
{
    //
    public function index()
    {
        $desigantion=Designation::get();
        $staff=Staff::get();
        return view('admin.staff.index',['desigantions'=>$desigantion,'staff'=>$staff]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'uname'=>'required|max:255',
            'fname'=>'required|max:255',
            'lname'=>'required|max:255',
            'email'=>'required',
            'shift'=>'required',
            'designation'=>'required',
            'salary'=>'required',
            

        ]);
        // dd($request->all());
        $staff=new Staff;
        $staff->username=$request->uname;
        $staff->first_name=$request->fname;
        $staff->last_name=$request->lname;
        $staff->email=$request->email;
        $staff->shift=$request->shift;
        $staff->designation=$request->designation;
        $staff->salary=$request->salary;
        $staff->status=$request->status;
        $staff->save();
        return redirect()->back()->with('message', 'Yee! New Staff Added Sucessfully');
    }
    public function edit($id)
    {
        $staff=Staff::find($id);
        return response()->json([
            'status'=>200,
            'staff'=>$staff,
        ]);
    }
    public function update(Request $request)
    {
        $staff_id=$request->input('staff_id');
        $staff=Staff::find($staff_id);
        $staff->first_name=$request->fname;
        $staff->last_name=$request->lname;
        $staff->email=$request->email;
        $staff->shift=$request->shift;
        $staff->designation_id=$request->designation;
        $staff->salary=$request->salary;
        $staff->status=$request->status;

        $staff->update();
        return redirect()->back()->with('message','Upadated');
    }
    public function destroy($id)
    {
        Staff::find($id)->delete();
        return response()->json([
            'sucess'=>'Staff Delated successfully',
        ]);
    }
}
