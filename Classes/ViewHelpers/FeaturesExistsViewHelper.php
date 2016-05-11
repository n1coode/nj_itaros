<?php
namespace N1coode\NjItaros\ViewHelpers;

/**
 * @author n1coode
 * @package nj_itaros
 */
class FeaturesExistsViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
	/**
	 * @param \N1coode\NjItaros\Domain\Model\Product|\N1coode\NjItaros\Domain\Model\Solution $object
	 * @return bool
	 */
	public function render($object = NULL)
	{	
		
		$productsExists = false;
		$featuresExists = false;
		$showFeatures = false;
		
		
		if($object !== NULL)
		{
			if($object instanceof \N1coode\NjItaros\Domain\Model\Solution)
			{
				if(count($object->getProducts()) > 0)
				{
					$productsExists = true;
				}
			}
			if(count($object->getFeatures()) > 0)
			{
				$featuresExists = true;
			}
			
			if($productsExists || $featuresExists){ $showFeatures = true; }
		}
		
		return $showFeatures;
	}
} 