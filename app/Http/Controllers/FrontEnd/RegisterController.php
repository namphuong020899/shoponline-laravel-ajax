<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravolt\Avatar\Avatar;
use App\User;
use Hash;
use Session;
use Auth;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('BackEnd.login');
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
        $this->validate($request,
        [
            'email_signup'=>'required|email|unique:users,email',
            'password_signup'=>'required|min:6|max:20',
            'repassword_signup'=>'required|min:6|max:20|same:password_signup',

            'username_signup'=>'required|unique:users,user_name|regex:/^(?=.*[a-z]).{1,255}+$/',
        ],
        [
            'email_signup.required'=>'Vui lòng nhập email',
            'email_signup.email'=>'Email không đúng định dạng',
            'email_signup.unique'=>'Email đã được sử dụng',
            'username_signup.required'=>'Nick name không để rỗng!',
            'username_signup.unique'=>'Nick name đã được sử dụng',
            'username_signup.regex'=>'Mật khẩu phải có ký tự VD: abc',

            'password_signup.required'=>'Vui lòng nhập mật khẩu',
            'password_signup.regex'=>'Mật khẩu phải có 6 ký tự VD: Abc@123',
            'password_signup.min'=>'Mật khẩu ít nhất 6 ký tự',
            'password_signup.max'=>'Mật khẩu không quá 20 ký tự',
        ]);
        $avatar = new Avatar();
        $avatar->create($request->email_signup)->toBase64();
        $name = time().'_user-default.png';
        $avatar->create($request->email_signup)->save('public/uploads/profile/'.$name.'', 100);

        $users = new User();
        $users->name = $request->username_signup;
        $users->user_name = $request->username_signup;
        $users->email  = $request->email_signup ;
        $users->password = Hash::make($request->password_signup);
        $users->level = 1;
        $users->image_user = $name;
        $users->save();

        Auth::login($users,true);
        if (Auth::user()) {
            return redirect()->route('home')->with('thongbao', ' Hi, '.Auth::user()->name.' ');
        }else{
            return redirect()->withInput()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $users = User::findOrfail($id);
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
