<?php
namespace N1coode\NjItaros\Domain\Model;

/**
 * A header
 * @author n1coode
 * @package nj_itaros
 */
class Header extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
	/**
     * @var string
     */
    protected $description;
	
	/**
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $image;
	
	/**
     * @var string
     * @validate StringLength(minimum = 2, maximum = 255)
     */
    protected $title;
	

    /* ***************************************************** */

    /**
     * Constructs a new main category
     *
     */
    public function __construct() {

    }

    /* ***************************************************** */
	
	
	/**
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
		return $this->description;
    }
	
	
	/**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getImage()
    {
        return $this->image;
    }
	
	
	/**
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
	
	
	
} //end of class