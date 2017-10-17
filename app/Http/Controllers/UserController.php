<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\User;

class UserController extends Controller
{
    private function handleUserData($user) {
        return array (
            'id' => $user['id'],
            'gender' => $user['gender'],
            'name' => (object) array (
                'title' => $user['nametitle'],
                'first' => $user['firstname'],
                'last' => $user['lastname'],
            ),
            'location' => (object) array (
                'street' => $user['street'],
                'city' => $user['city'],
                'state' => $user['state'],
                'postcode' => $user['postcode'],
            ),
            'email' => $user['email'],
            'login' => (object) array (
                'username' => $user['username'],
                'password' => $user['pass'],
                'salt' => $user['remember_token'],
                'md5' => $user['passwordmd5'],
                'sha1' => $user['passwordsha1'],
                'sha256' => $user['passwordsha256'],
            ),
            'dob' => $user['dob'],
            'registered'  => $user['created_at'],
            'phone' => $user['phone'],
            'cell' => $user['cell'],
            'picture' => (object) array (
                'large' => str_replace ('70/70', '600/600', $user['picture']),
                'medium' => str_replace ('70/70', '280/280', $user['picture']),
                'thumbnail' => $user['picture'],
            ),
            'nat' => $user['nat'],
        );
    }

    public function index($limit = 0, $start = 0) {
        $users = $limit > 0 ?
            User::offset($start)->limit($limit)->orderBy('firstname')->get() :
            User::orderBy('firstname')->get();

        return $users->map(function($user) {
            return $this->handleUserData($user);
        });
    }

    public function show($id = -1) {
        $user = $id <= 0 ?
            User::offset(mt_rand(1, User::all()->count()))->limit(1)->get()[0] :
            User::find($id);

        // Handle user data
        return $this->handleUserData($user);
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $data = $request->all();
        if (isset($data['password'])) {
          $data['pass'] = $data['password'];
          $data['password'] = bcrypt($data['password']);
        }
        $user->update($data);

        return $user;
    }

    public function delete(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->delete();

        return 204;
    }
}
