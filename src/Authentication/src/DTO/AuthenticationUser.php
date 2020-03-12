<?php

declare(strict_types=1);

namespace Authentication\DTO;

use App\Entity\BaseEntityInterface;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

class AuthenticationUser implements BaseEntityInterface
{
    /**
     * @var string
     * @Type("string")
     * @Assert\NotNull(message="O campo login deve ser preenchido!")
     * @Assert\NotBlank(message="O campo login deve ser preenchido!")
     */
    private $login;

    /**
     * @var string
     * @Type("string")
     * @Assert\NotBlank(message="O campo password deve ser preenchido!")
     */
    private $password;

    /**
     * @return string|null
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
