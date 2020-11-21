<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class DashboardController extends Controller
{
    private $rcdate ;
     /**
     * ADMIN CLASS costructor 
     *
     */
    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate 		= date('Y-m-d');
        $this->current_time = date('H:i:s');
        $this->loged_id 	= Session::get('admin_id');
    }

    #---------------------- Admin Dashboard --------------------#
    public function adminDashboard()
    {
        $total_selected_member = DB::table('member')->where('status',2)->count() ;
        $total_pending_member = DB::table('member')->where('status',0)->count() ;
        $total_primary_select_member = DB::table('member')->where('status',1)->count() ;
        $total_dead_member = DB::table('member')->where('status',1)->count() ;
    	return view('admin.adminDashboard')->with('total_selected_member',$total_selected_member)->with('total_pending_member',$total_pending_member)->with('total_primary_select_member',$total_primary_select_member) ->with('total_dead_member',$total_dead_member) ;
    }

    #----------------- UDC User Dashboard -----------------------#
    public function udcDashboard()
    {
        return view('udc.udcDashboard') ;
    }


}
