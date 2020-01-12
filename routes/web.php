<?php

Route::get('', [
    'uses' => 'UserAction\ActionController@display',
    'as' => 'homepage'
]);
/*Route::get('signup',function(){
    return view('userAuth.user');
})->name('signup');*/

/*Route::get('register',function (){
    return view('userAuth.userReg');
});*/
/*Route::get('forgotpassword',function (){
    return view('userAuth.userPassword');
});*/
Route::post('getRegistered', [
    'as' => 'register',
    'uses' => 'userAuth\UserController@register'
]);

Route::post('/login', [
    'as' => 'login',
    'uses' =>  'userAuth\UserController@login'
]);

Route::get('logout',[
    'as' => 'logout',
    'uses' => 'UserAction\ActionController@logout'
]);

/*Route::get('newSeller',function (){
    return view('sellerAuth.newSeller');
});*/
/*Route::post('getnewSeller', 'userAuth\SellerController@register');*/

Route::get('activate/{token}', [
    'as' => "confirm_token",
    'uses' => 'userAuth\UserController@confirm'
]);

Route::get('search', [
    'as' => "search",
    'uses' => 'UserAction\ActionController@search'
]);

Route::get('photo/search',[
    'as' => "browse.all",
    'uses' => 'UserAction\ActionController@searchAll'
]);

Route::get('browse/{keyword}',[
    'as' => "browse.category",
    'uses' => 'UserAction\ActionController@searchCategory'
]);

//Route::get('admin',function (){
//    return
//});
Route::get('upload',function(){
    return view('action.upload');
})->name('upload')->middleware('seller');

Route::post('uploadpictures/{id}', [
    'as' => 'upload_pictures',
    'uses' => 'UserAction\ActionController@upload'
])->middleware('seller');
Route::post('upload-collection-pictures', [
    'as' => 'upload_collection_pictures',
    'uses' => 'UserAction\ActionController@collectionUpload'
])->middleware('seller');

Route::get('admin/dashboard', [
    'as' => 'admin.dashboard',
    'uses' =>  'UserAction\ActionController@homepage'
])->middleware('admin');

Route::get('admin/user-management', [
    'as' => 'admin.user-management',
    'uses' =>  'AdminAction\AdminController@userManagement'
])->middleware('admin');

Route::get('admin/user-management/delete-user/{id}', [
    'as' => 'admin.action.delete-user',
    'uses' =>  'AdminAction\AdminController@deleteUser'
])->middleware('admin');

Route::get('admin/user-management/activate-user/{id}', [
    'as' => 'admin.action.activate-user',
    'uses' =>  'AdminAction\AdminController@activateUser'
])->middleware('admin');

Route::get('admin/user-management/make-admin/{id}', [
    'as' => 'admin.action.make-admin',
    'uses' =>  'AdminAction\AdminController@makeAdmin'
])->middleware('admin');

Route::get('admin/user-management/remove-admin{id}', [
    'as' => 'admin.action.remove-admin',
    'uses' =>  'AdminAction\AdminController@removeAdmin'
])->middleware('admin');

Route::get('admin/check-upload', [
    'as' => 'admin.user-upload',
    'uses' =>  'AdminAction\AdminController@checkUpload'
])->middleware('admin');

Route::get('admin/check-upload/view/{id}', [
    'as' => 'admin.upload.view-upload',
    'uses' =>  'AdminAction\AdminController@viewUpload'
])->middleware('admin');

Route::get('admin/check-upload/accept/{id}', [
    'as' => 'admin.upload.accept',
    'uses' =>  'AdminAction\AdminController@acceptUpload'
])->middleware('admin');

Route::post('admin/check-upload/reject/{id}', [
    'as' => 'admin.upload.reject',
    'uses' =>  'AdminAction\AdminController@rejectUpload'
])->middleware('admin');

Route::get('admin/withdrawal-request', [
    'as' => 'admin.withdrawal-request',
    'uses' =>  'AdminAction\AdminController@withdrawalRequest'
])->middleware('admin');

Route::get('admin/withdrawal-request/reject/{id}', [
    'as' => 'admin.withdrawal-request.reject',
    'uses' =>  'AdminAction\AdminController@rejectWithdrawal'
])->middleware('admin');

Route::get('admin/withdrawal-request/accept/{id}', [
    'as' => 'admin.withdrawal-request.accept',
    'uses' =>  'AdminAction\AdminController@acceptWithdrawal'
])->middleware('admin');

Route::get('admin/check-bank-details', [
    'as' => 'admin.bank-details',
    'uses' =>  'AdminAction\AdminController@bankDetails'
])->middleware('admin');

