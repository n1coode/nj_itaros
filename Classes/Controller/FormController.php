<?php
namespace N1coode\NjItaros\Controller;

/**
 * @author n1coode
 * @package nj_itaros
 */
class FormController extends \N1coode\NjItaros\Controller\AbstractController
{	
	const FORM_IDENTIFIER_APPLICATION = 'application';
	
	/**
	 * Initializes the controller before invoking an action method.
	 *
	 * @return void
	 */
	protected function initializeAction()
	{
		parent::init('Form');
	}
	
	/**
	 * @return void
	 */
	public function applicationAction()
	{
		$assignValues = [];
		$extSettings = parent::setExtSettings();
		
		if($this->request->hasArgument('submitApplicationData'))
		{
			$applicationData = $this->request->getArguments();
			$assignValues['applicationData'] = $applicationData;
			
			$errors = $this->checkFormData($this->FORM_IDENTIFIER_APPLICATION);
			if(!empty($errors)) 
			{
				$assignValues['errors'] = $errors;
			}
		}
		
		
		$assignValues['ext'] = $extSettings;
		$this->view->assignMultiple($assignValues);
	}
	
	/**
	 * @return void
	 */
	public function contactAction()
	{
		$assignValues = [];
		$extSettings = parent::setExtSettings();
		
		$assignValues['ext'] = $extSettings;
		$this->view->assignMultiple($assignValues);
	}
	
	/**
	 * @return void
	 */
	public function infomailAction()
	{
		$assignValues = [];
		$extSettings = parent::setExtSettings();
		
		$assignValues['ext'] = $extSettings;
		$this->view->assignMultiple($assignValues);
	}
	
	/**
	 * @return void
	 */
	public function supportAction()
	{
		$assignValues = [];
		$extSettings = parent::setExtSettings();
		
		$assignValues['ext'] = $extSettings;
		$this->view->assignMultiple($assignValues);
	}

	/**
	 * @param string form
	 * @return array errors
	 */
	protected function checkFormData($form)
	{
		$errors = array();

		if($form === $this->FORM_IDENTIFIER_APPLICATION)
		{
			if(empty($this->request->getArgument("lastName")) || $this->request->getArgument("lastName") == '')
			{
				$errors['lastName'] = 'missing';
			}
			if(empty($this->request->getArgument("firstName")) || $this->request->getArgument("firstName") == '')
			{
				$errors['firstName'] = 'missing';
			}
		

			if(empty($this->request->getArgument("email")) || $this->request->getArgument("email") == '')
			{
				$errors['email'] = 'missing';
			}
			elseif(!\TYPO3\CMS\Core\Utility\GeneralUtility::validEmail($this->request->getArgument('email')))
			{
				$errors['email'] = 'wrongFormat';
			}

		} //end of if($form === $this->FORM_IDENTIFIER_REGISTRATION)

		return $errors;
	
	} //end of function checkFormData
	
	
} //end of class N1coode\NjItaros\Controller\FormController