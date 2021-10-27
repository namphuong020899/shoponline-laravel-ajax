
@extends('LayoutBackEnd')
@section('title')    
  Products
@endsection
@section('content') 

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content text-center">

                        <h2>
                            <i class="fa fa-expand"> </i> Resize the window to see how behaves responsive video.
                        </h2>
                        <small>Just put video on <code>figure > iframe</code> element. Script will do the rest. </small>


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Video window</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <figure>
                            <iframe width="100%" height="349" src="https://www.youtube.com/embed/KFlK-g_WlkQ" frameborder="0" allowfullscreen></iframe>
                        </figure>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('script') 
    <!-- Custom and plugin javascript -->
    <script src="{{ asset('backend/js/inspinia.js') }} "></script>
    <script src="{{ asset('backend/js/plugins/pace/pace.min.js') }} "></script>
    <script src="{{ asset('backend/js/plugins/video/responsible-video.js') }} "></script>   

	<script type="text/javascript">
		$(document).ready(function(){
		    $(document).on('webkitfullscreenchange mozfullscreenchange fullscreenchange', function (e){
		        $('body').hasClass('fullscreen-video') ? $('body').removeClass('fullscreen-video') : $('body').addClass('fullscreen-video')
		    });
		});
	</script>

@endsection