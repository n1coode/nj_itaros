<?php
namespace N1coode\NjItaros\Controller;

/**
 * @author n1coode
 * @package nj_itaros
 */
class ApplicationController extends \N1coode\NjItaros\Controller\AbstractController
{
	/**
	 * Initializes the controller before invoking an action method.
	 * @return void
	 */
	protected function initializeAction()
	{
		parent::init('Application');
	}
	
}