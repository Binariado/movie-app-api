<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ResponseTrait;
use Closure;
use Exception;
use Illuminate\Http\Request;
use JWTAuth;

class JwtMiddleware
{
  use ResponseTrait;
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {
    try {
			
      if (!$user = JWTAuth::parseToken()->authenticate()) {
        return $this->error('user_not_found', 404);
			}
			
    } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
			return $this->error('token_is_invalid', 404);
		} catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
			return $this->error('token_is_expired', 404);
		} catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
			return $this->error('token_absent', 404);
		}catch (Exception $e) {
			return $this->error('authorization_token_not_found', 404);
		}
    return $next($request);
  }
}
