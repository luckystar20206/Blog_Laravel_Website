<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    use ApiResponse;

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * @throws ValidationException
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, 422, $validator->errors());
        }
        if (! $token = auth()->attempt($validator->validated())) {
            return $this->apiResponse(null, 401, 'unauthorized');
        }
        return $this->apiResponse($this->createNewToken($token), 200, 'User Logged in Successfully');
    }

    /**
     * @throws ValidationException
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, 400, $validator->errors()); // bad request
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        if ($user) {
            return $this->apiResponse(new UserResource($user), 201, 'User Registered Successfully');
        } else {
            return $this->apiResponse(null, 500, 'Failed'); // 500 => Internal Server Error
        }
    }

    public function logout() {
        auth()->logout();
        return $this->apiResponse(null, 200, 'Logged Out');
    }

    public function refresh() {
        return $this->apiResponse($this->createNewToken(auth()->refresh()), 200, 'Refreshed Token');
    }

    public function userProfile() {
        return $this->apiResponse(new UserResource(auth()->user()), 200, 'User Data');
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
