<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    //
    public function index()
    {
        return view('admin.holidays.index');
    }
}
