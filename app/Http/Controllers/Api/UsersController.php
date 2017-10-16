<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use App\Models\Log;

class UsersController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // get all the users
        $users = User::all();

        // load the view and pass the users
        return view('a.users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('a.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'       => 'required',
            'email'      => 'required|email',
            'access'     => 'required|numeric'
        ]);

        // process the login
        if ($validator->fails()) {
            return redirect('users/create')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            // store
            $user = new User;
            $user->name       = $request->get('name');
            $user->email      = $request->get('email');
            $user->access     = $request->get('access');
            $user->save();

            Log::user($user->id, 'create', $user);

            // redirect
            Session::flash('message', 'Successfully created user!');
            return Redirect::to('users');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        // get the user
        $user = User::find($id);

        // show the view and pass the user to it
        return view('a.users.show')
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // get the user
        $user = User::find($id);

        // show the view and pass the user to it
        return view('a.users.edit')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'email'      => 'required|email',
            'access'     => 'required|numeric'
        ]);

        // process the login
        if ($validator->fails()) {
            return redirect('users/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            // store
            $user = User::find($id);
            $user->name       = $request->get('name');
            $user->email      = $request->get('email');
            $user->access     = $request->get('access');
            $user->save();

            Log::user($user->id, 'update', $user);

            // redirect
            $request->session()->flash('message', 'Successfully updated user!');
            return redirect('/a/users');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        Log::user($id, 'delete');
        // delete
        $user = User::find($id);
        $user->delete();

        // redirect
        $request->session()->flash('message', 'Successfully deleted the user!');
        return response()->redirect('users');
    }
}
