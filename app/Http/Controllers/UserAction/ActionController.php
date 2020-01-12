<?php


namespace App\Http\Controllers\UserAction;

use App\Account;
use App\Cashout;
use App\Category;
use App\Collection;
use App\Country;
use App\Http\Controllers\Controller;
use App\Http\OtherMethods;
use App\Keyword;
use App\Message;
use App\Photo;
use App\Price;
use App\Region;
use App\Review;
use App\Transaction;
use App\Upload;
use App\User;
use App\Withdrawal;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use http\Env\Response;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
/*use Dropbox\Client;*/
use Dropbox\WriteMode;


class ActionController extends Controller
{
    public $regions;
    public function __construct()
    {
        $this->regions = Region::get();
    }

    public function display(Request $request){
        $categories = Keyword::orderBy('search_count', 'desc')->take(4)->get();

        /*if($categories->count() >= 4)
        {
            $categories = $categories->random(4);
        }*/

        $sellers = User::where('is_seller',1)->where('is_activated',1)->get();

        $approved_pictures_array = OtherMethods::fetchPhotosForFlexDisplay(3, 1, 9);

        $featured_pictures = Photo::whereHas('upload', function($query){
            $query->where('approved', 1);
            })->where('featured', 1)->paginate(12);

        $regions = $this->regions;

        if(($request->session()->has('location')))
        {
            $default_country = Region::where("currency_code", "NGN")->first();
            $request->session()->put("location",[$default_country->currency_code]);
        }
        $previous_region = $request->session()->get("location");
        $current_region = Region::where("currency_code",$previous_region[0])->first();
        return view('homepage', compact('categories','featured_pictures','sellers', 'approved_pictures_array', "regions", "current_region"));
    }
    public function moreImages(Request $request){
        $approved_pictures_array = OtherMethods::fetchPhotosForFlexDisplay(3, $request->page_number, 9);
        $json_result = $approved_pictures_array;
        $response = array(
            'results' => $json_result,
        );
        return response()->json($response);
    }

    public  function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function search(Request $request){
       // dd($request);
        $searched_word = $request->search;
        $categories = Category::get();
        $photo_keyword = [];
        $keyword = [] ;
        $words = explode(' ', $request->search);
        foreach ($words as $word){
            array_push($keyword,$word);
        }
//        foreach ($photo_keyword as $word){
//            $get_pictures = Photo::wherehas('upload', function ($query) {
//                $query->where('approved', 1);
//            })->where('tags', 'LIKE', '%' . $word . '%')->inRandomOrder()->get();
//
//            $tags = $get_pictures->tags;
//            $words = explode(',', $tags);
//            foreach ($words as $word){
//                array_push($keyword,$word);
//            }
//
//        }
        /*$keyword = Keyword::all();

        if($keyword->count() >= 4) {
            $keyword = $keyword->random(4);
        }*/

        //dd($ph);

        $approved_pictures_array = OtherMethods::fetchPhotosForFlexSearch(4, $searched_word);
        //dd($approved_pictures_array);
        return view('action.search_result', compact('categories', 'approved_pictures_array','keyword', 'searched_word'));
    }
    public function searchId($id){
        $search=Photo::where('category_id', $id)->get();
        $categories = Category::get();
        return view('action.search_result', compact('search_results','categories'));
    }

    public function searchAll(){
        $searched_word = "";
        $keywords = [];
        /*if($keyword->count() >= 4)
        {
            $keyword = $keyword->random(4);
        }*/

        $categories = Category::all();
        if($categories->count() >= 4)
        {
            $categories = $categories->random(4);
        }

        $approved_pictures = Photo::whereHas('upload', function($query){
            $query->where('approved', 1);
        })->inRandomOrder()->get();
        foreach ($approved_pictures as $approved_picture){
            $tags = $approved_picture->tags;
            $words = explode(',', $tags);
            foreach ($words as $word){
                array_push($keywords,$word);
            }
        }
        foreach ($keywords as $key => $word){
            if(($keywords[$key]) == ""){
                unset($keywords[$key]);
            }
        }
        $keyword = [];
        $random_keywords_keys = array_rand($keywords,4);
        foreach ($random_keywords_keys as $key){
            array_push($keyword, $keywords[$key]);
        }

        $sellers = User::where('is_seller',1)->where('is_activated',1)->get();

        $approved_pictures_array = OtherMethods::fetchPhotosForFlex(3, $approved_pictures);



        return view('action.search_result', compact('categories', 'approved_pictures_array', 'keyword', 'searched_word'));

    }

    public function searchCategory($search_word)
    {
        $searched_word = $search_word;
        $categories = Category::get();
        // $keywords = [];
        $keyword = [];
        $pictures_array = OtherMethods::fetchPhotosForFlexSearch(3,$search_word);
        $keyword = $pictures_array[0];
        $approved_pictures_array = $pictures_array[1];
        //dd($related_tags);
        /*foreach ($approved_pictures_array as $key => $picture){
            if(array_key_exists($key, $approved_pictures_array)){
                $picture_tags =  $picture[key($approved_pictures_array)]->tags;
                $words = explode(',', $picture_tags);
                foreach ($words as $word){
                    array_push($keyword,$word);
                }

            }
        }*/
        /*foreach ($keyword as $key=> $word){

            foreach ($keyword as $keys => $confirmed_word){
                if($key == $keys){
                    continue ;
                }
                else{
                    if(ltrim(($word))  == ltrim($confirmed_word)){
                        unset($keyword[$key]);
                    }
                    else{
                        continue ;
                    }
                }
            }

        }*/
        /*foreach ($keywords as $key => $word){
            if(($keywords[$key]) == ""){
                unset($keywords[$key]);
            }
        }

        $random_keywords_keys = array_rand($keywords,4);
        foreach ($random_keywords_keys as $key){
            array_push($keyword, $keywords[$key]);
        }*/
        return view('action.search_result', compact('categories', 'approved_pictures_array', 'keyword', "searched_word"));
    }
    public function sort($id){
        $searchAllPhotos = Photo::where('tags','LIKE',$id.'%')
            ->whereHas('upload', function($query){
            $query->where('approved', 1);
            })->orderBy('tags', 'asc')->paginate(12);
        return view('action.browse_all',compact('searchAllPhotos'));
    }

