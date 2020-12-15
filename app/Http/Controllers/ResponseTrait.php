<?php

namespace App\Http\Controllers;

trait ResponseTrait
{

	public function error($type, $code)
	{
		return response()
			->json([
				'errors' =>(object) [
					'code' => $code,
					'message' => $type
				]
			], $code)
			->header('content-type', 'application/json');
	}

	public function success($data, $message, $code)
	{
		return response()->json([
			'code' => $code,
			'message' => $message,
			'data' => $data,
		], $code)
			->header('content-type', 'application/json');
	}

}
