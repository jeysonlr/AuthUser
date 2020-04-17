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
use User\Service\User\InsertUserService;
use User\Exception\UserDatabaseException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class InsertUserHandler implements RequestHandlerInterface
{
    /**
     * @var InsertUserService
     */
    private $insertUserService;

    /**
     * @var SerializeUtil
     */
    private $serializeUtil;

    public function __construct(
        InsertUserService $insertUserService,
        SerializeUtil $serializeUtil
    ) {
        $this->insertUserService = $insertUserService;
        $this->serializeUtil = $serializeUtil;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            // $user = $this->serializeUtil->deserialize(
            //     $request->getBody()->getContents(),
            //     User::class,
            //     'json'
            // );

            $this->insertUserService->insertUser(
                $request->getAttribute('user')
            );

            return new ApiResponse(
                SuccessMessage::SAVED_RECORD,
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
