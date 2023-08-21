<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shift;

class ShiftController extends Controller
{
    //
    public function index()
    {
        $shift=Shift::get();
        return view('admin.shift.index',['shift'=>$shift]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'sname'=>'required',
        ]);

        $shift=new Shift;
        $shift->name=$request->sname;
        $shift->start_time=$request->shift_start;
        $shift->end_time=$request->shift_end;
        $shift->late_time=$request->shift_late;
        $shift->status=$request->status;
        $shift->save();
        return redirect()->back()->with('message','Shift added sucessfully');
    }

    public function edit($id)
    {
        $shift=Shift::find($id);
        return response()->json([
            'status'=>200,
            'shift'=>$shift,
        ]);
    }

    public function update(Request $request)
    {
        $shift_id=$request->input('shift_id');
        $shift=Shift::find($shift_id);
        $shift->name=$request->sname;
        $shift->start_time=$request->shift_start;
        $shift->end_time=$request->shift_end;
        $shift->late_time=$request->shift_late;
        $shift->status=$request->status;
        $shift->update();
        return redirect()->back()->with('message','Shift Updated sucessfully');
    }

    public function destroy($id)
    {
        Shift::find($id)->delete();
        return response()->json([
            'sucess'=>'Deleted Sucessfully',
        ]);
    }
}
