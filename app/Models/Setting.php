<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;
    
    public function setSetting($key,$value)
    {
    	Setting::where('key', $key)->update(['value' => $value]);
    }

    public function getSetting($key)
    {
    	$result = Setting::where('key', $key)->first();
    	return $result->value;
    }
}