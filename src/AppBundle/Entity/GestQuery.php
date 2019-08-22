<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Exercice
 * @ORM\Table(name="gest_query")
 * @ORM\Entity
 */
class GestQuery
{
	/**
	 * @var string
	 * @ORM\Column(name="query_id", type="integer", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $queryId;


    /**
     * @var string|null
     * @ORM\Column(name="query_name", type="string", length=100, nullable=true)
     */
    private $queryName;

	/**
	 * @var string|null
	 * @ORM\Column(name="query_body", type="string", length=5000, nullable=true)
	 */
	private $queryBody;


    /**
     * @var \GestConnectionConfig
     *
     * @ORM\ManyToOne(targetEntity="GestConnectionConfig" ,inversedBy="query"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="query_connection", referencedColumnName="connection_id")
     * })
     */
    private $queryConnection;

    public function getQueryId(): ?int
    {
        return $this->queryId;
    }

    public function getQueryName(): ?string
    {
        return $this->queryName;
    }

    public function setQueryName(?string $queryName): self
    {
        $this->queryName = $queryName;

        return $this;
    }

    public function getQueryBody(): ?string
    {
        return $this->queryBody;
    }

    public function setQueryBody(?string $queryBody): self
    {
        $this->queryBody = $queryBody;

        return $this;
    }

    public function getQueryConnection(): ?GestConnectionConfig
    {
        return $this->queryConnection;
    }

    public function setQueryConnection(?GestConnectionConfig $queryConnection): self
    {
        $this->queryConnection = $queryConnection;

        return $this;
    }



}
