<?php

namespace WapiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Book
 *
 * @ORM\Table(name="book")
 * @UniqueEntity(
 *     fields={"iSBN"},
 *     message="This ISBN is already added"
 * )
 * @ORM\Entity(repositoryClass="WapiBundle\Repository\BookRepository")
 */
class Book
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Format must be chosen.")
     * @ORM\ManyToOne(targetEntity="WapiBundle\Entity\Format", inversedBy="books")
     * @ORM\JoinColumn(name="format_id", referencedColumnName="id")
     */
    private $format;

    /**
     * @var string
     * @Assert\NotBlank(message="Title should not be blank.")
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @Assert\NotBlank(message="Author should not be blank.")
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Date Published should not be blank.")
     * @ORM\Column(name="datePublished", type="date")
     */
    private $datePublished;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAdded", type="datetime")
     */
    private $dateAdded;

    /**
     * @var int
     * @Assert\NotBlank(message="Page Count should not be blank.")
     * @Assert\Type(
     *     type="integer",
     *     message="Page Count should be integer."
     * )
     * @ORM\Column(name="pageCount", type="integer")
     */
    private $pageCount;

    /**
     * @var string
     * @Assert\NotBlank(message="ISBN should not be blank")
     * @Assert\Isbn(message="This value is not valid.")
     * @ORM\Column(name="ISBN", type="string", length=100, unique=true)
     */
    private $iSBN;

    /**
     * @var string
     * @Assert\NotBlank(message="Resume should not be blank.")
     * @ORM\Column(name="resume", type="text")
     */
    private $resume;

    /**
     * @Assert\NotBlank(message="Cover must be chosen.")
     * @ORM\Column(name="cover", type="string")
     * @Assert\File(
     *     maxSize="5M",
     *     mimeTypes={ "image/x-icon" ,"image/png","image/jpeg"})
     */
    private $cover;

    /**
     * Get id
     *
     * @return int
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
     * @return Book
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
     * Set author
     *
     * @param string $author
     *
     * @return Book
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set pageCount
     *
     * @param integer $pageCount
     *
     * @return Book
     */
    public function setPageCount($pageCount)
    {
        $this->pageCount = $pageCount;

        return $this;
    }

    /**
     * Get pageCount
     *
     * @return int
     */
    public function getPageCount()
    {
        return $this->pageCount;
    }

    /**
     * Set iSBN
     *
     * @param string $iSBN
     *
     * @return Book
     */
    public function setISBN($iSBN)
    {
        $this->iSBN = $iSBN;

        return $this;
    }

    /**
     * Get iSBN
     *
     * @return string
     */
    public function getISBN()
    {
        return $this->iSBN;
    }

    /**
     * Set datePublished
     *
     * @param \DateTime $datePublished
     *
     * @return Book
     */
    public function setDatePublished($datePublished)
    {
        $this->datePublished = $datePublished;

        return $this;
    }

    /**
     * Get datePublished
     *
     * @return \DateTime
     */
    public function getDatePublished()
    {
        return $this->datePublished;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     *
     * @return Book
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Set resume
     *
     * @param string $resume
     *
     * @return Book
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume
     *
     * @return string
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param mixed $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return mixed
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param mixed $cover
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
    }
}

