<?php

declare(strict_types=1);

namespace App\DTO\Response;

use JMS\Serializer\Annotation\Type;

class ResponseError
{
    /**
     * @var null|string
     * @Type("string")
     */
    private $messageerror;

    /**
     * @var null|string
     * @Type("string")
     */
    private $internalmessageerror;

    /**
     * @var null|int
     * @Type("int")
     */
    private $internalcodeerror;

    /**
     * @return mixed
     */
    public function getMessageError()
    {
        return $this->messageerror;
    }

    /**
     * @param mixed $messageerror
     */
    public function setMessageError($messageerror): void
    {
        $this->messageerror = $messageerror;
    }

    /**
     * @return string|null
     */
    public function getInternalMessageError(): ?string
    {
        return $this->internalmessageerror;
    }

    /**
     * @param string|null $internalmessageerror
     */
    public function setInternalMessageError(?string $internalmessageerror): void
    {
        $this->internalmessageerror = $internalmessageerror;
    }

    /**
     * @return int|null
     */
    public function getInternalCodeError(): ?int
    {
        return $this->internalcodeerror;
    }

    /**
     * @param int|null $internalcodeerror
     */
    public function setInternalCodeError(?int $internalcodeerror): void
    {
        $this->internalcodeerror = $internalcodeerror;
    }
}
