<?php
namespace App\Http\Composers;

use Illuminate\Contracts\View\View;

class MasterComposer {

    public function compose(View $view)
    {
        $user = session('user', null);
        if ($user !== null){
            $view->with('userName', $user->name);
        }
        else{
            $view->with('userName', 'a');
        }
    }

}
