<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');
use N1coode\NjItaros\Utility\Constants;

$nj_ext_key			= Constants::NJ_EXT_KEY;
$nj_ext_namespace	= Constants::NJ_EXT_NAMESPACE;
$nj_ext_path		= Constants::NJ_EXT_PATH;
$nj_ext_title		= Constants::NJ_EXT_TITLE;

$nj_lang_file		= 'LLL:EXT:'.$nj_ext_path.'/Resources/Private/Language/locallang_db.xml';

$nj_domain_model = 'Module';
$nj_domain = strtolower($nj_domain_model);

return array(
	'ctrl' => array(
		'title'	=> $nj_lang_file.':model.'.$nj_domain,
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'default_sortby' => 'ORDER BY crdate ASC',
		'sortby' => 'sorting',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden'
		),
		'requestUpdate' => 'sys_language_uid',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($nj_ext_path) . 'Resources/Public/Icons/'.$nj_ext_key.'_domain_model_'.$nj_domain.'.png',
	),
	'interface' => array(
		'showRecordFieldList' => 'title, description',
		'maxDBListItems' => 100,
		'maxSingleDBListItems' => 500,
		'always_description' => 1,
	),
	'feInterface' => array(
		'fe_admin_fieldList' => 'title',
	),
	'columns' => array(
		'crdate' => Array (
            'exclude' => 1,
            'label' => 'Creation date',
            'config' => Array (
                'type' => 'none',
                'format' => 'date',
                'eval' => 'date',
        
            )
        ),  
		'cruser_id' => array(
			'exclude' => 0,
			'label'   => 'cruser',
			'config'  => array(
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'foreign_class' => '\N1coode\NjCollection\Domain\Model\User',
				'maxitems' => 1
			)
		),
		'tstamp' => Array (
			'exclude' => 1,
			'label' => 'Creation date',
			'config' => Array (
				'type' => 'none',
				'format' => 'date',
				'eval' => 'date',
			),
		),
		
		'sys_language_uid' => Array (
			//'displayCond' => 'USER:N1coode\\'.$nj_ext_namespace.'\\Utility\\Tca->isMultiLingual',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'change' => 'reload',
			'config' => Array (
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => Array(
					Array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages',-1),
					Array('LLL:EXT:lang/locallang_general.php:LGL.default_value',0)
				)
			)
		),
		'l18n_parent' => Array (
			//'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array (
				'type' => 'select',
				'multiple' => '1',
				'itemsProcFunc' => 'N1coode\\'.$nj_ext_namespace.'\\Utility\\Tca->getL18nParent',
				'items' => Array (
					Array('', 0),
				),
				'maxitems' => '1',
				'minitems' => '0'
			),
		),
		'l18n_diffsource' => Array(
			'config'=>array(
				'type'=>'passthrough'
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type' => 'check'
			)
		),
		
		'description' => array(
			'exclude' => 1,
			'label'   => $nj_lang_file.':general.description',
			'config'  => array(
				'type' => 'text',
				'cols' => 60,
				'rows' => 6,
			),
			'defaultExtras' => 'richtext[]',
		),
		'title' => array(
			'exclude' => 0,
			'label'   => $nj_lang_file.':general.title',
			'config'  => array(
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim',
				'max'  => 256
			),
		),
	),
	'types' => array(
		'0' => array('showitem' =>
			'--div--;LLL:EXT:'.$nj_lang_path.'locallang_db.xml:general.tab.generalSettings,
			 hidden,sys_language_uid;;1,title,description'
		)
	),
	'palettes' => array(
		'1' => array('showitem' => 'l18n_parent'),
	),
);