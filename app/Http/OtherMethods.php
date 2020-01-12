<?php
/**
 * Created by PhpStorm.
 * User: drebakare
 * Date: 04/01/2019
 * Time: 2:15 PM
 */

namespace App\Http;

use App\Category;
use App\Keyword;
use App\Photo;
use App\Upload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OtherMethods
{
    public static function  fetchPhotosForFlexDisplay($photos_column_limit, $page_number, $per_page)
    {
        $page_start = ($page_number - 1) * $per_page;

        $approved_pictures = Photo::whereHas('upload', function($query){
            $query->where('approved', 1);
        })->inRandomOrder()->skip($page_start)->take($per_page)->get();

        $approved_pictures_array = [];

        for ($i=0; $i<$photos_column_limit; $i++)
        {
            $approved_pictures_array[$i] = [];
        }

        foreach ($approved_pictures as $key => $approved_picture)
        {
            $index_to_be_pushed = $key % $photos_column_limit;
            array_push($approved_pictures_array[$index_to_be_pushed], $approved_picture);
        }

        return $approved_pictures_array;
    }

    public static function fetchPhotosForFlexSearch($photos_column_limit, $search_value)

    {

        $check_search = Keyword::where('keyword',$search_value)->get();
        if(count($check_search) < 1){
            if(Auth::check()){
                Keyword::create([
                    'user_id' => Auth::user()->id,
                    'keyword' => $search_value,
                    'search_count' => 1,
                ]);
            }
            else{
                Keyword::create([
                    'keyword' => $search_value,
                    'search_count' => 1,
                ]);
            }

        }
        $check_search = Keyword::where('keyword',$search_value)->first();
        Keyword::where('keyword',$search_value)->update([
           'search_count' => $check_search->search_count + 1,
        ]);
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $search_value = str_replace($reservedSymbols, '', $search_value);
        $words = explode(' ', $search_value);
        foreach ($words as $key =>$word){
            if(strlen($word)<3){
                unset($words[$key]);
            }
        }
        $approved_pictures = [];
        foreach ($words as $key=>$word) {
            $get_pictures = Photo::wherehas('upload', function ($query) {
                $query->where('approved', 1);
            })->where('tags', 'LIKE', '%' . $word . '%')->inRandomOrder()->get();
            if (count($get_pictures) < 1) {
                continue;
            }
            else {
                foreach ($get_pictures as $get_picture)
                array_push($approved_pictures, $get_picture);
            }

        }
        foreach ($approved_pictures as $key=> $approved_picture){
            foreach ($approved_pictures as $keys => $confirmed_approved_picture){
                if($key == $keys){
                    continue ;
                }
                else{
                    if($approved_picture->image == $confirmed_approved_picture->image){
                        unset($approved_pictures[$keys]);
                    }
                    else{
                        continue ;
                    }
                }
            }

        }
        $approved_pictures_array = [];
        for ($i=0; $i<$photos_column_limit; $i++)
        {
            $approved_pictures_array[$i] = [];
        }

        foreach ($approved_pictures as $key => $approved_picture)
        {
            $index_to_be_pushed = $key% $photos_column_limit;
            array_push($approved_pictures_array[$index_to_be_pushed], $approved_picture);
        }

        if(count($approved_pictures_array) <1){

           $get_all_photos = Photo::where('tags','LIKE', '%'. ''. '%')->inRandomOrder()->get();

            foreach ($get_all_photos as $key => $approved_picture)
            {
                $index_to_be_pushed = $key % $photos_column_limit;
                array_push($approved_pictures_array[$index_to_be_pushed], $approved_picture);
            }
        }

        return $approved_pictures_array;
    }
    public static function fetchPhotosForFlexComplexSearch( $search_value)
    {

        //$check_search = Keyword::where('keyword',$search_value)->get();
        /*if(count($check_search) < 1 && !is_null($search_value)){
            Keyword::create([
                'user_id' => (auth()->check()) ? auth()->user()->id : null,
                'keyword' => $search_value,
                'search_count' => 1,
            ]);
        }
        else{
            $check_search = Keyword::where('keyword',$search_value)->first();
            Keyword::where('keyword',$search_value)->update([
                'search_count' => $check_search->search_count + 1,
            ]);
        }*/
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $search_value = str_replace($reservedSymbols, '', $search_value);
        $words = explode(' ', $search_value);

        foreach ($words as $key =>$word){
            if(strlen($word)<3){
                unset($words[$key]);
            }
        }

        $approved_pictures = [];
        foreach ($words as $key=>$word) {
            $get_pictures = Photo::wherehas('upload', function ($query) {
                $query->where('approved', 1);
            })->where('tags', 'LIKE', '%' . $word . '%')->inRandomOrder()->get();
            if (count($get_pictures) < 1) {
                continue;
            }
            else {
                foreach ($get_pictures as $get_picture){
                    array_push($approved_pictures, $get_picture);
                }
            }
        }

        foreach ($approved_pictures as $key=> $approved_picture){
            foreach ($approved_pictures as $keys => $confirmed_approved_picture){
                if($key == $keys){
                    continue ;
                }
                else{
                    if($approved_picture->image == $confirmed_approved_picture->image){
                        unset($approved_pictures[$keys]);
                    }
                    else{
                        continue ;
                    }
                }
            }

        }

        return $approved_pictures;
    }

    public static function fetchPhotosForFlexCategories($photos_column_limit, $category)
    {
        $approved_pictures_array = self::fetchPhotosForFlexSearch($photos_column_limit,$category);
        return $approved_pictures_array;
    }
    public static function fetchPhotosForFlexMyGallery($photos_column_limit, $all_transactions)
    {
        $approved_pictures_array = [];
        for ($i=0; $i<$photos_column_limit; $i++)
        {
            $approved_pictures_array[$i] = [];
        }

        foreach ($all_transactions as $key => $all_transaction)
        {
            if($all_transaction->picture_id!=null){
                $get_picture = Photo::where('id', $all_transaction->picture_id)->first();
                $index_to_be_pushed = $key% $photos_column_limit;
                array_push($approved_pictures_array[$index_to_be_pushed], $get_picture);
            }
            else{
                $get_pictures = Photo::where('upload_id', $all_transaction->upload_id)->get();
               foreach ($get_pictures as $get_picture){
                   $index_to_be_pushed = $key++ % $photos_column_limit;
                   array_push($approved_pictures_array[$index_to_be_pushed], $get_picture);
               }
            }

        }
        return $approved_pictures_array;
    }

    public static function fetchPhotosForFlex($photos_column_limit, $photo_array)
    {
        $approved_pictures_array = [];
        for ($i=0; $i<$photos_column_limit; $i++)
        {
            $approved_pictures_array[$i] = [];

        }
        foreach ($photo_array as $key => $photo)
        {
                    //$key = $key + 1;
                    $index_to_be_pushed = $key  % $photos_column_limit;
                    array_push($approved_pictures_array[$index_to_be_pushed], $photo);
        }
        foreach ($approved_pictures_array as $key => $approved_picture){
           // dd(array_key_exists($key, $approved_pictures_array) && is_null($approved_pictures_array[$key]));
            if(($approved_pictures_array[$key]) ==[]){
                unset($approved_pictures_array[$key]);
            }
        }
        return $approved_pictures_array;
    }
}
