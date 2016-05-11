<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

$nj_ext_key					= \N1coode\NjItaros\Utility\Constants::NJ_EXT_KEY;
$nj_ext_namespace			= \N1coode\NjItaros\Utility\Constants::NJ_EXT_NAMESPACE;
$nj_ext_path				= \N1coode\NjItaros\Utility\Constants::NJ_EXT_PATH;
$nj_ext_title				= \N1coode\NjItaros\Utility\Constants::NJ_EXT_TITLE;

$nj_ext_lang_file			= \N1coode\NjItaros\Utility\Constants::NJ_EXT_LANG_FILE_BACKEND;
$nj_collection_lang_file	= 'LLL:EXT:nj_collection/Resources/Private/Language/locallang_db.xlf:';

$nj_domain_model = 'Corporation';
$nj_domain = strtolower($nj_domain_model);

return array(
	'ctrl' => array(
        'title' => $nj_ext_lang_file.'model.'.$nj_domain,
        'label' => 'name',
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
		'type' => 'content_type',
        'default_sortby' => 'ORDER BY name ASC',
        'sortby' => 'sorting',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden'
        ),
        'requestUpdate' => 'sys_language_uid,logo_type',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($nj_ext_path) . 'Resources/Public/Icons/' . $nj_ext_key . '_domain_model_' . $nj_domain . '.png',
    ),
	'interface' => array(
        'showRecordFieldList' => 'sorting',
		'maxDBListItems' => 100,
		'maxSingleDBListItems' => 500,
		'always_description' => 1,
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
        'image' => array(
            'exclude' => 1,
            'label' => $nj_collection_lang_file.'label.general.imageFile',
			'displayCond' => array(
				'AND' => array(
					'FIELD:sys_language_uid:<=:0',
					'FIELD:logo_type:=:0',
				),
			),
            //'l10n_mode' => 'mergeIfNotBlank',
            'l10n_mode' => 'exclude',
            'l10n_display' => 'hideDiff,defaultAsReadonly',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image', 
                array(
                    'appearance' => array(
                        'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
                    ),
                    'minitems' => 0,
                    'maxitems' => 1,
                    'foreign_match_fields' => array(
                        'fieldname' => 'image'
                    ),
            ), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
        ),
		
		'is_customer' => array(
            'exclude' => 1,
            'label'   => $nj_ext_lang_file.'label.model.'.$nj_domain.'.isCustomer',
            'config'  => array(
                'type' => 'check'
            )
        ),
		
		'is_partner' => array(
            'exclude' => 1,
            'label'   => $nj_ext_lang_file.'label.model.'.$nj_domain.'.isPartner',
            'config'  => array(
                'type' => 'check'
            )
        ),
		
        'description' => array(
            'exclude' => 1,
            'label' => $nj_collection_lang_file.'label.general.description',
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
		'logo_type' => Array (
            'exclude' => 1,
            'label' => $nj_ext_lang_file.'label.model.'.$nj_domain.'.logoType',
            'change' => 'reload',
            'config' => Array (
                'type' => 'select',
                'items' => Array(
                    Array('Bilddatei (PNG, JPEG, GIF)',0),
                    Array('SVG',1)
                ),
				'default' => 0
            )
        ),
		'name' => array(
            'displayCond' => 'FIELD:sys_language_uid:<=:0',
            'l10n_mode' => 'exclude',
            'l10n_display' => 'hideDiff,defaultAsReadonly',
            'exclude' => 0,
            'label' => $nj_collection_lang_file.'label.general.name',
            'config'  => array(
                'type' => 'input',
                'size' => 25,
                'eval' => 'trim,required',
                'max'  => 256
            )
        ),
		'svg' => array(
            'exclude' => 1,
			'displayCond' => array(
				'AND' => array(
					'FIELD:sys_language_uid:<=:0',
					'FIELD:logo_type:=:1',
				),
			),
            'label' => $nj_ext_lang_file.'label.model.'.$nj_domain.'.svg',
            'config'  => array(
                'type' => 'text',
                'cols' => 60,
                'rows' => 6,
            )
        ),
		'url' => array(
			'exclude' => 0,
			'label'   => $nj_collection_lang_file.'label.general.website',
			'config'  => array(
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim',
				'max'  => 256
			),
		),
    ),
	'types' => array(
        '0' => array('showitem' => '--div--;'.$nj_collection_lang_file.'tab.general.generalInformation,hidden,sys_language_uid;;1,name,description,--palette--;'.$nj_ext_lang_file.'label.model.'.$nj_domain.'.displayAs;displayAs,url,--div--;'.$nj_collection_lang_file.'tab.general.images,logo_type,image,svg' )
    ),
    'palettes' => array(
        '1' => array('showitem' => 'l18n_parent'),
		'displayAs' => array('showitem' => 'is_customer,is_partner','canNotCollapse' => 1)
    ),
);