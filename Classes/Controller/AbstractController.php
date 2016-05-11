<?php
namespace N1coode\NjItaros\Controller;

/**
 * Abstract base controller for the extension Tx_NjItaros
 * @author n1coode
 * @package nj_itaros
 */
class AbstractController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
	/**
	 * @var int
	 */
	protected $storagePid;

	/**
	 * @var string
	 */
	protected $nj_ext_key = \N1coode\NjItaros\Utility\Constants::NJ_EXT_KEY;
	
	/**
	 * @var string
	 */
	protected $nj_ext_path = \N1coode\NjItaros\Utility\Constants::NJ_EXT_PATH;
	
	/**
	 * @var string
	 */
	protected $nj_ext_namespace = \N1coode\NjItaros\Utility\Constants::NJ_EXT_NAMESPACE;

	/**
	 * @var string
	 */
	protected $nj_domain_model = '';
	
	/**
	 * @var string
	 */
	protected  $nj_domain = '';
	
	/**
	 * @var array
	 */
	protected $nj_settings = array();
	
	
	/**
	 * @var \N1coode\NjCollection\Domain\Repository\ContentRepository
	 * @inject 
	 */
	protected $contentRepository;
	
	/**
	 * @var \N1coode\NjItaros\Domain\Repository\CorporationRepository
	 * @inject 
	 */
	protected $corporationRepository;
	
	/**
	 * @var \N1coode\NjItaros\Domain\Repository\FeatureRepository
	 * @inject
	 */
	protected $featureRepository;
	
	/**
	 * @var \N1coode\NjItaros\Domain\Repository\ModuleRepository
	 * @inject
	 */
	protected $moduleRepository;
	
	/**
	 * @var \N1coode\NjItaros\Domain\Repository\NewsRepository
	 * @inject
	 */
	protected $newsRepository;
	
	/**
	 * @var \N1coode\NjItaros\Domain\Repository\NewsCategoryRepository
	 * @inject
	 */
	protected $newsCategoryRepository;
	
	/**
	 * @var \N1coode\NjItaros\Domain\Repository\SheetRepository
	 * @inject 
	 */
	protected $sheetRepository;
	
	/**
	 * @var \N1coode\NjItaros\Domain\Repository\ProductRepository
	 * @inject
	 */
	protected $productRepository;

	/**
	 * @var \N1coode\NjItaros\Domain\Repository\SolutionRepository
	 * @inject
	 */
	protected $solutionRepository;
	
	
	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 * @inject
	 */
	protected $configurationManager;
	
	/**
	 * Holds an instance of persistence manager
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * @inject
	 */
	protected $persistenceManager;
	
	
	/**
	 * 
	 * @param string $model
	 * @throws Exception
	 */
	protected function init($model)
	{	
		if($model !== null)
		{
			$this->nj_domain_model = $model;
			$this->nj_domain = strtolower($this->nj_domain_model);
			
			$this->configurationManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManagerInterface');
			
			if(\N1coode\NjCollection\Utility\Configuration::flexformSettingsExists($this->configurationManager))
			{
				\N1coode\NjCollection\Utility\Configuration::settings($this->configurationManager);
			}
			
			$configuration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
			
			$this->settings = $configuration['settings'];
                        
			unset($this->settings['flexform']);
			
		} //end of if model
		else
		{
			throw new \TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException
				('Kein Model angegeben. Überprüfe die Controller-Klasse.',48246892768209576);
		}
		
		if(!isset($this->settings))
			throw new \TYPO3\CMS\Extbase\Configuration\Exception('Please include typoscript to enable the extension.', 48246892768209576 );
		
		if(isset($configuration['persistence']['storagePid']))
			$this->storagePid = intval($configuration['persistence']['storagePid']);		
		
		
		$this->includeJavaScript();
	} 
	
	
	protected function callActionMethod() 
	{
		Try {
			parent::callActionMethod();
		} Catch(Exception $e) {
			$this->response->appendContent($e->getMessage());
		}
	}
	
	
	/**
	 * @param \String $controller
	 * @param \String $action
	 * @param \String $format
	 * @return \TYPO3\CMS\Fluid\View\StandaloneView
	 */
	protected function initViewAjax($controller, $action, $format)
	{
		$view = $this->objectManager->create('TYPO3\CMS\Fluid\View\StandaloneView');
		$view->setFormat($format);
		$view->setTemplatePathAndFilename(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:'.$this->nj_ext_path.'/Resources/Private/Templates/'.$controller.'/'.ucfirst($action).'.'.$format));
		$view->setPartialRootPath(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:'.$this->nj_ext_path.'/Resources/Private/Partials/'));
		$view->setLayoutRootPath(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:'.$this->nj_ext_path.'/Resources/Private/Layouts/'));
		
		return $view;
	}
	
	private function includeJavaScript()
	{
		//   \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->nj_domain);
		//if($this->settings['general']['includeJQuery'])
		//{
			//$GLOBALS['TSFE']->getPageRenderer()
			//	->addJsLibrary(
			//		'jQuery_NjInternship',
			//		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($this->nj_ext_path) . 'Resources/Public/Javascript/Lib/jquery-1.11.3.min.js');
		//}
            if($this->nj_domain === 'internship')
            {
                $GLOBALS['TSFE']->getPageRenderer()
                            ->addJsLibrary(
                                    'jQueryUI_NjInternship',
                                    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($this->nj_ext_path) . 'Resources/Public/Javascript/Lib/jquery-ui-1.11.4/jquery-ui.min.js');
                $GLOBALS['TSFE']->getPageRenderer()->addCssFile(
                    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($this->nj_ext_path) . 'Resources/Public/Javascript/Lib/jquery-ui-1.11.4/jquery-ui.min.css'
                );
            }
                        
                
		$GLOBALS['TSFE']->getPageRenderer()
			->addJsFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($this->nj_ext_path) . 'Resources/Public/Javascript/'.$this->nj_ext_key.'_frontend.js');
		
		if($this->nj_domain == 'testimonial')
		{
			//$GLOBALS['TSFE']->getPageRenderer()
			//	->addJsFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($this->nj_ext_path) . 'Resources/Public/Javascript/Lib/Jssor/jssor.js');
			$GLOBALS['TSFE']->getPageRenderer()
				->addJsFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($this->nj_ext_path) . 'Resources/Public/Javascript/Lib/FlexSlider/2.5.0/jquery.flexslider.min.js');
			//	->addJsFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($this->nj_ext_path) . 'Resources/Public/Javascript/Lib/JC-Slider/jcSlider.js');
			//	->addJsFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($this->nj_ext_path) . 'Resources/Public/Javascript/Lib/Slider/Liquid/jquery.liquid-slider.min.js');
			//	->addJsFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($this->nj_ext_path) . 'Resources/Public/Javascript/Lib/JcSlider/jquery.jcslider.min.js');
			//	->addJsFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($this->nj_ext_path) . 'Resources/Public/Javascript/Lib/Jssor/jssor.slider.min.js');
		}
		
		
		//if($this->nj_domain_model === 'Tour')
		//{
		//	$GLOBALS['TSFE']->getPageRenderer()
		//		->addJsFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($this->nj_ext_path) . 'Resources/Public/Javascript/Lib/form-validator/jquery.form-validator.min.js');
		//}
	}
	
	private function includeCss()
	{
		//TODO
	}

	protected function setExtSettings()
	{
		$extSettings = [];
		$extSettings['key']			= $this->nj_ext_key;
		$extSettings['name']		= strtolower($this->nj_ext_namespace);
		$extSettings['controller']	= $this->nj_domain_model;		
		$extSettings['domain']		= $this->nj_domain;
		$extSettings['action']		= explode('Action',self::getCaller())[0];
		$extSettings['langFile']	= 'LLL:EXT:'.$this->nj_ext_path.'/Resources/Private/Language/locallang.xlf:';
		$extSettings['language']	= $GLOBALS['TSFE']->sys_language_uid;
		
		return $extSettings;
	}
	
	protected function getConfiguration()
	{
		$this->configurationManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManagerInterface');
		return  $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK); 
	}

	protected function getCaller() 
	{
		$trace = debug_backtrace();
		$name = $trace[2]['function'];
		return empty($name) ? 'global' : $name;
	}
	
	
	protected function storagePidIsset()
	{
		if(isset($this->settings['persistence']['storagePid']))
		{
			return true;
		}
		else {
			return false;
		}
	}
	
} //end of class N1coode\NjInternship\Controller\AbstractController
?>