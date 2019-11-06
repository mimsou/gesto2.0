<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestQuery
 *
 * @ORM\Table(name="gest_query", indexes={@ORM\Index(name="IDX_E3FA290BE260ACE6", columns={"query_connection"})})
 * @ORM\Entity
 */
class GestQuery
{
    /**
     * @var int
     *
     * @ORM\Column(name="query_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $queryId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="query_name", type="string", length=100, nullable=true)
     */
    private $queryName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="query_body", type="string", length=5000, nullable=true)
     */
    private $queryBody;

    /**
     * @var \GestConnectionConfig
     *
     * @ORM\ManyToOne(targetEntity="GestConnectionConfig")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="query_connection", referencedColumnName="connection_id")
     * })
     */
    private $queryConnection;


}
