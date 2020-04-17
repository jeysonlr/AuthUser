<?php

declare(strict_types=1);

namespace Authentication\Middleware\Authorization;

use Exception;
use App\Service\Response\ApiResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Authentication\Exception\ExpiredTokenException;
use Authentication\Exception\InvalidTokenException;
use Authentication\Exception\NotFoundTokenException;
use Authentication\Middleware\Token\AuthenticationTokenMiddleware;
class AuthorizationUserMiddleware implements MiddlewareInterface
{
    /**
     * @var AuthenticationTokenMiddleware
     */
    private $authenticationTokenMiddleware;
    /**
     * @var array
     */
    private $routes;
    
    public function __construct(
        AuthenticationTokenMiddleware $authenticationTokenMiddleware,
        $routes
    ) {
        $this->routes = $routes;
        $this->authenticationTokenMiddleware = $authenticationTokenMiddleware;
    }
    
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {

            $router = $request->getAttribute('Zend\Expressive\Router\RouteResult')->getMatchedRouteName();
          
                if ($this->routes['login'][0] !== $router) {
                    
                    $accessallowed = [];
                    foreach ($this->routes['accessallowed'] as $route => $value) {
                      
                        if ($value == $router) {    
                            array_push($accessallowed, $value);
                        }

                    }

                    $accessdenied = [];
                    foreach ($this->routes['accessdenied'] as $route => $value) {
                      
                        if ($value == $router) {    
                            array_push($accessdenied, $value);
                        }
                    }

                    if ($accessdenied) {
                        return $this->authenticationTokenMiddleware->process($request, $handler); 
                    }   

                    if (!$accessdenied && !$accessallowed){
                        throw new Exception("Rota não registrada!", 404);
                    }

                }
         
        } catch (NotFoundTokenException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (InvalidTokenException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (ExpiredTokenException $e) {
            return new ApiResponse($e->getCustomError(), $e->getCode(), ApiResponse::ERROR);
        } catch (Exception $e) {
            return new ApiResponse($e->getMessage(), $e->getCode(), ApiResponse::ERROR);
        }
        return $handler->handle($request);
    }
}
