<?php
namespace N1coode\NjItaros\Domain\Repository;

/**
 * @author n1coode
 * @package nj_itaros
 */
class FeatureRepository extends \N1coode\NjItaros\Domain\Repository\AbstractRepository
{
	protected $nj_domain_model = 'Feature';
	
	protected $defaultOrderings = array(
		'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	);
	
	/**
	 * Initializes the repository.
	 * @return void
	 * @see \TYPO3\CMS\Extbase\Persistence\Repository::initializeObject()
	 */
	public function initializeObject() 
	{
		parent::init($this->nj_domain_model);
	}
	
} //end of class \N1coode\NjItaros\Domain\Repository\FeatureRepository
?>