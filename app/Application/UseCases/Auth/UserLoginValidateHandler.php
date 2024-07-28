<?php

namespace App\Application\UseCases\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class UserLoginValidateHandler
{
    /**
     * Валидация данных при авторизации
     * @param array $user_data
     * @return array|MessageBag|null
     */
    public function make(array $user_data): array|MessageBag|null
    {
        $validator = Validator::make($user_data, [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        return null;
    }
}
