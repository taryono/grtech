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
    protected $model;
    
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

    protected function serialize($data, $model = NULL, $ignored = []) { 
        unset($data['_method'], $data['_token']); 
        try { 
            if ($ignored) {
                foreach ($ignored as $val) {
                    unset($data[$val]);
                }
            }
            if ($model) { 
                unset($data['_method'], $data['_token']); 
                if(array_key_exists('id', $data)){
                    unset($data['id']);
                }
                $fields = $this->getFields($model);
                $result = []; 

                foreach ($data as $key => $val) {
                    if (in_array($key, $fields)) {
                        $result[$key] = $val;
                    }
                } 
                $data = $result;
            } 
        } catch (\Exception $e) {
            dd($e->getMessage(), $e->getLine(), __METHOD__);
        }
        return $data;
    } 

    protected function getFields($model){
        return $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());
    }


}