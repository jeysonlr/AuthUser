<?php

declare(strict_types=1);

namespace App\Exception\BaseException;

use Exception;
use App\DTO\Response\ResponseError;
use App\Exception\BaseException\BaseExceptionInterface;

class BaseException extends Exception implements BaseExceptionInterface
{
    /**
     * @var null|string
     */
    private $messageError;

    /**
     * @var null|string
     */
    private $internalMessageError;

    /**
     * @var null|int
     */
    private $internalCodeError;

    /**
     * @var array
     */
    private $arrayMessageError = [];

    /**
     * @var int
     */
    private $countError = 0;

    /**
     * @var array
     */
    private $customError = [];

    public function __construct(
        int $statusCode,
        ?string $messageError = null,
        ?string $internalMessageError = null,
        ?int $internalCodeError = null,
        ?array $arrayMessageError = null
    ) {
        $this->messageError = empty($messageError) ? "" : $messageError;
        $this->internalMessageError = $internalMessageError;
        $this->internalCodeError = $internalCodeError;
        $this->arrayMessageError = $arrayMessageError;
        parent::__construct($this->messageError, $statusCode);
    }

    /**
     * Create custom error response
     * @return array
     */
    public function createCustomError(): array
    {
        $this->countError = (!empty($this->arrayMessageError) ? count($this->arrayMessageError) : 0);
        if ($this->countError > 0) {
            foreach (range(1, $this->countError) as $index) {
                array_push($this->customError, $this->errorResponse($this->arrayMessageError[$index - 1]));
            }
            return $this->customError;
        }
        return [$this->errorResponse($this->messageError)];
    }

    /**
     * Create DTO error response
     * @param $messageError
     * @return ResponseError
     */
    public function errorResponse($messageError): ResponseError
    {
        $errorResponse = new ResponseError();
        $errorResponse->setMessageError($messageError);
        $errorResponse->setInternalMessageError($this->internalMessageError);
        $errorResponse->setInternalCodeError($this->internalCodeError);
        return $errorResponse;
    }

    /**
     * @return array
     */
    public function getCustomError(): array
    {
        return $this->createCustomError();
    }

    /**
     * @return string|null
     */
    public function getInternalMessageError(): ?string
    {
        return $this->internalMessageError;
    }

    /**
     * @return int|null
     */
    public function getInternalCodeError(): ?int
    {
        return $this->internalCodeError;
    }

    /**
     * @return array
     */
    public function getArrayMessageError(): array
    {
        return $this->arrayMessageError;
    }
}
