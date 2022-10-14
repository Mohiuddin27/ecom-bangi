<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    //color Index
    public function colorIndex(){
        if (is_null($this->user) || !$this->user->can('color')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }

        $colors=Color::where('is_deleted','No')->latest()->get();
        return view('admin.pages.color',[
            'colors'=>$colors,
        ]);
    }

    //color store
    
    public function colorStore(Request $request){
        if (is_null($this->user) || !$this->user->can('color-create')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:191|unique:colors,name',
        ]);
        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }else{
           
            Color::create([
                'name'  => $request->name,
                'created_by' =>Auth::user()->id,
            ]);
          
            return response()->json([
                'status'=>200
               ]);
    
        }
    }

    //color edit
    public function colorEdit($id){
        if (is_null($this->user) || !$this->user->can('color-edit')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        $data=Color::findOrFail($id);
        return[
            'id'=>$data->id,
            'name' => $data->name,
            'status'=>$data->status,    
        ];
    }

    //color update
    public function colorUpdate(Request $request,$id){
        if (is_null($this->user) || !$this->user->can('color-update')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:191|unique:colors,name,'.$id,
            'status'=>'required',
       ]);
       if ($validator->fails()){
           return response()->json([
               'status' => 400,
               'errors' => $validator->messages()
           ]);
       }else{
           $color=Color::findOrFail($id);
           $color->name = $request->name;
           $color->status = $request->status;
           $color->updated_by=Auth::user()->id;
           $color->update();
           return response()->json([
               'status'=>200
           ]);
       }
    }
    //color delete
    public function colorDelete($id){
        if (is_null($this->user) || !$this->user->can('color-delete')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        $data=Color::findOrFail($id);
        $data->is_deleted='Yes';
        $data->status='Inactive';
        $data->deleted_by=Auth::user()->id;
    
        $data->deleted_at=Carbon::now();
        $data->save();
    }
}
