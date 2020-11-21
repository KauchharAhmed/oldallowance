<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class UnionController extends Controller
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
        $this->loged_id     = Session::get('admin_id');
    }

    #========================== UNION PAURASHAVA =========================#
    public function manageUnionPaurashava()
    {
    	$result = DB::table('union_paurashava')->orderBy('id','asc')->get() ;
    	return view('union.manageUnionPaurashava')->with('result',$result) ;
    }

    #--------------------- Union Paurashva Add Form -----------------------#
    public function addUnionPaurashava()
    {
    	return view('union.addUnionPaurashava') ;
    }

    #--------------------- Union Paurashava Insert Info -------------------#
    public function addUnionPaurashavaInfo(Request $request)
    {
    	$this->validate($request,[
    		'unpb_name'	=> 'required' 
    	]);

    	$unpb_name 	= trim($request->unpb_name) ;

    	#--------------- Check Duplicate Union Name ---------------------#
    	$check_duplicate = DB::table('union_paurashava')->where('unpb_name',$unpb_name)->count() ;
    	if ($check_duplicate > 0) {
    		Session::put('failed','দুঃখিত ! ইউনিয়ন বা পৌরসভা নাম ইতিমধ্যে যুক্ত করা হয়েছে.') ;
    		return Redirect::to('addUnionPaurashava') ;
    	}

    	$data = array() ;
    	$data['added_id']		= $this->loged_id ;
    	$data['unpb_name']		= $unpb_name ;
    	$data['status']			= 1 ;
    	$data['created_at']		= $this->rcdate ;

    	$query = DB::table('union_paurashava')->insert($data) ;

    	if ($query) {
    		Session::put('success','ধন্যবাদ ! ইউনিয়ন / পৌরসভা সফল ভাবে যুক্ত হয়েছে .') ;
    		return Redirect::to('addUnionPaurashava') ;
    	}else{
    		Session::put('failed','দুঃখিত! কিছু ভুল হয়েছে.') ;
    		return Redirect::to('addUnionPaurashava') ;
    	}
    }

    #------------------ Union Paurashava Edit Form --------------------#
    public function editUnionPaurashava($id)
    {
    	$value = DB::table('union_paurashava')->where('id',$id)->first() ;
    	return view('union.editUnionPaurashava')->with('value',$value) ;
    }

    #--------------- Update Union Paurashva --------------------------#
    public function updateUnionPaurashavaInfo(Request $request)
    {
    	$this->validate($request,[
    		'unpb_name'	=> 'required' 
    	]);

        $status         = trim($request->status) ;
    	$unpb_name 		= trim($request->unpb_name) ;
    	$primary_id 	= trim($request->primary_id) ;

    	#--------------- Check Duplicate Union Name ---------------------#
    	$check_duplicate = DB::table('union_paurashava')->where('unpb_name',$unpb_name)->whereNotIn('id',[$primary_id])->count() ;
    	if ($check_duplicate > 0) {
    		Session::put('failed','Sorry ! দুঃখিত ! ইউনিয়ন বা পৌরসভা নাম ইতিমধ্যে যুক্ত করা হয়েছে.') ;
    		return Redirect::to('editUnionPaurashava/'.$primary_id) ;
    	}

    	$data = array() ;
    	$data['added_id']		= $this->loged_id ;
        $data['unpb_name']      = $unpb_name ;
    	$data['status']		    = $status ;
    	$data['updated_at']		= $this->rcdate ;

    	$query = DB::table('union_paurashava')->where('id',$primary_id)->update($data) ;

		Session::put('success','ধন্যবাদ ! ইউনিয়ন / পৌরসভা সফল ভাবে সংশোধন হয়েছে') ;
		return Redirect::to('editUnionPaurashava/'.$primary_id) ;

    }

    #====================== WARD =============================#
    public function manageUnionPaurashavaWard()
    {
        $result = DB::table('ward')
                ->join('union_paurashava','ward.union_id','=','union_paurashava.id')
                ->select('ward.*','union_paurashava.unp_name')
                ->orderBy('ward.id','desc')
                ->get() ;

        return view('ward.manageUnionPaurashavaWard')->with('result',$result) ;
    }

    #-------------------- Ward Add Form ---------------------#
    public function addUnionPaurashavaWard()
    {
        $all_union = DB::table('union_paurashava')->where('status',1)->get() ;

        return view('ward.addUnionPaurashavaWard')->with('all_union',$all_union) ;
    }

    #------------------- Insert Ward Info --------------------#
    public function addUnionPaurashavaWardInfo(Request $request)
    {
        $this->validate($request,[
            'union_id'  => 'required',
            'wb_name'  => 'required',
        ]);

        $union_id   = trim($request->union_id) ;
        $wb_name    = trim($request->wb_name) ;

        #------------------ Check Count -------------------------#
        $check_duplicate = DB::table('ward')
                        ->where('union_id',$union_id)
                        ->where('wb_name',$wb_name)
                        ->count();

        if ($check_duplicate > 0) {
            Session::put('failed','দুঃখিত ! ওয়ার্ড এর নাম ইতিমধ্যে যুক্ত করা হয়েছে.') ;
            return Redirect::to('addUnionPaurashavaWard') ;
        }

        $data = array() ;
        $data['union_id']       = $union_id ;
        $data['wb_name']        = $wb_name ;
        $data['status']         = 1 ;
        $data['created_at']     = $this->rcdate ;

        if ($query) {
            Session::put('success','ধন্যবাদ ! ওয়ার্ড সফল ভাবে যুক্ত হয়েছে .') ;
            return Redirect::to('addUnionPaurashavaWard') ;
        }else{
            Session::put('failed','Sorry ! Somthing Went Wrong.') ;
            return Redirect::to('addUnionPaurashavaWard') ;
        }

    }

}
