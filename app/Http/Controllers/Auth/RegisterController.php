<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator( array $data )
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/(.*)@vemst\.ru$/i'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'fathers_name' => ['required', 'string', 'max:255'],
            'unit' => ['required', 'string', 'max:255']
        ],
//        message
            [
                'name.required' => 'Обязательное поле.',
                'name.string' => 'Данныеы в поле должны быть тексом.',

                'email.required' => 'Обязательное поле.',
                'email.string' => 'Данныеы в поле должны быть тексом.',
                'email.email' => 'Ожидался E-mail адрес',
                'email.unique' => 'Сожалеем, но данный адрес уже зарегистрирован.',
                'email.regex' => 'E-mail должен быть внутренним - @vemst.ru',

                'password.required' => 'Обязательное поле.',
                'password.string' => 'Данныеы в поле должны быть тексом.',
                'password.min' => 'Пароль должен содержать не менее :min символов.',
                'password.confirmed' => 'Пароли должны совпадать',

                'fathers_name.required' => 'Обязательное поле.',
                'fathers_name.string' => 'Данныеы в поле должны быть тексом.',

                'unit.required' => 'Обязательное поле.',
                'unit.string' => 'Данныеы в поле должны быть тексом.',
            ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create( array $data )
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'fathers_name' => $data['fathers_name'],
            'unit' => $data['unit']
        ]);
    }
}
