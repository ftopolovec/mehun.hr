<?php

namespace mehun\EngContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * CategoryEng
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CategoryEng
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="PageEng", mappedBy="category")
     */
    private $pages;

    public function __construct(){
        $this->pages = new ArrayCollection();
    }

    public  function  __toString() {
        return $this->name;
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return CategoryEng
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add page
     *
     * @param \mehun\EngContentBundle\Entity\PageEng $page
     *
     * @return CategoryEng
     */
    public function addPage(\mehun\EngContentBundle\Entity\PageEng $page)
    {
        $this->pages[] = $page;

        return $this;
    }

    /**
     * Remove page
     *
     * @param \mehun\EngContentBundle\Entity\PageEng $page
     */
    public function removePage(\mehun\EngContentBundle\Entity\PageEng $page)
    {
        $this->pages->removeElement($page);
    }

    /**
     * Get pages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPages()
    {
        return $this->pages;
    }
}
