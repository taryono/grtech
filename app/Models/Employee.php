<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class Employee extends Model
{
    use HasFactory, SoftDeletes; 
    protected $guarded = ['id']; 
    protected $dates = ['deleted_at'];

    public static $rules = array(
        'company_id' => 'required', 
        'first_name' => 'required', 
        'last_name' => 'required', 
    );

    public function validate($data)
    {
        $v = Validator::make($data, Employee::$rules);
        return $v;
    }

    public function company()
    {
        return $this->belongsTo('Models\Company');
    }

    public function full_name($value)
    {
        return $this->first_name." ".$this->last_name;
    }

}
