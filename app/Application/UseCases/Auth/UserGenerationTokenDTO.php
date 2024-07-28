<?php

namespace App\Application\UseCases\Auth;

use App\Application\DTOs\User\UserTokenDTO;

class UserGenerationTokenDTO
{
    private string $token_type = 'bearer';

    /**
     * Возвращает DTO по токену
     * @param string $token
     * @return UserTokenDTO
     */
    public function make(string $token): UserTokenDTO
    {
        return new UserTokenDTO($token, $this->token_type, auth('api')->factory()->getTTL() * env('TIME_FROM_VALID_TOKEN'));
    }

}
