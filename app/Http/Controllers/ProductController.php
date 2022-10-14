<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    //product index
    public function productIndex(){
        if (is_null($this->user) || !$this->user->can('product')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }

        $products=Product::where('is_deleted','No')->latest()->get();
        return view('admin.pages.product',[
            'products'=>$products,
        ]);
        
    }


    //product create
    public function productCreate(){
        if (is_null($this->user) || !$this->user->can('product-create')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }

        $categories=Category::where('status','Active')->where('is_deleted','No')->get();
        $subcategories=SubCategory::where('status','Active')->where('is_deleted','No')->get();
        $colors=Color::where('status','Active')->where('is_deleted','No')->get();
        $sizes=Size::where('status','Active')->where('is_deleted','No')->get();

        return view('admin.pages.productcreate',[
            'categories'=>$categories,
            'subcategories'=>$subcategories,
            'colors'=>$colors,
            'sizes'=>$sizes,
        ]);

    }
    //find subcategory
     public function findSubCategory(Request $request){
        $data=SubCategory::select('name','id')->where('category_id',$request->id)->get();
    	return response()->json($data);

    }
    //product store
    public function productStore(Request $request){
        if (is_null($this->user) || !$this->user->can('product-store')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }

        $request->validate([
            'name' => 'required|max:191|unique:products,name',
            'category_id'=>'required',
            'price'=>'required',
            'stock'=>'required',
            // 'short_description'=>'required',
            'description'=>'required',
            'color_id'=>'required',
            'size_id'=>'required'    
       ]);
        
            $product=new Product([
                'name'  => $request->name,
                'slug'=>Str::slug($request->name),
                'category_id'=>$request->category_id,
                'subcategory_id'=>$request->subcategory_id,
                'price'=>$request->price,
                'discount'=>$request->discount,
                'stock'=>$request->stock,
                'size_id'=>json_encode($request->size_id),
                'color_id'=>json_encode($request->color_id),
                'short_description'=>$request->short_description,
                'description'=>$request->description,
                'stock_status'=>'instock',
                'created_by' =>Auth::user()->id,
            ]);
            $product->save();
            if($request->hasFile('image')){
                foreach(($request->file('image')) as $file){
                    $file_name=md5(time().rand()).'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('media/products'),$file_name);
                    Image::create([
                        'product_id'=>$product->id,
                        'image'=>$file_name,
                        'created_by' =>Auth::user()->id,
                    ]);
                }
            }
            Alert::success('Success','Product has been Created successfully!');
            return redirect()->route('product.index');

        }

    
 // product edit
    public function productEdit($id){
        if (is_null($this->user) || !$this->user->can('product-edit')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }

        $data=Product::findOrFail($id);
        $colors=Color::where('status','Active')->where('is_deleted','No')->get();
        $sizes=Size::where('status','Active')->where('is_deleted','No')->get();
        $categories=Category::where('status','Active')->where('is_deleted','No')->get();
        $subcategories=SubCategory::where('category_id',$data->category_id)->get();
        $images=Image::where('Product_id',$id)->where('is_deleted','No')->get();
        return view('admin.pages.productedit',[
            'data'=>$data,
            'colors'=>$colors,
            'sizes'=>$sizes,
            'categories'=>$categories,
            'subcategories'=>$subcategories,
            'images'=>$images,
        ]);

       
    }

//image delete from image table
    public function imageDelete($id){
        if (is_null($this->user) || !$this->user->can('image-delete')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }

        $data=Image::findOrFail($id);
        $data->is_deleted='Yes';
        $data->status='Inactive';
        $data->deleted_by=Auth::user()->id;
    
        $data->deleted_at=Carbon::now();
        $data->save();
        // unlink(public_path('media/products/'.$data->image));
    }
    //product update
    public function productUpdate(Request $request,$id){
        if (is_null($this->user) || !$this->user->can('product-update')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }

        $request->validate([
            'name' => 'required|max:191|unique:products,name,'.$id,
            'category_id'=>'required',
            'price'=>'required',
            'stock'=>'required',
            // 'short_description'=>'required',
            'description'=>'required',
            'color_id'=>'required',
            'size_id'=>'required',  
            'stock_status'=>'required',
            'status'=>'required',
       ]);      
           $product=Product::findOrFail($id);
           $product->name = $request->name;
           $product->slug = Str::slug($request->name);
           $product->category_id = $request->category_id;
           $product->subcategory_id = $request->subcategory_id;
           $product->price = $request->price;
           $product->discount = $request->discount;
           $product->stock_status = $request->stock_status;
           $product->short_description=$request->short_description;
           $product->color_id=json_encode($request->color_id);
           $product->size_id=json_encode($request->size_id);
           $product->description = $request->description;
           $product->stock = $request->stock;
           $product->status = $request->status;
           $product->updated_by=Auth::user()->id;
           $product->update();

           if($request->hasFile('image')){
            foreach(($request->file('image')) as $file){
                $file_name=md5(time().rand()).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('media/products'),$file_name);
                Image::create([
                    'product_id'=>$id,
                    'image'=>$file_name,
                    'created_by' =>Auth::user()->id,
                ]);
            }


        }
        Alert::success('Success','Product has been Updated successfully!');
        return redirect()->back();
          
    }


    //product delete
    public function productDelete($id){
        if (is_null($this->user) || !$this->user->can('product-delete')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }

        $data=Product::findOrFail($id);
        $images=Image::where('product_id',$id)->get();
        $data->is_deleted='Yes';
        $data->status='Inactive';
        $data->deleted_by=Auth::user()->id;
        $data->deleted_at=Carbon::now();
        $data->save();
        foreach($images as $image){
            $image->is_deleted='Yes';
            $image->status='Inactive';
            $image->deleted_by=Auth::user()->id;
            $image->deleted_at=Carbon::now();
            $image->save();
        }
    }
}