Route::get('user_management', [
    'as' => 'dashboard.user_management',
    'uses' => 'AdminAction\AdminController@user',
])->middleware('admin');
//Route::get('{id}','UserAction\ActionController@searchId');

Route::get('login/{social}', [
    'as' => "login.social",
    'uses' => 'userAuth\UserController@redirectToProvider'
]);

Route::get('loggedIn/{social}/callback', [
    'as' => "login.social.callback",
    'uses' => 'userAuth\UserController@handleProviderCallback'
]);

Route::get('make_admin/{id}', [
    'as' => "make_admin",
    'uses' => 'AdminAction\AdminController@makeAdmin'
])->middleware('admin');

Route::get('view_profile/{id}', [
    'as' => "view_profile",
    'uses' =>  'AdminAction\AdminController@viewProfile'
])->middleware('admin');

Route::get('delete_user/{id}', [
    'as' => "delete_user",
    'uses' => 'AdminAction\AdminController@deleteUser'
])->middleware('admin');

Route::get('remove_admin/{id}', [
    'as' => "remove_admin",
    'uses' => 'AdminAction\AdminController@removeAdmin'
])->middleware('admin');

Route::post('admin/search', [
    'as' => "search_email",
    'uses' => 'AdminAction\AdminController@searchEmail'
])->middleware('admin');

Route::get('check_upload/accept/{id}', [
    'as' => "accept_upload",
    'uses' =>  'AdminAction\AdminController@acceptUpload'
])->middleware('admin');

Route::get('check_upload/reject/{id}', [
    'as' => "reject_upload",
    'uses' =>  'AdminAction\AdminController@rejectUpload'
])->middleware('admin');

Route::get('check_upload/{id}', [
    'as' => "check_upload",
    'uses' => 'AdminAction\AdminController@checkUpload'
])->middleware('admin');

Route::get('browse/{character}', [
    'as' => "sort_pictures",
    'uses' => 'UserAction\ActionController@sort'
]);

Route::get('browse/{slug}', [
    'as' => "browse.slug",
    'uses' => 'UserAction\ActionController@imageDetails'
]);

Route::get('dashboard/upload_photos',[
    'as' => "dashboard.upload_photos",
    'uses' => 'UserAction\ActionController@displayUploadForm'
])->middleware('seller');

Route::get('dashboard/edit-upload/{upload_id}',[
    'as' => "dashboard.edit-upload",
    'uses' => 'UserAction\ActionController@displayEditUploadForm',
])->middleware('seller');

Route::get('dashboard/update_account', [
    'as' => "dashboard.update_account",
    'uses' => 'UserAction\ActionController@editProfileRendering'
])->middleware('checkauth');

Route::get('dashboard', [
    'as' => "dashboard",
    'uses' => 'UserAction\ActionController@dasboardRendering'
])->middleware('checkauth');

Route::post('dashboard/{id}/edit-profile-account', [
    'as' => 'dashboard.edit_profile_account',
    'uses' => 'UserAction\ActionController@updateProfileAccount'
])->middleware('checkauth');

Route::post('dashboard/{id}/edit-profile-password', [
    'as' => 'dashboard.edit_profile_password',
    'uses' => 'UserAction\ActionController@updateProfilePassword'
])->middleware('checkauth');

Route::get('search/{category_id}', [
    'as' => 'search.category',
    'uses' => 'UserAction\ActionController@search_category'
]);

Route::post('image/download/{slug}', [
    'as' => 'download',
    'uses' => 'UserAction\ActionController@download'
]);

Route::get('photo/{slug}/{id}', [
    'as' => 'all.picture',
    'uses' => 'UserAction\ActionController@imageDetails'
]);

Route::get('/photograhers', [
    'as' => 'photographers',
    'uses' => 'UserAction\ActionController@photographers'
]);

Route::get('/photograhers/profile/{name}', [
    'as' => 'photographers.profile',
    'uses' => 'UserAction\ActionController@photographersDetails'
]);

Route::post('photographer/message/{id}', [
    'as' => 'drop-message',
    'uses' => 'UserAction\ActionController@message'
]);

Route::get('dashboard/reviews', [
    'as' => 'view-message',
    'uses' => 'UserAction\ActionController@viewMessage'
])->middleware("seller");

Route::get('dashboard/message/delete/{id}', [
    'as' => 'message.delete',
    'uses' => 'UserAction\ActionController@deleteMessage'
])->middleware("seller");

Route::post('/user/image/checkpayment', [
    'as' => 'checkpayment',
    'uses' => 'UserAction\ActionController@checkpayment'
]);

Route::post('user/login', [
    'as'=>'user.login',
    'uses' => 'userAuth\UserController@checkoutLogin'
]);

