<?php

namespace App\Http\Controllers\AdminAction;

use App\Account;
use App\Cashout;
use App\Category;
use App\Country;
use App\Http\Controllers\Controller;
use App\Photo;
use App\Price;
use App\Region;
use App\Upload;
use App\User;
use App\Withdrawal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\ClassLike;

class AdminController extends Controller
{
  /* public function user(){
    $all_user=User::get();
    return view('Admin.user_management', compact('all_user'));
   }*/
   public function makeAdmin($id){
       $user = User::where('id', $id)->update([
           'is_admin'=>1,
           'is_seller'=>0,
           'is_activated'=>0,
       ]);
       if($user){
           return redirect()->back()->with('success', 'The user is now an Admin');
       }
       else{
           return redirect()->back()->with('failure', 'Action could not be perfomed');
       }
   }
   public function removeAdmin($id){
        $user = User::where('id',$id)->update([
            'is_admin'=>0,
        ]);
       if($user){
           return redirect()->back()->with('success', 'Action perfomed successfully');
       }
       else{
           return redirect()->back()->with('failure', 'Action could not be perfomed ');
       }
   }
   public  function deleteUser($id){
       $user = User::where('id',$id)->delete();
       if($user){
           return redirect()->back()->with('success', 'The user has been successfully deleted');
       }
       else{
           return redirect()->back()->with('failure', 'The the user could not be deleted');
       }
   }
   public  function activateUser($id){
       $user = User::where('id',$id)->update([
           'is_activated'=>1,
       ]);
       if($user){
           return redirect()->back()->with('success', 'The user has been successfully activated');
       }
       else{
           return redirect()->back()->with('failure', 'The user could not be activated');
       }
   }

   /*public function searchEmail(Request $request){
       $email = $request->email;
       $all_user=User::where('email',$request->email)->get();
       if($all_user){
           return view('Admin.user_management', compact('all_user'));
       }
   }*/

   public function checkUpload(){
       $all_uploads = Upload::get();
       return view('Admin.Action.check_upload', compact('all_uploads'));
   }

   public function viewUpload($id){
       $all_photos = Photo::where('upload_id', $id)->get();
       return view('Admin.Action.view_uploads',compact('all_photos'));
   }

   public function acceptUpload($id){
        $accept_upload = Upload::where('id',$id)->update([
            'approved'=>1
        ]);
        if($accept_upload){
            return redirect(route('admin.user-upload'))->with('success','The upload has been approved successfully');
        }
        else{
            return redirect(route('admin.user-upload'))->with('failure','The action could not be performed');
        }
   }

   public function rejectUpload(Request $request, $id){
        $reject_upload = Upload::where('id',$id)->update([
            'approved'=>2,
            'comment'=>$request->comment
        ]);
        if($reject_upload){
            return redirect(route('admin.user-upload'))->with('success','The upload is being rejected successfully');
        }
        else{
            return redirect(route('admin.user-upload'))->with('failure','The action could not be performed');
        }
   }

   public function userManagement(){
       $all_users = User::paginate(10);
       return view('Admin.Action.user_management', compact('all_users'));
   }

   public function withdrawalRequest(){
       $all_withdrawals = Cashout::get();
       return view('Admin.Action.withdrawal_request', compact('all_withdrawals'));
   }

   public function rejectWithdrawal($id){
       $reject_withdrawal = Cashout::where('id',$id)->update([
           'status'=>2
       ]);
       if($reject_withdrawal){
           return redirect(route('admin.withdrawal-request'))->with('success','Withdrawal rejected successfully');
       }
       else{
           return redirect(route('admin.user-upload'))->with('failure','The action could not be performed');
       }
   }

   public function acceptWithdrawal($id){
       $accept_withdrawal = Cashout::where('id',$id)->update([
           'status'=>1
       ]);
       if($accept_withdrawal){
               return redirect(route('admin.withdrawal-request'))->with('success','Withdrawal has been approved');
       }
       else{
           return redirect(route('admin.withdrawal-request'))->with('failure','The action could not be performed');
       }
   }

   public function bankDetails(){
        $bank_details = Account::paginate(10);
        return view('Admin.Action.check_user_account_details', compact('bank_details'));
   }

    public function renderUpdateCategory(){
       $all_categories = Category::get();
       return view('Admin.Action.category_management', compact('all_categories'));
    }

    public function addCategory(Request $request){
       $check_category = Category::where("title", $request->name)->first();
       if($check_category){
           return redirect()->back()->with('failure','Category already exist');
       }
       else{
           $add_category = Category::create([
               'title' => $request->category
           ]);
           if($add_category){
               return redirect()->back()->with('success', 'Category added successfully');
           }
           else{
               return redirect()->back()->with('failure', 'Error adding category');
           }
       }
    }
    public function deleteCategory($category){
        $delete_category = Category::where('title', $category)->delete();
        if($delete_category){
            return redirect()->back()->with('success', 'Success deleting category');
        }
        else{
            return redirect()->back()->with('failure', 'Error deleting category');
        }
    }

