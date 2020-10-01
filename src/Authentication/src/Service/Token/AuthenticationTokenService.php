<?php

declare(strict_types=1);

namespace Authentication\Service\Token;

use Exception;
use Firebase\JWT\JWT;
use App\Util\Enum\StatusHttp;
use Authentication\DTO\Token;
use Firebase\JWT\ExpiredException;
use Authentication\Entity\User;
use Authentication\Exception\CreateTokenException;
use Authentication\Exception\ExpiredTokenException;
use Authentication\Exception\InvalidTokenException;

class AuthenticationTokenService
{
    /**
     * @var JWT
     */
    private $jwt;

    /**
     * @var array
     */
    private $tokenData;

    /**
     * @var string
     */
    private $algorithm;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $timezone;

    /**
     * @var mixed
     */
    private $defaultTimeZone;

    public function __construct(JWT $jwt, array $tokenData)
    {
        $this->jwt = $jwt;
        $this->tokenData = $tokenData;
        $this->algorithm = $this->tokenData["algorithm"];
        $this->key = $this->tokenData["key"];
        $this->timezone = $this->tokenData["timezone"];
        $this->defaultTimeZone = date_default_timezone_set($this->timezone);
    }

    /**
     * Cria o token de acesso para os usuários
     * @param User |null $user
     * @return string
     * @throws CreateTokenException
     */
    public function createUserToken(?User $user): Token
    {
        try {
            if (empty($user)) {
                throw new CreateTokenException(
                    StatusHttp::BAD_REQUEST,
                    "Os dados do usuário estão inválidos!"
                );
            }

            $this->defaultTimeZone;
            $createdAt = time();
            $expirationTime = $createdAt + $this->tokenData["expiration"];

            $payload = [
                "iat" => $createdAt,
                "iss" => $this->tokenData["serverName"],
                "nbf" => $createdAt,
                "exp" => $expirationTime,
                "data" => [
                   
                ]
            ];
            $payload = $this->encode($payload);
            $token = new Token();
            $token->setToken($payload);
            return $token;
        } catch (CreateTokenException $e) {
            throw new CreateTokenException($e->getCode(), $e->getMessage());
        } catch (Exception $e) {
            throw new CreateTokenException(
                StatusHttp::UNAUTHORIZED,
                "Ocorreu um erro ao criar o token do usuário!",
                $e->getMessage()
            );
        }
    }

    /**
     * Encoda o token com as informações recebidas
     * @param array $payload
     * @return string
     */
    private function encode(array $payload): string
    {
        return $this->jwt->encode($payload, base64_decode($this->key), $this->algorithm);
    }

    /**
     * Decoda o token, retorna exception caso não conseguir
     * @param string $jwtToken
     * @return object
     * @throws ExpiredTokenException
     * @throws InvalidTokenException
     */
    public function decode(string $jwtToken): object
    {
        try {
            return $this->jwt->decode($jwtToken, base64_decode($this->key), [$this->algorithm]);
        } catch (ExpiredException $e) {
            throw new ExpiredTokenException(
                StatusHttp::UNAUTHORIZED,
                "O token de acesso expirou!",
                $e->getMessage()
            );
        } catch (Exception $e) {
            throw new InvalidTokenException(
                StatusHttp::UNAUTHORIZED,
                "O token de acesso esta inválido!",
                $e->getMessage()
            );
        }
    }

    /**
     * @return mixed
     */
    public function getDefaultTimeZone()
    {
        return $this->defaultTimeZone;
    }
}
