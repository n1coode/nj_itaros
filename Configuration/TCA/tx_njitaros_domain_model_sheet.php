<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

$nj_ext_key					= \N1coode\NjItaros\Utility\Constants::NJ_EXT_KEY;
$nj_ext_namespace			= \N1coode\NjItaros\Utility\Constants::NJ_EXT_NAMESPACE;
$nj_ext_path				= \N1coode\NjItaros\Utility\Constants::NJ_EXT_PATH;
$nj_ext_title				= \N1coode\NjItaros\Utility\Constants::NJ_EXT_TITLE;

$nj_ext_lang_file			= \N1coode\NjItaros\Utility\Constants::NJ_EXT_LANG_FILE_BACKEND;
$nj_collection_lang_file	= 'LLL:EXT:nj_collection/Resources/Private/Language/locallang_db.xlf:';

$nj_domain_model = 'Sheet';
$nj_domain = strtolower($nj_domain_model);


return array(
	'ctrl' => array(
        'title' => $nj_ext_lang_file.'model.'.$nj_domain,
        'label' => 'title',
        //'l10n_mode' => 'mergeIfNotBlank',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'dividers2tabs' => TRUE,
        'default_sortby' => 'ORDER BY sorting ASC',
        'sortby' => 'sorting',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden'
        ),
        'requestUpdate' => '',
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
        'hidden' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array(
                'type' => 'check'
            )
        ),
		'image' => array(
			//'displayCond' => 'FIELD:sys_language_uid:<=:0',
			'exclude' => 0,
			'label' => $nj_collection_lang_file.'label.general.image',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('image', array(
				'appearance' => array(
					'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
				),
				'minitems' => 0,
				'maxitems' => 1,
			),
			$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
		),
		'link' => array(
            'label' => $nj_collection_lang_file.'label.general.link',
            'exclude' => 1,
            'config' => array(
                'type' => 'input',
                'size' => '50',
                'max' => '1024',
                'eval' => 'trim',
                'wizards' => array(
                    'link' => array(
                        'type' => 'popup',
                        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:header_link_formlabel',
                        'icon' => 'link_popup.gif',
                        'module' => array(
                            'name' => 'wizard_element_browser',
                            'urlParameters' => array(
                                'mode' => 'wizard'
                            )
                        ),
                        'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
                    )
                ),
                'softref' => 'typolink'
            )
        ),
		'subtitle' => array(
            'exclude' => 0,
            'label'   => $nj_collection_lang_file.'label.general.subtitle',
            'config'  => array(
                'type' => 'input',
                'size' => 25,
                'eval' => 'trim,required',
                'max'  => 256
            ),
        ),
		'title' => array(
            'exclude' => 0,
            'label'   => $nj_collection_lang_file.'label.general.title',
            'config'  => array(
                'type' => 'input',
                'size' => 25,
                'eval' => 'trim,required',
                'max'  => 256
            ),
        ),
		'template' => array(
            'exclude' => 0,
            'label'   => 'Template (TODO)',
            'config' => Array (
                'type' => 'select',
                'items' => Array(
                    Array('1',1),
                    Array('2',2)
                ),
				'default' => 1
            )
        ),
	),
	'types' => array(
        '0' => array('showitem' => 'title,subtitle,image,link,template' )
    ),
    'palettes' => array(
        '1' => array(),
    ),
);