    public function complexSearch(Request $request){

        $searched_photos = [];
        $approved_pictures = [];
        $tags = [];
        /*if($request->has('price')){
            $words = explode(',', $request->price);
            $price_range = range($words[0], $words[1]);
        }*/
        if($request->has('search')){
            $photo_array = OtherMethods::fetchPhotosForFlexComplexSearch($request->search);
           $searched_photos = $photo_array;
        }
        $searched_word = $request->search;

        if($request->has('keywords') && $request->keywords != null){
            $keywords = [];
            /*foreach($request->keywords as $key => $keyword){
                dd($key);
                array_push($keywords, Keyword::where('id', $key)->first());
            }*/
            foreach ($request->keywords as $keyword){
                $words = explode(' ', $keyword);

                foreach ($words as $key =>$word){
                    if(strlen($word)<3){
                        unset($words[$key]);
                    }
                    array_push($tags, $word);
                }
                foreach ($words as $key=>$word) {
                    $get_pictures = Photo::wherehas('upload', function ($query) {
                        $query->where('approved', 1);
                    })->where('tags', 'LIKE', '%' . $word . '%')->inRandomOrder()->get();

                    foreach($get_pictures as $get_picture){
                        array_push($approved_pictures , $get_picture);
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
            $searched_photos_size  = count($searched_photos);
            foreach ($approved_pictures as $key=> $approved_picture){
                $searched_photos[$searched_photos_size+$key+1] = $approved_picture;
            }
        }

        /*if($request->category != null && $request->has('category')){
            if(count($searched_photos)>1){
                foreach ( $searched_photos as $key => $searched_photo){
                    if($searched_photo->id != $request->category){
                        unset($searched_photos[$key]);
                    }
                    else{
                        continue;
                    }
                }
            }
        }*/
        /*if ($request->price != null && $request->has('price')){
            if(count($searched_photos)>1){
                foreach ( $searched_photos as $key => $searched_photo){
                   if($searched_photo->price != null){
                       if(in_array($searched_photo->price,$price_range)){
                           continue;
                       }
                       else{
                           unset($searched_photos[$key]);
                       }
                   }
                   else{

                       if(in_array($searched_photo->upload->collections->price,$price_range)){
                           continue;
                       }
                       else{
                           unset($searched_photos[$key]);
                       }
                   }
                }
            }
        }*/
        if($request->has('photo_type') && $request->photo_type != null){
            if(count($searched_photos)>1){
                foreach ( $searched_photos as $key => $searched_photo){
                    if($searched_photo->type == $request->photo_type){
                        continue;
                    }
                    else{
                        unset($searched_photos[$key]);
                    }

                }
            }
        }

        foreach ($searched_photos as $key=> $searched_photo){

            foreach ($searched_photos as $keys => $confirmed_search_photo){
                if($key == $keys){
                    continue ;
                }
                else{
                    if($searched_photo->image == $confirmed_search_photo->image){
                        unset($searched_photos[$key]);
                    }
                    else{
                        continue ;
                    }
                }
            }

        }
        $approved_pictures_array = OtherMethods::fetchPhotosForFlex(3,$searched_photos);
        $keyword = [];
        foreach ($approved_pictures_array as $key => $picture){
                if(array_key_exists($key, $approved_pictures_array)){
                    $picture_tags =  $picture[key($approved_pictures_array)]->tags;
                    $words = explode(',', $picture_tags);
                    foreach ($words as $word){
                        array_push($keyword,$word);
                    }

                }
        }
        foreach ($keyword as $key=> $word){

            foreach ($keyword as $keys => $confirmed_word){
                if($key == $keys){
                    continue ;
                }
                else{
                    if(ltrim(($word))  == ltrim($confirmed_word)){
                        unset($keyword[$key]);
                    }
                    else{
                        continue ;
                    }
                }
            }

        }

        /*foreach ($keyword as $key => $word){
            foreach ($keyword as $keys => $confirmed_word){
                if ($key != $keys){
                    if ($word == $confirmed_word){
                        unset($keyword[$key]);
                    }
                }
            }
        }*/
        /*dd($tags);*/
        /*$keyword = [];
        foreach($tags as  $tag){
            $get_tag = Photo::where('tags',"LIKE","%".$tag."%")->get();
            foreach ($get_tag as $tag){
                array_push($keyword,$tag);
            }
        }
        foreach ($keyword as $key=> $word){

            foreach ($keyword as $keys => $confirmed_word){
                if($key == $keys){
                    continue ;
                }
                else{
                    if($word->keyword == $confirmed_word->keyword){
                        unset($keyword[$key]);
                    }
                    else{
                        continue ;
                    }
                }
            }

        }*/
        /*if(count($keyword) == 0){
            $get_random_keywords = Keyword::all();
            if (count($get_random_keywords)>=4){
                $get_random_keywords = $get_random_keywords->random(4);
            }
            foreach ($get_random_keywords as $get_random_keyword){
                array_push($keyword, $get_random_keyword);
            }
        }*/

        /*if(count($keyword)>= 4)
        {
            $keyword = array_random($keyword, 4);
        }
        else{
            $keyword = array_random($keyword, count($keyword));
        }*/

       // $categories = Category::get();
        return view('action.search_result', compact(/*'categories',*/ 'approved_pictures_array', 'keyword', 'searched_word'));
    }
    public function upload(Request $request, $id)
    {


        for($i=0; $i<5; $i++){
            //try {
            $maximum_upload_count = 6;
            $photo_commission_percentage = 0.01;
            $free_count = 0;

            for($i=1; $i<$maximum_upload_count; $i++)
            {
                $this->validate($request, [
                    'type'.$i =>'bail|required',
                    //'tag'.$i => 'bail|required',
                    'description'.$i => 'bail|required',
                    'category'.$i => 'bail|required',
                    // 'price'.$i => 'bail|required',
                    // 'feature'.$i => 'bail|required',
                    'image'.$i => 'bail|required|max:4000',
                ]);
                $type = "type".$i;
                if($request->$type == 1 ){
                    $free_count = $free_count + 1;
                }

            }

            if($free_count<3){
                return redirect()->back()->with("failure", "Basic pictures must be up to 3");
            }

            $new_upload = new Upload();
            $new_upload->user_id = $id;
            $new_upload->save();

            for($i=1; $i<$maximum_upload_count; $i++)
            {
                // Get uploaded file
                $image = $request->file('image'.$i);

                // Creating a random name  for the image
                $image_name = str_random(10).'.'.$image->getClientOriginalExtension();

                // $new_price = 'price'.$i;
                // $new_feature = 'feature'.$i;
                $new_tag = 'tag'.$i;
                $tag = $request->$new_tag;

                if(substr($tag, strlen($tag) - 1, strlen($tag)) == ",")
                {
                    $tag = substr($tag, 0, strlen($tag) - 1);
                }
                $price = Price::orderBy('created_at', "desc")->first();
                $new_type = 'type'.$i;
                if($request->$new_type == 1){
                    $price->price = 0;
                    //$request->$new_feature = 0;
                }
                $new_category = 'category'.$i;
                $new_description = 'description'.$i;

                // Create new photo instance
                $new_photo = new Photo();

                // Set attributes for photo
                $new_photo->upload_id = $new_upload->id;
                $new_photo->image = $image_name;
                $new_photo->featured = 0;
                $new_photo->title = $request->$new_description;
                $new_photo->slug = Str::slug($request->$new_description);
                $new_photo->type = $request->$new_type;
                $new_photo->price = $price->price;
                $new_photo->commission = /*($request->$new_feature) ? $photo_commission_percentage * $price :*/ 0;
                $new_photo->tags = $tag;
                $new_photo->category_id = 1;

                // Resize and process photo by adding watermark
                // 1.) Create an instance of the image for processing
                $make_image = Image::make($image);
                // 2.) Save original image
                $custom_properties = $new_photo->getImageCustomProperties($make_image);
                $orientation = $custom_properties[0];
                $image_size = $custom_properties[1];
                $new_photo->size = $image_size;
                $new_photo->orientation = $orientation;
                $is_file_uploaded = Storage::disk('dropbox')->put( '/', $image,'image.jpg');
                // Storage::put('uploads/original/'.$image_name, $make_image->encode());



                // 3.) get custom height for each of the dimensions
                /*$image_dimensions = [
                    'large',
                    'medium',
                    'small'
                ];

                // 4.) Process and save resized versions of photo for legal download
                foreach ($image_dimensions as $image_dimension)
                {
                    $custom_size = $new_photo->getImageCustomDimension($make_image, $image_dimension);
                    $resized_image = $make_image->resize($custom_size[0], $custom_size[1]);
                    Storage::put('uploads/'.$image_dimension.'/'.$image_name, $resized_image->encode());
                }

                // 5.) Process and save watermarked and resized versions of photo for public use
                // 5.1) Create watermarked version
                $watermarked_image = $make_image->insert(public_path("/uploads/yaami.png"));

                // Save watermarked original
                Storage::disk("public")->put('uploads/original/'.$image_name, $watermarked_image->encode());

               /* $watermarked_image_dimensions = [
                    100,
                    250
                ];
                foreach ($watermarked_image_dimensions as $watermarked_image_dimension)
                {
                    $custom_size = $new_photo->getImageCustomDimension($watermarked_image, $watermarked_image_dimension);
                    $resized_image = $watermarked_image->resize($custom_size[0], $custom_size[1]);
                    Storage::disk("public")->put('uploads/'.$watermarked_image_dimension.'/'.$image_name, $resized_image->encode());
                }*/

                // Save photo to database
                $watermarked_image = $make_image->insert(public_path("/uploads/yaami.png"));

                // Save watermarked original
                Storage::disk("public")->put('uploads/original/'.$image_name, $watermarked_image->encode());

                $new_photo->image_re_id = $is_file_uploaded;
                $new_photo->save();
            }

            return redirect()->back()->with("success", "Images uploaded successfully");

            // } catch (ValidationException $exception)
            // {
            /*dd($exception->validator->errors()->first());*/
            //    return redirect()->back()->with("failure", $exception->validator->errors()->first())->withInput();

            //  } catch (\Exception $exception)
            //  {
            /*dd($exception->getMessage());*/
            //     return redirect()->back()->with("failure", $exception->getMessage())->withInput();
            // }
        }


    }
 public function collectionUpload(Request $request)
    {
        for($i=1; $i<2; $i++){
            try {
                $maximum_upload_count = 2;
                $photo_commission_percentage = 0.01;

                for($i=1; $i<$maximum_upload_count; $i++)
                {
                    $this->validate($request, [
                        'type'.$i =>'bail|required',
                        // 'tag'.$i => 'bail|required',
                        'description'.$i => 'bail|required',
                        'category'.$i => 'bail|required',
                        // 'price'.$i => 'bail|required',
                        //  'feature'.$i => 'bail|required',
                        'image'.$i => 'bail|required',
                    ]);
                }
                $price = Price::orderBy('created_at', "desc")->first();
                $new_upload = new Upload();
                $new_upload->user_id = Auth::user()->id;
                $new_upload->is_collection = 1;
                $new_upload->save();
                $new_collection = new Collection();
                $new_collection->upload_id = $new_upload->id;
                $new_collection->price = $price->price;
                $new_collection->save();
                if($request->hasFile('image1')){
                    foreach($request->file('image1') as $file)
                    {


                        // Creating a random name  for the image
                        $image_name = str_random(10).'.'.$file->getClientOriginalExtension();
                        // $new_price = 'price'.$i;
                        $new_feature = 'feature'.$i;
                        $new_tag = 'tag'.$i;
                        $tag = $request->$new_tag;

                        if(substr($tag, strlen($tag) - 1, strlen($tag)) == ",")
                        {
                            $tag = substr($tag, 0, strlen($tag) - 1);
                        }

                        $new_type = 'type'.$i;
                        $new_category = 'category'.$i;
                        $new_description = 'description'.$i;

                        // Create new photo instance
                        $new_photo = new Photo();

                        // Set attributes for photo
                        $new_photo->upload_id = $new_upload->id;
                        $new_photo->image = $image_name;
                        $new_photo->featured = 0;
                        $new_photo->title = $request->description1;
                        $new_photo->slug = Str::slug($request->description1);
                        $new_photo->type = $request->type1;
                        $new_photo->commission = /*($request->feature1) ? $photo_commission_percentage * $request->price1 :*/ 0;
                        $new_photo->tags = $request->tag1;
                        $new_photo->category_id = $request->category1;
                        $new_photo->collection_id = $new_collection->id;

                        // Resize and process photo by adding watermark
                        // 1.) Create an instance of the image for processing
                        $make_image = Image::make($file);

                        $custom_properties = $new_photo->getImageCustomProperties($make_image);
                        $orientation = $custom_properties[0];
                        $image_size = $custom_properties[1];
                        $new_photo->size = $image_size;
                        $new_photo->orientation = $orientation;

                        // 2.) Save original image
                        /*$file_src = $request->file('image');
                       $is_file_uploaded = Storage::disk('dropbox')->put( '/', $file_src,'image.jpg');

                       dd($is_file_uploaded);*/
                        $is_file_uploaded = Storage::disk('dropbox')->put( '/', $file,'image.jpg');
                        // Storage::put('uploads/original/'.$image_name, $make_image->encode());

                        // 3.) get custom height for each of the dimensions
                        /*$image_dimensions = [
                            'large',
                            'medium',
                            'small'
                        ];*/

                        // 4.) Process and save resized versions of photo for legal download
                        /* foreach ($image_dimensions as $image_dimension)
                         {
                             $custom_size = $new_photo->getImageCustomDimension($make_image, $image_dimension);
                             $resized_image = $make_image->resize($custom_size[0], $custom_size[1]);
                             Storage::put('uploads/'.$image_dimension.'/'.$image_name, $resized_image->encode());
                         }*/

                        // 5.) Process and save watermarked and resized versions of photo for public use
                        // 5.1) Create watermarked version
                        $watermarked_image = $make_image->insert(public_path("/uploads/yaami.png"));

                        // Save watermarked original
                        Storage::disk("public")->put('uploads/original/'.$image_name, $watermarked_image->encode());

                        /*$watermarked_image_dimensions = [
                            100,
                            250
                        ];

                        foreach ($watermarked_image_dimensions as $watermarked_image_dimension)
                        {
                            $custom_size = $new_photo->getImageCustomDimension($watermarked_image, $watermarked_image_dimension);
                            $resized_image = $watermarked_image->resize($custom_size[0], $custom_size[1]);
                            Storage::disk("public")->put('uploads/'.$watermarked_image_dimension.'/'.$image_name, $resized_image->encode());
                        }*/

                        // Save photo to database
                        $new_photo->image_ref_id = $is_file_uploaded;
                        $new_photo->save();
                    }

                    return redirect()->back()->with("success", "Images uploaded successfully");
                }


            } catch (ValidationException $exception)
            {
                /*dd($exception->validator->errors()->first());*/
                return redirect()->back()->with("failure", $exception->validator->errors()->first())->withInput();

            } catch (\Exception $exception)
            {
                /*dd($exception->getMessage());*/
                return redirect()->back()->with("failure", $exception->getMessage())->withInput();
            }
        }




    }

    public function editUploadPictures(Request $request, $id){

        $previous_pictures =Photo::where("upload_id", $id)->get();
        $upload = Upload::where("id", $id)->first();
        $maximum_upload_count = 6;
        $photo_commission_percentage = 0.01;
        $free_count = 0;
        // $price = Price::orderBy('created_at', "desc")->first();
        for($i=1; $i<$maximum_upload_count; $i++)
        {
            $type = "type".$i;

            if($request->$type == 1 ){
                $free_count = $free_count + 1;
            }

        }

        if($free_count<3){
            return redirect()->back()->with("failure", "Basic pictures must be up to 3");
        }
        for($i=1; $i<$maximum_upload_count; $i++)
        {
            $new_image = "image".$i ;
            if($request->$new_image){
                $image = $request->file('image'.$i);
                $image_name = str_random(10).'.'.$image->getClientOriginalExtension();
            }
            $new_price = Price::orderBy('created_at', "desc")->first();
            //$new_price = 'price'.$i;
            // $new_feature = 'feature'.$i;
            $new_tag = 'tag'.$i;
            $tag = $request->$new_tag;

            if(substr($tag, strlen($tag) - 1, strlen($tag)) == ",")
            {
                $tag = substr($tag, 0, strlen($tag) - 1);
            }

            $new_type = 'type'.$i;
            if($request->$new_type == 1){
                $new_price->price = 0;
                // $request -> $new_feature = 0;
            }
            $new_category = 'category'.$i;
            $new_description = 'description'.$i;
            $new_picture_id = "picture_id".$i;

            $upload->approved = 0;
            $upload->save();

            foreach ($previous_pictures as $previous_picture){
                if($previous_picture->id == $request->$new_picture_id){
                    if($request->$new_image){
                        $previous_picture ->image = $image_name;
                    }

                    $previous_picture->featured = 0;
                    $previous_picture->title = $request->$new_description;
                    $previous_picture->slug = Str::slug($request->$new_description);
                    $previous_picture->type = $request->$new_type;
                    $previous_picture->price = $new_price->price;
                    $previous_picture->commission = /*($request->$new_feature) ? $photo_commission_percentage * $request->$new_price :*/ 0;
                    $previous_picture->tags = $tag;
                    $previous_picture->category_id = $request->$new_category;
                    if($request->$new_image){
                        $make_image = Image::make($image);
                        // 2.) Save original image
                        $custom_properties = $previous_picture->getImageCustomProperties($make_image);
                        $orientation = $custom_properties[0];
                        $image_size = $custom_properties[1];
                        $previous_picture->size = $image_size;
                        $previous_picture->orientation = $orientation;

                        $is_file_uploaded = Storage::disk('dropbox')->put( '/', $image,'image.jpg');
                        // Storage::put('uploads/original/'.$image_name, $make_image->encode());

                        // 3.) get custom height for each of the dimensions
                        /*$image_dimensions = [
                            'large',
                            'medium',
                            'small'
                        ];*/

                        // 4.) Process and save resized versions of photo for legal download
                        /* foreach ($image_dimensions as $image_dimension)
                         {
                             $custom_size = $previous_picture->getImageCustomDimension($make_image, $image_dimension);
                             $resized_image = $make_image->resize($custom_size[0], $custom_size[1]);
                             Storage::put('uploads/'.$image_dimension.'/'.$image_name, $resized_image->encode());
                         }*/
                        // 5.) Process and save watermarked and resized versions of photo for public use
                        // 5.1) Create watermarked version
                        $watermarked_image = $make_image->insert(public_path("/uploads/yaami.png"));

                        // Save watermarked original
                        Storage::disk("public")->put('uploads/original/'.$image_name, $watermarked_image->encode());

                        /*$watermarked_image_dimensions = [
                            100,
                            250
                        ];

                        foreach ($watermarked_image_dimensions as $watermarked_image_dimension)
                        {
                            $custom_size = $previous_picture->getImageCustomDimension($watermarked_image, $watermarked_image_dimension);
                            $resized_image = $watermarked_image->resize($custom_size[0], $custom_size[1]);
                            Storage::disk("public")->put('uploads/'.$watermarked_image_dimension.'/'.$image_name, $resized_image->encode());
                        }*/

                    }
                    // Save photo to database
                    $previous_picture->image_ref_id = $is_file_uploaded;
                    $saved =  $previous_picture->save();
                    if($saved){
                        return redirect()->back()->with("success", "Upload updated successfully");
                    }
                    else{
                        return redirect()->back()->with("failure", "Error updating the upload");
                    }

                }
            }
        }
    }

    public function homepage(){
        $all_cashouts = Cashout::where('status',0)->get();
        $all_uploads = Upload::get();
        $all_users = User::get();
        $all_downloads = Transaction::get();
        $latest_price = Price::orderBy('created_at', "desc")->first();
        return view('Admin.dashboard',compact('all_uploads','all_cashouts','all_users','all_downloads', 'latest_price'));
    }

    public function imageDetails(Request $request,$slug,$id){
        $categories = Keyword::all();

        if($categories->count() >= 10)
        {
            $categories = $categories->random(10);
        }
        $photoDetails = Photo::where('slug', $slug)
            ->where('id',$id)->first();
        $get_upload = Upload::where('id',$photoDetails->upload_id)->first();
        $all_photos = array();
        if($get_upload->is_collection ==1 ){
            $all_photos = Photo::whereHas('upload', function($query) use ($get_upload){
                $query->where('id', $get_upload->id);
            })->get();
        }
        $featured_pictures = Photo::whereHas('upload', function($query){
            $query->where('approved', 1);
        })->where('featured', 1)->get();

        if($featured_pictures->count() >= 8)
        {
            $featured_pictures = $featured_pictures->random(8);
        }

        $get_all_picture_reviews = Review::where("image_id", $id)->get();
        if(count($get_all_picture_reviews ) == 0){
            $image_review  = 0;
        }
        else{
            $review_count = count($get_all_picture_reviews);
            $total_review = 0;
            foreach($get_all_picture_reviews as $get_all_picture_review){
                $total_review = $total_review + $get_all_picture_review->rating;
            }
            $image_review = round($total_review / $review_count);
        }

        $all_transactions = Transaction::get();
        $is_paid = false;
       if(Auth::check()){
           $is_paid = false;
           if($photoDetails->price != null){
               $checkpayment = Transaction::where(function ($query)use($id) {
                   $query->where("picture_id", $id);
               })->where('user_id', Auth::user()->id)->get();
               if(!$checkpayment->isEmpty()){
                   $is_paid = true;
               }
           }else{
               $checkpayment = Transaction::where(function ($query)use($photoDetails) {
                   $query->where("collection_id", $photoDetails->collection_id);
               })->where('user_id', Auth::user()->id)->get();
               if(!$checkpayment->isEmpty()){
                   $is_paid = true;
               }
           }
       }
        $regions = $this->regions;
       $current_location = $request->session()->get("location");
        $current_region = Region::where("currency_code",$current_location[0])->first();
       $get_region = Region::where("currency_code", $current_location[0])->first();
        return view('action.checkout', compact('photoDetails', 'all_transactions','all_photos','featured_pictures', "image_review", "is_paid", "categories", "regions", "get_region","current_region"));
    }

    public function dasboardRendering(){
        $user_id = Auth::user()->id;
        $get_user_transactions =Transaction::where('user_id', $user_id)->get();
        $get_user_withdrawals = Cashout::where(function ($query) {
            $query->where("status", 0)
                ->orWhere("status", 1);
        })->where('user_id', $user_id)->get();
        $get_user_previous_transactions = Transaction::where(function ($query){
            $date = Carbon::now()->subDays(2);
               $query->where("created_at","<",$date);
        })->where("user_id", $user_id)->get();
        $total_downloads = count($get_user_transactions);
        $total_transaction_earnings = 0;
        $total_transaction_withdrawals = 0;
        $total_withdrawable_earnings = 0;
        foreach ($get_user_transactions as $get_user_transaction){
            $total_transaction_earnings = $total_transaction_earnings +($get_user_transaction->price) - ($get_user_transaction->price * 0.25) ;
        }
        foreach ($get_user_withdrawals as $get_user_withdrawal){
            $total_transaction_withdrawals = $total_transaction_withdrawals + $get_user_withdrawal->amount;
        }

        foreach ($get_user_previous_transactions as $get_user_previous_transaction){
            $total_withdrawable_earnings = $total_withdrawable_earnings +(($get_user_previous_transaction->price) - ($get_user_previous_transaction->price * 0.25)) ;
        }
        $earning = $total_transaction_earnings - $total_transaction_withdrawals;
        $withdrawable = $total_withdrawable_earnings - $total_transaction_withdrawals;
        $messages = Review::where('user_id', Auth::user()->id)->get();
        $all_upload = Upload::where('user_id', Auth::user()->id)->get();
        $upload_count = count($all_upload);
        $number_count = count($messages);
        return view('action.dashboard', compact('number_count', 'earning', 'total_downloads', "upload_count", "withdrawable"));
    }

    public function viewMessage(){
        $messages = Review::where('user_id', Auth::user()->id)->get();
        return view('action.message', compact('messages'));
    }

    public function deleteMessage($id){
        $result = Review::where('id', $id)->delete();
        if($result){
            return redirect()->back()->with('success', 'Review deleted succesfully');
        }
        else{
            return redirect()->back()->with('success','error occur while deleting Review');
        }
    }
    public function displayUploadForm(){
        $latest_price = Price::orderBy('created_at', "desc")->first();
        $categories = Category::get();
        return view('action.upload_photos',compact('categories', "latest_price"));
    }
    public function displayCollectionUploadForm(){
        $categories = Category::get();
        $latest_price = Price::orderBy('created_at', "desc")->first();
        return view('action.upload_collection_photos',compact('categories', 'latest_price'));
    }

    public function editProfileRendering(){
        return view('action.editProfile');
    }

    public function updateProfileAccount(Request $request,$id){
          $this->validate($request,[
                'fullname' =>'bail|required',
                'email' =>'bail|required',
               /* 'account_type'=>'bail|required',
                'previous_password'=>'bail|required',
                'new_password'=>'bail|required',
                'confirm_password'=>'bail|required',*/
            ]);
          $new_update = User::where('id', $id)->update([
               'name' => $request->fullname,
               'email'=> $request->email,
           ]);
          if($new_update){
              return redirect()->back()->with('good','Account updated successfully');
          }
          else{
              return redirect()->back()->with('bad','Account Update failed');
          }
    }
    public function updateProfilePassword(Request $request,$id){
        $this->validate($request,[
            /*'fullname' =>'bail|required',
            'email' =>'bail|required',
            'account_type'=>'bail|required',*/
            'previous_password'=>'bail|required',
            'new_password'=>'bail|required',
            'confirm_password'=>'bail|required',
        ]);
        if($request->confirm_password == $request->new_password){
            $password = Auth::user()->password;
            if(Hash::check($request->previous_password, $password)){
                $new_update = User::where('id', $id)->update([
                   /* 'name' => $request->fullname,
                    'email'=> $request->email,*/
                    'password'=>Hash::make($request->new_password),
                ]);
                Auth::attempt(['email' => $request->email, 'password' =>$password ]);
                if($new_update){
                    return redirect()->back()->with('good','Account updated successfully');
                }
                else{
                    return redirect()->back()->with('bad','Account Update failed');
                }

            }
            else{
                return redirect()->back()->with('bad','Previous password is incorrect, please double check');
            }
        }
        else{
            return redirect()->back()->with('bad','Passwords do not match, please double check');
        }

    }

  /*  public function searchCategory($category_id){
        $search_results =Photo::whereHas('upload', function($query){
            $query->where('approved', 1);
             })->where('category_id',$category_id)->paginate(2);
        $categories = Category::get();
        return view('action.search_result',compact('search_results','categories'));
    }*/

    public function download(Request $request,$slug){
             $image = Photo::where('image',$slug)->first();
             function  getImageCustomDimension($image, $dimension, $to_be_returned = 'height')
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

             if($image->price !== null ){

                 /*$header =array(
                     'Content-Type: image/jpg',
                 );
                 return Storage::disk('dropbox')->download($image->image_ref_id, '');*/

                 $check_image = file_exists(public_path('uploads/original/'.$image->image));
                 if($check_image){
                     $header =array(
                         'Content-Type: image/jpg',
                     );
                    // return response()->download(Storage::url('https://www.dropbox.com/home?preview=zKqxKjm5WMLQNCruPDOids7PZyL1vQBoSJ7SOL4U.jpeg'));
/*                     return response()->download(public_path('uploads/original/'.$image->image).$image->image), $image->slug.'.jpg',$header);*/
                     return response()->download(public_path('uploads/original/'.$image->image),$image->slug.'.jpg', $header);
                 }
                 else{
                     return redirect()->back()->with('failure', 'file does not exits');
                 /*$get_image = Storage::disk('dropbox')->get($image->image_ref_id);
                 $image_make = Image::make($get_image);
                 $custom_size = getImageCustomDimension($image_make, $request->size);
                 $resized_image = $image_make->resize($custom_size[0], $custom_size[1]);
                 Storage::put('uploads/'.$request->size.'/'.$image->image, $resized_image->encode());
                 $header =array(
                     'Content-Type: image/jpg',
                 );
                 return response()->download(storage_path('/app/uploads/'.$request->size.'/'.$image->image), $image->slug.'.jpg',$header);*/

                 }
             }
             /*else{
                 $zip_file_name = $image->slug.'.zip';
                 $file_dir = storage_path('/app/uploads/'.$request->size);
                 $check_file = Storage::exists('uploads/'.$request->size.'/'.$zip_file_name);
                 if($check_file){
                     $header =array(
                         'Content-Type' => 'application/octet-stream',
                     );
                     $file_to_path = $file_dir."/".$zip_file_name;
                     if(file_exists($file_to_path)){
                         return response()->download($file_to_path,$zip_file_name,$header);
                     }
                     return ['status'=>'file does not exist'];
                 }
                 else{
                     $all_collections = Photo::where('upload_id' , $image->upload_id)->get();
                     foreach ($all_collections as $all_collection){
                         //$get_image = Storage::get('uploads/original/'.$all_collection->image);
                         $get_image = Storage::disk('dropbox')->get($all_collection->image_ref_id);
                         $image_make = Image::make($get_image);
                         $custom_size = getImageCustomDimension($image_make, $request->size);
                         $resized_image = $image_make->resize($custom_size[0], $custom_size[1]);
                         Storage::put('uploads/'.$request->size.'/'.$all_collection->image, $resized_image->encode());
                     }
                     $zip = new \ZipArchive();
                     if ($zip->open($file_dir . '/' . $zip_file_name, ZipArchive::CREATE) === TRUE) {
                         foreach ($all_collections as $all_collection){
                             $zip->addFile(storage_path('/app/uploads/'.$request->size.'/'.$all_collection->image),$all_collection->image.'.jpg');
                         }
                         $zip->close();
                     }
                     $header =array(
                         'Content-Type' => 'application/octet-stream',
                     );
                     $file_to_path = $file_dir."/".$zip_file_name;
                     if(file_exists($file_to_path)){
                         foreach ($all_collections as $all_collection){
                             $check_status = Storage::delete('/uploads/'.$request->size.'/'.$all_collection->image);
                         }
                         return response()->download($file_to_path,$zip_file_name,$header);
                     }
                     return ['status'=>'file does not exist'];
                 }

             }*/
    }
    public function photographers(){
        $sellers = User::where('is_seller',1)->where('is_activated',1)->paginate(3);
        return view('action.photographers', compact('sellers'));
    }

    public function photographersDetails($name){
        $seller = User::where('name', $name)->first();
        return view('action.photographerProfile', compact('seller'));
    }

    public function message(Request $request, $id){
        $validate = $this->validate($request,[
            'name' => 'bail|required',
            'email' => 'bail|required',
            'message' => 'bail|required'
        ]);
        if($validate){
            $new_message = Message::create([
                'user_id' => $id,
                'email' => $request->email,
                'message' => $request->message,
                'name' => $request->name,
            ]);
            if ($new_message){
                return redirect()->back()->with('success', ' Message sent successfully');
            }
            else{
                return redirect()->back()->with('failure', ' Error sending message');

            }
        }else{
            return redirect()->back()->with('failure', ' please fill all the fields');
        }
    }
    public function confirmPayment(Request $request){
        //get the user_id that uploaded the photo
        $client = new Client();
        $url = "https://api.demo.payant.ng/payments/".$request->reference_key;
        $headers = [
            "Authorization" => "Bearer 6908dd0994dcd64c06a8dcbaefa0147274f52036404cf8b2797cc3cb",
            "Content-Type" => "application/json"
        ];
        $result = $client->request(
            "GET",
            $url,
            [
                "headers" => $headers
            ]
        );
       $transaction_details = json_decode($result->getBody()->getContents());
       if (isset($transaction_details->status) && $transaction_details->status =="success"){
           $image_id =  $request->image_id;
           $upload= Upload::whereHas('photos', function($query) use($image_id){
               $query->where('id',$image_id);
           })->first();
           $image  = Photo::where("id", $image_id)->first();
           if($image->price!=null){
               $update_transaction = Transaction::create([
                   "user_id" =>Auth::user()->id,
                   "picture_id" =>$request->image_id,
                   "price" =>$request->price,
                   "is_paid" => 1,
                   "upload_id" => $upload->id,
               ]);
               if($update_transaction){
                   $response = array(
                       "status" => true,
                       "msg" => "confirm"
                   );
                   return response()->json($response);
               }
               else{
                   $response = array(
                       "status" => false,
                       "msg" => "not confirm"
                   );
                   return response()->json($response);
               }
           }
           else{
               $update_transaction = Transaction::create([
                   "user_id" =>Auth::user()->id,
                   "price" =>$request->price,
                   "is_paid" => 1,
                   "upload_id" => $upload->id,
                   "collection_id" =>$image->collection_id,
               ]);
               if($update_transaction){
                   $response = array(
                       "status" => true,
                       "msg" => "confirm"
                   );
                   return response()->json($response);
               }
               else{
                   $response = array(
                       "status" => false,
                       "msg" => "not confirm"
                   );
                   return response()->json($response);
               }
           }

       }
       else{
           $response = array(
               "status" => false,
               "msg" => "payment not successful"
           );
           return response()->json($response);
       }

    }

    public function confirmFeaturePayment(Request $request){
        $client = new Client();
        $url = "https://api.demo.payant.ng/payments/".$request->reference_key;
        $headers = [
            "Authorization" => "Bearer 6908dd0994dcd64c06a8dcbaefa0147274f52036404cf8b2797cc3cb",
            "Content-Type" => "application/json"
        ];
        $result = $client->request(
            "GET",
            $url,
            [
                "headers" => $headers
            ]
        );
        $transaction_details = json_decode($result->getBody()->getContents());
        if (isset($transaction_details->status) && $transaction_details->status =="success"){
            $add_feature_attribute = Photo:: where("id", $request->image_id)->update([
                'featured' => 1 ,
            ]);
            if($add_feature_attribute){
                $response = array(
                    "status" => true,
                    "msg" => "confirm"
                );
                return response()->json($response);
            }
            else{
                $response = array(
                    "status" => false,
                    "msg" => "confirm"
                );
                return response()->json($response);
            }
        }
        else{
            $response = array(
                "status" => false,
                "msg" => "confirm"
            );
            return response()->json($response);
        }

    }
    public function confirmFeaturePaymentWallet(Request $request){
        $user_id = Auth::user()->id;
        $get_user_previous_transactions = Transaction::where(function ($query){
            $date = Carbon::now()->subDays(2);
            $query->where("created_at","<",$date);
        })->where("user_id", $user_id)->get();
        $get_user_withdrawals = Cashout::where(function ($query) {
            $query->where("status", 0)
                ->orWhere("status", 1);
        })->where('user_id', $user_id)->get();
        $total_previous_transaction = 0;
        $total_transaction_withdrawals = 0;

        foreach ($get_user_previous_transactions as $get_user_previous_transaction){
            $total_previous_transaction = $total_previous_transaction + ($get_user_previous_transaction->price)-($get_user_previous_transaction->price * 0.25) ;
        }
        foreach ($get_user_withdrawals as $get_user_withdrawal){
            $total_transaction_withdrawals = $total_transaction_withdrawals + $get_user_withdrawal->amount;
        }

        $earning = $total_previous_transaction - $total_transaction_withdrawals;

        if($earning < 180){
            return redirect()->back()->with('failure', 'Insufficient Fund');
        }
        else{
            $update_withdrawal =Cashout::Create([
                'user_id' => Auth::user()->id,
                'amount' => 180,
                'status' => 1,
            ]);
            if ($update_withdrawal){
                $update_feature = Photo::where('id', $request->image_id)->update([
                   'featured' => 1,
                ]);
                if($update_feature){
                    return redirect()->back()->with('success', 'Image is featured successfully');
                }
                else{
                    return redirect()->back()->with('failure', 'Image could not be featured');
                }
            }
            else{
                return redirect()->back()->with('failure', 'Image could not be featureds');
            }
        }
    }

    public function checkpayment(Request $request){
        $get_user = User::where('id', $request->id)->first();
        $get_image = Photo::where('image', $request->image)->first();
        if($get_image->price!= null){
            $confirm_payment = Transaction::where('user_id', $get_user->id)
                ->where('picture_id', $get_image->id) ->first();
            if($confirm_payment){
                $response = array(
                    "status" => "true",
                );
                return response()->json($response);
            }
            else{
                $response = array(
                    "msg"=>'isokay'
                );
                return response()->json($response);
            }
        }
        else{
            $confirm_payment = Transaction::where('user_id', $get_user->id)
                ->where('upload_id', $get_image->upload_id) ->first();
            if($confirm_payment){
                $response = array(
                    "status" => "true",
                );
                return response()->json($response);
            }
            else{
                $response = array(
                    "msg"=>'isokay'
                );
                return response()->json($response);
            }
        }

    }

    public function cashoutRendering(){
        $all_requests = Cashout::where('user_id',Auth::user()->id)->get();
        return view('action.cashout', compact('all_requests'));
    }
    public function cashout(Request $request){

        $validation = $this->validate($request, [
            'amount' => 'bail|required'
        ]);
        $user_details = Account::where('user_id', Auth::user()->id)->first();
        if($user_details){
            $user_id = Auth::user()->id;
            $get_user_previous_transactions = Transaction::where(function ($query){
                $date = Carbon::now()->subDays(2);
                $query->where("created_at","<",$date);
             })->where("user_id", $user_id)->get();
            $get_user_withdrawals = Cashout::where(function ($query) {
                                    $query->where("status", 0)
                                        ->orWhere("status", 1);
                                })->where('user_id', $user_id)->get();
            $total_previous_transaction = 0;
            $total_transaction_withdrawals = 0;

            foreach ($get_user_previous_transactions as $get_user_previous_transaction){
                $total_previous_transaction = $total_previous_transaction + ($get_user_previous_transaction->price)-($get_user_previous_transaction->price * 0.25) ;
            }
            foreach ($get_user_withdrawals as $get_user_withdrawal){
                $total_transaction_withdrawals = $total_transaction_withdrawals + $get_user_withdrawal->amount;
            }

            $earning = $total_previous_transaction - $total_transaction_withdrawals;
            if($earning > $request->amount){
                if($validation){
                    $new_cashout = Cashout::create([
                        'user_id' => Auth::user()->id,
                        'amount' => $request->amount,
                        'status' => 0,
                    ]);
                }
                if($new_cashout ) {
                    return redirect()->back()->with('good', 'Request submitted for processing');
                }
                else{
                    return redirect()->back()->with('bad', 'Error submitting request');

                }
            }
            else{
                return redirect()->back()->with('bad', 'Insufficient  Balance, upload pictures to make more money');
            }
        }else{
            return redirect()->back()->with('bad', 'Bank Account Details must be added before withdrawal can be made');
        }


    }
    public function updateBankDetails(){
        $get_user = Account::where('user_id', Auth::user()->id)->first();
        return view('action.update_bank_details', compact("get_user"));
    }

    public  function bankDetails(Request $request){
        $this->validate($request,[
            'account_name' => 'bail|required',
            'account_number' => 'bail|required',
            'bank' => 'bail|required'
        ]);
        $get_user = Account::where('user_id', Auth::user()->id)->first();
        if(!$get_user){
            $add_account = Account::Create([
                'user_id' => Auth::user()->id,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'bank' => $request->bank,
            ]);
            if($add_account){
                return redirect()->back()->with('good', 'Bank details updated successfully');
            }
            else{
                return redirect()->back()->with('bad', 'Action could not be executed');
            }
        }else{
            $add_account = Account::where('user_id',Auth::user()->id)->update([
                'user_id' => Auth::user()->id,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'bank' => $request->bank,
            ]);
            if($add_account){
                return redirect()->back()->with('good', 'Bank details updated successfully');
            }
            else{
                return redirect()->back()->with('bad', 'Action could not be executed');
            }

        }
    }
    public function uploadStatus(){
        $all_uploads = Upload::where('user_id', Auth::user()->id)->get();
        return view('action.check_upload_status', compact('all_uploads'));
    }
    public function myGallery(){
        $user_transactions = Transaction::where('user_id',Auth::user()->id)->get();

        $approved_pictures_array = OtherMethods::fetchPhotosForFlexMyGallery(3,$user_transactions);

        return view('action.check_all_paid_pictures', compact('approved_pictures_array'));
    }

    public function rateUser(Request $request){
        if(Auth::check()){
            $check_rate_history = Review::where("user_id", Auth::user()->id)->first();
            if($check_rate_history){
                $response = array(
                    "status" => "false",
                );
                return response()->json($response);
            }
            else{
                $rate_user = Review::create([
                    'user_id' => $request->user_id,
                    'comment' => $request->comment,
                    'rating'  => $request->rating,
                    'image_id' => $request->image_id,
                ]);
                if($rate_user){
                    $response = array(
                        "status" => "true",
                    );
                    return response()->json($response);
                }
                else{
                    $response = array(
                        "status" => "false",
                    );
                    return response()->json($response);
                }
            }
        }
        else{
            $rate_user = Review::create([
                'user_id' => $request->user_id,
                'comment' => $request->comment,
                'rating'  => $request->rating,
                'image_id' => $request->image_id,
            ]);
            if($rate_user){
                $response = array(
                    "status" => "true",
                );
                return response()->json($response);
            }
            else{
                $response = array(
                    "status" => "false",
                );
                return response()->json($response);
            }
        }

    }

    public  function displayEditUploadForm($upload_id){
        $categories = Category::get();
        $latest_price = Price::orderBy('created_at', "desc")->first();
        $get_upload = Upload::where("id", $upload_id)->first();
        if($get_upload->is_collection == 0){
            $pictures = Photo::where("upload_id", $upload_id)->get();
            return view("action.edit_upload_photos", compact("pictures", "categories", "latest_price"));
        }/*
        else{
            $pictures = Photo::where("upload_id", $upload_id)->get();
            return view("action.edit_upload_collection_photos", compact("pictures", "categories"));
        }*/

    }

    public function checkoutRegister(Request $request){
        $user_data = $request;
        $validation = $this->validate($user_data, [
            'fullname' => 'bail|required|max:100 ',
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:8'
        ]);
        $confirm = User::where('email', '=', $user_data->email)->get();
        if (count($confirm) == 0) {
            if ($validation) {
                if ($user_data->password == $user_data->confirm_password) {
                    $new_user = User::create([
                        'name' => $user_data->fullname,
                        'email' => $user_data->email,
                        'password' => bcrypt($user_data->password),
                        'is_seller' => 0,
                    ]);
                    if (Auth::attempt(['email' => $user_data->email, 'password' => $user_data->password])){
                        return redirect()->back()->with('success', 'you have been successfully registered, you can login');
                    }
                    else{
                        return redirect()->back()->with('failure', 'Kindly login to continue');
                    }
                }
                else {
                    return redirect()->back()->with('failure', 'The passwords do not match');
                }
            }


        }
        else {
            return redirect()->back()->with('failure', 'email already exist');
        }
    }
    public function checkoutLogin(Request $request){
        $user_data = $request;
        $validation = $this->validate($user_data, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        if ($validation) {
            $confirm = User::where('email', '=', $user_data->email)->first();
            if ($confirm) {
                if (Auth::attempt(['email' => $user_data->email, 'password' => $user_data->password])) {
                    return redirect()->back()->with("success",'Success logging in');
                } else {
                    return redirect()->back()->with('failure', 'username or password incorrect');
                }
            }
            else{
                return redirect()->back()->with('failure', 'You are not a registered member, kindly register to kick start');
            }
        }
    }

    public function changeCurrency( Request $request, $currency_code){
        //$request->session()->flush();
        $get_location = Region::where("currency_code", $currency_code)->first();
        $request->session()->put("location",[$get_location->currency_code, $get_location->rate]);
        return redirect()->back();
    }

    public function viewPhotos(){
        $all_photos = Photo::whereHas('upload', function($query){
            $query->where('user_id', Auth::user()->id);
        })->get();

        return view('action.view_all_uploaded_photos', compact('all_photos'));
    }

    //public function testUpload()
    //{
        /*$file_src = $request->file('image');
        $is_file_uploaded = Storage::disk('dropbox')->put( '/', $file_src,'image.jpg');

        dd($is_file_uploaded);*/
        /*$image = Storage::disk('dropbox')->get("ZB9vhMrlp3lxJgvZsJQHXPXSQCTR8b1PlQT7MkEK.jpeg");
        return response()->download(base64_decode($image));

        dd();*/
        //dd(Storage::disk('dropbox')->get("Get Started with Dropbox.pdf"));
        //$is_file_uploaded = Storage::putFileAs('yaami.png',  fopen($image_file, 'rb'), 'dropbox');
        //$is_file_uploaded = Storage::disk('dropbox')->put($image_file, fopen($image_file, 'rb'));
        //dd($is_file_uploaded);
        /*$is_file_uploaded = Storage::disk('dropbox')->get("yaami.png");
        $header =array(
            'Content-Type' => 'image/png',
        );*/
        /*if(Storage::disk('dropbox')->exists($image_file)){
            dd($image_file);
            return response()->download(Storage::disk('dropbox')->get($image_file));
        }*/

        /*dd($is_file_uploaded);
        $Client = new Spatie\Dropbox\Client(env('DROPBOX_TOKEN'), env('DROPBOX_SECRET'));
        $links =  $Client->uploadFile("/".$image_file, \Dropbox\WriteMode::add(), fopen($image_file, 'rb'));
        $links['share'] = $Client->createShareableLink($image_file);
        $links['view'] = $Client->createTemporaryDirectLink($image_file);
        dd($links);*/
   // }

}
