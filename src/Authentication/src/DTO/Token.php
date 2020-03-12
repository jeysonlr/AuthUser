<?php

declare(strict_types=1);

namespace Authentication\DTO;

use JMS\Serializer\Annotation\Type;

class Token
{
    /**
     * @var string
     * @Type("string")
     */
    private $token;

    /**
     * Get the value of token
     *
     * @return  string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @param  string  $token
     *
     * @return  self
     */
    public function setToken(string $token)
    {
        $this->token = $token;

        return $this;
    }
}
