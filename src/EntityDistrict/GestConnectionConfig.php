<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestConnectionConfig
 *
 * @ORM\Table(name="gest_connection_config", indexes={@ORM\Index(name="IDX_541FB095B7E9ABE2", columns={"connection_module"})})
 * @ORM\Entity
 */
class GestConnectionConfig
{
    /**
     * @var int
     *
     * @ORM\Column(name="connection_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $connectionId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="connection_driver", type="string", length=100, nullable=true)
     */
    private $connectionDriver;

    /**
     * @var string|null
     *
     * @ORM\Column(name="connection_dbuser", type="string", length=200, nullable=true)
     */
    private $connectionDbuser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="connection_dbpassword", type="string", length=200, nullable=true)
     */
    private $connectionDbpassword;

    /**
     * @var string|null
     *
     * @ORM\Column(name="connection_dbname", type="string", length=200, nullable=true)
     */
    private $connectionDbname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="connection_host", type="string", length=200, nullable=true)
     */
    private $connectionHost;

    /**
     * @var string|null
     *
     * @ORM\Column(name="connection_name", type="string", length=100, nullable=true)
     */
    private $connectionName;

    /**
     * @var \GestModule
     *
     * @ORM\ManyToOne(targetEntity="GestModule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="connection_module", referencedColumnName="module_id")
     * })
     */
    private $connectionModule;


}
