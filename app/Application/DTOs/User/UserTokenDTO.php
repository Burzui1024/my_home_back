<?php

namespace App\Application\DTOs\User;

class UserTokenDTO
{
    /**
     * @param string $access_token
     * @param string $token_type
     * @param int $expires_in
     */
    public function __construct(
        private readonly string $access_token,
        private readonly string $token_type,
        private readonly int    $expires_in
    )
    {
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->token_type;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expires_in;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'access_token' => $this->getAccessToken(),
            'token_type' => $this->getTokenType(),
            'expires_in' => $this->getExpiresIn()
        ];
    }

}
