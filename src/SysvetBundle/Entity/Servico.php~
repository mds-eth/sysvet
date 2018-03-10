<?php

namespace SysvetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="servicos")
 */
class Servico {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idServico;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomeServico;

    /**
     * @ORM\Column(type="text")
     */
    private $descricaoServico;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $precoServico;

    public function __toString() {

        return $this->nomeServico . ' -> ' . $this->precoServico;
    }

    /**
     * Get idServico
     *
     * @return integer
     */
    public function getIdServico() {
        return $this->idServico;
    }

    /**
     * Set nomeServico
     *
     * @param string $nomeServico
     *
     * @return Servico
     */
    public function setNomeServico($nomeServico) {
        $this->nomeServico = $nomeServico;

        return $this;
    }

    /**
     * Get nomeServico
     *
     * @return string
     */
    public function getNomeServico() {
        return $this->nomeServico;
    }

    /**
     * Set descricaoServico
     *
     * @param string $descricaoServico
     *
     * @return Servico
     */
    public function setDescricaoServico($descricaoServico) {
        $this->descricaoServico = $descricaoServico;

        return $this;
    }

    /**
     * Get descricaoServico
     *
     * @return string
     */
    public function getDescricaoServico() {
        return $this->descricaoServico;
    }

    /**
     * Set precoServico
     *
     * @param string $precoServico
     *
     * @return Servico
     */
    public function setPrecoServico($precoServico) {
        $this->precoServico = $precoServico;

        return $this;
    }

    /**
     * Get precoServico
     *
     * @return string
     */
    public function getPrecoServico() {
        return $this->precoServico;
    }

}
