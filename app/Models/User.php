<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    public function getAvatar($size){
        return str_replace('normal',$size,$this->avatar);
    }
}