Route::post('user/confirm-payment',[
    'as' => 'checkout.payment',
    'uses' => 'UserAction\ActionController@confirmPayment',
]);
Route::get('dashboard/request-payment',[
    'as' => 'cashout',
    'uses' => 'UserAction\ActionController@cashoutRendering',
])->middleware("seller");

Route::post('dashboard/request-payment',[
    'as' => 'cashout.submit',
    'uses' => 'UserAction\ActionController@cashout',
])->middleware("seller");

Route::get('dashboard/update-bank-details',[
    'as' => 'update-bank-account',
    'uses' => 'UserAction\ActionController@updateBankDetails',
])->middleware("seller");

Route::post('dashboard/update-bank-details',[
    'as' => 'update-bank-account',
    'uses' => 'UserAction\ActionController@bankDetails',
])->middleware("seller");

Route::get('dashboard/upload-status',[
    'as' => 'upload-status',
    'uses' => 'UserAction\ActionController@uploadStatus',
])->middleware("seller");

Route::get('dashboard/upload-collection-photos',[
    'as' => 'dashboard.upload_collection_photos',
    'uses' => 'UserAction\ActionController@displayCollectionUploadForm',
])->middleware("seller");

Route::post('/get-more',[
    'as' => 'get-more',
    'uses' => 'UserAction\ActionController@moreImages',
]);

Route::post('/get-more-for-search',[
    'as' => 'get-more-for-search',
    'uses' => 'UserAction\ActionController@moreImagesForSearch',
]);

Route::get('/dashboard/my-gallery',[
    'as' => 'dashboard.my-gallery',
    'uses' => 'UserAction\ActionController@myGallery',
])->middleware("checkauth");

Route::get('photos/search',[
   'as' => 'complex.search',
   'uses' => 'UserAction\ActionController@complexSearch',
]);

Route::post('user/rate',[
   'as' => 'user.rate',
   'uses' => 'UserAction\ActionController@rateUser',
]);
Route::get('admin/update-category',[
   'as' => 'admin.update-category',
   'uses' => 'AdminAction\AdminController@renderUpdateCategory',
])->middleware("admin");
Route::get('admin/add/category',[
   'as' => 'category.add',
   'uses' => 'AdminAction\AdminController@addCategory',
])->middleware("admin");

Route::get('admin/delete/{category}', [
   'as' => 'admin.action.delete-category',
   'uses' => 'AdminAction\AdminController@deleteCategory',
])->middleware("admin");

Route::post('dashboard/edit-upload-pictures/{id}',[
   'as' => 'edit_upload_pictures',
   'uses' => 'UserAction\ActionController@editUploadPictures',
])->middleware("seller");

Route::post("admin/dashboard/change-price",[
   'as' => 'dashboard.change-price',
   'uses' => 'AdminAction\AdminController@changePrice',
])->middleware("admin");

Route::post("user/register",[
   'as' => "checkout.register",
   'uses' => "UserAction\ActionController@checkoutRegister",
]);

Route::post("user/login",[
   'as' => "checkout.login",
   'uses' => "UserAction\ActionController@checkoutLogin",
]);

Route::get("admin/system-settings",[
   'as' => "admin.system_settings",
   'uses' => "AdminAction\AdminController@render_system_settings",
])->middleware("admin");
Route::post("admin/add-country",[
   'as' => "admin.add-country",
   'uses' => "AdminAction\AdminController@AddCountry",
])->middleware("admin");

Route::get("admin/delete-country/{id}",[
    'as' => "admin.delete-country",
    'uses' => "AdminAction\AdminController@deleteCountry",
])->middleware("admin");

Route::post("admin/update-rate",[
    'as' => "admin.update-rate",
    'uses' => "AdminAction\AdminController@updateRate",
])->middleware("admin");

Route::get("currency/{currency_code}",[
    'as' => "location.change",
    'uses' => "UserAction\ActionController@changeCurrency",
]);

Route::post("admin/delete-upload/{id}", [
    'as' => "admin.delete-upload",
    'uses' => "AdminAction\AdminController@deleteUpload",
])->middleware("admin");

Route::post("feature/payment", [
    'as' => "feature.payment",
    'uses' => "UserAction\ActionController@confirmFeaturePayment",
])->middleware("seller");

Route::post("add-feature/wallet-payment", [
    'as' => "feature.payment.wallet",
    'uses' => "UserAction\ActionController@confirmFeaturePaymentWallet",
]);

Route::get("dashboard/view-uploaded-photos",[
    'as' => "view-photos",
    'uses' => "UserAction\ActionController@viewPhotos",
])->middleware("seller");

Route::get("test-upload", "UserAction\ActionController@testUpload");
Route::get("test",function (){
    return view('test');
});










