<?php

namespace Cliente\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Telefonos
 *
 * @ORM\Table(name="telefonos", indexes={@ORM\Index(name="FK_clientes", columns={"cliente_id"}), @ORM\Index(name="FK_telefonos_tipos", columns={"telefono_tipo_id"})})
 * @ORM\Entity
 */
class Telefonos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="telefono_numero", type="integer", nullable=false)
     */
    private $telefonoNumero;

    /**
     * @var \Cliente\Entity\TelefonosTipos
     *
     * @ORM\ManyToOne(targetEntity="Cliente\Entity\TelefonosTipos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="telefono_tipo_id", referencedColumnName="id")
     * })
     */
    private $telefonoTipo;

    /**
     * @var \Cliente\Entity\Clientes
     *
     * @ORM\ManyToOne(targetEntity="Cliente\Entity\Clientes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     * })
     */
    private $cliente;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set telefonoNumero
     *
     * @param integer $telefonoNumero
     * @return Telefonos
     */
    public function setTelefonoNumero($telefonoNumero)
    {
        $this->telefonoNumero = $telefonoNumero;

        return $this;
    }

    /**
     * Get telefonoNumero
     *
     * @return integer 
     */
    public function getTelefonoNumero()
    {
        return $this->telefonoNumero;
    }

    /**
     * Set telefonoTipo
     *
     * @param \Cliente\Entity\TelefonosTipos $telefonoTipo
     * @return Telefonos
     */
    public function setTelefonoTipo(\Cliente\Entity\TelefonosTipos $telefonoTipo = null)
    {
        $this->telefonoTipo = $telefonoTipo;

        return $this;
    }

    /**
     * Get telefonoTipo
     *
     * @return \Cliente\Entity\TelefonosTipos 
     */
    public function getTelefonoTipo()
    {
        return $this->telefonoTipo;
    }

    /**
     * Set cliente
     *
     * @param \Cliente\Entity\Clientes $cliente
     * @return Telefonos
     */
    public function setCliente(\Cliente\Entity\Clientes $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return \Cliente\Entity\Clientes 
     */
    public function getCliente()
    {
        return $this->cliente;
    }
    
}
