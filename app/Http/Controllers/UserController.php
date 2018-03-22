<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
