<?php

namespace mehun\EngContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PageEng
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PageEng
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var string
     * @ORM\Column(name="abstract", type="string", length=255)
     */
    private $abstract;

    /**
     * @var string
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="CategoryEng", inversedBy="pages")
     * @ORM\JoinColumn (name="category_id", referencedColumnName="id")
     */
    private $category;


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
     * Set title
     *
     * @param string $title
     *
     * @return PageEng
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return PageEng
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }


    /**
     * Set category
     *
     * @param \mehun\EngContentBundle\Entity\CategoryEng $category
     *
     * @return PageEng
     */
    public function setCategory(\mehun\EngContentBundle\Entity\CategoryEng $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \mehun\EngContentBundle\Entity\CategoryEng
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return PageEng
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set abstract
     *
     * @param string $abstract
     *
     * @return PageEng
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get abstract
     *
     * @return string
     */
    public function getAbstract()
    {
        return $this->abstract;
    }
}
