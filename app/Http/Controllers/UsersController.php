<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        if (
            $request->input('name') !== null &&
            $request->input('email') !== null &&
            $request->input('password') !== null &&
            $request->input('password') === $request->input('confirm')
        ) {

            try {
                DB::table('users')->insert(
                    [
                        'name'       => $request->input('name'),
                        'email'      => $request->input('email'),
                        'password'   => $request->input('password'),
                        'api_token'  => str_random(255),
                        'created_at' => new \DateTime(),
                        'updated_at' => new \DateTime()
                    ]
                );

                $user = DB::table('users')
                    ->select('id', 'api_token', 'email', 'name')
                    ->where('email', '=', $request->input('email'))
                    ->get()
                    ->first();

                return ['success' => true, 'data' => $user];

            } catch (\Exception $e) {
                return ['success' => false];
            }

        } else {
            return array();
        }

    }
}
