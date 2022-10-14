<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    //
    public function index(){
        $setting=Setting::find(1);
        return view('admin.setting.index',[
          'setting'=>$setting,
        ]);
    }
    public function update(Request $request){
        $setting=Setting::find(1);
        $setting->name=$request->name;
        $setting->number1=$request->number1;
        $setting->number2=$request->number2;
        $setting->email1=$request->email1;
        $setting->email2=$request->email2;
        $setting->address=$request->address;
        $setting->facebook=$request->facebook;
        $setting->youtube=$request->youtube;
        $setting->instagram=$request->instagram;
        $setting->twitter=$request->twitter;
        if($request->hasFile('logo')){
            if(!empty($setting->logo)){
                unlink(public_path('media/settings/'.$setting->logo));

            }
            $logo=$request->file('logo');
            $logo_name=md5(time().rand()).'.'.$logo->getClientOriginalExtension();
            $logo->move(public_path('media/settings'),$logo_name);
            $setting->logo=$logo_name;
        }
        if($request->hasFile('icon')){
            if(!empty($setting->icon)){
                unlink(public_path('media/settings/'.$setting->icon));

            }
            $icon=$request->file('icon');
            $icon_name=md5(time().rand()).'.'.$icon->getClientOriginalExtension();
            $icon->move(public_path('media/settings'),$icon_name);
            $setting->icon=$icon_name;
        }
        if($request->hasFile('fav_icon')){
            if(!empty($setting->fav_icon)){
                unlink(public_path('media/settings/'.$setting->fav_icon));

            }
            $favicon=$request->file('fav_icon');
            $favicon_name=md5(time().rand()).'.'.$favicon->getClientOriginalExtension();
            $favicon->move(public_path('media/settings'),$favicon_name);
            $setting->fav_icon=$favicon_name;
        }
        $setting->update();
        Alert::success('Success','Setting has been updated successfully!');

        return back();
    }
}
