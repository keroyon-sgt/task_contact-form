<?php

namespace App\Http\Controllers;

// use Illuminate\Support\ServiceProvider;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\AuthRequest;

use Laravel\Fortify\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {

echo '<br />index get = ';
var_dump($_GET);

echo '<br />post = ';
var_dump($_POST);

        return view('login');
    }

    public function login_view()
    {

echo '<br />login_view get = ';
var_dump($_GET);

echo '<br />post = ';
var_dump($_POST);

        return view('login');
    }

    public function register_view()
    {
        
        return view('register');
    }
    public function register(UserRequest $request)
    {
        $user = $request->only([
            'name',
            'email',
            'password',
            // 'password' => Hash::make($request->password),
        ]);
        
        $user['password']=Hash::make($request->password);

echo '<br />user = ';
var_dump($user);
echo '<br />Hash:make = ';
var_dump(Hash::make($request->password));

        User::create($user);

        return redirect('login');
    }

    // public function store(LoginRequest $request)
    public function store(LoginRequest $request)
    {
echo '<br />here4! ';
echo '<br />request = ';
var_dump($request->only('email', 'password'));

echo '<br />get = ';
var_dump($_GET);
echo '<br />post = ';
var_dump($_POST);

        return $this->loginPipeline($request)->then(function ($request) {
            return app(LoginResponse::class);
        });
    }


    public function login(AuthRequest $request)
    {

echo '<br />AuthController';
echo '<br />here2! ';
//         $user = $request->only([
//             'email',
//             'password',
//         ]);
        
echo '<br />get = ';
var_dump($_GET);

echo '<br />post = ';
var_dump($_POST);
    //     // User::create($user);
        /* Validation */
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|confirmed|min:8',
        // ]);

        /*
        Database Insert
        */
        $user = $request->only([
            // 'name',
            'email',
            'password',
        ]);

        
echo '<br />user = ';
var_dump($user);

$user = User::find(27);

// echo '<br />user = ';
// var_dump($user);

        Auth::login($user);
        // Auth::attempt($user);
// exit;
        // return redirect('admin')->with('message', 'ログインしました');
        // return redirect('login');
        return view('login');
    }
    
    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'ログアウトしました');

    }



}