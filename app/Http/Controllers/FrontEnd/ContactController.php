<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Carbon\Carbon;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('FrontEnd.About.contact');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //send mail lien he
        $to_email =  env('MAIL_USERNAME');

        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $tile_mail = "Liên Hệ từ Limupa".' '.$now;
        $data['email'] = $request->customerEmail;

        $name_mail = $request->customerName;
        $email_mail = $request->customerEmail;
        $content_mail = $request->contactMessage;


        Mail::send('Mail.contact',
            [
                'name_mail' => $name_mail,
                'email_mail' => $email_mail,
                'content_mail' => $content_mail,
            ],
            function($message) use ($tile_mail, $name_mail, $data, $content_mail, $email_mail, $to_email){
                    $message->to($to_email)->subject($tile_mail);
                    $message->from($data['email'],$tile_mail);
                });

        return redirect()->back()->with('thongbao_mail','Gửi email thành công, Shop sẽ phản hồi trong thời gian sớm nhất có thể');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
