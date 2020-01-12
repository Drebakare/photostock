<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Photo extends Model
{
    protected $fillable = [
        'upload_id',
        'image',
        'title',
        'type',
        'price',
        'commission',
        'tags',
        'category_id',
        'featured',
        'image_re_id',
        'size',
        'orientation',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function upload(){
        return $this->belongsTo(Upload::class);
    }
    public function transaction(){
        return $this->hasMany(Transaction::class);
    }
    public function review(){
        return $this->hasMany(Review::class);
    }
    public function collections(){
        return $this->hasMany(Collection::class);
    }

    public function getImageCustomDimension($image, $dimension, $to_be_returned = 'height')
    {
        $height = null;
        $width = null;
        $custom_width = null;
        $custom_height = null;
        if($to_be_returned == 'height'){
            $large_dimension_custom_width = 1920;
            $medium_dimension_custom_width = 1920;
            $small_dimension_custom_width = 1920;
            switch ($dimension){
                case "large":
                    $custom_width = $large_dimension_custom_width;
                    break;

                case "medium":
                    $custom_width = $medium_dimension_custom_width;
                    break;

                case "small":
                    $custom_width = $small_dimension_custom_width;
                    break;

                default:
                    $custom_width = $dimension;
                    break;
            }
            $width = $image->width();
            $height = $image->height();
            $custom_height = ($height/$width)* $custom_width;

        } else{

        }

        return [$custom_width,$custom_height];
    }


    public function getImageCustomProperties($image){
        $width = $image->width();
        $height = $image->height();
        $orientation = null;
        $image_size = null;
        $large_dimension_custom_width = 1920;
        $medium_dimension_custom_width = 1500;
        $small_dimension_custom_width = 800;
        if($width > $height){
            $orientation = "landscape";
        }
        else{
            $orientation = "portrait";
        }

        if ($width <= $small_dimension_custom_width){
            $image_size = "small";
        }
        elseif($width > $small_dimension_custom_width && $width <= $medium_dimension_custom_width){
            $image_size = "medium";
        }
        else{
            $image_size = "large";
        }
        return [$orientation,$image_size];
    }

}
