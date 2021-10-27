<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/images/favicon.png')}}">
    <title>Admin Shop | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">​

    <link href="{{asset('backend/css/active.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
    <!-- Gritter -->
    <link href="{{asset('backend/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">
    <!-- Toastr style -->
    <link href="{{asset('backend/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

    <link href="{{asset('backend/css/plugins/iCheck/custom.css')}}" rel="stylesheet">

    <link href="{{asset('backend/css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">

    <link href="{{asset('backend/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">

    <link href="{{asset('backend/css/plugins/colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet">

    <link href="{{asset('backend/css/plugins/cropper/cropper.min.css')}}" rel="stylesheet">

    <link href="{{asset('backend/css/plugins/switchery/switchery.css')}}" rel="stylesheet">

    <link href="{{asset('backend/css/plugins/jasny/jasny-bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('backend/css/plugins/nouslider/jquery.nouislider.css')}}" rel="stylesheet">

    <link href="{{asset('backend/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">

    <link href="{{asset('backend/css/plugins/ionRangeSlider/ion.rangeSlider.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">

    <link href="{{asset('backend/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">

    <link href="{{asset('backend/css/plugins/clockpicker/clockpicker.css')}}" rel="stylesheet">

    <link href="{{asset('backend/css/plugins/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet">

    <link href="{{asset('backend/css/plugins/select2/select2.min.css')}}" rel="stylesheet">

    <link href="{{asset('backend/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">

    <link href="{{asset('backend/css/plugins/dualListbox/bootstrap-duallistbox.min.css')}}" rel="stylesheet">

    <link href="{{asset('backend/css/plugins/bootstrap-markdown/bootstrap-markdown.min.css')}}" rel="stylesheet">

    <!-- Ladda style -->
    <link href="{{asset('backend/css/plugins/ladda/ladda-themeless.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    @yield('css')

</head>

