<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Cliente
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $nome;

    /**
     *
     * @var Plano @ORM\ManyToOne(targetEntity="Plano")
     *      @ORM\JoinColumn(name="plano_id", referencedColumnName="id")
     *     
     */
    protected $plano;

    /**
     * @ORM\Column(type="string")
     */
    protected $foto;

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getPlano()
    {
        return $this->plano;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function setPlano(Plano $plano = null)
    {
        $this->plano = $plano;
        return $this;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
        return $this;
    }
}