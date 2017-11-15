<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoContent extends Model
{
    protected $table = 'info_content';

    public static function handle($handle){
      $val = InfoContent::where('handle', '=', $handle)->first();
      if ($val == null){
        $val = new InfoContent;
        $val->handle=$handle;
      }
      return $val;
    }
}
