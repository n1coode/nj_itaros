<?php
namespace N1coode\NjItaros\Domain\Model;

/**
 * A news
 * @author n1coode
 * @package nj_itaros
 */
class News extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
	/**
	 * @var \N1coode\NjItaros\Domain\Model\NewsCategory
	 */
	protected $category;
	
	/**
     * @var string
     * @validate StringLength(minimum = 3, maximum = 255)
     */
    protected $content;
	
	/**
	 * @var int 
	 */
	protected $crdate;
	
	/**
	 * @var string
	 */
	protected $teaserText;
	
	/**
     * @var string
     * @validate StringLength(minimum = 3, maximum = 255)
     */
    protected $title;
	
    /* ***************************************************** */

    /**
     * Constructs a new news
     *
     */
    public function __construct() {

    }

    /* ***************************************************** */
	
	
	/**
     * @return \N1coode\NjItaros\Domain\Model\NewsCategory
     */
    public function getCategory()
    {
        return $this->category;
    }
	
	/**
     * @param string $content
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
	
	
	/**
     * @param int $crdate
     * @return void
     */
    public function setCrdate($crdate)
    {
        $this->crdate = $crdate;
    }

    /**
     * @return int
     */
    public function getCrdate()
    {
        return $this->crdate;
    }
	
	
	/**
     * @param string $teaserText
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
    public function getTitle()
    {
        return $this->title;
    }
	
} //end of class
?>