<?php

declare(strict_types=1);

namespace Authentication\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\BaseEntityInterface;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * gazin.pco_lojista
 *
 * @ORM\Table(schema="gazin", name="pco_lojista")
 * @ORM\Entity(repositoryClass="Authentication\Repository\ShopkeeperRepository")
 */
class PcoShopkeeperEntity implements BaseEntityInterface
{
    /**
     * @var int
     * @Type("int")
     * @ORM\Id
     * @ORM\Column(name="idpcolojista", type="integer", nullable=false)
     */
    public $idpcolojista;

    /**
     * @var bool
     * @Type("bool")
     * @ORM\Column(name="situacao", type="boolean", nullable=false)
     */
    public $situacao;

    /**
     * @return int
     */
    public function getIdpcolojista(): int
    {
        return $this->idpcolojista;
    }

    /**
     * @param int $idpcolojista
     */
    public function setIdpcolojista(int $idpcolojista): void
    {
        $this->idpcolojista = $idpcolojista;
    }

    /**
     * @return bool
     */
    public function isSituacao(): bool
    {
        return $this->situacao;
    }

    /**
     * @param bool $situacao
     */
    public function setSituacao(bool $situacao): void
    {
        $this->situacao = $situacao;
    }
}
