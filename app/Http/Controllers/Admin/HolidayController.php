<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Holiday;
use DateTime;

class HolidayController extends Controller
{
    //
    public function index()
    {
        $holiday=Holiday::get();
        return view('admin.holidays.index',['holiday'=>$holiday]);
    }
    public function store(Request $request)
    {
        $holiday=new Holiday;
        $holiday->name=$request->name;
        $holiday->holiday_from=$request->holiday_from;
        $holiday->holiday_to=$request->holiday_to;
        $holiday->status=$request->status;
        $fdate=$request->holiday_from;
        $tdate=$request->holiday_to;
        $datatime1=new DateTime($fdate);
        $datatime2=new DateTime($tdate);
        $interval=$datatime1->diff($datatime2);
        $days=$interval->format('%a');
        //echo $days;
        $holiday->days=$days+1;
        $holiday->save();
        return redirect()->back()->with('message','Added');

      
        // $from_date = $request->holiday_from;
        // $to_date = $request->holiday_to;
        // $first_datetime = new DateTime($from_date);
        // $last_datetime = new DateTime($to_date);
        // $interval = $first_datetime->diff($last_datetime);
         //dd($request->all());
    }

    public function edit($id)
    {
        $holiday=Holiday::find($id);
        return response()->json([
            'status'=>200,
            'holiday'=>$holiday,
        ]);
        
    }
    public function update(Request $request)
    {
        $holiday_id=$request->holiday_id;
        $holiday=Holiday::find($holiday_id);
        $holiday->name=$request->name;
        $holiday->holiday_from=$request->holiday_from;
        $holiday->holiday_to=$request->holiday_to;
        $holiday->status=$request->status;
        $fdate=$request->holiday_from;
        $tdate=$request->holiday_to;
        $datatime1=new DateTime($fdate);
        $datatime2=new DateTime($tdate);
        $interval=$datatime1->diff($datatime2);
        $days=$interval->format('%a');
        //echo $days;
        $holiday->days=$days+1;
        $holiday->update();
        return redirect()->back()->with('message','Added');
    }

    public function destroy($id)
    {
        Holiday::find($id)->delete();
        return reponse()->json([
            'sucess'=>'Deleted',
        ]);
    }
}
