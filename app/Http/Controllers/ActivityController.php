<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    //Activity log index
    public function index(){
        $activity_logs=Activity::latest()->get();
        return view('admin.pages.activity',[
           'activity_logs'=>$activity_logs,
        ]);
    }
}
