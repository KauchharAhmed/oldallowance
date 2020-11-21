<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin','AdminController@index');
Route::post('/adminLogin','AdminController@adminLogin');
Route::get('/myProfile','AdminController@myProfile');
Route::get('/editAdminPofile','AdminController@editAdminPofile');
Route::post('/adminEditMyProfileInfo','AdminController@adminEditMyProfileInfo');
Route::get('/adminChangePassword','AdminController@adminChangePassword');
Route::post('/adminChangePasswordInfo','AdminController@adminChangePasswordInfo');
Route::get('/adminLogout','AdminController@adminLogout');
Route::get('/adminDashboard','DashboardController@adminDashboard');

#=================== UDC Section ===============================#
Route::get('/udcDashboard','DashboardController@udcDashboard');
Route::get('/udcProfile','UdcController@udcProfile');
Route::get('/editUDCAdminPofile','UdcController@editUDCAdminPofile');
Route::post('/updateUDCAdminProfileInfo','UdcController@updateUDCAdminProfileInfo');
Route::get('/udcAdminChangePassword','UdcController@udcAdminChangePassword');
Route::post('/udcAdminChangePasswordInfo','UdcController@udcAdminChangePasswordInfo');

#================== UNION CONTROLLER ========================#
Route::get('/manageUnionPaurashava','UnionController@manageUnionPaurashava');
Route::get('/addUnionPaurashava','UnionController@addUnionPaurashava');
Route::post('/addUnionPaurashavaInfo','UnionController@addUnionPaurashavaInfo'); 
Route::get('/editUnionPaurashava/{id}','UnionController@editUnionPaurashava');
Route::post('/updateUnionPaurashavaInfo','UnionController@updateUnionPaurashavaInfo');

#================= UNION CONTROLLER WARD =====================#
Route::get('/manageUnionPaurashavaWard','UnionController@manageUnionPaurashavaWard');
Route::get('/addUnionPaurashavaWard','UnionController@addUnionPaurashavaWard');
Route::post('/addUnionPaurashavaWardInfo','UnionController@addUnionPaurashavaWardInfo');

#===================== ALL SYSTEM USER ========================#
Route::get('/manageAllUdc','UserController@manageAllUdc');
Route::get('/addUdc','UserController@addUdc');
Route::post('/addUdcUserInfo','UserController@addUdcUserInfo');
Route::get('/editUdcUserInfo/{id}','UserController@editUdcUserInfo');
Route::post('/updateUdcUserInfo','UserController@updateUdcUserInfo');

#===================== MEMBER CONTROLLER ========================#
Route::get('/addMemberApplication','MemberController@addMemberApplication');
Route::post('/addOldAgeAllowanceApplicationInfo','MemberController@addOldAgeAllowanceApplicationInfo');
Route::get('/manageUDCMemberApplication','MemberController@manageUDCMemberApplication');
Route::get('/editMemberInfo/{id}','MemberController@editMemberInfo');
Route::post('/updateOldAgeAllowanceApplicationInfo','MemberController@updateOldAgeAllowanceApplicationInfo');
Route::get('/viewMemberDetails/{id}','MemberController@viewMemberDetails');

#======================== Admin Section ==========================#
Route::get('/oldAllowanceApplication','MemberController@oldAllowanceApplication');
Route::post('/viewOldAllowanceApplication','MemberController@viewOldAllowanceApplication');
Route::post('/oldAllowanceMemberPrimarySelection','MemberController@oldAllowanceMemberPrimarySelection');
Route::get('/primarySelectedMemberList','MemberController@primarySelectedMemberList');
Route::post('/viewPrimarySelectedMemberList','MemberController@viewPrimarySelectedMemberList');
Route::post('/oldAllowanceMemberFinalSelection','MemberController@oldAllowanceMemberFinalSelection');
Route::get('/finalSelectedMemberList','MemberController@finalSelectedMemberList');
Route::post('/viewFinalSelectedMemberList','MemberController@viewFinalSelectedMemberList');
Route::get('/manageFinalSelectedMember','MemberController@manageFinalSelectedMember');
Route::post('/oldAllowanceDeadMember','MemberController@oldAllowanceDeadMember');
Route::get('/deadMemberList','MemberController@deadMemberList');
Route::post('/viewDeadMemberList','MemberController@viewDeadMemberList');

#======================= PRINT CONTROLLER ================================#
Route::post('/printPrimarySelectedMemberList','PrintController@printPrimarySelectedMemberList');
Route::post('/printPendingMemberList','PrintController@printPendingMemberList');
Route::post('/printFinalSelectedMemberList','PrintController@printFinalSelectedMemberList');
Route::get('/printMemberDetails/{id}','PrintController@printMemberDetails');
Route::post('/printDeadMemberList','PrintController@printDeadMemberList');

#==================== SETTINGS ==========================#
Route::get('/ageSetting','SettingController@ageSetting');
Route::post('/updateAgeSettings','SettingController@updateAgeSettings');

#======================== VATA TYPE =======================#
Route::get('/addVataType','VataController@addVataType');
Route::post('/addVataTypeInfo','VataController@addVataTypeInfo');
Route::get('/manageVataType','VataController@manageVataType');
Route::get('/editVataType/{id}','VataController@editVataType');
Route::post('/updateVataTypeInfo','VataController@updateVataTypeInfo');

// Chosse Vata Type
Route::get('/chooseAllowanceType','VataController@chooseVataType');
Route::post('/chooseVataTypeInfo','VataController@chooseVataTypeInfo');
// online application
Route::get('/onlineApplication/{allowance_type_id}','VataController@onlineApplication');
Route::post('/addOnlineApplicationInfo','VataController@addOnlineApplicationInfo');








