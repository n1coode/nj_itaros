<?php
namespace N1coode\NjItaros\Domain\Model;

/**
 * A module
 * @author n1coode
 * @package nj_itaros
 */
class Module extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
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

