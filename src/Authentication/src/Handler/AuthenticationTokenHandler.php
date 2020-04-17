<?php

declare(strict_types=1);

namespace Authentication\Handler;

use Exception;
use App\Util\Enum\StatusHttp;
use App\Service\Response\ApiResponse;
use Psr\Http\Message\ResponseInterface;
use Authentication\Exception\BodyException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Authentication\Exception\CreateTokenException;
use Authentication\Exception\ExpiredTokenException;
use Authentication\Exception\InvalidTokenException;
use Authentication\Service\Token\AuthenticationTokenService;

class AuthenticationTokenHandler implements RequestHandlerInterface
{
    /**
     * @var AuthenticationTokenService
     */
    private $authenticationTokenService;

    public function __construct(AuthenticationTokenService $authenticationTokenService)
    {
        $this->authenticationTokenService = $authenticationTokenService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $result = $this->authenticationTokenService->createUserToken($request->getAttribute("user"));
            return new ApiResponse(
                $result,
                StatusHttp::OK,
                Apiresponse::SUCCESS
            );
        } catch (CreateTokenException $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        } catch (ExpiredTokenException $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        } catch (BodyException $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        } catch (InvalidTokenException $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        } catch (Exception $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        }
    }
}
