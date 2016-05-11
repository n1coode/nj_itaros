<?php
namespace N1coode\NjItaros\Domain\Model;

/**
 * A sheet (for a caroussel for example)
 * @author n1coode
 * @package nj_itaros
 */
class Sheet extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
	/**
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $image;
	
	/**
     * @var string
     */
    protected $title;
	
	/**
     * @var string
     */
    protected $subtitle;
	
	
	/* ***************************************************** */

	/**
	 * Constructs a new teaser
	 * @return AbstractObject
	 */
	public function __construct() {

	}
	
	/* ***************************************************** */
	
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
     * @param string $subtitle
     * @return void
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @return string
     */
    public function getSubtitle()
    {
		return $this->subtitle;
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
}