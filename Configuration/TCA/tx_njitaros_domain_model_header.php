<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');
use N1coode\NjItaros\Utility\Constants;

$nj_ext_key			= \N1coode\NjItaros\Utility\Constants::NJ_EXT_KEY;
$nj_ext_namespace	= \N1coode\NjItaros\Utility\Constants::NJ_EXT_NAMESPACE;
$nj_ext_path 		= \N1coode\NjItaros\Utility\Constants::NJ_EXT_PATH;
$nj_ext_title 		= \N1coode\NjItaros\Utility\Constants::NJ_EXT_TITLE;

$nj_ext_lang_file			= \N1coode\NjItaros\Utility\Constants::NJ_EXT_LANG_FILE_BACKEND;
$nj_collection_lang_file	= 'LLL:EXT:nj_collection/Resources/Private/Language/locallang_db.xlf:';

$nj_domain_model = 'Header';
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
		'default_sortby' => 'ORDER BY title ASC',
		//'sortby' => 'sorting',
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
        'maxSingleDBListItems' => 500
    ),
    'feInterface' => array(
        'fe_admin_fieldList' => 'title',
    ),
    'columns' => array(
        'tstamp' => Array (
            'exclude' => 1,
            'label' => 'Creation date',
            'config' => Array (
                'type' => 'none',
                'format' => 'date',
                'eval' => 'date',
            )
        ),
        'sys_language_uid' => Array (
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
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
            'config' => array (
                'type' => 'select',
                'multiple' => '1',
                'itemsProcFunc' => 'N1coode\\NjCollection\\Utility\\Tca->getL18nParent',
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
            
        'title' => array(
            'exclude' => 0,
            'label'   => $nj_lang_file.':general.title',
            'config'  => array(
                'type' => 'input',
                'size' => 40,
                'eval' => 'trim,unique,required',
                'max'  => 256
            )
        ),
        'description' => array(
            'exclude' => 1,
            'label'   => $nj_lang_file.':general.description',
            'defaultExtras' => 'richtext[*]',
            'config'  => array(
                'type' => 'text',
                'cols' => 60,
                'rows' => 6,
                'wizards' => array(
                    '_PADDING' => 4,
                    'RTE' => array(
                        'notNewRecords'	=> 1,
                        'RTEonly'	=> 1,
                        'type' 		=> 'script',
                        'title' 	=> 'LLL:EXT:cms/locallang_ttc.php:bodytext.W.RTE',
                        'icon' 		=> 'wizard_rte2.gif',
                        'script' 	=> 'wizard_rte.php'
                    )
                )
            )
        ),
		'image' => array(
			//'displayCond' => 'FIELD:sys_language_uid:<=:0',
			'exclude' => 0,
			'label' => $nj_ext_lang_file.'label.general.image',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('image', array(
				'appearance' => array(
					'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
				),
				'minitems' => 0,
				'maxitems' => 1,
			),
			$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
		),
	),
    'types' => array(
        '0' => array('showitem' => 'hidden,sys_language_uid;;1,title,description,image' )
    ),
    'palettes' => array(
        '1' => array('showitem' => 'l18n_parent'),
    ),
);
?>