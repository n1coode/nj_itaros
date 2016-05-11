<?php
namespace N1coode\NjItaros\Domain\Model;

/**
 * Abstract Model
 * @author n1coode
 * @package nj_itaros
 */
class AbstractProductSolution extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
	/**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\N1coode\NjCollection\Domain\Model\Content>
     */
    protected $content;
	
	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\N1coode\NjItaros\Domain\Model\Feature>
	 * @lazy
	 * @cascade remove
	 */
	protected $features;
	
	/**
	 * @var array 
	 */
	protected $menuArguments;
	
	/**
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $teaserImage;
	
	/**
	 * @var string 
	 */
	protected $teaserText;
	
	/**
     * @var string
     * @validate StringLength(minimum = 2, maximum = 255)
     */
    protected $title;
	
	/**
     * @var string
     * @validate StringLength(minimum = 2, maximum = 255)
     */
    protected $titleDisplay;

    /* ***************************************************** */

    public function __construct() {

    }

    /* ***************************************************** */
	
	
	/**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\N1coode\NjCollection\Domain\Model\Content> $content
     */
    public function getContent() 
	{
        return $this->content;        
    }
	
	
	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function getFeatures()
	{
		return $this->features;
	}
	
	
	/**
	 * @return array
	 */
	public function getMenuArguments()
	{
		return $this->menuArguments;
	}
	
	/**
	 * @param array $menuArguments
	 * @return void
	 */
	public function setMenuArguments($menuArguments)
	{
		$this->menuArguments = $menuArguments;
	}
	
	
	/**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $teaserImage
     * @return void
     */
    public function setTeaserImage($teaserImage)
    {
        $this->teaserImage = $teaserImage;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getTeaserImage()
    {
        return $this->teaserImage;
    }
	
	
	/**
     * @param string
     * @return void
     */
    public function setTeaserText($teaserText)
    {
        $this->teaserText = $teaserText;
    }

    /**
     * @return string
     */
    public function getTeaserText()
    {
        return $this->teaserText;
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
    public function getTitleDisplay()
    {
        return $this->titleDisplay;
    }
	
	/**
     * @param string $titleDisplay
     * @return void
     */
    public function setTitleDisplay($titleDisplay)
    {
        $this->titleDisplay = $titleDisplay;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
	
} //end of class