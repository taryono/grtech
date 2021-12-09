<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use View;

class MainController extends Controller
{   
    protected $user;
    
    public function __construct($model, $controller_name)
    {
        $this->middleware('auth');
        $this->user = Auth::user();

        if (Auth::check()) {
            $this->model = $model;
            $this->controller_name = $controller_name; 
            view::share('user', $this->user); 
        }
    }
}