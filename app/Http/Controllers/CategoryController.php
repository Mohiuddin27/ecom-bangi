<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    //category index
    public function categoryIndex(){
        if (is_null($this->user) || !$this->user->can('categories')) {
            
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $categories=Category::where('is_deleted','No')->latest()->get();
        return view('admin.pages.categories',[
            'categories'=> $categories,
        ]);
    }
    //category create

    public function categoryStore(Request $request){
        if (is_null($this->user) || !$this->user->can('categories-store')) {
            
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:191',
        ]);
        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }else{
           
            $category=new Category([
                'name'  => $request->name,
                'slug'=>Str::slug($request->name),
                'created_by' =>Auth::user()->id,
            ]);
            $category->save();
            
        
            if($request->subcategory_name !=['']){
                foreach($request->subcategory_name as $subcat){
                    if($subcat !=''){
                        SubCategory::create([
                            'name'=>json_encode($subcat),
                            'slug'=>Str::slug(json_encode($subcat)),
                            'category_id'=>$category->id,
                            'created_by' =>Auth::user()->id,
                          ]);
                    }
                }
            }
          
            return response()->json([
                'status'=>200
               ]);
    
        }
    }
    //category edit
    public function categoryEdit($id){
        if (is_null($this->user) || !$this->user->can('categories-edit')) {
            
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $data=Category::findOrFail($id);
        $subcat=SubCategory::where('category_id',$data->id)->where('is_deleted','No')->get();
        return view('admin.pages.categoryUpdate',[
            'data'=>$data,
            'subcat'=>$subcat,
        ]);
    }

    //category Update
    public function categoryUpdate(Request $request,$id){
        if (is_null($this->user) || !$this->user->can('categories-update')) {
            
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $request->validate([
            'name' =>  'required|max:191',
            'status' => 'required',     
       ]);
            $Category=Category::findOrFail($id);
            $Category->name = $request->name;
            $Category->slug = Str::slug($request->name);
            $Category->status = $request->status;
      
            $Category->updated_by=Auth::user()->id;
            $Category->update();
            $subcategories=SubCategory::select('id')->where('category_id',$id)->get();
            $i=0;
            foreach($subcategories as $subcates){
                SubCategory::where("id", $subcates->id)->update(["name" => json_encode($request->subcategoryname[$i]),"slug"=>Str::slug($request->subcategoryname[$i]),"updated_by"=>Auth::user()->id]);
                $i++;   
            }

            

            //for newly create subcategory
            if($request->subcategory_name !=['']){
                foreach($request->subcategory_name as $subcat){
                    if($subcat !=''){
                        SubCategory::create([
                            'name'=>json_encode($subcat),
                            'slug'=>Str::slug(json_encode($subcat)),
                            'category_id'=>$id,
                            'created_by' =>Auth::user()->id,
                          ]);
                    }
                }
            }
            Alert::success('Success','Category has been updated successfully!');

            return redirect()->route('category.index');

    }
    //new subcategory add
    public function newSubcategoryStore(Request $request,$id){
      
        $request->validate([
            'name' => 'required|max:191',
        ]);
        foreach($request->name as $subcat){
            SubCategory::create([
                'name'=>json_encode($subcat),
                'slug'=>Str::slug(json_encode($subcat)),
                'category_id'=>$id,
                'created_by' =>Auth::user()->id,
              ]);
        }
        return redirect()->back();
    }
   //subcategories show
   public function categoryOfSubcategories($id){
    $category=Category::find($id);
    $subcategories=SubCategory::where('category_id',$id)->get();
    return view('admin.pages.subcategories',[
        'category'=>$category,
        'subcategories'=>$subcategories,
    ]);
   }
    //subcategory delete
    public function subcategoryDelete($id){
        if (is_null($this->user) || !$this->user->can('subcategories-delete')) {
            
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $data=SubCategory::findOrFail($id);
        $data->is_deleted='Yes';
        $data->status='Inactive';
        $data->deleted_by=Auth::user()->id;
        $data->deleted_at=Carbon::now();
        $data->save();   
     }
    //category single data delete
  public function categoryDelete($id){
     if (is_null($this->user) || !$this->user->can('categories-delete')) {
            
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
    $data=Category::findOrFail($id);
    $subcats=SubCategory::where('category_id',$id)->get();
    $data->is_deleted='Yes';
    $data->status='Inactive';
    $data->deleted_by=Auth::user()->id;
    $data->deleted_at=Carbon::now();
  
    $data->save();
    foreach($subcats as $subcat){
        $subcat->is_deleted='Yes';
        $subcat->status='Inactive';
        $subcat->deleted_by=Auth::user()->id;
        $subcat->deleted_at=Carbon::now();
        $subcat->save();
    }
  



  }


}
