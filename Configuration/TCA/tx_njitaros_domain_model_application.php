<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

$nj_ext_key			= \N1coode\NjItaros\Utility\Constants::NJ_EXT_KEY;
$nj_ext_namespace	= \N1coode\NjItaros\Utility\Constants::NJ_EXT_NAMESPACE;
$nj_ext_path		= \N1coode\NjItaros\Utility\Constants::NJ_EXT_PATH;
$nj_ext_title		= \N1coode\NjItaros\Utility\Constants::NJ_EXT_TITLE;

$nj_ext_lang_file			= \N1coode\NjItaros\Utility\Constants::NJ_EXT_LANG_FILE_BACKEND;
$nj_collection_lang_file	= 'LLL:EXT:nj_collection/Resources/Private/Language/locallang_db.xlf:';

$nj_domain_model = 'Application';
$nj_domain = strtolower($nj_domain_model);


return array(
	'ctrl' => array(
        'title' => $nj_ext_lang_file.'model.'.$nj_domain,
        'label' => 'last_name',
        //'l10n_mode' => 'mergeIfNotBlank',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'dividers2tabs' => TRUE,
        'default_sortby' => 'ORDER BY crdate ASC',
        //'sortby' => 'sorting',
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
		'email' => array(
            'exclude' => 0,
            'label'   => $nj_collection_lang_file.'label.general.email',
            'config'  => array(
                'type' => 'input',
                'size' => 25,
                'eval' => 'email,trim,required',
                'max'  => 256
            ),
        ),
		'first_name' => array(
            'exclude' => 0,
            'label'   => $nj_collection_lang_file.'label.general.firstName',
            'config'  => array(
                'type' => 'input',
                'size' => 25,
                'eval' => 'trim,required',
                'max'  => 256
            ),
        ),
		'last_name' => array(
            'exclude' => 0,
            'label'   => $nj_collection_lang_file.'label.general.lastName',
            'config'  => array(
                'type' => 'input',
                'size' => 25,
                'eval' => 'trim,required',
                'max'  => 256
            ),
        ),
		'salutation' => array(
			'exclude' => 0,
			'label'   => $nj_collection_lang_file.'label.general.salutation',
			'config' => Array (
				'type' => 'select',
				'items' => array(
					array($nj_collection_lang_file.'select.general.title.ms', 0),
					array($nj_collection_lang_file.'select.general.title.mr', 1),
				),
				'maxitems' => 1,
				'default' => 0,
			)
		)
		
	),
	'types' => array(
        '0' => array('showitem' => 'salutation,last_name,first_name,email' )
    ),
    'palettes' => array(
        '1' => array(),
    ),
);
?>