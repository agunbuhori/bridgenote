<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends ApiController
{
    /**
     * User register
     * 
     * @param \Illuminate\Http\Request;
     * @return json
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:6|max:255'
        ]);

        if ($validator->fails())
            return $this->failed(422, $validator->errors());

        $newUser = User::create($request->all());

        return $this->success($newUser, 200, "Register success");
    }
    /**
     * User authentication
     * 
     * @param \Illuminate\Http\Request;
     * @return json
     */
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('Personal Access Token');
            $expires = now()->addHours(6);

            return $this->success([
                'tokenType' => 'Bearer',
                'accessToken' => $token->accessToken,
                'expiresIn' => $expires
            ]);
        }

        return $this->failed(403, 'Authentication Failed');
    }

    /**
     * User detail
     * 
     * @param \Illuminate\Http\Request;
     * @return json
     */
    public function user(Request $request)
    {
        return $this->success($request->user());
    }

    /**
     * User logout
     * 
     * @param \Illuminate\Http\Request
     * @return json
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return $this->success(null, 200, "User has logout");
    }
}
