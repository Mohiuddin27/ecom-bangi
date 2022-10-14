<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function images(){
        return $this->hasMany('App\Models\Image');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id','id');
    }
    public function subcategory(){
        return $this->belongsTo('App\Models\SubCategory','subcategory_id','id');
    }


}
