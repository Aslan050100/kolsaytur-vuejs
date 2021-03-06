<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';


    public function product_types(){
    	return $this->belongsTo('App\Product_type');
    }


    public function cities(){
    	return $this->belongsTo('App\City');
    }


    public function rooms(){
    	return $this->hasMany('App\Room','pro_id','id');
    }

    public function comforts(){
    	return $this->belongsToMany('App\Comfort','pro_com','pro_id','com_id');
    }


    public function getImageUrlAttribute(): string
    {
        $image_url = $this->image;
        if ( strpos($image_url, 'http') === 0) {
            return $image_url;
        }
        return "https://sirius.onmonday.kz/assets/images/".$image_url;
    }
}
