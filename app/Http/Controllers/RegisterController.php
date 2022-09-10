<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('register',[
            'title' => 'Register'
        ]);
    }
    public function store(Request $request){

        $validate = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required','min:3','max:255','unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5'
        ]);

        // $validate = new Request(['status', 'user']);
        $validate['password'] = Hash::make( $validate['password']);
        $validate['status'] = 'petugas';
        User::create($validate);

        // $request->session()->flash('success', 'Register Berhasil! Silahkan Login');
        return redirect('/')->with('success', 'Register Berhasil! Silahkan Login');
    }

}
