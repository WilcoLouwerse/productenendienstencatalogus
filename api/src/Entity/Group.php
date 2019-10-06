<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\GroupRepository")
 * @ORM\Table(name="productorservicegroup")
 */
class Group
{
	/**
	 * @var \Ramsey\Uuid\UuidInterface
	 *
	 * @ApiProperty(
	 * 	   identifier=true,
	 *     attributes={
	 *         "swagger_context"={
	 *         	   "description" = "The UUID identifier of this object",
	 *             "type"="string",
	 *             "format"="uuid",
	 *             "example"="e2984465-190a-4562-829e-a8cca81aa35d"
	 *         }
	 *     }
	 * )
	 *
	 * @Groups({"read"})
	 * @ORM\Id
	 * @ORM\Column(type="uuid", unique=true)
	 * @ORM\GeneratedValue(strategy="CUSTOM")
	 * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
	 */
	private $id;
		
	/**
	 * @var string $name The name of this product group
	 * @example My Group
	 *
	 * @ApiProperty(
	 * 	   iri="http://schema.org/name",
	 *     attributes={
	 *         "swagger_context"={
	 *         	   "description" = "The name of this product group",
	 *             "type"="string",
	 *             "example"="My Group",
	 *             "maxLength"="255",
	 *             "required" = true
	 *         }
	 *     }
	 * )
	 *
	 * @Assert\NotNull
	 * @Assert\Length(
	 *      max = 255
	 * )
	 * @Groups({"read"})
	 * @ORM\Column(type="string", length=255)
	 */
	private $name;
	
	/**
	 * @var string $description An short description of this product group
	 * @example This is the best group ever
	 *
	 * @ApiProperty(
	 * 	   iri="https://schema.org/description",
	 *     attributes={
	 *         "swagger_context"={
	 *         	   "description" = "An short description of this product group",
	 *             "type"="string",
	 *             "example"="This is the best group ever",
	 *             "maxLength"="2550"
	 *         }
	 *     }
	 * )
	 *
	 * @Assert\Length(
	 *      max = 2550
	 * )
	 * @Groups({"read"})
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $description;
	
	/**
	 * @var string $logo The logo for this component
	 * @example https://www.my-organisation.com/logo.png
	 *
	 * @ApiProperty(
	 * 	   iri="https://schema.org/logo",
	 *     attributes={
	 *         "swagger_context"={
	 *         	   "description" = "The logo for this component",
	 *             "type"="string",
	 *             "format"="url",
	 *             "example"="https://www.my-organisation.com/logo.png",
	 *             "maxLength"=255
	 *         }
	 *     }
	 * )
	 *
	 * @Assert\Url
	 * @Assert\Length(
	 *      max = 255
	 * )
	 * @Groups({"read"})
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $logo;

    /**
     * @var ArrayCollection $products The groups that are a part of this product group
     * 
     * @Groups({"read","write"})
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", inversedBy="groups")
     */
    private $products;     
    
    /**
     * @var string $sourceOrganisation The RSIN of the organisation that ownes this group
     * @example 002851234
     *
     * @ApiProperty(
     *     attributes={
     *         "swagger_context"={
     *         	   "description" = "The RSIN of the organisation that ownes this group",
     *             "type"="string",
     *             "example"="002851234",
     *              "maxLength"="255",
	 *             "required" = true
     *         }
     *     }
     * )
     *
     * @Assert\NotNull
     * @Assert\Length(
     *      min = 8,
     *      max = 11
     * )
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     * @ApiFilter(SearchFilter::class, strategy="exact")
     */
    private $sourceOrganisation;

    /**
     * @var Catalogus $catalogus The Catalogus that this product group belongs to
     * 
     * @MaxDepth(1)
     * @Groups({"read", "write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Catalogus", inversedBy="groups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $catalogus;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->services = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
    
    public function getLogo(): ?string
    {
        return $this->logo;
    }
    
    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;
        
        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
        }

        return $this;
    }
    
    public function getSourceOrganisation(): ?string
    {
    	return $this->sourceOrganisation;
    }
    
    public function setSourceOrganisation(string $sourceOrganisation): self
    {
    	$this->sourceOrganisation = $sourceOrganisation;
    	
    	return $this;
    }

    public function getCatalogus(): ?Catalogus
    {
        return $this->catalogus;
    }

    public function setCatalogus(?Catalogus $catalogus): self
    {
        $this->catalogus = $catalogus;

        return $this;
    }
}