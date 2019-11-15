<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('verified');
    }

}
