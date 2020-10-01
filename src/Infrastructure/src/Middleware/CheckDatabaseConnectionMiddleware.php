<?php

declare(strict_types=1);

namespace Infrastructure\Middleware;

use Exception;
use App\Service\Response\ApiResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Infrastructure\Exception\DatabaseConnectionException;
use Infrastructure\Service\DatabaseConnectionCheckService;

class CheckDatabaseConnectionMiddleware implements MiddlewareInterface
{
    /**
     * @var DatabaseConnectionCheckService
     */
    private $databaseCheckService;

    /**
     * @var array
     */
    private $checkDataBaseConection;

    public function __construct(
        DatabaseConnectionCheckService $databaseCheckService,
        array $checkDataBaseConection
    ) {
        $this->databaseCheckService = $databaseCheckService;
        $this->checkDataBaseConection = $checkDataBaseConection;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $router = $request->getAttribute('Zend\Expressive\Router\RouteResult')->getMatchedRouteName();

            # se rota solicitada consultar banco, verifica se há conexão
            if (isset($this->checkDataBaseConection[$router])) {
                if (in_array('banco', array_unique($this->checkDataBaseConection[$router]))) {
                    if (!$this->databaseCheckService->hasConnection()) {
                        $this->databaseCheckService
                            ->throwException($this->databaseCheckService->hasConnection());
                    }
                }
            }
        } catch (DatabaseConnectionException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (Exception $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        }
        return $handler->handle($request->withAttribute("connection", true));
    }
}
