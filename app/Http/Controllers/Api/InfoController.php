<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use App\Models\Log;
use App\Models\InfoContent;

class InfoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      return $this->json(InfoContent::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'handle'    => 'required',
            'content'   => 'required',
            'title'     => 'required'
        ]);

        // process the login
        if ($validator->fails()) {
          return $this->json($request->all(), $validator);
        } else {
            // store
            $info = InfoContent::handle($request->get('handle'));
            $info->title       = $request->get('title');
            $info->content       = $request->get('content');
            $info->save();

            // Log::user($info->id, 'create', $user);

            return $this->json($info);
        }
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
        'handle'    => 'required',
        'content'   => 'required',
        'title'     => 'required'
      ]);

      // process the login
      if ($validator->fails()) {
        return $this->json($request->all(), $validator);
      } else {
          // store
          $info = InfoContent::handle($request->get('handle'));
          $info->title       = $request->get('title');
          $info->content = $request->get('content');          
          $info->save();

          // Log::user($info->id, 'create', $user);

          return $this->json($info);
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
