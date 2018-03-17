<?php

namespace SysvetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Length(
     *      min = 10,
     *      max = 30,
     *      minMessage = "O nome deve ter pelo menos {{ limit }} caracteres",
     *      maxMessage = "O nome deve ter no máximo {{ limit }} caracteres"
     * )
     *  @Assert\NotBlank(
     *  message = "O nome não pode ficar vazio"
     * )
     */
    private $nomeServico;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(
     * message = "A descrição não pode ficar vazia"
     * )
     */
    private $descricaoServico;

    /**
     * @ORM\Column(type="decimal", scale=2)
     * @Assert\NotBlank(
     * message = "O preço não pode ficar vazio"
     * )
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
