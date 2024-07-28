<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Application\UseCases\Auth\UserGenerationTokenDTO;
use App\Application\UseCases\Auth\UserLoginValidateHandler;
use App\Application\UseCases\Auth\UserRegisterCreate;
use App\Application\UseCases\Auth\UserRegisterValidateHandler;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    public function __construct(private readonly UserRegisterValidateHandler $userRegisterValidateHandler,
                                private readonly UserRegisterCreate          $userRegisterCreate,
                                private readonly UserLoginValidateHandler    $userLoginValidateHandler,
                                private readonly UserGenerationTokenDTO      $userGenerationTokenDTO)
    {
    }

    /**
     * Регистрация пользователя
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $input_data = $request->all();

        if (
            !is_null($errors = $this->userRegisterValidateHandler->make($input_data))
        ) {
            return $this->sendError('Validation Error.', $errors);
        }

        return $this->sendResponse($this->userRegisterCreate->make($input_data), 'User register successfully.');
    }

    /**
     * Получение токена
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $input_data = $request->all();
        if (
            !is_null($errors = $this->userLoginValidateHandler->make($input_data))
        ) {
            return response()->json($errors, 422);

        }

        if (!$token = auth()->guard('api')->attempt($input_data)) {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }

        return $this->sendResponse($this->userGenerationTokenDTO->make($token)->toArray(), 'User login successfully.');
    }

    /**
     * Получение данных аккаунта
     * @return JsonResponse
     */
    public function profile()
    {
        return $this->sendResponse(auth()->user(), 'Token is valid');
    }

    /**
     * Выход пользователя
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return $this->sendResponse([], 'Successfully logged out.');
    }

    /**
     * Обновить токен
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->sendResponse(
            $this->userGenerationTokenDTO->make(auth()->guard('api')->refresh())->toArray(),
            'Refresh token return successfully.'
        );
    }

}
