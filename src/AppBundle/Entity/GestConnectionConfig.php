<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Exercice
 * @ORM\Table(name="gest_connection_config")
 * @ORM\Entity
 */
class GestConnectionConfig
{
	/**
	 * @var string
	 * @ORM\Column(name="connection_id", type="integer", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $connectionId;


    /**
     * @var string|null
     * @ORM\Column(name="connection_name", type="string", length=100, nullable=true)
     */
    private $connectionName;

	/**
	 * @var string|null
	 * @ORM\Column(name="connection_driver", type="string", length=100, nullable=true)
	 */
	private $connectionDriver;

    /**
     * @var string|null
     * @ORM\Column(name="connection_dbuser", type="string", length=200, nullable=true)
     */
    private $connectionDbuser;

    /**
     * @var string|null
     * @ORM\Column(name="connection_dbpassword", type="string", length=200, nullable=true)
     */
    private $connectionDbbpassword;

    /**
     * @var string|null
     * @ORM\Column(name="connection_dbname", type="string", length=200, nullable=true)
     */
    private $connectionDbname;

    /**
     * @var string|null
     * @ORM\Column(name="connection_host", type="string", length=200, nullable=true)
     */
    private $connectionHost;


    /**
     * @var \GestModule
     *
     * @ORM\ManyToOne(targetEntity="GestModule" ,inversedBy="connection"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="connection_module", referencedColumnName="module_id")
     * })
     */
    private $connectionModule;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="GestQuery", mappedBy="queryConnection")
     *
     */
    private $query;

    public function __construct()
    {
        $this->query = new ArrayCollection();
    }



    public function getConnectionId(): ?int
    {
        return $this->connectionId;
    }

    public function getConnectionDriver(): ?string
    {
        return $this->connectionDriver;
    }

    public function setConnectionDriver(?string $connectionDriver): self
    {
        $this->connectionDriver = $connectionDriver;

        return $this;
    }

    public function getConnectionDbuser(): ?string
    {
        return $this->connectionDbuser;
    }

    public function setConnectionDbuser(?string $connectionDbuser): self
    {
        $this->connectionDbuser = $connectionDbuser;

        return $this;
    }

    public function getConnectionDbbpassword(): ?string
    {
        return $this->connectionDbbpassword;
    }

    public function setConnectionDbbpassword(?string $connectionDbbpassword): self
    {
        $this->connectionDbbpassword = $connectionDbbpassword;

        return $this;
    }

    public function getConnectionDbname(): ?string
    {
        return $this->connectionDbname;
    }

    public function setConnectionDbname(?string $connectionDbname): self
    {
        $this->connectionDbname = $connectionDbname;

        return $this;
    }

    public function getConnectionHost(): ?string
    {
        return $this->connectionHost;
    }

    public function setConnectionHost(?string $connectionHost): self
    {
        $this->connectionHost = $connectionHost;

        return $this;
    }

    public function getConnectionName(): ?string
    {
        return $this->connectionName;
    }

    public function setConnectionName(?string $connectionName): self
    {
        $this->connectionName = $connectionName;

        return $this;
    }

    public function getConnectionModule(): ?GestModule
    {
        return $this->connectionModule;
    }

    public function setConnectionModule(?GestModule $connectionModule): self
    {
        $this->connectionModule = $connectionModule;

        return $this;
    }

    /**
     * @return Collection|GestQuery[]
     */
    public function getQuery(): Collection
    {
        return $this->query;
    }

    public function addQuery(GestQuery $query): self
    {
        if (!$this->query->contains($query)) {
            $this->query[] = $query;
            $query->setQueryConnection($this);
        }

        return $this;
    }

    public function removeQuery(GestQuery $query): self
    {
        if ($this->query->contains($query)) {
            $this->query->removeElement($query);
            // set the owning side to null (unless already changed)
            if ($query->getQueryConnection() === $this) {
                $query->setQueryConnection(null);
            }
        }

        return $this;
    }


}
