<?php

namespace App\Application\UseCases\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class UserRegisterValidateHandler

{
    /**
     * Валидация данных пользователя при регистрации
     * @param array $user_data
     * @return array|MessageBag|null
     */
    public function make(array $user_data): array|MessageBag|null
    {
        $validator = Validator::make($user_data, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        return null;
    }
}
