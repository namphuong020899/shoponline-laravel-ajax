<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Quên mật khẩu</title>
</head>
<body>
	<h2>Xin Chào {{$data['name_user']}},</h2>
	<p></p>
	<p>Bạn đã yêu cầu thiết lập lại mật khẩu cho tài khoản của bạn tại <a href="{{route('home')}}">SHOP LIMUPA</a></p>
	<p></p>
	<p>Vui lòng truy cập vào đường link bên dưới để thiết lập lại mật khẩu của bạn. </p>
	<p></p>
	<p>{{$data['body']}}</p>
	<p></p> 
	<p>Nếu bạn nhận được email này do nhầm lẫn, bạn hoàn toàn có thể bỏ qua email này.</p>
</body>
</html>