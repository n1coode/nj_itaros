<?php
namespace N1coode\NjItaros\Controller;

/**
 * @author n1coode
 * @package nj_itaros
 */
class FeatureController extends \N1coode\NjItaros\Controller\AbstractController
{
	/**
	 * Initializes the controller before invoking an action method.
	 *
	 * @return void
	 */
	protected function initializeAction()
	{
		parent::init('Feature');
	}
	
	
	/**
	 * @param \N1coode\NjItaros\Domain\Model\Product $object
	 * @return void
	 */
	public function highlightAction()
	{
		$this->featureRepository->initializeObject();
		$assignValues = [];
		$assignValues['ext'] = parent::setExtSettings();

		$features = $this->featureRepository->findByHighlight(1);
		$assignValues['features'] = $features;

		$this->view->assignMultiple($assignValues);
	}
	
} //end of class