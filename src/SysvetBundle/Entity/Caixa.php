<?php

namespace SysvetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="caixa")
 */
class Caixa {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $numero;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $total;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data;

    /**
     * @ORM\Column(type="text")
     */
    private $itens;


    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set total
     *
     * @param string $total
     *
     * @return Caixa
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     *
     * @return Caixa
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set itens
     *
     * @param string $itens
     *
     * @return Caixa
     */
    public function setItens($itens)
    {
        $this->itens = $itens;

        return $this;
    }

    /**
     * Get itens
     *
     * @return string
     */
    public function getItens()
    {
        return $this->itens;
    }
}
