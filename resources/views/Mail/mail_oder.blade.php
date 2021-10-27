
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Đơn Hàng</title>
</head>
<body>
    <div marginheight="0" marginwidth="0" style="background:#f0f0f0">
    <div id="wrapper" style="background-color:#f0f0f0">
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="margin:0 auto;width:600px!important;min-width:600px!important" class="container">
            <tbody>
                <tr>
                    <td align="center" valign="middle" style="background:#ffffff">
                        <table style="width:580px;border-bottom:1px solid #ff3333" cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <tr>
                                    <td align="left" valign="middle" style="width:500px;height:60px">
                                        <a href="{{route('home')}}" style="border:0" target="_blank" width="130" height="35" style="display:block;border:0px">
                                            <img src="https://i.pinimg.com/564x/71/ca/6f/71ca6f70e4379441768d414e4dba6751.jpg" height="110px" width="155px" style="display:block;border:0px;float: left;"> <b style="float: left;line-height: 100px;color: red;font-size: 20px;"></b>
                                        </a>
                                    </td>
                                    <td align="right" valign="middle" style="padding-right:15px">
                                        <a href="" style="border:0"> 
                                            <img src="https://i.imgur.com/eL1uAJx.png" height="36" width="115" style="display:block;border:0px"> 
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle" style="background:#ffffff">
                        <table style="width:580px" cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <tr>
                                    <td align="left" valign="middle" style="font-family:Arial,Helvetica,sans-serif;font-size:24px;color:#ff3333;text-transform:uppercase;font-weight:bold;padding:25px 10px 15px 10px">
                                        Thông báo đặt hàng thành công
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="middle" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding:0 10px 20px 10px;line-height:17px">
                                        Chào bạn, <b>{{$shipping_array['name']}}</b>,
                                        <br> Cảm ơn bạn đã mua sắm tại ShopPV
                                        <br>
                                        <br> Đơn hàng của bạn đang 
                                        <b>chờ shop</b>  
                                        <b>xác nhận</b> (trong vòng 24h)
                                        <br> Chúng tôi sẽ thông tin <b>trạng thái đơn hàng</b> trong email tiếp theo.
                                        <br> Bạn vui lòng kiểm tra email thường xuyên nhé.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle" style="background:#ffffff">
                        <table style="width:580px;border:1px solid #ff3333;border-top:3px solid #ff3333" cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <tr>
                                    <td colspan="2" align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#666666;padding:10px 10px 20px 15px;line-height:17px"> 
                                        <b>Đơn hàng của bạn #</b> 
                                        <a href="#" style="color:#ed2324;font-weight:bold;text-decoration:none" target="_blank">
                                        </a>
                                        <span style="font-size:12px"></span>
                                    </td>
                                </tr>
                                @foreach(Cart::content() as $cart)
                                    <tr>
                                        <td align="left" valign="top" style="width:120px;padding-left:15px">
                                            <a href="#_" style="border:0"> 
                                                <img src="{{asset('public/uploads/'.$cart->options->image)}}" height="120" width="120" style="display:block;border:0px">
                                            </a>
                                        </td>
                                        <td align="left" valign="top">
                                            <table style="width:100%" cellpadding="0" cellspacing="0" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:15px;padding-right:10px;line-height:20px;padding-bottom:5px"> 
                                                            <b>Sản phẩm</b>
                                                        </td>
                                                        <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">:</td>
                                                        <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px">
                                                             <a href="#" style="color:#115fff;text-decoration:none" target="_blank">
                                                                {{$cart->name}}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:15px;padding-right:10px;line-height:20px;padding-bottom:5px"> 
                                                            <b>Số lượng</b>
                                                        </td>
                                                        <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">:</td>
                                                        <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px"> {{$cart->qty}}

                                                        </td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px"> 
                                                            <b>Tổng thanh toán</b>
                                                        </td>
                                                        <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">:</td>
                                                        <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px">    
                                                            {{number_format(Session::get('total_order')+Session::get('fee')).' '.'vnđ'}}
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px"> 
                                                            <b>Người nhận</b>
                                                        </td>
                                                        <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">:</td>
                                                        <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px"> 
                                                            <b>{{$shipping_array['name']}}</b> - {{$shipping_array['phone_number']}}
                                                            <br>
                                                            {{$shipping_array['address']}}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="2" align="center" valign="top" style="padding-top:20px;padding-bottom:20px;border-bottom:1px solid #ebebeb">
                                        <a href="#" style="border:0px" target="_blank"> 
                                            <img src="https://i.imgur.com/f92hL68.jpg" height="29" width="191" alt="Chi tiết đơn hàng" style="border:0px"> 
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle" style="background:#ffffff;padding-top:20px">
                        <table style="width:500px" cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <tr>
                                    <td align="center" valign="middle" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px"> 
                                        Đây là thư tự động từ hệ thống. Vui lòng không trả lời email này.
                                        <br> Nếu có bất kỳ thắc mắc hay cần giúp đỡ, Bạn vui lòng ghé thăm 
                                        <b style="font-family:Arial,Helvetica,sans-serif;font-size:13px;text-decoration:none;font-weight:bold">Trung tâm trợ giúp</b> của chúng tôi tại địa chỉ: 
                                        <a href="{{route('contact.index')}}" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#0066cc;text-decoration:none;font-weight:bold" target="_blank">
                                            help.shop.vn
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div> 
</div>
</body>
</html>
