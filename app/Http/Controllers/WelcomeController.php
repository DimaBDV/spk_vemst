<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    /** Функция для проверки пришедшего и перенаправления его в зависимости от статуса
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index(){
        if(Auth::check()){
            if( Auth::user()->isAdmin() ){
                return redirect(route('admin.index'));
            }

            return redirect('offer');
        }
        return redirect('login');
    }

}
