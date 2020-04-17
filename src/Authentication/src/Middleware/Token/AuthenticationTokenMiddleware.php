<?php

declare(strict_types=1);

namespace Authentication\Middleware\Token;

use Exception;
use App\Util\Enum\StatusHttp;
use App\Service\Response\ApiResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use App\Util\Validation\ValidationService;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Authentication\Exception\ExpiredTokenException;
use Authentication\Exception\InvalidTokenException;
use Authentication\Exception\NotFoundTokenException;
use Authentication\Util\CheckUser\CreateValidatePassword;
use Authentication\Service\Token\AuthenticationTokenService;

class AuthenticationTokenMiddleware implements MiddlewareInterface
{
    /**
     * @var AuthenticationTokenService
     */
    private $authenticationTokenService;

    /**
     * @var ValidationService
     */
    private $validationService;

    /**
     * @var CreateValidatePassword
     */
    private $validatePassword;

    public function __construct(
        AuthenticationTokenService $authenticationTokenService,
        ValidationService $validationService,
        CreateValidatePassword $validatePassword
    ) {
        $this->authenticationTokenService = $authenticationTokenService;
        $this->validationService = $validationService;
        $this->validatePassword = $validatePassword;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $keyRequest = isset($request->getHeaders()['authorization'])
                ? $request->getHeaders()['authorization'] : null;

            if (!isset($request->getHeaders()['authorization'])) {
                throw new NotFoundTokenException(
                    StatusHttp::FORBIDDEN,
                    "Token de acesso não encontrado na requisição!",
                );
            }
            $valueRequest = $keyRequest[0];
            list($jwtToken) = sscanf($valueRequest, 'Bearer %s');

            if (!$jwtToken) {
                throw new Exception("O token de acesso está inválido!", 400);
            }

            $tokenDecoded = $this->authenticationTokenService->decode($jwtToken);
        } catch (NotFoundTokenException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (InvalidTokenException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (ExpiredTokenException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (Exception $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        }
        return ($handler->handle($request->withAttribute('tokenDecoded', $tokenDecoded)));
    }
}
