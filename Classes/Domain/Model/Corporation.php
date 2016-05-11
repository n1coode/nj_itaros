<?php
namespace N1coode\NjItaros\Domain\Model;

/**
 * A corporation
 * @author n1coode
 * @package nj_itaros
 */
class Corporation extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
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
	 * @var int
	 */
	protected $logoType;
	
	/**
     * @var string
     */
    protected $name;
	
	
	
	/* ***************************************************** */

	/**
	 * Constructs a new artist
	 * @return AbstractObject
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
     * @param int $logoType
     * @return void
     */
    public function setLogoType($logoType)
    {
        $this->logoType = $logoType;
    }

    /**
     * @return int
     */
    public function getLogoType()
    {
		return $this->logoType;
    }
	
	
	/**
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
		return $this->name;
    }
}