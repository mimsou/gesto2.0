<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GestCustomCode
 * @ORM\Table(name="gest_custom_code")
 * @ORM\Entity
 */
class GestCustomCode
{
	/**
	 * @var integer
	 * @ORM\Column(name="custom_code_id", type="integer", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $customCodeId;


    /**
     * @var string|null
     * @ORM\Column(name="custom_code_content", type="string", length=10000000, nullable=true)
     */
    private $customCodeContent;

      /**
     * @var \GestActions
     *
     * @ORM\ManyToOne(targetEntity="GestActions" ,inversedBy="actionCustomCode")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="custom_code_action", referencedColumnName="action_id"  )
     * })
     */
    private $customCodeAction;

    public function getCustomCodeId(): ?int
    {
        return $this->customCodeId;
    }

    public function getCustomCodeContent(): ?string
    {
        return $this->customCodeContent;
    }

    public function setCustomCodeContent(?string $customCodeContent): self
    {
        $this->customCodeContent = $customCodeContent;

        return $this;
    }

    public function getCustomCodeAction(): ?GestActions
    {
        return $this->customCodeAction;
    }

    public function setCustomCodeAction(?GestActions $customCodeAction): self
    {
        $this->customCodeAction = $customCodeAction;

        return $this;
    }

    

}