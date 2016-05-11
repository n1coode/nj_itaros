<?php
namespace N1coode\NjItaros\Domain\Repository;

/**
 * @author n1coode
 * @package nj_itaros
 */
class AbstractRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
	protected $nj_ext_key		= \N1coode\NjItaros\Utility\Constants::NJ_EXT_KEY;
	protected $nj_ext_listtype	= \N1coode\NjItaros\Utility\Constants::NJ_EXT_LISTTYPE;
	
	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 * @inject
	 */
	protected $configurationManager;
	
	
	protected $defaultOrderings = array(
            'crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
	);

	/**
	 * @param string $model
	 * @throws Exception
	 */
	protected function init($model)
	{
		$this->configurationManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManagerInterface');
	
		if(\N1coode\NjCollection\Utility\Configuration::flexformSettingsExists($this->configurationManager))
		{
			\N1coode\NjCollection\Utility\Configuration::settings($this->configurationManager);
		}

		$configuration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);

		$this->settings = $configuration['settings'];

		unset($this->settings['flexform']);
		
		
		$querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
		$querySettings->setRespectStoragePage(TRUE);
		$querySettings->setStoragePageIds(array($configuration['persistence']['storagePid']));
		$querySettings->setRespectSysLanguage(TRUE);
		$this->setDefaultQuerySettings($querySettings);
	}
	
	
	public function findFlexformDataByUid($uid)
	{
		$query = $this->createQuery();
		$query->getQuerySettings()->setReturnRawQueryResult(TRUE);
		$query->statement('SELECT pi_flexform from tt_content where list_type="'.$this->nj_ext_listtype.'" and uid = ' . $uid);
		$pages = $query->execute();
	
		$xml = simplexml_load_string($pages[0]['pi_flexform']);
		$flexformData = array();
		$flexformData['uid'] = $uid;
	
		foreach ($xml->data->sheet->language->field as $field) 
		{
			$flexformData[str_replace('settings.','',(string)$field->attributes())] = (string)$field->value;
		}
		
		return $flexformData;
	} //end of findFlexformDataByUid($uid)
	
	
	protected function getConfiguration()
	{
		$this->configurationManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManagerInterface');
		return  $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
	}
	
	
	/**
	 * @param int $uid
	 * @return int
	 */
	private function getStoragePid($uid)
	{
		$storagePid;
	
		$configuration = $this->getConfiguration();
		
		if(!empty($configuration['persistence']['storagePid']))
			$storagePid = $configuration['persistence']['storagePid'];
	
		$flexformData = array();
		
		if(!empty($uid))
		{
			$flexformData = $this->findFlexformDataByUid($uid);
		}
		if(!empty($flexformData) && $flexformData['flexform.general.typoScript'] < 1)
		{
			$storagePid = $flexformData['flexform.persistence.storagePid'];
		}
		
		return $storagePid;
	}
	
	
	/**
	 * @param int $uid
	 * @return void
	 */
	function setQuerySettings($uid)
	{
		$storagePid = $this->getStoragePid($uid);
		
		$querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
		$querySettings->setRespectStoragePage(TRUE);
		$querySettings->setStoragePageIds(array($storagePid));
		$querySettings->setRespectSysLanguage(FALSE);
		$this->setDefaultQuerySettings($querySettings);
	}
	
} //end of class N1coode\NjItaros\Domain\Repository\AbstractRepository
?>