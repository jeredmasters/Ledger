<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiSession extends Model
{
    protected $table = 'api_sessions';
    private static function generateRandomString($length = 32) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public static function create($user){
        $session = new ApiSession;
        $session->token = static::generateRandomString();
        $session->user_id = $user->id;
        $session->ip_address = request()->ip();    
        $session->save();
        
        return $session;
    }
    public static function token($token){
      return ApiSession::where('token', '=', $token)->first();
    }
}
