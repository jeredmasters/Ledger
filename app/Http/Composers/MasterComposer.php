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
            if ($user !== null){
                $view->with('userName', $user->name);
                $view->with('userAccess', $user->access);
                $view->with('userAvatar', $user->avatar);
                return;
            }
        }
        $view->with('userName', '');
        $view->with('userAccess', 0);
        $view->with('userAvatar', false);

    }

}
