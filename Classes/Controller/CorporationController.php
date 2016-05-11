<?php
namespace N1coode\NjItaros\Controller;

/**
 * @author n1coode
 * @package nj_itaros
 */
class CorporationController extends \N1coode\NjItaros\Controller\AbstractController
{
	/**
     * Initializes the controller before invoking an action method.
     *
     * @return void
     */
    protected function initializeAction()
    {
        parent::init('Corporation');
    }
	
	
	public function listAction()
	{
		$assignValues = [];
		$extSettings = parent::setExtSettings();
		
		if(isset($this->settings['model']['corporation']['uids']) && $this->settings['model']['corporation']['uids'] != '')
		{
			$corporations = [];
			$uids = explode(',', $this->settings['model']['corporation']['uids']);
			foreach($uids as $uid)
			{
				$corporations[] = $this->corporationRepository->findByUid($uid);
			}
			$assignValues['corporations'] = $corporations;
		}

		$assignValues['ext'] = $extSettings;
		$this->view->assignMultiple($assignValues);
	}
	
} //end of class N1coode\NjItaros\Controller\CorporationController