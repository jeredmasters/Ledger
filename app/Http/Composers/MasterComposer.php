<?php
namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use App\Models\User;

class MasterComposer {

    public function compose(View $view)
    {
        $user = session('user', null);
        if ($user !== null){
            $user = User::find($user->id);
            $view->with('userName', $user->name);
            $view->with('userAccess', $user->access);
        }
        else{
            $view->with('userName', '');
            $view->with('userAccess', 0);
        }
    }

}
