<?php

declare(strict_types=1);

namespace Authentication\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\BaseEntityInterface;
use JMS\Serializer\Annotation\Type;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * gazin.pco_usuario
 *
 * @ORM\Table(name="gazin.pco_usuario")
 * @ORM\Entity(repositoryClass="Authentication\Repository\UserRepository")
 */

class PcoUserEntity implements BaseEntityInterface
{
    /**
     * @var int
     * @Type("int")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="gazin.pco_usuario_id_seq", allocationSize=1, initialValue=1)
     * @ORM\Column(name="idpcousuario", type="integer", nullable=false)
     */
    private $idpcousuario;

    /**
     * @var string
     * @Type("string")
     * @ORM\Column(name="nomeusuario", type="text", nullable=false)
     * @Assert\NotBlank(message="O nome de usuário é obrigatório!")
     */
    private $nomeusuario;

    /**
     * @var string
     * @Type("string")
     * @ORM\Column(name="login", type="text", nullable=false)
     * @Assert\NotNull(message="Login é obrigatório!")
     */
    private $login;

    /**
     * @var string
     * @Type("string")
     * @ORM\Column(name="senha", type="text", nullable=false)
     * @Assert\NotBlank(message="Senha é obrigatória!")
     */
    private $senha;

    /**
     * @var string
     * @Type("string")
     * @ORM\Column(name="email", type="text", nullable=false)
     * @Assert\NotBlank(message="O email é obrigatório!")
     */
    private $email;

    /**
     * @var bool
     * @Type("boolean")
     * @ORM\Column(name="status", type="boolean", nullable=false)
     * @Assert\NotBlank(message="O status de usuário é obrigatório!")
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity="Authentication\Entity\PcoShopkeeperEntity", cascade={"refresh"}, fetch="LAZY")
     * @ORM\JoinTable(name="gazin.pco_usuario_lojista",
     * joinColumns={@ORM\JoinColumn(name="idpcousuario", referencedColumnName="idpcousuario")},
     * inverseJoinColumns={@ORM\JoinColumn(name="idpcolojista", referencedColumnName="idpcolojista")}
     * )
     */
    private $lojista;

    public function __construct()
    {
        $this->lojista = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getIdpcousuario(): ?int
    {
        return $this->idpcousuario;
    }

    /**
     * @param int $idpcousuario
     */
    public function setIdpcousuario(?int $idpcousuario): void
    {
        $this->idpcousuario = $idpcousuario;
    }

    /**
     * @return string
     */
    public function getNomeusuario(): string
    {
        return $this->nomeusuario;
    }

    /**
     * @param string $nomeusuario
     */
    public function setNomeusuario(string $nomeusuario): void
    {
        $this->nomeusuario = $nomeusuario;
    }

    /**
     * @return string
     */
    public function getLogin(): string
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
     * @return string
     */
    public function getSenha(): string
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     */
    public function setSenha(string $senha): void
    {
        $this->senha = $senha;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $statususuario
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    /**
     * Get joinColumns={@ORM\JoinColumn(name="idpcousuario", referencedColumnName="idpcousuario")},
     */
    public function getLojista()
    {
        return $this->lojista;
    }

    /**
     * Set joinColumns={@ORM\JoinColumn(name="idpcousuario", referencedColumnName="idpcousuario")},
     *
     * @return  self
     */
    public function setLojista($lojista)
    {
        return $this->lojista = $lojista;
    }
}
