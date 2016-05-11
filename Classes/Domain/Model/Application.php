<?php
namespace N1coode\NjItaros\Domain\Model;

/**
 * A feature
 * @author n1coode
 * @package nj_itaros
 */
class Application extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
	/**
     * @var string
     */
    protected $email;
	
	/**
     * @var string
     * @validate StringLength(minimum = 3, maximum = 255)
     */
    protected $firstName;
	
	/**
     * @var string
     * @validate StringLength(minimum = 3, maximum = 255)
     */
    protected $lastName;
	
	/**
     * @var int
     */
    protected $salutation;
	
	
	/* ***************************************************** */

    /**
     * Constructs a new main category
     *
     */
    public function __construct() {}
	
	/* ***************************************************** */
	
	
	/**
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
	
	
	/**
     * @param string $firstName
     * @return void
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
	
	
	/**
     * @param int $salutation
     * @return void
     */
    public function setSalutation($salutation)
    {
        $this->salutation = $salutation;
    }

    /**
     * @return int
     */
    public function getSalutation()
    {
        return $this->salutation;
    }
	
	
	/* ***************************************************** */
	
}