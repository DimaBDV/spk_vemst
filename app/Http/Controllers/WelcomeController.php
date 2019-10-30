<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    /** Функция для проверки пришедшего и перенаправления его в зависимости от статуса
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index(){
        if(Auth::check()){
            return redirect('offer');
        }
        return redirect('login');
    }

}
