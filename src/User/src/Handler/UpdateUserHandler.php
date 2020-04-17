<?php

declare(strict_types=1);

namespace User\Handler;

use Exception;
use User\Entity\User;
use App\Util\Enum\StatusHttp;
use App\Util\Enum\SuccessMessage;
use App\Service\Response\ApiResponse;
use App\Util\Serialize\SerializeUtil;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use User\Exception\UserDatabaseException;
use User\Service\User\UpdateUserServiceInterface;

class UpdateUserHandler implements RequestHandlerInterface
{
    /**
     * @var UpdateUserServiceInterface
     */
    private $updateUserService;

    /**
     * @var SerializeUtil
     */
    private $serializeUtil;

    public function __construct(
        UpdateUserServiceInterface $updateUserService,
        SerializeUtil $serializeUtil
    ) {
        $this->updateUserService = $updateUserService;
        $this->serializeUtil = $serializeUtil;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $user = $this->serializeUtil->deserialize(
                $request->getBody()->getContents(),
                User::class,
                'json'
            );
            $user->setIdTccUsuario(intval($request->getAttribute('idtccusuario')));
            $this->updateUserService->updateByIdTccUser($user);
    
            return new ApiResponse(
                SuccessMessage::RECORD_CHANGED,
                StatusHttp::CREATED,
                ApiResponse::SUCCESS
            );
        } catch (UserDatabaseException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (Exception $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        }
    }
}
