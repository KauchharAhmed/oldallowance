<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use DateTime;
use Session;

class SettingController extends Controller
{
    private $rcdate ;
     /**
     * ADMIN CLASS costructor 
     *
     */
    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate       = date('Y-m-d');
        $this->current_time = date('H:i:s');
        $this->year 		= date('Y');
        $this->loged_id     = Session::get('admin_id');
    }

    #------------------ Age Setting -------------------------#
    public function ageSetting()
    {
    	$value = DB::table('age_setting')->where('id',1)->first();

    	return view('setting.ageSetting')->with('value',$value) ;
    }

    #-------------------- Check --------------------------#
    public function updateAgeSettings(Request $request)
    {
    	$this->validate($request,[
    		'male'		=> 'required',
    		'female'	=> 'required',
    	]);

    	$male 	= trim($request->male) ;
    	$female = trim($request->female) ;

    	$data 				= array();
    	$data['male']		= $male ;
    	$data['female']		= $female ;
    	$data['updated_at']	= $this->rcdate ;

    	DB::table('age_setting')->where('id',1)->update($data) ;

    	Session()->put('success', "ধন্যবাদ ! সফলভাবে সেটিংস সংশোধন করা হয়েছে");
        return Redirect::to('/ageSetting') ;
    }


}
