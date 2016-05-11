<?php
namespace N1coode\NjItaros\Controller;

/**
 * @author n1coode
 * @package nj_itaros
 */
class CarouselController extends \N1coode\NjItaros\Controller\AbstractController
{		
	const _MODEL = 'carousel';
	
	/**
	 * Initializes the controller before invoking an action method.
	 *
	 * @return void
	 */
	protected function initializeAction()
	{
		parent::init(\ucfirst($this::_MODEL));
	}

	
	public function headerAction()
	{
		$assignValues = [];
		$extSettings = parent::setExtSettings();
		$extSettings['maxWidth'] = 1240;
		$extSettings['maxHeight'] = 420;
		
		if(isset($this->settings['model'][$this::_MODEL]['sheets']) && $this->settings['model'][$this::_MODEL]['sheets'] != '')
		{
			$sheets = [];
			$uids = explode(',', $this->settings['model'][$this::_MODEL]['sheets']);
			foreach($uids as $uid)
			{
				$sheets[] = $this->sheetRepository->findByUid($uid);
			}
			$assignValues['sheets'] = $sheets;
		}
		
		$assignValues['ext'] = $extSettings;
		$this->view->assignMultiple($assignValues);
	}
} //end of class N1coode\NjItaros\Controller\CarouselController