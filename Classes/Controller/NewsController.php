<?php
namespace N1coode\NjItaros\Controller;

/**
 * @author n1coode
 * @package nj_itaros
 */
class NewsController extends \N1coode\NjItaros\Controller\AbstractController
{	
	/**
	 * Initializes the controller before invoking an action method.
	 *
	 * @return void
	 */
	protected function initializeAction()
	{
		parent::init('News');
	}
	
	
	/**
	 * @return void
	 */
	public function focusAction()
	{
		$assignValues = [];
		$extSettings = parent::setExtSettings();
		
		$this->view->assignMultiple($assignValues);
	}
	
	
	/**
	 * @return void
	 */
	public function listAction()
	{
		$this->newsCategoryRepository->initializeObject();
		$this->newsRepository->initializeObject();
		
		$assignValues = [];
		$extSettings = parent::setExtSettings();
		
		$assignValues['ext'] = $extSettings;

		if(isset($this->settings['model'][$this->nj_domain][$extSettings['action']]['category']))
		{
			$categoryUid = $this->settings['model'][$this->nj_domain][$extSettings['action']]['category'];
			$category = $this->newsCategoryRepository->findByUid($categoryUid);
			if(is_object($category))
			{
				$assignValues['category'] = $category;
				$news = $this->newsRepository->findByCategory($category);
				if(is_object($news))
				{
					$assignValues['news'] = $news;
				}
			}
			
		}
		else
		{
			//TODO
		}
		
		$this->view->assignMultiple($assignValues);
	}
	
	
} //end of class
?>

