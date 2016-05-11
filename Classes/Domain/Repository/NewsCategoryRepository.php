<?php
namespace N1coode\NjItaros\Domain\Repository;

/**
 * @author n1coode
 * @package nj_itaros
 */
class NewsCategoryRepository extends \N1coode\NjItaros\Domain\Repository\AbstractRepository
{
	protected $nj_domain_model = 'NewsCategory';
	
	protected $defaultOrderings = ['crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];
	
	/**
	 * Initializes the repository.
	 * @return void
	 * @see \TYPO3\CMS\Extbase\Persistence\Repository::initializeObject()
	 */
	public function initializeObject() 
	{
		parent::init($this->nj_domain_model);
	}
	
} //end of class
?>