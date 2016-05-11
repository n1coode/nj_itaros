<?php
namespace N1coode\NjItaros\Domain\Repository;

/**
 * @author n1coode
 * @package nj_itaros
 */
class SheetRepository extends \N1coode\NjCollection\Domain\Repository\AbstractRepository
{
	protected $defaultOrderings = array(
		'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	);
	
} //end of class N1coode\NjItaros\Domain\Repository\SheetRepository