<?php

declare(strict_types=1);

namespace Authentication\DTO;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

class UserDTO
{
    /**
     * @var int
     * @Type("int")
     */
    private $idpcousuario;

    /**
     * @var int
     * @Type("int")
     */
    private $idpcolojista;

    /**
     * @var string
     * @Type("string")
     * @Assert\NotBlank(message="Nome é obrigatório!")
     * @Assert\NotNull(message="Nome não pode ser nulo!")
     */
    private $nomeusuario;

    /**
     * @var string
     * @Type("string")
     * @Assert\NotBlank(message="Login é obrigatório!")
     * @Assert\NotNull(message="Login não pode ser nulo!")
     */
    private $login;

    /**
     * @var string
     * @Type("string")
     */
    private $senha;

    /**
     * @var string
     * @Type("string")
     * @Assert\NotBlank(message="E-mail é obrigatório!")
     * @Assert\NotNull(message="E-mail não pode ser nulo!")
     */
    private $email;

    /**
     * @var bool
     * @Type("bool")
     * @Assert\NotNull(message="Status não pode ser nulo!")
     */
    private $status;

    /**
     * Get the value of idpcousuario
     *
     * @return  int
     */
    public function getIdpcousuario()
    {
        return $this->idpcousuario;
    }

    /**
     * Set the value of idpcousuario
     *
     * @param  int  $idpcousuario
     *
     * @return  self
     */
    public function setIdpcousuario(int $idpcousuario)
    {
        $this->idpcousuario = $idpcousuario;

        return $this;
    }

    /**
     * Get the value of idpcolojista
     *
     * @return  int
     */
    public function getIdpcolojista()
    {
        return $this->idpcolojista;
    }

    /**
     * Set the value of idpcolojista
     *
     * @param  int  $idpcolojista
     *
     * @return  self
     */
    public function setIdpcolojista(int $idpcolojista)
    {
        $this->idpcolojista = $idpcolojista;

        return $this;
    }

    /**
     * Get the value of nomeusuario
     *
     * @return  string
     */
    public function getNomeusuario()
    {
        return $this->nomeusuario;
    }

    /**
     * setNomeusuario
     *
     * @param  mixed $nomeusuario
     *
     * @return void
     */
    public function setNomeusuario(?string $nomeusuario)
    {
        $this->nomeusuario = $nomeusuario;

        return $this;
    }

    /**
     * Get the value of login
     *
     * @return  string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @param  string  $login
     *
     * @return  self
     */
    public function setLogin(string $login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of senha
     *
     * @return  string
     */
    public function getSenha(): ?string
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @param  string  $senha
     *
     * @return  self
     */
    public function setSenha(?string $senha): void
    {
        $this->senha = $senha;
    }

    /**
     * Get the value of email
     *
     * @return  string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     * @return  self
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of status
     *
     * @return  bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  bool  $status
     *
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }
}
