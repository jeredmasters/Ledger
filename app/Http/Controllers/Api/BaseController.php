<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Validator;
use App\Models\Log;

class BaseController extends Controller
{
  public function session(){
    return $GLOBALS['session'];
  }
  public function user(){
    return $GLOBALS['user'];
  }
  public function json($data, $errors = []){
    return [
      'data' => $data,
      'success' => empty($errors),
      'errors' => $errors
    ];
  }
}