<?php

declare(strict_types=1);

namespace App\Service\Response;

use Zend\Diactoros\Response;
use Zend\Diactoros\Stream;
use App\DTO\Pagination\RequestFilters;
use App\DTO\Response\ResponseData;
use JMS\Serializer\SerializationContext;
use App\DTO\Response\ResponseError;
use Zend\Diactoros\Response\InjectContentTypeTrait;
use App\Util\Serialize\SerializeUtil;

class ApiResponse extends Response
{
    use InjectContentTypeTrait;

    /**
     * @var mixed
     */
    private $container;

    /**
     * @var SerializeUtil
     */
    private $jms;

    public const SUCCESS = 0;
    public const ERROR = 1;

    public function __construct($data, ?int $status, int $type = 0, RequestFilters $params = null)
    {
        $status = (empty($status) || $status < 100) ? 500 : $status;
        $headers = [];
        $this->container = require 'config/container.php';
        $this->jms = $this->container->get(SerializeUtil::class);
        $headers = $this->injectContentType('application/json', $headers);
        parent::__construct($this->createResponse($data, $status, $params, $type), $status, $headers);
    }

    /**
     * Cria a resposta para o client-side
     *
     * @param $data
     * @param int $status
     * @param RequestFilters|null $params
     * @param int $type
     * @return Stream
     * @throws \Exception
     */
    private function createResponse($data, int $status, RequestFilters $params = null, int $type = 0): Stream
    {
        $responseData = new ResponseData();
        $responseData->setStatusCode($status);
        $responseData->setParams($params);

        if ($type == self::SUCCESS) {
            $responseData->setData($data);
        } else {
            if (!is_array($data)) {
                $error = new ResponseError();
                $error->setMessageError("Ocorreu um erro inesperado na aplicação!");
                $error->setInternalMessageError($data);
                $error->setInternalCodeError(-1);
                $data = [$error];
            }
            $responseData->setError($data);
        }

        $context = new SerializationContext();
        $context->setSerializeNull(true);

        $body = new Stream('php://temp', 'wb+');
        $body->write($this->jms->serialize($responseData, 'json', $context));
        $body->rewind();
        return $body;
    }
}
