<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\ResponseTrait;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	use ResponseTrait;

	public function __construct()
	{
		//$this->middleware('auth:api', ['except' => ['login', 'register']]);
	}

	public function login(Request $request)
	{
		try {
			$credentials = $request->only('email', 'password');

			try {
				if (!$access_token = JWTAuth::attempt($credentials)) {
					return $this->error('invalid_credentials', 400);
				}
			} catch (JWTException $e) {
				return $this->error('could_not_create_token', 500);
			}

			$token = $this->respondWithToken($access_token);
			$user = Auth::user();
			$user->access_token = $token->access_token;

			return response()->json([
				'code' => 200,
				'message' => 'login_success',
				'data' => 	compact('user')
			], 200)
				->header('content-type', 'application/json');

		} catch (\Throwable $th) {
			return $this->error('internal_server_error', 500);
		}
	}

	public function logout()
	{
		try {
			$this->guard()->logout();
			return response()->json([
				'code' => 200,
				'message' => 'successfully_logged_out',
				'data' => true,
			], 200)
				->header('content-type', 'application/json');
		} catch (\Throwable $th) {
			return $this->error('internal_server_error', 500);
		}
	}

	/**
	 * Undocumented function
	 *
	 * @param Request $request
	 * @return void
	 */
	public function register(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				'name' => 'required|string|max:255',
				'email' => 'required|string|email|max:255|unique:users',
				'password' => 'required|string|min:8|confirmed',
			]);

			if ($validator->fails()) {
				return $this->error(json_decode($validator->errors()->toJson()), 400);
			}

			$user = User::create([
				'name' => $request->get('name'),
				'email' => $request->get('email'),
				'password' => Hash::make($request->get('password')),
			]);

			$access_token = JWTAuth::fromUser($user);
			$token = $this->respondWithToken($access_token);
			$user->access_token = $token->access_token;

			return response()->json([
				'code' => 201,
				'message' => 'register_success',
				'data' => 	compact('user')
			], 201)
				->header('content-type', 'application/json');
		} catch (\Throwable $th) {
			return $this->error('internal_server_error', 500);
		}
	}

	public function me()
	{

		try {

			if (!$user = JWTAuth::parseToken()->authenticate()) {
				return $this->error('user_not_found', 404);
			}

			// $token = $this->respondWithToken(JWTAuth::getToken());
			// $user->access_token = $token->access_token;

			return response()->json([
				'code' => 201,
				'message' => 'get_successful_user',
				'data' => 	compact('user')
			], 201)
				->header('content-type', 'application/json');

		} catch (\Throwable $th) {
			return $this->error('internal_server_error', 500);
		}

	}

	protected function respondWithToken($token)
	{
		return (object)[
			'access_token' => "$token",
			'token_type'   => 'bearer',
			'expires_in'   => $this->guard()->factory()->getTTL() * (60 * 24)
		];
	}

	public function _refreshToken()
	{
		Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
	}

	public function guard()
	{
		return Auth::guard('api');
	}
}
