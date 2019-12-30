<?php

declare(strict_types=1);

namespace User\Middleware\User;

use Exception;
use User\Entity\User;
use App\Util\Enum\StatusHttp;
use App\Util\Enum\ErrorMessage;
use App\Service\Response\ApiResponse;
use App\Util\Serialize\SerializeUtil;
use Psr\Http\Message\ResponseInterface;
use User\Exception\ExistEmailException;
use User\Exception\ExistLoginException;
use Psr\Http\Server\MiddlewareInterface;
use User\Exception\DeserializeException;
use User\Exception\EmailInvalidException;
use User\Exception\LoginInvalidException;
use App\Util\Validation\ValidationService;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use User\Exception\InvalidPasswordException;
use User\Service\User\GetUserServiceInterface;
use User\Service\Validation\ValidationInsertUserServiceInterface;
use App\Util\Validation\CheckConstraints\Exception\BaseEntityViolationsException;

class InsertUserMiddleware implements MiddlewareInterface
{
    /**
     * @var SerializeUtil
     */
    private $serializeUtil;

    /**
     * @var ValidationInsertUserServiceInterface
     */
    private $validationUserService;

    /**
     * @var ValidationService
     */
    private $validationEntity;

    public function __construct(
        SerializeUtil $serializeUtil,
        ValidationInsertUserServiceInterface $validationUserService,
        ValidationService $validationEntity
    ) {
        $this->serializeUtil = $serializeUtil;
        $this->validationUserService = $validationUserService;
        $this->validationEntity = $validationEntity;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $user = $this->serializeUtil->deserialize(
                $request->getBody()->getContents(),
                User::class,
                'json'
            );
            $this->validationEntity->validateEntity($user);

            $this->validationUserService->formatLoginValid(strtolower($user->getTccLogin()));

            $this->validationUserService->formatEmailIsValid(strval($user->getTccEmail()));

            $this->validationUserService->existLogin(strtolower($user->getTccLogin()));

            $this->validationUserService->existEmail(strval($user->getTccEmail()));

            $this->validationUserService->formatPasswordValid(strval($user->getTccSenha()));

        } catch (DeserializeException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (BaseEntityViolationsException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (ExistEmailException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (ExistLoginException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (EmailInvalidException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (LoginInvalidException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (InvalidPasswordException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (Exception $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        }
        return $handler->handle($request->withAttribute('user', $user));
    }
}
