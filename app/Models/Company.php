<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class Company extends Model
{
    use HasFactory, SoftDeletes; 
    protected $guarded = ['id']; 
    protected $dates = ['deleted_at'];

    public static $rules = array( 
        'name' => 'required'
    );

    public function validate($data)
    {
        $v = Validator::make($data, job::$rules);
        return $v;
    }

    public function employee()
    {
        return $this->hasMany('Models\Employee');
    }
}