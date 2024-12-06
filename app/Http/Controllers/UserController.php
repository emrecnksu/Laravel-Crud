<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        return view("register");
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:3|confirmed',
        ],[
            'name.required' => 'Ad alanı boş bırakılmaz.',
            'surname.required' => 'Soyad alanı boş   bırakılmaz.',
            'email.required' => 'E-Posta alanı boş bırakılmaz.',
            'email.unique' => 'Bu e-posta daha önceden alınmış.',
            'password.required' => 'Şifre alanı boş bırakılmaz.',
            'password.confirmed' => 'Şifreler eşleşmiyor. Tekrar deneyin.'
            ]
    );

        $existingUser = User::where('email', $request->input('email'))->first();

        $user = new User([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->save();

        Auth::login($user);

        return redirect()->route('login')->with('success', 'Kayıt başarılı. Artık giriş yapabilirsiniz.');
    }


    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'E-posta alanı boş bırakılamaz.',
            'email.email' => 'Lütfen geçerli bir e-posta adresi girin.',
            'password.required' => 'Şifre alanı boş bırakılamaz.'
        ]);

        if ($validator->fails()) {
            $firstError = $validator->errors()->first(); 
            return back()->withErrors(['firstError' => $firstError])->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->input('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('index')->with('success', 'Giriş başarılı.');
        }

        return back()->with('error', 'Geçersiz giriş bilgileri. Lütfen tekrar deneyin.');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login.form')->with('success', 'Başarıyla çıkış yapıldı.');
    }

    public function index()
    {
        if(Auth::check()) {
            $products = Product::all();
            return view('index', compact('products'));
        } else {
            return redirect()->route('login')->with('error', 'Verileri görmek için giriş yapmalısınız.');
        }
    }
}