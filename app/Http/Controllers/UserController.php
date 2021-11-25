<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
    return view('users_create');
    }

    public function store(Request $request)
    {   
        $req = $request->all();
        $user = User::create([
            'name' => $req['name'],
            'email' => $req['email'],
            'password' => Hash::make($req['password']),
            'is_admin' => $req['is_admin'],
        ]);

        return redirect()
            ->route('manage')
            ->withSuccess("A new product with ID of {$user->id} has been created")
            ->withErrors("If available, must have stock");
    }

    public function manage(Request $request) {

        $users = \DB::table('users')->get();
        return view('user_management')
        ->with([
            'users' => $users,
        ]);
    }



    public function edit($user) 
    {

        return view('user_edit')->with([
        'user' => \DB::table('users')->find($user), 
    ]);
    }

    public function update(Request $request, User $user) 
    {
        $toPost = $request->all();

        if($toPost['password'] == '' || is_null($toPost['password'])) 
        {
            $user->update([
                'name' => $toPost['name'],
                'email' => $toPost['email'],
                'is_admin' => $toPost['is_admin'],
            ]);
        } else {
            $user->update([
                'name' => $toPost['name'],
                'email' => $toPost['email'],
                'password' => Hash::make($toPost['password']),
                'is_admin' => $toPost['is_admin'],
            ]);
        }


       return redirect()
       ->action('UserController@manage')
       ->withSuccess("The user with ID of {$user->id} has been updated");
    }

    public function destroy(User $user) 
    {
        $user->delete();

        return redirect()
        ->action('UserController@manage')
        ->withSuccess("The product with ID of {$user->id} has been deleted");

    }
}
