<?php
namespace N1coode\NjItaros\Controller;

/**
 * @author n1coode
 * @package nj_itaros
 */
class ProductController extends \N1coode\NjItaros\Controller\AbstractController
{
	/**
	 * Initializes the controller before invoking an action method.
	 *
	 * @return void
	 */
	protected function initializeAction()
	{
		parent::init('Product');
	}
	
	
	/**
	 * @param \N1coode\NjItaros\Domain\Model\Product $object
	 * @return void
	 */
	public function focusAction(\N1coode\NjItaros\Domain\Model\Product $object = NULL)
	{
		$this->productRepository->initializeObject();
		
		if($object !== NULL)
		{
			$assignValues = [];
			$assignValues['ext'] = parent::setExtSettings();
			$assignValues['object'] = $object;
			$this->view->assignMultiple($assignValues);
		}
	}
	
	
	public function headerAction()
	{
		$assignValues = [];
		$assignValues['ext'] = parent::setExtSettings();
		$this->view->assignMultiple($assignValues);
	}
	
	
	/**
	 * @return void
	 */
	public function listAction()
	{
		$assignValues = [];
		$assignValues['ext'] = parent::setExtSettings();
		
		$products = $this->productRepository->findAll();
		$assignValues['items'] = $products;
		
		$this->view->assignMultiple($assignValues);
	}
	
	
	public function listFeaturesAction()
	{
		$assignValues = [];
		if(isset($this->settings['model'][$this->nj_domain]['uid']))
		{
			$product = $this->productRepository->findByUid(intval($this->settings['model'][$this->nj_domain]['uid']));
			if(is_object($product)) $assignValues['features'] = $product->getFeatures();
		}
		
		$this->view->assignMultiple($assignValues);
	}
	
} //end of class