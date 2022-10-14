<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    //size Index
    public function sizeIndex(){
        if (is_null($this->user) || !$this->user->can('size')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        $sizes=Size::where('is_deleted','No')->latest()->get();
        return view('admin.pages.size',[
            'sizes'=>$sizes,
        ]);
    }

    //color store
    
    public function sizeStore(Request $request){
        if (is_null($this->user) || !$this->user->can('size-create')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:191|unique:sizes,name',
        ]);
        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }else{
           
            Size::create([
                'name'  => $request->name,
                'created_by' =>Auth::user()->id,
            ]);
          
            return response()->json([
                'status'=>200
               ]);
    
        }
    }

    //color edit
    public function sizeEdit($id){
        if (is_null($this->user) || !$this->user->can('size-edit')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        $data=Size::findOrFail($id);
        return[
            'id'=>$data->id,
            'name' => $data->name,
            'status'=>$data->status,    
        ];
    }

    //color update
    public function sizeUpdate(Request $request,$id){
        if (is_null($this->user) || !$this->user->can('size-update')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:191|unique:sizes,name,'.$id,
            'status'=>'required',
       ]);
       if ($validator->fails()){
           return response()->json([
               'status' => 400,
               'errors' => $validator->messages()
           ]);
       }else{
           $size=Size::findOrFail($id);
           $size->name = $request->name;
           $size->status = $request->status;
           $size->updated_by=Auth::user()->id;
           $size->update();
           return response()->json([
               'status'=>200
           ]);
       }
    }
    //color delete
    public function sizeDelete($id){
        if (is_null($this->user) || !$this->user->can('size-delete')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        $data=Size::findOrFail($id);
        $data->is_deleted='Yes';
        $data->status='Inactive';
        $data->deleted_by=Auth::user()->id;
    
        $data->deleted_at=Carbon::now();
        $data->save();
    }
}
