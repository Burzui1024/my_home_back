<?php

namespace App\Application\UseCases\Auth;

use App\Models\User;

class UserRegisterCreate
{
    /**
     * Создание пользователя в БД при регистрации
     * @param array $user_data
     * @return User
     */
    public function make(array $user_data): User
    {
        $success = [];
        $user_data['password'] = bcrypt($user_data['password']);
        $user = User::create($user_data);
        return $success['user'] = $user;
    }
}
