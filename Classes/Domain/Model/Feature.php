<?php
namespace N1coode\NjItaros\Domain\Model;

/**
 * A feature
 * @author n1coode
 * @package nj_itaros
 */
class Feature extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
	/**
	 * @var int
	 */
	protected $highlight;

	/**
	 * @var string
	 */
	protected $icon;

	/**
     * @var string
     * @validate StringLength(minimum = 3, maximum = 255)
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
     * @param int $highlight
     * @return void
     */
    public function setHighlight($highlight)
    {
        $this->highlight = $highlight;
    }

    /**
     * @return int
     */
    public function getHighlight()
    {
        return $this->highlight;
    }
	
	
	/**
     * @param int $icon
     * @return void
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
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

