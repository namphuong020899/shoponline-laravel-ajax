<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Hash;
use Auth;
use App\Http\Requests\LoginRequest;
use Laravel\Socialite\Facades\Socialite;
use App\User;

class LoginController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoginRequest $request)
    {
        $check_email = array('email'=>$request->email_login, 'password'=>$request->password_login);
        $check_nickname= array('user_name'=>$request->email_login, 'password'=>$request->password_login);
        
        if(Auth::attempt($check_nickname) || Auth::attempt($check_email)){
            if (Auth::user()->level == 1) {
                if (Session::get('url_shopping')) {
                    return redirect(Session::get('url_shopping'))->with('message', ' Hi, '.Auth::user()->name.' ');
                }
                return redirect()->route('home')->with('message', ' Hi, '.Auth::user()->name.' ');
            }else{

                return redirect()->route('dashboard.index')->with('message', ' Hi, '.Auth::user()->name.' ');
            }
        }else{
            return redirect()->back()->withInput()->with('loisignin', 'Tên đăng nhập hoặc mật khẩu không đúng!');
        }
    }
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $google = Socialite::driver('google')->user();
        $user = User::where('social_id', $google->getId())->first();

        if (!$user) {
            $user = new User();
            $user->name = $google->getName();
            $user->user_name = $google->user['given_name'].'_'.$google->user['family_name'];
            $user_check = User::where('email', $google->getEmail())->first();
            if ($user_check) {
                $user->email = $google->getId().'@gnail.com';
            }else{
                $user->email = $google->getEmail();
            }
            $user->password = Hash::make($google->getName().'@'.$google->getId());
            $user->social_id = $google->getId();
            $user->level = 1;
            $user->image_user = $google->getAvatar();
            $user->save();
        }
        if ($user->image_user != $google->getAvatar()) {
            $user->image_user = $google->getAvatar();
            $user->save();
        }

        Auth::login($user,true);
        if (Auth::user()->level == 1) {
            return redirect()->route('home')->with('message', ' Hi, '.Auth::user()->name.' ');
        }else{
            return redirect()->route('dashboard.index')->with('message', ' Hi, '.Auth::user()->name.' ');
        }
        
 
    }
    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback_facebook()
    {
        $facebook = Socialite::driver('facebook')->user();
        $user = User::where('social_id', $facebook->getId())->first();
        // dd($facebook);
        if (!$user) {
            $user = new User();
            $user->name = $facebook->getName();
            $user->user_name = $facebook->getName();
            if ($facebook->getEmail() == '') {
                $user->email = $facebook->getId().'@gnail.com';
            }else{
                $user_check = User::where('email', $facebook->getEmail())->first();
                if ($user_check) {
                    $user->email = $facebook->getId().'@gnail.com';
                }else{
                    $user->email = $facebook->getEmail();
                }
            }
            
            $user->password = Hash::make($facebook->getName().'@'.$facebook->getId());
            $user->social_id = $facebook->getId();
            $user->level = 1;
            $user->image_user = $facebook->getAvatar();
            $user->save();
        }
        if ($user->image_user != $facebook->getAvatar()) {
            $user->image_user = $facebook->getAvatar();
            $user->save();
        }
        Auth::login($user,true);
        if (Auth::user()->level == 1) {
            return redirect()->route('home')->with('message', ' Hi, '.Auth::user()->name.' ');
        }else{
            return redirect()->route('dashboard.index')->with('message', ' Hi, '.Auth::user()->name.' ');
        }
        
 
    }
      /**
     * Redirect the user to the Github authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider_github()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from Github.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback_github()
    {
        $github = Socialite::driver('github')->user();
        $user = User::where('social_id', $github->getId())->first();
        
        // dd($github);
        if (!$user) {
            $user = new User();
            $user->name = $github->getNickname();
            $user->user_name = $github->getNickname();
            if ($github->getEmail() == '') {
                $user->email = $github->getId().'@gnail.com';
            }else{
                $user_check = User::where('email', $github->getEmail())->first();
                if ($user_check) {
                    $user->email = $github->getId().'@gnail.com';
                }else{
                    $user->email = $github->getEmail();
                }
                
            }
            
            $user->password = Hash::make($github->getNickname().'@'.$github->getId());
            $user->social_id = $github->getId();
            $user->level = 1;
            $user->image_user = $github->getAvatar();
            $user->save();
        }
        if ($user->image_user != $github->getAvatar()) {
            $user->image_user = $github->getAvatar();
            $user->save();
        }
        Auth::login($user,true);
        if (Auth::user()->level == 1) {
            return redirect()->route('home')->with('message', ' Hi, '.Auth::user()->name.' ');
        }else{
            return redirect()->route('dashboard.index')->with('message', ' Hi, '.Auth::user()->name.' ');
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
