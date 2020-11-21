<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use DateTime;
use Session;

class PrintController extends Controller
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

    #====================== Print Primary Selected Member List ==============================#
    public function printPendingMemberList(Request $request)
    {
    	$union_id   = trim($request->union_id) ;
        $year       = trim($request->year) ;

        if (empty($year)) {
            $check_count = DB::table('member')->where('union_id',$union_id)->where('status',0)->count() ;
            if ($check_count > 0) {
                $result = DB::table('member')
                        ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                        ->select('member.*','union_paurashava.unpb_name') 
                        ->where('member.union_id',$union_id)
                        ->where('member.status',0)
                        ->orderBy('id','desc')
                        ->get();

                return view('print.printPendingMemberList')->with('result',$result)->with('union_id',$union_id)->with('year',$year)->with('check_count',$check_count) ;
            }else{
                echo "<h4>কোনো তথ্য পাওয়া যায়নি</h4>";
                exit();
            }
        }else{
            $check_count = DB::table('member')->where('union_id',$union_id)->where('year',$year)->where('status',0)->count() ;
            if ($check_count > 0) {
                $result = DB::table('member')
                        ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                        ->select('member.*','union_paurashava.unpb_name') 
                        ->where('member.union_id',$union_id)
                        ->where('member.year',$year)
                        ->where('member.status',0)
                        ->orderBy('id','desc')
                        ->get();

                return view('print.printPendingMemberList')->with('result',$result)->with('union_id',$union_id)->with('year',$year)->with('check_count',$check_count) ;
                
            }else{
                echo "<h4>কোনো তথ্য পাওয়া যায়নি</h4>";
                exit();
            }
        }
    }

    #====================== Print Primary Selected Member List ==============================#
    public function printPrimarySelectedMemberList(Request $request)
    {
    	$union_id   = trim($request->union_id) ;
        $year       = trim($request->year) ;

        if (empty($year)) {
            $check_count = DB::table('member')->where('union_id',$union_id)->where('status',1)->count() ;
            if ($check_count > 0) {
                $result = DB::table('member')
                        ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                        ->select('member.*','union_paurashava.unpb_name') 
                        ->where('member.union_id',$union_id)
                        ->where('member.status',1)
                        ->orderBy('id','desc')
                        ->get();

                return view('print.printPrimarySelectedMemberList')->with('result',$result)->with('union_id',$union_id)->with('year',$year)->with('check_count',$check_count) ;
            }else{
                echo "<h4>কোনো তথ্য পাওয়া যায়নি</h4>";
                exit();
            }
        }else{
            $check_count = DB::table('member')->where('union_id',$union_id)->where('year',$year)->where('status',1)->count() ;
            if ($check_count > 0) {
                $result = DB::table('member')
                        ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                        ->select('member.*','union_paurashava.unpb_name') 
                        ->where('member.union_id',$union_id)
                        ->where('member.year',$year)
                        ->where('member.status',1)
                        ->orderBy('id','desc')
                        ->get();

                return view('print.printPrimarySelectedMemberList')->with('result',$result)->with('union_id',$union_id)->with('year',$year)->with('check_count',$check_count) ;
                
            }else{
                echo "<h4>কোনো তথ্য পাওয়া যায়নি</h4>";
                exit();
            }
        }
    }

    #====================== Print Primary Selected Member List ==============================#
    public function printFinalSelectedMemberList(Request $request)
    {
    	$union_id   = trim($request->union_id) ;
        $year       = trim($request->year) ;

        if (empty($year)) {
            $check_count = DB::table('member')->where('union_id',$union_id)->where('status',2)->count() ;
            if ($check_count > 0) {
                $result = DB::table('member')
                        ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                        ->select('member.*','union_paurashava.unpb_name') 
                        ->where('member.union_id',$union_id)
                        ->where('member.status',2)
                        ->orderBy('id','desc')
                        ->get();

                return view('print.printFinalSelectedMemberList')->with('result',$result)->with('union_id',$union_id)->with('year',$year)->with('check_count',$check_count) ;
            }else{
                echo "<h4>কোনো তথ্য পাওয়া যায়নি</h4>";
                exit();
            }
        }else{
            $check_count = DB::table('member')->where('union_id',$union_id)->where('year',$year)->where('status',2)->count() ;
            if ($check_count > 0) {
                $result = DB::table('member')
                        ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                        ->select('member.*','union_paurashava.unpb_name') 
                        ->where('member.union_id',$union_id)
                        ->where('member.year',$year)
                        ->where('member.status',2)
                        ->orderBy('id','desc')
                        ->get();

                return view('print.printFinalSelectedMemberList')->with('result',$result)->with('union_id',$union_id)->with('year',$year)->with('check_count',$check_count) ;
                
            }else{
                echo "<h4>কোনো তথ্য পাওয়া যায়নি</h4>";
                exit();
            }
        }
    }

    #--------------------- Print Single Member Details -----------------------#
    public function printMemberDetails($id)
    {
        $value = DB::table('member')
                ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                ->select('member.*','union_paurashava.unpb_name') 
                ->where('member.id',$id)
                ->first();
        return view('print.printMemberDetails')->with('value',$value) ;
    }

    #====================== Print Dead Member List ============================#
    public function printDeadMemberList(Request $request)
    {
        $union_id   = trim($request->union_id) ;

        if (empty($union_id)) {
            $check_count = DB::table('member')->where('status',3)->count() ;
            if ($check_count > 0) {
                $result = DB::table('member')
                        ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                        ->select('member.*','union_paurashava.unpb_name') 
                        ->where('member.status',3)
                        ->orderBy('id','desc')
                        ->get();

                return view('print.printDeadMemberList')->with('result',$result)->with('union_id',$union_id)->with('check_count',$check_count) ;
                
            }else{
                echo "<h4>কোনো তথ্য পাওয়া যায়নি</h4>";
                exit();
            }
        }else{
            $check_count = DB::table('member')->where('union_id',$union_id)->where('status',3)->count() ;
            if ($check_count > 0) {
                $result = DB::table('member')
                        ->join('union_paurashava','member.union_id','=','union_paurashava.id')
                        ->select('member.*','union_paurashava.unpb_name') 
                        ->where('member.union_id',$union_id)
                        ->where('member.status',3)
                        ->orderBy('id','desc')
                        ->get();

                return view('print.printDeadMemberList')->with('result',$result)->with('union_id',$union_id)->with('check_count',$check_count) ;
                
            }else{
                echo "<h4>কোনো তথ্য পাওয়া যায়নি</h4>";
                exit();
            }
        }
    }

}