    public function changePrice(Request $request){
       $add_new_price = Price::create([
           "price" => $request->price,
       ]);
       if($add_new_price){
           return redirect()->back()->with("success", "Price changed successfully");
       }
       else{
           return redirect()->back()->with("failure", "Error changing price");
       }
    }

    public function render_system_settings(){
       $regions = Region::get();
       $countries = Country::get();
       return view("Admin.Action.system_settings", compact("regions", "countries"));
    }

    public function addCountry(Request $request){
        $get_country = Country::where("name", $request->country)->first();
        $endpoint = 'latest';
        $access_key = 'a81fc232c4b4156a1d03de5015a87d3c';
        $result = curl_init('http://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.'');
        curl_setopt($result, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($result);
        curl_close($result);
        $exchangeRates = json_decode($json, true);
        $dollar_value = $exchangeRates["rates"]["USD"];
        if ($dollar_value!=null){
            $currency_value = $exchangeRates["rates"][$get_country->currency_code];
            $current_rate = ceil($currency_value/$dollar_value);
            $add_country = Region::create([
                "country_id" => $get_country->id,
                "currency_code" => $get_country->currency_code,
                "name" => $request->country,
                "rate" => $current_rate,
            ]);
            if($add_country){
                return redirect()->back()->with("success", "Country added successfully");
            }
            else{
                return redirect()->back()->with("failure", "Error adding country");
            }
        }
        else{
            return redirect()->back()->with("failure", "Network issue. Please contact your ISP!");
        }

    }
    public function deleteCountry($id){
       $delete_country = Region::where("id", $id)->delete();
       if($delete_country){
           return redirect()->back()->with("success", "Country deleted successfully");
       }
       else{
           return redirect()->back()->with("failure", "Error deleting country");
       }
    }

    public function updateRate(Request $request){
        $endpoint = 'latest';
        $access_key = 'a81fc232c4b4156a1d03de5015a87d3c';
        $result = curl_init('http://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.'');
        curl_setopt($result, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($result);
        curl_close($result);
        $exchangeRates = json_decode($json, true);
        $regions = Region::get();
        $dollar_value = $exchangeRates["rates"]["USD"];
        if($dollar_value != null){
            $check = false;
            foreach($regions as $region){
                $currency_value = $exchangeRates["rates"][$region->currency_code];
                $current_rate = ceil($currency_value/$dollar_value);
                $update_country = Region::where('id', $region->id)->update([
                    "rate" => $current_rate,
                ]);
                if($update_country){
                    $check = true;
                }
                else{
                    $check = false;
                }
            }
            if ($check){
                return redirect()->back()->with("success","Rate update successfully");
            }
            else{
                return redirect()->back()->with("failure", "Error updating rates");
            }
        }
        else{
            return redirect()->back()->with("failure", "Network issue. Please contact your ISP!");
        }

    }

    public function deleteUpload($id){
       $all_photos = Photo::where('upload_id', $id)->get();
        $image_dimensions = [
           /* 'large',
            'medium',
            'small',*/
            'original',
        ];

        $image_sizes = [
            /*'100',
            '250',*/
            'original',
        ];

        $delete_status = false;
       foreach($all_photos as $all_photo){
            foreach ($image_sizes as $image_size){
                $check_dropbox_delete_status = Storage::disk('dropbox')->delete('/'.$all_photo->image_ref_id);
                $check_status = Storage::disk('public')->delete('uploads/'.$image_size.'/'.$all_photo->image);
                if($check_status){
                    $delete_status = true;
                }
                else{
                    return redirect()->back()->with('failure', 'something came up while deleting the upload');
                }
            }
            /*foreach ($image_dimensions as $image_dimension){
                $check_status = Storage::delete('uploads/'.$image_dimension.'/'.$all_photo->image);
                if($check_status){
                    $delete_status = true;
                }
                else{
                    return redirect()->back()->with('failure', 'something came up while deleting the upload');
                }
            }*/
            $delete_photo = Photo::where('id', $all_photo->id)->delete();
            if($delete_photo){
                $delete_status = true;
            }
            else{
                return redirect()->back()->with('failure', 'photo row could not be deleted in the database');
            }
       }
       if($delete_status){
           $get_upload = Upload::where('id',$id )->delete();
           if($get_upload){
               return redirect()->back()->with("success", 'Upload deleted successfully');
           }
           else{
               return redirect()->back()->with("failure", "Error deleting upload");
           }
       }

    }
}