<body>
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        @if (Auth::user()->social_id != '')
                            <img alt="image" class="rounded-circle" src="{{Auth::user()->image_user}}" height="48px" width="48px" />
                        @else
                            <img alt="image" class="rounded-circle" src="{{asset('uploads/profile/'.Auth::user()->image_user)}}" height="48px" width="48px" />
                        @endif
                        
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold">{{Auth::user()->name}}</span>
                            <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" id="edit_profile" data-profile_id="{{ Auth::user()->id }}" >Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('contacts.index') }}">Contacts</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('logout.index') }}">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        <img src="{{ asset('backend/icon.png') }}" alt="" width="70px" height="52px">
                    </div>
                </li>

                <li class="{{ route('dashboard.index')==$url_canonical ? 'active' : '' }}">
                    <a href="{{route('dashboard.index')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
                </li>
                <li class="{{ route('account.index')==$url_canonical || route('account.create')==$url_canonical ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Account</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{ route('account.index')==$url_canonical ? 'active' : '' }}"><a href="{{route('account.index')}}">List Account</a></li>
                        @if (route('account.index')==$url_canonical)
                            <li><a id="add_account">Add Account</a></li>
                        @endif
                        
                    </ul>
                </li>
                @if (Session::get('gallery_session') || Session::get('id_edit_product'))
                <li  
                @if (Session::get('id_edit_product'))
                    class="{{ route('product.index')==$url_canonical || route('product.create')==$url_canonical || route('product-gallery.index')==$url_canonical || route('product.edit',[Session::get('id_edit_product')]) == $url_canonical  ? 'active' : '' }}"
                @else
                    class="{{ route('product.index')==$url_canonical || route('product.create')==$url_canonical || route('product-gallery.index')==$url_canonical || route('product-gallery.show',[Session::get('gallery_session')]) == $url_canonical  ? 'active' : '' }}"
                @endif
                >
                    <a href="#"><i class="fa fa-inbox"></i> <span class="nav-label">Products</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li  class="{{ route('product.index')==$url_canonical ? 'active' : '' }}"><a href="{{ route('product.index') }}">List Product</a></li>
                        <li class="{{ route('product.create')==$url_canonical ? 'active' : '' }}"><a  href="{{ route('product.create') }}">Add Product</a></li>
                        @if (Session::get('gallery_session') || Session::get('id_edit_product'))
                            @if (Session::get('id_edit_product'))
                            <li class="{{ route('product.edit',[Session::get('id_edit_product')])==$url_canonical ? 'active' : '' }}"><a  href="{{ $url_canonical }}">Edit "{{$name_product->product_name}}"</a></li>
                            @else
                            <li class="{{ route('product-gallery.show',[Session::get('gallery_session')])==$url_canonical ? 'active' : '' }}"><a  href="{{ $url_canonical }}">Gallery "{{$name_product->product_name}}"</a></li>
                            @endif
                        @endif
                    </ul>
                </li>
                @else
                <li  class="{{ route('product.index')==$url_canonical || route('product.create')==$url_canonical || route('product-gallery.index')==$url_canonical  ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-inbox"></i> <span class="nav-label">Products</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li  class="{{ route('product.index')==$url_canonical ? 'active' : '' }}"><a href="{{ route('product.index') }}">List Product</a></li>
                        <li class="{{ route('product.create')==$url_canonical ? 'active' : '' }}"><a  href="{{ route('product.create') }}">Add Product</a></li>
                    </ul>
                </li>
                @endif
                <li class="{{ route('category.index')==$url_canonical ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-certificate"></i> <span class="nav-label">Category</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{ route('category.index')==$url_canonical ? 'active' : '' }}"><a href="{{ route('category.index') }}">List Category</a></li>
                        @if (route('category.index')==$url_canonical)
                            <li><a id="add_category">Add Category</a></li>
                        @endif
                    </ul>
                </li>
                <li class="{{ route('brand.index')==$url_canonical ? 'active' : '' }}">
                    <a href=""><i class="fa fa-qq"></i> <span class="nav-label">Brand </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{ route('brand.index')==$url_canonical ? 'active' : '' }}"><a href="{{ route('brand.index') }}">List Brand</a></li>
                        @if (route('brand.index')==$url_canonical)
                            <li><a id="add_brand">Add Brand</a></li>
                        @endif
                    </ul>
                </li>
                <li class="{{ route('slider.index')==$url_canonical ? 'active' : '' }}">
                    <a href=""><i class="fa fa-slideshare"></i> <span class="nav-label">Slider </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{ route('slider.index')==$url_canonical ? 'active' : '' }}"><a href="{{ route('slider.index') }}">List Slider</a></li>
                        @if (route('slider.index')==$url_canonical)
                            <li><a id="add_slider">Add Slider</a></li>
                        @endif
                    </ul>
                </li>
                <li class="{{ route('coupon.index')==$url_canonical ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Coupon</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{ route('coupon.index')==$url_canonical ? 'active' : '' }}"><a href="{{ route('coupon.index') }}">List Coupon</a></li>
                        @if (route('coupon.index')==$url_canonical)
                        <li><a id="add_coupon">Add Coupon</a></li>
                        @endif
                    </ul>
                </li>
                <li class="{{ route('order.index')==$url_canonical ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Order</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{ route('order.index')==$url_canonical ? 'active' : '' }}"><a href="{{ route('order.index') }}">List Order</a></li>
                    </ul>
                </li>
                <li class="{{ route('delivery.index')==$url_canonical ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Transport Fee</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{ route('delivery.index')==$url_canonical ? 'active' : '' }}"><a href="{{ route('delivery.index') }}">List Transport Fee</a></li>
                        @if (route('delivery.index')==$url_canonical)
                        <li><a id="add_delivery">Add Transport Fee</a></li>
                        @endif
                    </ul>
                </li>
                <li class="landing_link">
                    <a target="_blank" href="{{ route('home') }}"><i class="fa fa-star"></i> <span class="nav-label">Page User</span></a>
                </li>
                <li class="special_link">
                    <a href="{{ route('youtube.index') }}"><i class="fa fa-youtube-play"></i> <span class="nav-label">YouTube Demo</span></a>
                </li>
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to INSPINIA+ Admin Theme.</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a class="dropdown-item float-left" href="profile.html">
                                    <img alt="image" class="rounded-circle" src="{{asset('backend/img/a7.jpg')}}">
                                </a>
                                <div>
                                    <small class="float-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a class="dropdown-item float-left" href="profile.html">
                                    <img alt="image" class="rounded-circle" src="{{asset('backend/img/a4.jpg')}}">
                                </a>
                                <div>
                                    <small class="float-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a class="dropdown-item float-left" href="profile.html">
                                    <img alt="image" class="rounded-circle" src="{{asset('backend/img/profile.jpg')}}">
                                </a>
                                <div>
                                    <small class="float-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html" class="dropdown-item">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html" class="dropdown-item">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="float-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <a href="profile.html" class="dropdown-item">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="float-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <a href="grid_options.html" class="dropdown-item">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="float-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html" class="dropdown-item">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="{{ route('logout.index') }}">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
                <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li>
            </ul>

        </nav>
        </div>


        @yield('content')


        <div class="footer">
            <div class="float-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; {{now()->format('Y')}}
            </div>
        </div>

        </div>
        <div id="right-sidebar">
            <div class="sidebar-container">

                <ul class="nav nav-tabs navs-3">
                    <li>
                        <a class="nav-link active" data-toggle="tab" href="#tab-1"> Notes </a>
                    </li>
                    <li>
                        <a class="nav-link" data-toggle="tab" href="#tab-2"> Projects </a>
                    </li>
                    <li>
                        <a class="nav-link" data-toggle="tab" href="#tab-3"> <i class="fa fa-gear"></i> </a>
                    </li>
                </ul>

                <div class="tab-content">


                    <div id="tab-1" class="tab-pane active">

                        <div class="sidebar-title">
                            <h3> <i class="fa fa-comments-o"></i> Latest Notes</h3>
                            <small><i class="fa fa-tim"></i> You have 10 new message.</small>
                        </div>

                        <div>

                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="float-left text-center">
                                        <img alt="image" class="rounded-circle message-avatar" src="{{asset('backend/img/a1.jpg')}}">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">

                                        There are many variations of passages of Lorem Ipsum available.
                                        <br>
                                        <small class="text-muted">Today 4:21 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="float-left text-center">
                                        <img alt="image" class="rounded-circle message-avatar" src="{{asset('backend/img/a2.jpg')}}">
                                    </div>
                                    <div class="media-body">
                                        The point of using Lorem Ipsum is that it has a more-or-less normal.
                                        <br>
                                        <small class="text-muted">Yesterday 2:45 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="float-left text-center">
                                        <img alt="image" class="rounded-circle message-avatar" src="{{asset('backend/img/a3.jpg')}}">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        Mevolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                        <br>
                                        <small class="text-muted">Yesterday 1:10 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="float-left text-center">
                                        <img alt="image" class="rounded-circle message-avatar" src="{{asset('backend/img/a4.jpg')}}">
                                    </div>

                                    <div class="media-body">
                                        Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the
                                        <br>
                                        <small class="text-muted">Monday 8:37 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="float-left text-center">
                                        <img alt="image" class="rounded-circle message-avatar" src="{{asset('backend/img/a8.jpg')}}">
                                    </div>
                                    <div class="media-body">

                                        All the Lorem Ipsum generators on the Internet tend to repeat.
                                        <br>
                                        <small class="text-muted">Today 4:21 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="float-left text-center">
                                        <img alt="image" class="rounded-circle message-avatar" src="{{asset('backend/img/a7.jpg')}}">
                                    </div>
                                    <div class="media-body">
                                        Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                                        <br>
                                        <small class="text-muted">Yesterday 2:45 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="float-left text-center">
                                        <img alt="image" class="rounded-circle message-avatar" src="{{asset('backend/img/a3.jpg')}}">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        The standard chunk of Lorem Ipsum used since the 1500s is reproduced below.
                                        <br>
                                        <small class="text-muted">Yesterday 1:10 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="float-left text-center">
                                        <img alt="image" class="rounded-circle message-avatar" src="{{asset('backend/img/a4.jpg')}}">
                                    </div>
                                    <div class="media-body">
                                        Uncover many web sites still in their infancy. Various versions have.
                                        <br>
                                        <small class="text-muted">Monday 8:37 pm</small>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div id="tab-2" class="tab-pane">

                        <div class="sidebar-title">
                            <h3> <i class="fa fa-cube"></i> Latest projects</h3>
                            <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                        </div>

                        <ul class="sidebar-list">
                            <li>
                                <a href="#">
                                    <div class="small float-right m-t-xs">9 hours ago</div>
                                    <h4>Business valuation</h4>
                                    It is a long established fact that a reader will be distracted.

                                    <div class="small">Completion with: 22%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                    </div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small float-right m-t-xs">9 hours ago</div>
                                    <h4>Contract with Company </h4>
                                    Many desktop publishing packages and web page editors.

                                    <div class="small">Completion with: 48%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small float-right m-t-xs">9 hours ago</div>
                                    <h4>Meeting</h4>
                                    By the readable content of a page when looking at its layout.

                                    <div class="small">Completion with: 14%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-primary float-right">NEW</span>
                                    <h4>The generated</h4>
                                    <!--<div class="small float-right m-t-xs">9 hours ago</div>-->
                                    There are many variations of passages of Lorem Ipsum available.
                                    <div class="small">Completion with: 22%</div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small float-right m-t-xs">9 hours ago</div>
                                    <h4>Business valuation</h4>
                                    It is a long established fact that a reader will be distracted.

                                    <div class="small">Completion with: 22%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                    </div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small float-right m-t-xs">9 hours ago</div>
                                    <h4>Contract with Company </h4>
                                    Many desktop publishing packages and web page editors.

                                    <div class="small">Completion with: 48%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small float-right m-t-xs">9 hours ago</div>
                                    <h4>Meeting</h4>
                                    By the readable content of a page when looking at its layout.

                                    <div class="small">Completion with: 14%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-primary float-right">NEW</span>
                                    <h4>The generated</h4>
                                    <!--<div class="small float-right m-t-xs">9 hours ago</div>-->
                                    There are many variations of passages of Lorem Ipsum available.
                                    <div class="small">Completion with: 22%</div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>

                        </ul>

                    </div>

                    <div id="tab-3" class="tab-pane">

                        <div class="sidebar-title">
                            <h3><i class="fa fa-gears"></i> Settings</h3>
                            <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                        </div>

                        <div class="setings-item">
                    <span>
                        Show notifications
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                                    <label class="onoffswitch-label" for="example">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Disable Chat
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" checked class="onoffswitch-checkbox" id="example2">
                                    <label class="onoffswitch-label" for="example2">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Enable history
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                                    <label class="onoffswitch-label" for="example3">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Show charts
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                                    <label class="onoffswitch-label" for="example4">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Offline users
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example5">
                                    <label class="onoffswitch-label" for="example5">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Global search
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example6">
                                    <label class="onoffswitch-label" for="example6">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Update everyday
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                                    <label class="onoffswitch-label" for="example7">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-content">
                            <h4>Settings</h4>
                            <div class="small">
                                I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                And typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                            </div>
                        </div>

                    </div>
                </div>

            </div>


        </div>
    </div>

    <div class="modal inmodal" id="Modal_edit_profile" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button style="margin-top: -5%" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    {{-- <i class="fa fa-user modal-icon"></i> --}}
                    @if (Auth::user()->social_id != '')
                        <img src="{{ Auth::user()->image_user }}" alt="" class="modal-icon img-thumbnail" width="80px" height="80px">
                    @else
                        <img src="{{ asset('uploads/profile/'.Auth::user()->image_user) }}" alt="" class="modal-icon img-thumbnail" width="80px" height="80px">
                    @endif
                    
                    <h4 class="modal-title">Edit Profile</h4>
                    <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                </div>
                <form id="update_profile_form" enctype="multipart/form-data" method="POST">
                    <div class="modal-body">
                        <div id="message_err"></div>
                        <div class="hr-line-dashed"></div>
                        <input type="hidden" class="form-control" name="profile_user_id" id="profile_user_id">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name <sup class="text-danger">*</sup></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name_profile"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">User Name <sup class="text-danger">*</sup></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="user_name" id="user_name_profile"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email <sup class="text-danger">*</sup></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" id="email_profile"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Password <sup class="text-danger">*</sup></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="password" id="password_profile"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Level <sup class="text-danger">*</sup></label>
                            <div class="col-sm-10">
                                <select name="level" id="level_profile" class="form-control" disabled="">
                                    <option value="">Select</option>
                                    <option value="1">User</option>
                                    <option value="2">Admin</option>
                                </select>
                            </div>
                        </div>
                        @if (Auth::user()->social_id == '')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Image <sup class="text-danger">*</sup></label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="select_image" id="select_image" accept="image/*" multiple="" onchange="ImagesFileAsURL_2()"> 
                                <div id="displayImg" class="displayImg"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary update_profile">Save changes</button> --}}
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style type="text/css">
    .displayImg img{
        width: 100%;
        height: 300px;
        margin-bottom: 2%;
        margin-top: 3%;
    }
    .tdcheckbox{
        text-align: center;
        vertical-align: middle;
    }
    .none{
        display: none;
    }
    </style>


    <!-- Mainly scripts -->
    <script src="{{asset('backend/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('backend/js/popper.min.js')}}"></script>
    <script src="{{asset('backend/js/bootstrap.js')}}"></script>
    <script src="{{asset('backend/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('backend/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    
    <!-- Page-Level Scripts -->
    <script src="{{asset('backend/js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{asset('backend/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{asset('backend/js/inspinia.js')}}"></script>
    <script src="{{asset('backend/js/plugins/pace/pace.min.js')}}"></script>

    <!-- Chosen -->
    <script src="{{asset('backend/js/plugins/chosen/chosen.jquery.js')}}"></script>

   <!-- JSKnob -->
   <script src="{{asset('backend/js/plugins/jsKnob/jquery.knob.js')}}"></script>

   <!-- Input Mask-->
    <script src="{{asset('backend/js/plugins/jasny/jasny-bootstrap.min.js')}}"></script>

   <!-- Data picker -->
   <script src="{{asset('backend/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>

   <!-- NouSlider -->
   <script src="{{asset('backend/js/plugins/nouslider/jquery.nouislider.min.js')}}"></script>

   <!-- Switchery -->
   <script src="{{asset('backend/js/plugins/switchery/switchery.js')}}"></script>

    <!-- IonRangeSlider -->
    <script src="{{asset('backend/js/plugins/ionRangeSlider/ion.rangeSlider.min.js')}}"></script>

    <!-- iCheck -->
    <script src="{{asset('backend/js/plugins/iCheck/icheck.min.js')}}"></script>

    <!-- MENU -->
    <script src="{{asset('backend/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>

    <!-- Color picker -->
    <script src="{{asset('backend/js/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>

    <!-- Clock picker -->
    <script src="{{asset('backend/js/plugins/clockpicker/clockpicker.js')}}"></script>

    <!-- Image cropper -->
    <script src="{{asset('backend/js/plugins/cropper/cropper.min.js')}}"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="{{asset('backend/js/plugins/fullcalendar/moment.min.js')}}"></script>

    <!-- Date range picker -->
    <script src="{{asset('backend/js/plugins/daterangepicker/daterangepicker.js')}}"></script>

    <!-- Select2 -->
    <script src="{{asset('backend/js/plugins/select2/select2.full.min.js')}}"></script>

    <!-- TouchSpin -->
    <script src="{{asset('backend/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>

    <!-- Tags Input -->
    <script src="{{asset('backend/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

    <!-- Dual Listbox -->
    <script src="{{asset('backend/js/plugins/dualListbox/jquery.bootstrap-duallistbox.js')}}"></script>

    <!-- Slug & ChangePrice-->
    <script src="{{asset('backend/js/slug.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/js/slug_coupon.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/js/change_price.js')}}" type="text/javascript"></script>

    <!-- Bootstrap markdown -->
    <script src="{{asset('backend/js/plugins/bootstrap-markdown/bootstrap-markdown.js')}}"></script>
    <script src="{{asset('backend/js/plugins/bootstrap-markdown/markdown.js')}}"></script>

    <!-- Jquery Validate -->
    <script src="{{asset('backend/js/plugins/validate/jquery.validate.min.js')}}"></script>

    <!-- Toastr script -->
    <script src="{{asset('backend/js/plugins/toastr/toastr.min.js')}}"></script>


    <?php Session::forget('id_edit_product');Session::forget('gallery_session'); Session::forget('url_shopping'); ?>
    <script>
        @if(Session::get('message') || Session::get('message_err'))
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            @if(Session::get('message'))
            toastr.success('{{ Session::get('message') }}', 'Notification');
            @else
            toastr.error('{{ Session::get('message_err') }}', 'Notification');
            @endif
            
            
        }, 1300);
        @endif

        $(".touchspin3").TouchSpin({
            verticalbuttons: true,
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });
        $('#data_3 .input-group.date').datepicker({
            format: 'yyyy/mm/dd',
            startView: 2,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
        });

        $('.clockpicker').clockpicker();
        $('.chosen-select').chosen({width: "100%"});

        function ImagesFileAsURL() {
            var fileSelected = document.getElementById('product_image').files;
            if (fileSelected.length > 0) {
                var fileToLoad = fileSelected[0];
                var fileReader = new FileReader();
                fileReader.onload = function(fileLoaderEvent) {
                    var srcData = fileLoaderEvent.target.result;
                    var newImage = document.createElement('img');
                    newImage.src = srcData;
                    document.getElementById('displayImg').innerHTML = newImage.outerHTML;
                }
                fileReader.readAsDataURL(fileToLoad);
            }
        }
        function ImagesFileAsURL_2() {
            var fileSelected = document.getElementById('select_image').files;
            if (fileSelected.length > 0) {
                var fileToLoad = fileSelected[0];
                var fileReader = new FileReader();
                fileReader.onload = function(fileLoaderEvent) {
                    var srcData = fileLoaderEvent.target.result;
                    var newImage = document.createElement('img');
                    newImage.src = srcData;
                    document.getElementById('displayImg').innerHTML = newImage.outerHTML;
                }
                fileReader.readAsDataURL(fileToLoad);
            }
        }

        function uploadImg() {
  
            var fileSelected = document.getElementById('file').files;
            console.log(fileSelected.length);

            if (fileSelected.length > 0 && fileSelected.length <= 4) {
                for (var i = 0; i < fileSelected.length; i++) {
                    var fileToLoad = fileSelected[i];
                    var fileReader = new FileReader();
                    fileReader.onload = function(fileLoaderEvent) {
                        var srcData = fileLoaderEvent.target.result;
                        var newImage = document.createElement('img');
                        newImage.src = srcData;
                        document.getElementById('displayImg').innerHTML += newImage.outerHTML;
                    }
                    fileReader.readAsDataURL(fileToLoad);

                }

            }

        }

        //Update Profile
        $(document).on('click','#edit_profile', function(e){
            var profile_id = $(this).data('profile_id');

            $('#Modal_edit_profile').modal('show');
            $.ajax({
                type: "get",
                url: "account/"+profile_id+"/edit",
                dataType: "json",
                success:function(response){
                    if (response.status == 404) {
                        toastr.error(response.message);
                    }else{
                        $('#name_profile').val(response.profile_login.name);
                        $('#user_name_profile').val(response.profile_login.user_name);
                        $('#email_profile').val(response.profile_login.email);
                        $('#level_profile').val(response.profile_login.level);
                        $('#profile_user_id').val(profile_id);
                    }
                }
            });
        });
        $(document).on('submit','#update_profile_form', function(e){
            e.preventDefault();
            var profile_id = $('#profile_user_id').val();

            var select_image = $('#select_image')[0].files[0];
            var name = $('#name_profile').val();
            var user_name = $('#user_name_profile').val();
            var password = $('#password_profile').val();
            var email = $('#email_profile').val();
            var level = $('#level_profile').val();

            var data = new FormData(this);
            data.append('select_image', select_image);
            data.append('name', name);
            data.append('user_name', user_name);
            data.append('password', password);
            data.append('email', email);
            data.append('level', level);
            data.append('_method', 'PUT');

            $.ajax({
                type: "POST",
                url: "account/"+profile_id,
                data: data,
                contentType: false,
                processData: false,
                dataType: "json",
                success:function(response){
                    if (response.status == 400) {
                        $('#message_err').html('');
                        $('#message_err').addClass('alert alert-danger');
                        $.each(response.errors, function(key, err_values){
                            $('#message_err').append('\
                                <li style="list-style-type: none;">'+err_values+'</li>')
                        });
                    }else if (response.status == 404) {
                        toastr.error(response.message,'Notification');
                    }else{
                        toastr.success(response.message);
                        $('#Modal_edit_profile').modal('hide');
                        location.reload();
                    }
                }
            });
        });

    </script>
    <!-- Ladda -->
    <script src="{{asset('backend/js/plugins/ladda/spin.min.js')}}"></script>
    <script src="{{asset('backend/js/plugins/ladda/ladda.min.js')}}"></script>
    <script src="{{asset('backend/js/plugins/ladda/ladda.jquery.min.js')}}"></script>
    <script>

    $(document).ready(function (){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        // Bind normal buttons
        Ladda.bind( '.ladda-button',{ timeout: 2000 });

        // Bind progress buttons and simulate loading progress
        Ladda.bind( '.progress-demo .ladda-button',{
            callback: function( instance ){
                var progress = 0;
                var interval = setInterval( function(){
                    progress = Math.min( progress + Math.random() * 0.1, 1 );
                    instance.setProgress( progress );

                    if( progress === 1 ){
                        instance.stop();
                        clearInterval( interval );
                    }
                }, 200 );
            }
        });


        var l = $( '.ladda-button-demo' ).ladda();

        l.click(function(){
            // Start loading
            l.ladda( 'start' );

            // Timeout example
            // Do something in backend and then stop ladda
            setTimeout(function(){
                l.ladda('stop');
            },12000)


        });
        // CheckAll
        $('#checkAll').click(function(){
            $('.checkboxclass').prop('checked',$(this).prop('checked'));
            var checked_all = $(this).is(':checked');
            
            if (checked_all) {
                $('#deleteAllcheck').removeClass('none');
                $('#checkAll_footer').addClass('none');
            }else{
                $('#deleteAllcheck').addClass('none');
            }
            
        });
        // CheckAll Footer
        $('#checkAll_footer').click(function(){
            $('.checkboxclass').prop('checked',$(this).prop('checked'));
            var checked_all_footer = $(this).is(':checked');
            
            if (checked_all_footer) {
                $('#deleteAllcheck').removeClass('none');
                $('#checkAll_footer').addClass('none');
                $('#checkAll').attr('checked','checked');
            }else{
                $('#deleteAllcheck').addClass('none');
            }
            
        });
        $(document).on('click','#ids', function(e){

            var checked = $(this).is(':checked');

            if (checked) {
                $('#deleteAllcheck').removeClass('none');
                $(this).attr('checked','checked');
            }else if($('input:checkbox[name=ids]:checked').length > 0){
                $('#deleteAllcheck').removeClass('none');
            }else{
                $('#deleteAllcheck').addClass('none');
            }
        });

    });

</script>
@yield('script')


</body>
</html>

</html>
