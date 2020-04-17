<?php

declare(strict_types=1);

namespace Authentication\Middleware\Login;

use Exception;
use App\Util\Enum\StatusHttp;
use App\Util\Enum\ErrorMessage;
use App\Service\Response\ApiResponse;
use App\Util\Serialize\SerializeUtil;
use App\Exception\DeserializeException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use App\Util\Validation\ValidationService;
use Authentication\DTO\AuthenticationUser;
use Authentication\Exception\BodyException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Authentication\Service\User\GetUserService;
use Authentication\Exception\UserNotFoundException;
use Authentication\Util\CheckUser\CreateValidatePassword;
use Authentication\Exception\UserValidationStatusException;
use App\Util\Validation\CheckConstraints\Exception\BaseEntityViolationsException;

class ValidationLoginMiddleware implements MiddlewareInterface
{
    /**
     * @var SerializeUtil
     */
    private $jms;

    /**
     * @var ValidationService
     */
    private $validationService;

    /**
     * @var GetUserService
     */
    private $getUserService;

    /**
     * @var CreateValidatePassword
     */
    private $validatePassword;

    public function __construct(
        SerializeUtil $jms,
        ValidationService $validationService,
        GetUserService $getUserService,
        CreateValidatePassword $validatePassword
    ) {
        $this->jms = $jms;
        $this->validationService = $validationService;
        $this->getUserService = $getUserService;
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
            try {
                $user = $this->jms->deserialize(
                    $request->getBody()->getContents(),
                    AuthenticationUser::class,
                    "json"
                );
            } catch (Exception $e) {
                throw new DeserializeException(
                    StatusHttp::BAD_REQUEST,
                    ErrorMessage::ERROR_DESERIALIZATION . "o usuário!",
                    $e->getMessage()
                );
            }

            $this->validationService->validateEntity($user);

            $userSearch = $this->getUserService->getOneUserByLogin($user->getLogin());
            if (!$userSearch) {
                throw new UserNotFoundException(
                    StatusHttp::NOT_FOUND,
                    ErrorMessage::ERROR_USER_NOT_FOUND
                );
            }
            $this->validatePassword->validatePassword($user->getPassword(), $userSearch->getTccSenha());
        } catch (DeserializeException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (BaseEntityViolationsException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (UserNotFoundException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (BodyException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (UserValidationStatusException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (Exception $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        }
        return $handler->handle($request->withAttribute("user", $userSearch));
    }
}
