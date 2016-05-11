<?php
namespace N1coode\NjItaros\Controller;

/**
 * @author n1coode
 * @package nj_itaros
 */
class MenuController extends \N1coode\NjItaros\Controller\AbstractController
{
	const SHOW_PRODUCTS	= 'products';
	const SHOW_SOLUTIONS = 'solutions';
	
	/**
	 * Initializes the controller before invoking an action method.
	 *
	 * @return void
	 */
	protected function initializeAction()
	{
		parent::init('Menu');
	}
	
	public function teaserAction()
	{
		//$this->productRepository->initializeObject();
		//$this->solutionRepository->initializeObject();
		
		$assignValues = [];
		$assignValues['ext'] = parent::setExtSettings();
		
		$assignValues['products'] = $this->productRepository->findAll();
		$assignValues['solutions'] = $this->solutionRepository->findAll();
		
		$this->view->assignMultiple($assignValues);
	}
	
	
	/**
	 * @return void
	 */
	public function listAction()
	{
		$assignValues = [];
		$extSettings = parent::setExtSettings();
		
		$extSettings['show'] = $this->settings['general']['menu']['show'];
	
		switch($this->settings['general']['menu']['show'])
		{
			case self::SHOW_PRODUCTS:
				
				$menuitemsTmp = $this->productRepository->findAll();
				$menuitems = [];
				foreach($menuitemsTmp as $item)
				{
					$item->setMenuArguments(["object" => $item]);
					$menuitems[] = $item;
				}
				break;
			case self::SHOW_SOLUTIONS:
				$menuitemsTmp = $this->solutionRepository->findAll();
				$menuitems = [];
				foreach($menuitemsTmp as $item)
				{
					$item->setMenuArguments(["object" => $item]);
					$menuitems[] = $item;
				}
				break;
			default:;
		}
		$assignValues['ext'] = $extSettings;
		$assignValues['menuitems'] = $menuitems;
		
		if(!empty($this->request->getArguments()))
		{
			if($this->request->hasArgument('object')) 
			{
				$assignValues['active'] = $this->request->getArgument('object');
			}
		}
		$link['controller']	= ucfirst(substr($extSettings['show'],0,-1));
		$link['pageUid'] = $this->settings['model'][substr($extSettings['show'],0,-1)]['pid']['focus']; 
		$assignValues['link'] = $link;
		

		$this->view->assignMultiple($assignValues);
	}
	

	private function setMenuArguments()
	{
		
	}
	
} //end of class \N1coode\NjItaros\Controller\MenuController