<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserUpdateRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagetitle = 'Users';
        $params = array();
        $users = User::withCount('authors', 'poems');
        $sortby = '';
        if(isset($_GET['sortby'])) {
          $params['sortby'] = $_GET['sortby'];
          $sortby = $_GET['sortby'];
        }
        switch($sortby) {
          case 'created_at':
            $users = $users->orderBy('created_at', 'asc');
            break;
          case 'poems':
            $users = $users->orderBy('poems_count', 'desc');
            break;
          case 'authors':
            $users = $users->orderBy('authors_count', 'desc');
            break;
          default:
            $users = $users->orderBy('name', 'asc');
        }

        if ( isset($_GET['index'])) {
          $params['index'] = $_GET['index'];
          $users = $users->where('name', 'like', $params['index'] . '%');
          $pagetitle .= ': ' . $params['index'];
        }

        $users = $users->paginate(15);
        $view_data = array(
          'pagetitle' => $pagetitle,
          'users' => $users,
          'params' => $params,
        );
        return view('admin.users-list', $view_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = 0)
    {
      $current_user = Auth::user();
      if (empty($id)) {
        $id = $current_user->id;
      }
      $profile_user = User::find($id);
      if (empty($profile_user)) {
        abort(404);
      }
      if ( $current_user->cannot('view', $profile_user)) {
        abort(403);
      }
      $view_data = array(
        'pagetitle' => $profile_user->name,
        'user' => $profile_user,
      );
      return view('user.show', $view_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $current_user = Auth::user();
        $profile_user = User::find($id);
        if (empty($profile_user) ) {
          abort(404);
        }
        if ($current_user->cannot('edit', $profile_user)) {
          abort(403);
        }
        $view_data = array(
          'pagetitle' => 'Edit ' . $profile_user->name,
          'user' => $profile_user,
        );
        return view('user.edit', $view_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserUpdateRequest $request, $id)
    {
        $current_user = Auth::user();
        $profile_user = User::find($id);
        if (empty($profile_user) ) {
          abort(404);
        }
        if ($current_user->cannot('edit', $profile_user)) {
          abort(403);
        }
        $profile_user->name = $request->name;
        $profile_user->email = $request->email;
        $profile_user->save();
        return redirect(route('user', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
