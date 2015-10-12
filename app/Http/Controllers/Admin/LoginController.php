<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(\Auth::check()){
            return redirect()->route('admin.index');
        }
        return view('admin.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        if(\Auth::attempt(['email' => $email, 'password' => $password, 'is_banned' => '0'])){
            return redirect()->intended(route('admin.index'));
        } else {
            return redirect()->back()->withInput()->withErrors(['message' => 'Incorrect credentials.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        \Auth::logout();
        return redirect()->route('admin.login.index');
    }
}
