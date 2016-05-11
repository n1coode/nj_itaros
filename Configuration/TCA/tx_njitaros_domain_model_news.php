<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');
use N1coode\NjItaros\Utility\Constants;

$nj_ext_key			= Constants::NJ_EXT_KEY;
$nj_ext_namespace	= Constants::NJ_EXT_NAMESPACE;
$nj_ext_path		= Constants::NJ_EXT_PATH;
$nj_ext_title		= Constants::NJ_EXT_TITLE;

$nj_ext_lang_file			= \N1coode\NjItaros\Utility\Constants::NJ_EXT_LANG_FILE_BACKEND;
$nj_collection_lang_file	= \N1coode\NjCollection\Utility\Constants::NJ_EXT_LANG_FILE_BACKEND;


$nj_domain_model = 'News';
$nj_domain = strtolower($nj_domain_model);

return ['ctrl' => array(
		'title'	=> $nj_ext_lang_file.'model.'.$nj_domain,
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
			'displayCond' => 'USER:N1coode\\NjCollection\\Utility\\Tca->isMultiLingual',
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
		'category' => array(
			'displayCond' => 'FIELD:sys_language_uid:<=:0',
            'l10n_mode' => 'exclude',
            'l10n_display' => 'hideDiff,defaultAsReadonly',
            'exclude' => 0,
            'label'   => $nj_collection_lang_file.'label.general.category',
            'config' => Array (
                'type' => 'select',
                'foreign_table' => $nj_ext_key.'_domain_model_newscategory',
                'foreign_table_where' => 'AND '.$nj_ext_key.'_domain_model_newscategory.pid=###CURRENT_PID### AND '.$nj_ext_key.'_domain_model_newscategory.sys_language_uid=###REC_FIELD_sys_language_uid### ORDER BY '.$nj_ext_key.'_domain_model_newscategory.title',
				'size' => 1,
				'multiple' => 0,
				'minitems' => 1,
				'maxitems' => 1,
			),
		),
		'content' => array(
			'exclude' => 1,
			'label'   => $nj_collection_lang_file.'label.general.content',
			'config'  => array(
				'type' => 'text',
				'cols' => 60,
				'rows' => 6,
			),
			'defaultExtras' => 'richtext[]',
		),
		'highlight' => array(
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.'model.news.highlight',
			'config'  => array(
				'type' => 'check'
			)
		),
		'related_products' => array(
			'displayCond' => 'FIELD:sys_language_uid:<=:0',
            'l10n_mode' => 'exclude',
            'l10n_display' => 'hideDiff,defaultAsReadonly',
            'exclude' => 0,
            'label'   => $nj_ext_lang_file.'label.model.news.relatedProducts',
            'config' => Array (
                'type' => 'select',
                'foreign_table' => $nj_ext_key.'_domain_model_product',
                'foreign_table_where' => 'AND '.$nj_ext_key.'_domain_model_product.pid=###CURRENT_PID### AND '.$nj_ext_key.'_domain_model_product.sys_language_uid=###REC_FIELD_sys_language_uid### ORDER BY '.$nj_ext_key.'_domain_model_product.title',
				'size' => 5,
				'multiple' => 1,
				'maxitems' => 1000,
			),
		),
		'teaser_text' => array(
			'exclude' => 0,
			'label'   => $nj_collection_lang_file.'label.general.teaserText',
			'config'  => array(
				'type' => 'text',
				'cols' => 60,
				'rows' => 6,
			),
		),
		'title' => array(
			'exclude' => 0,
			'label'   => $nj_collection_lang_file.'label.general.title',
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
			'--div--;'.$nj_collection_lang_file.'tab.general.generalSettings,
			 hidden,sys_language_uid;;1,title,category,teaser_text,content,
			 --div--;'.$nj_ext_lang_file.'tab.general.relations,
			 related_products'
		)
	),
	'palettes' => array(
		'1' => array('showitem' => 'l18n_parent'),
	),
   ];