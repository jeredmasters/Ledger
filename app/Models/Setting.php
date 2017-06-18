<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $json = ['value'];

    public static function get($key, $default = null){
        $setting = Setting::where('key','=',$key)->first();
        if ($setting == null){
            return $default;
        }
        return $setting->value;
    }

    public static function set($key, $value){
        $setting = Setting::where('key','=',$key)->first();
        if ($setting == null){
            $setting = new Setting;
            $setting->key = $key;
        }
        $setting->value = $value;
        $setting->save();
        return $setting->id;
    }
}
