<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecyclebinController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    //index
    public function index(){
        if (is_null($this->user) || !$this->user->can('recyclebin')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        $products=Product::where('is_deleted','yes')->latest()->get();
        $images=Image::where('is_deleted','yes')->latest()->get();
        $categories=Category::where('is_deleted','yes')->latest()->get();
        $subcategories=SubCategory::where('is_deleted','yes')->latest()->get();
        $colors=Color::where('is_deleted','yes')->latest()->get();
        $sizes=Size::where('is_deleted','yes')->latest()->get();



        return view('admin.pages.recyclebin',[
           'products'=>$products,
           'images'=>$images,
           'categories'=>$categories,
           'subcategories'=>$subcategories,
           'colors'=>$colors,
           'sizes'=>$sizes,
        ]);
    }

    //product restore
    public function productRestore($id){
        if (is_null($this->user) || !$this->user->can('product-restore')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        $data=Product::findOrfail($id);
        $images=Image::where('product_id',$id)->get();
        $data->is_deleted='No';
        $data->status='Active';
        $data->save();
        foreach($images as $image){
            $image->is_deleted='No';
            $image->status='Active';
            $image->save();
        }
    }
    //product delete
    public function productPermanentlyDelete($id){
        if (is_null($this->user) || !$this->user->can('product-permanently-delete')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        $data=Product::findOrfail($id);
        $images=Image::where('product_id',$id)->get();
        $data->delete();
        foreach($images as $image){
            $image->delete();
            unlink(public_path('media/products/'.$image->image));
        }
    }
    //image restore
    public function imageRestore($id){
        if (is_null($this->user) || !$this->user->can('image-restore')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        $data=Image::findOrfail($id);
        $data->is_deleted='No';
        $data->status='Active';
        $data->save();

    }
    //image delete
    public function imagePermanentlyDelete($id){
        if (is_null($this->user) || !$this->user->can('image-permanently-delete')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        $data=Image::findOrfail($id);
        $data->delete();
        unlink(public_path('media/products/'.$data->image));


    }    
//category restore
  public function categoryRestore($id){
    if (is_null($this->user) || !$this->user->can('category-restore')) {
        abort(403, 'Sorry !! You are Unauthorized !');
    }
    $data=Category::findOrfail($id);
    $subcategory=SubCategory::where('category_id',$id)->get();
    $data->is_deleted='No';
    $data->status='Active';
    $data->save();
    foreach($subcategory as $subcat){
        $subcat->is_deleted='No';
        $subcat->status='Active';
        $subcat->save();
    }
  }
     //category delete
     public function categoryPermanentlyDelete($id){
        if (is_null($this->user) || !$this->user->can('category-permanently-delete')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        $data=Category::findOrfail($id);
        $data->delete();
        SubCategory::where('category_id',$id)->delete();

    }    

        //subcategory restore
        public function subcategoryRestore($id){
            if (is_null($this->user) || !$this->user->can('subcategory-restore')) {
                abort(403, 'Sorry !! You are Unauthorized !');
            }
            $data=SubCategory::findOrfail($id);
            $data->is_deleted='No';
            $data->status='Active';
            $data->save();
    
        }
        //subcategory delete
        public function subcategoryPermanentlyDelete($id){
            if (is_null($this->user) || !$this->user->can('subcategory-permanently-delete')) {
                abort(403, 'Sorry !! You are Unauthorized !');
            }
            $data=SubCategory::findOrfail($id);
            $data->delete();
    
    
        }  
         //color restore
         public function colorRestore($id){
            if (is_null($this->user) || !$this->user->can('color-restore')) {
                abort(403, 'Sorry !! You are Unauthorized !');
            }
            $data=Color::findOrfail($id);
            $data->is_deleted='No';
            $data->status='Active';
            $data->save();
    
        }
        //color delete
        public function colorPermanentlyDelete($id){
            if (is_null($this->user) || !$this->user->can('color-permanently-delete')) {
                abort(403, 'Sorry !! You are Unauthorized !');
            }
            $data=Color::findOrfail($id);
            $data->delete();
    
    
        }
         //size restore
         public function sizeRestore($id){
            if (is_null($this->user) || !$this->user->can('size-restore')) {
                abort(403, 'Sorry !! You are Unauthorized !');
            }
            $data=Size::findOrfail($id);
            $data->is_deleted='No';
            $data->status='Active';
            $data->save();
    
        }
        //size delete
        public function sizePermanentlyDelete($id){
            if (is_null($this->user) || !$this->user->can('size-permanently-delete')) {
                abort(403, 'Sorry !! You are Unauthorized !');
            }
            $data=Size::findOrfail($id);
            $data->delete();
    
    
        }  
 

}
