<?php
namespace N1coode\NjItaros\Domain\Model;

/**
 * A module
 * @author n1coode
 * @package nj_itaros
 */
class Solution extends \N1coode\NjItaros\Domain\Model\AbstractProductSolution
{
	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\N1coode\NjItaros\Domain\Model\Product>
	 * @lazy
	 * @cascade remove
	 */
	protected $products;

	
    /* ***************************************************** */

    /**
     * Constructs a new solution
     *
     */
    public function __construct() {

    }

    /* ***************************************************** */
	
	
	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function getProducts()
	{
		return $this->products;
	}
}