<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'log';
    protected $casts = [
        'data' => 'array',
    ];

    public static function booking($id, $event, $data = null){
        static::log('booking', $id, $event, $data);
    }
    public static function user($id, $event, $data = null){
        static::log('user', $id, $event, $data);
    }
    public static function setting($id, $data = null){
        static::log('setting', $id, 'update', $data);
    }
    public static function log($type, $id, $event, $data = null){
        $user = session('user',null);
        if ($user !== null){
            $log = new Log;
            $log->user_id = $user->id;
            $log->item_type = $type;
            $log->item_id = $id;
            $log->event = $event;
            $log->data = $data;
            // $log->save();
        }
    }
}
