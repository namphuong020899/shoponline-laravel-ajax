{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/images/favicon.png')}}">
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Toastr style -->
    <link href="{{asset('backend/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/styles-login.css') }}">
</head>
<body>
	<style type="text/css">
		.social{
			color: #FFC312;
		}
		.social:hover{
			color: #FFF;
		}
	</style>
@if ($url_canonical == route('login.index'))
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><a href="{{url('facebook')}}" class="social"><i class="fab fa-facebook-square"></i></a></span>
					<span><a href="{{url('google')}}" class="social"><i class="fab fa-google-plus-square"></i></a></span>
					<span><a href="{{url('github')}}" class="social"><i class="fab fa-github"></i></a></span>
				</div>
			</div>
			<div class="card-body">
				<form action="{{ route('login.store') }}" method="post">
					@csrf
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="username" name="email_login" value="{{old('email_login')}}">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" name="password_login" id="myShow">
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox" onclick="myFunction()">Show Password
					</div>
					<div class="form-group">
						<input type="submit" value="Sign In" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="{{ route('sign-up.index') }}">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#">Forgot your password?</a>
				</div>
			</div>
		</div>
	</div>
</div>
@elseif($url_canonical == route('sign-up.index'))
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign Up</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><a href="{{url('facebook')}}" class="social"><i class="fab fa-facebook-square"></i></a></span>
					<span><a href="{{url('google')}}" class="social"><i class="fab fa-google-plus-square"></i></a></span>
					<span><a href="{{url('github')}}" class="social"><i class="fab fa-github"></i></a></span>
				</div>
			</div>
			<div class="card-body">
				<form action="{{ route('sign-up.store') }}" method="post">
					@csrf
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="user name" name="username_signup" value="{{old('username_signup')}}">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-at"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="email" name="email_signup" value="{{old('email_signup')}}">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend" style="cursor:pointer; " id="clickdiv">
							<span class="input-group-text"><i id="check_show" class="fas fa-eye-slash"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" name="password_signup" id="myInput">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend" style="cursor:pointer;" id="clickdiv_2">
							<span class="input-group-text">
								<i id="check_show_2" class="fas fa-eye-slash"></i>
							</span>
						</div>
						<input type="password" class="form-control" placeholder="re password" name="repassword_signup" id="myInput_2">
					</div>

					<div class="form-group">
						<input type="submit" value="Sign Up" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Have an account?<a href="{{ route('login.index') }}">Sign In</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#">Forgot your password?</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
	<script src="{{asset('backend/js/jquery-3.1.1.min.js')}}"></script>
    <!-- Toastr script -->
    <script src="{{asset('backend/js/plugins/toastr/toastr.min.js')}}"></script>
    <!-- Page-Level Scripts -->
    <script>
    	function myFunction() {
		  	var x = document.getElementById("myShow");
		  	if (x.type === "password") {
		    	x.type = "text";
		  	} else {
		    	x.type = "password";
		  	}
		}
		@if($url_canonical == route('sign-up.index'))
	  	let showPassword = false;

	  	const clickdiv = document.querySelector('#clickdiv');
	  	const iconElement = document.querySelector('#check_show');
	  	const typeElement = document.querySelector('#myInput');
		clickdiv.addEventListener('click', function() {
		    if (showPassword) {
		        // Đang hiện password
		        // Chuyển sang ẩn password
		        iconElement.setAttribute('class', 'fas fa-eye-slash')
		        typeElement.setAttribute('type', 'password')
		        showPassword = false
		    } else {
		        // Đang ẩn password
		        // Chuyển sang hiện password
		        iconElement.setAttribute('class', 'fas fa-eye')
		        typeElement.setAttribute('type', 'text')
		        showPassword = true
		    }
		});

		const clickdiv_2 = document.querySelector('#clickdiv_2');
	  	const iconElement_2 = document.querySelector('#check_show_2');
	  	const typeElement_2 = document.querySelector('#myInput_2');
		clickdiv_2.addEventListener('click', function() {
		    if (showPassword) {
		        // Đang hiện password
		        // Chuyển sang ẩn password
		        iconElement_2.setAttribute('class', 'fas fa-eye-slash')
		        typeElement_2.setAttribute('type', 'password')
		        showPassword = false
		    } else {
		        // Đang ẩn password
		        // Chuyển sang hiện password
		        iconElement_2.setAttribute('class', 'fas fa-eye')
		        typeElement_2.setAttribute('type', 'text')
		        showPassword = true
		    }
		});
		@endif
		@if(Session::get('loisignin') || $errors->any())
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                // positionClass: 'toast-bottom-center',
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 5000
            };
            @if(Session::get('loisignin'))
            	toastr.error('{{ Session::get('loisignin') }}', 'Notification');
            @else
	            @foreach($errors->all() as $err)
	            	toastr.error('{{ $err }}', 'Notification');
	            @endforeach
            @endif
        }, 1300);
        @endif
        
    </script>
</body>
</html>