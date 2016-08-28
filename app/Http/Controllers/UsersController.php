<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;

class UsersController extends Controller
{
    protected $_salt = "98^.3c!2";

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
                        'password'   => hash(
                            'sha256', $this->_salt . $request->input('password')
                        ),
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
        }

        return ['success' => false];
    }

    public function login(Request $request)
    {
        if (
            $request->input('email') !== null &&
            $request->input('password') !== null
        ) {
            try {
                $user = DB::table('users')
                    ->select('id', 'api_token', 'email', 'name')
                    ->where([
                        ['email', '=', $request->input('email')],
                        [
                            'password',
                            '=',
                            hash('sha256', $this->_salt . $request->input('password'))
                        ]
                    ])->get()
                    ->first();

                if ($user !== null) {
                    return ['success' => true, 'data' => $user];
                }
            } catch (\Exception $e) {
                return ['success' => false];
            }
        }

        return ['success' => false];
    }
}
