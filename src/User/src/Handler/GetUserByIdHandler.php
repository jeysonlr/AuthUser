<?php

declare(strict_types=1);

namespace User\Handler;

use Exception;
use App\Util\Enum\StatusHttp;
use App\Service\Response\ApiResponse;
use User\Service\User\GetUserService;
use Psr\Http\Message\ResponseInterface;
use User\Exception\UserDatabaseException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use User\Exception\FiltersPaginationException;
use User\Exception\UserRegisterDatabaseException;

class GetUserByIdHandler implements RequestHandlerInterface
{
     /**
     * @var GetUserService
     */
    private $getUserService;

    public function __construct(
        GetUserService $getUserService
    ) {
        $this->getUserService = $getUserService;
    }
    
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        try {
            $result = $this->getUserService
                ->getByIdTccUser(intval($request->getAttribute("idtccusuario")));
            if (!$result) {
                throw new UserRegisterDatabaseException(
                    StatusHttp::FORBIDDEN,
                    "Registro não encontrado!"
                );
            }

            return new ApiResponse(
                $result,
                StatusHttp::OK,
                ApiResponse::SUCCESS
            );
        } catch (FiltersPaginationException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (UserDatabaseException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (UserRegisterDatabaseException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (Exception $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        }
    }
}
