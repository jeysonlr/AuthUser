<?php

declare(strict_types=1);

namespace Authentication\Entity;

use App\Entity\BaseEntityInterface;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * tccuser
 *
 * @ORM\Table(name="tccuser")
 * @ORM\Entity(repositoryClass="Authentication\Repository\UserRepository")
 */
class User implements BaseEntityInterface
{
    /**
     * @var int
     * @Type("int")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="tcc_usuario_id_seq", allocationSize=1, initialValue=1)
     * @ORM\Column(name="idtccusuario", type="integer")
     */
    private $idtccusuario;

    /**
     * @var string
     * @Type("string")
     * @ORM\Column(name="tccnome", type="text")
     * @Assert\NotBlank(message="O campo nome é obrigatório!")
     */
    private $tccnome;

    /**
     * @var string
     * @Type("string")
     * @ORM\Column(name="tcclogin", type="text")
     * @Assert\NotBlank(message="O campo login é obrigatório!")
     */
    private $tcclogin;

    /**
     * @var string
     * @Type("string")
     * @ORM\Column(name="tccemail", type="text")
     * @Assert\NotBlank(message="O campo email é obrigatório!")
     */
    private $tccemail;

    /**
     * @var string
     * @Type("string")
     * @ORM\Column(name="tccsenha", type="text")
     * @Assert\NotBlank(message="O campo senha é obrigatório!")
     */
    private $tccsenha;

    /**
     * Get the value of idtccusuario
     *
     * @return  int
     */
    public function getIdTccUsuario()
    {
        return $this->idtccusuario;
    }

    /**
     * Set the value of idtccusuario
     *
     * @param  int  $idtccusuario
     *
     * @return  self
     */
    public function setIdTccUsuario(int $idtccusuario)
    {
        $this->idtccusuario = $idtccusuario;

        return $this;
    }

    /**
     * Get the value of tccnome
     *
     * @return  string
     */ 
    public function getTccNome()
    {
        return $this->tccnome;
    }

    /**
     * Set the value of tccnome
     *
     * @param  string  $tccnome
     *
     * @return  self
     */ 
    public function setTccNome(string $tccnome)
    {
        $this->tccnome = $tccnome;

        return $this;
    }

    /**
     * Get the value of tcclogin
     *
     * @return  string
     */ 
    public function getTccLogin()
    {
        return $this->tcclogin;
    }

    /**
     * Set the value of tcclogin
     *
     * @param  string  $tcclogin
     *
     * @return  self
     */ 
    public function setTccLogin(string $tcclogin)
    {
        $this->tcclogin = $tcclogin;

        return $this;
    }

    /**
     * Get the value of tccemail
     *
     * @return  string
     */ 
    public function getTccEmail()
    {
        return $this->tccemail;
    }

    /**
     * Set the value of tccemail
     *
     * @param  string  $tccemail
     *
     * @return  self
     */ 
    public function setTccEmail(string $tccemail)
    {
        $this->tccemail = $tccemail;

        return $this;
    }

    /**
     * Get the value of tccsenha
     *
     * @return  string
     */ 
    public function getTccSenha()
    {
        return $this->tccsenha;
    }

    /**
     * Set the value of tccsenha
     *
     * @param  string  $tccsenha
     *
     * @return  self
     */ 
    public function setTccSenha(string $tccsenha)
    {
        $this->tccsenha = $tccsenha;

        return $this;
    }
}
