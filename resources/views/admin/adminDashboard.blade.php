@extends('admin.masterAdmin')
@section('content')
 <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.html">Dashboard</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                            </ul>
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                       
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN DASHBOARD STATS 1-->
                        <div class="row widget-row">
                            
                            <div class="col-md-3">
                                <!-- BEGIN WIDGET THUMB -->
                                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                    <h4 class="widget-thumb-heading">আবেদন</h4>
                                    <div class="widget-thumb-wrap">
                                        <i class="widget-thumb-icon bg-green icon-bulb"></i>
                                        <div class="widget-thumb-body">
                                            <span class="widget-thumb-body-stat" style="font-size: 20px;"><?php echo $total_pending_member ; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- END WIDGET THUMB -->
                            </div>
                            <div class="col-md-3">
                                <!-- BEGIN WIDGET THUMB -->
                                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                    <h4 class="widget-thumb-heading">প্রাথমিক নির্বাচিত</h4>
                                    <div class="widget-thumb-wrap">
                                        <i class="widget-thumb-icon bg-green icon-bulb"></i>
                                        <div class="widget-thumb-body">
                                            <span class="widget-thumb-body-stat" style="font-size: 20px;"><?php echo $total_primary_select_member ; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- END WIDGET THUMB -->
                            </div>

                            <div class="col-md-3">
                                <!-- BEGIN WIDGET THUMB -->
                                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                    <h4 class="widget-thumb-heading">নির্বাচিত সদস্য</h4>
                                    <div class="widget-thumb-wrap">
                                        <i class="widget-thumb-icon bg-green icon-bulb"></i>
                                        <div class="widget-thumb-body">
                                            <span class="widget-thumb-body-stat" style="font-size: 20px;"><?php echo $total_selected_member ; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- END WIDGET THUMB -->
                            </div>
    
                        </div>


                  <div class="clearfix"></div>
                        <!-- END DASHBOARD STATS 1-->
                    </div><!-- END PAGE CONTENT BODY -->
                </div><!-- END PAGE CONTENT -->             
            </div><!-- END CONTAINER -->
@endsection