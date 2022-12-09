<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  
    public $timestamps = false;
    protected $fillable = [
        'product_name','product_image','product_status'
    ];
    protected $primaryKey = 'product_id';
    protected  $table = 'tbl_product';

    public function category(){
        return $this->belongsTo('App\Models\CategoryProductModel', 'category_id');
    }
}
