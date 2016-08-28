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
                        'password'   => $this->_hashPassword(
                            $request->input('password')
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
                            $this->_hashPassword($request->input('password'))
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

    public function view()
    {
        $user = \Auth::guard('api')->user();

        return ['success' => true, 'data' => $user];
    }

    /**
     * I'm not sure if this method was intended to update any user data, but
     * using this method, you can update all the users data except id,
     * api_token, created_at, and updated_at.
     */
    public function edit(Request $request)
    {
        $user = \Auth::guard('api')->user();

        $valuesToUpdate = $request->all();

        //Cannot update id, api_token, created_at or updated_at
        unset($valuesToUpdate['id']);
        unset($valuesToUpdate['api_token']);
        unset($valuesToUpdate['created_at']);
        unset($valuesToUpdate['updated_at']);

        //Ignoring 'confirm' after validation
        if (
            isset($valuesToUpdate['password']) &&
            $valuesToUpdate['password'] !== $valuesToUpdate['confirm']
        ) {
            return ['success' => false];
        } else {
            $valuesToUpdate['password'] = $this->_hashPassword(
                $valuesToUpdate['password']
            );
        }
        unset($valuesToUpdate['confirm']);

        DB::table('users')->update($valuesToUpdate);

        //Reload the user to show the updated data
        //Seems like I should be able to user Auth::guard to get the users
        //data here too, but I can't see how to reload user data that way
        $user = DB::table('users')
            ->select('id', 'api_token', 'email', 'name')
            ->where('id', '=', $user['id'])
            ->get()
            ->first();

        return ['success' => true, 'data' => $user];
    }

    protected function _hashPassword($password)
    {
        return hash('sha256', $this->_salt . $password);
    }
}
