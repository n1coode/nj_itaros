<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');
use N1coode\NjItaros\Utility\Constants;

$nj_ext_key			= Constants::NJ_EXT_KEY;
$nj_ext_namespace	= Constants::NJ_EXT_NAMESPACE;
$nj_ext_path		= Constants::NJ_EXT_PATH;
$nj_ext_title		= Constants::NJ_EXT_TITLE;

$nj_lang_file				= 'LLL:EXT:'.$nj_ext_path.'/Resources/Private/Language/locallang_db.xlf:';
$nj_collection_lang_file	= 'LLL:EXT:nj_collection/Resources/Private/Language/locallang_db.xlf:';

$nj_domain_model = 'Solution';
$nj_domain = strtolower($nj_domain_model);


return array(
	'ctrl' => array(
        'title' => $nj_lang_file.'model.'.$nj_domain,
        'label' => 'title',
        //'l10n_mode' => 'mergeIfNotBlank',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
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
        'requestUpdate' => 'sys_language_uid,payment',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($nj_ext_path) . 'Resources/Public/Icons/' . $nj_ext_key . '_domain_model_' . $nj_domain . '.png',
    ),
	'interface' => array(
        'showRecordFieldList' => 'title, direction',
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
		'content' => Array(
			'exclude' => 0,
			'label' => $nj_collection_lang_file.'label.general.content',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_njcollection_domain_model_content',
				'foreign_field' => 'foreign_uid',
				'foreign_table_field' => 'foreign_table',
				'foreign_sortby' => 'sorting',
				'maxitems' => 99,
				'appearance' => Array(
					'collapseAll' => 1,
					'expandSingle' => 1,
					'useSortable' => 1,
					'enabledControls' => array(
						'sort' => true,
					)
				),
			),
		),
        'description' => array(
            'exclude' => 1,
            'label'   => $nj_collection_lang_file.'label.general.description',
            'defaultExtras' => 'richtext[*]',
            'config'  => array(
				'type' => 'text',
				'cols' => 60,
				'rows' => 6,
				'defaultExtras' => 'richtext[]',
			)
        ),
        'features' => Array (
            'displayCond' => 'FIELD:sys_language_uid:<=:0',
            'l10n_mode' => 'exclude',
            'l10n_display' => 'hideDiff,defaultAsReadonly',
            'exclude' => 0,
            'label'   => $nj_lang_file.'label.general.features',
            'config' => Array (
                'type' => 'select',
                'foreign_table' => $nj_ext_key.'_domain_model_feature',
                'foreign_table_where' => 'AND '.$nj_ext_key.'_domain_model_feature.pid=###CURRENT_PID### AND '.$nj_ext_key.'_domain_model_feature.sys_language_uid=###REC_FIELD_sys_language_uid### ORDER BY '.$nj_ext_key.'_domain_model_feature.title',
				'size' => 10,
				'multiple' => 1,
				'maxitems' => 1000,
			),
        ),
		'products' => Array (
            'displayCond' => 'FIELD:sys_language_uid:<=:0',
            'l10n_mode' => 'exclude',
            'l10n_display' => 'hideDiff,defaultAsReadonly',
            'exclude' => 0,
            'label'   => $nj_lang_file.'label.general.products',
            'config' => Array (
                'type' => 'select',
                'foreign_table' => $nj_ext_key.'_domain_model_product',
                'foreign_table_where' => 'AND '.$nj_ext_key.'_domain_model_product.pid=###CURRENT_PID### AND '.$nj_ext_key.'_domain_model_product.sys_language_uid=###REC_FIELD_sys_language_uid### ORDER BY '.$nj_ext_key.'_domain_model_product.title_display',
				'size' => 10,
				'multiple' => 1,
				'maxitems' => 1000,
				'label' => $nj_ext_key.'_domain_model_product.title_display',
			),
        ),
		'teaser_image' => array(
			//'displayCond' => 'FIELD:sys_language_uid:<=:0',
			'exclude' => 0,
			'label' => $nj_ext_lang_file.'label.general.teaserImage',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('image', array(
				'appearance' => array(
					'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
				),
				'minitems' => 0,
				'maxitems' => 1,
			),
			$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
		),
		'teaser_text' => array(
            'exclude' => 1,
            'label'   => $nj_ext_lang_file.'label.general.teaserText',
            'config'  => array(
                'type' => 'text',
                'cols' => 60,
                'rows' => 5,
            )
        ),
        'title' => array(
            'exclude' => 0,
            'label'   => $nj_collection_lang_file.'label.general.title',
            'config'  => array(
                'type' => 'input',
                'size' => 40,
                'eval' => 'trim,required',
                'max'  => 256
            )
        ),
		'title_display' => array(
            'exclude' => 0,
            'label'   => $nj_ext_lang_file.'label.general.titleDisplay',
            'config'  => array(
                'type' => 'input',
                'size' => 40,
                'eval' => 'trim,required',
                'max'  => 256
            )
        ),
    ),
    'types' => array(
        '0' => array('showitem' => 'hidden,sys_language_uid;;1,title,title_display,description,features,products,teaser_image,teaser_text,content' )
    ),
    'palettes' => array(
        '1' => array('showitem' => 'l18n_parent'),
    ),
);
?>