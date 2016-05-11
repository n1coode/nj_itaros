<?php
if(!defined('TYPO3_MODE')) die ('Access denied.');

$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_pi1';


$nj_ext_key			= \N1coode\NjItaros\Utility\Constants::NJ_EXT_KEY;
$nj_ext_namespace	= \N1coode\NjItaros\Utility\Constants::NJ_EXT_NAMESPACE;
$nj_ext_path 		= \N1coode\NjItaros\Utility\Constants::NJ_EXT_PATH;
$nj_ext_title 		= \N1coode\NjItaros\Utility\Constants::NJ_EXT_TITLE;
$nj_ext_lang_file	= \N1coode\NjItaros\Utility\Constants::NJ_EXT_LANG_FILE_BACKEND;


/**
 * Registers a Plugin to be listed in the Backend. You also have to configure the Dispatcher in ext_localconf.php.
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Pi1',
	$nj_ext_lang_file.'plugin.title'
);


//
// custom content elements
//
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig( '
	mod {
		wizards.newContentElement.wizardItems.extra {
    		header = nj_itaros
    		elements {
    			njitaros_teaser {
    				icon = ../typo3conf/ext/'.$nj_ext_path.'/Resources/Public/Icons/CustomContentElements/teaser.png
    				title = Teaser auf Startseite 
    				description = Siehe Titel
    				tt_content_defValues {
    					CType = njitaros_teaser
    				}
    			}
    		}
    		show := addToList(njitaros_teaser)
		}
	}
');

// ***********************


/**
 * TypoScript
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', $nj_ext_title.' setup');


/**
 * Flexform
 */
// Clean up the Flexform fields in the backend a bit
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,splash_layout';
// Add own flexform stuff.
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_'.$nj_ext_key.'.xml');


/**
 * JavaScript
 */
if(TYPO3_MODE === 'FE') 
{
	$GLOBALS['TSFE']->getPageRenderer()
		->addJsFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($nj_ext_path) . 'Resources/Public/Javascript/jq.js');
}


/**
 * Define dditional fields for the table 'pages'
 */
$addColumnItarosArray = array(
	'tx_njitaros_nav_title' => array(
		'exclude' => 0,
		'label'   => $nj_ext_lang_file.'pages.sysNavTitle',
		'config'  => array(
			'type' => 'input',
			'size' => 40,
			'eval' => 'trim,unique',
			'max'  => 256
		)
	),
	'tx_njitaros_page_type' => Array (
		'exclude' => 0,
		'label'   => $nj_ext_lang_file.'pages.pageType',
		'l10n_mode' => 'mergeIfNotBlank',
		#'change' => 'reload',
		'config' => Array (
			'type' => 'select',
			'items' => Array(
				Array($nj_ext_lang_file.'pages.pageType.option.0',0),
				Array($nj_ext_lang_file.'pages.pageType.option.1',1),
				Array($nj_ext_lang_file.'pages.pageType.option.2',2),
			)
		)
	),
	'tx_njitaros_teaser_text' => Array (
		'exclude' => 0,
		'displayCond' => 'FIELD:tx_njitaros_page_type:>:0',
		'l10n_mode' => 'mergeIfNotBlank',
		'label'   => $nj_ext_lang_file.'pages.teaserText',
		'defaultExtras' => 'richtext[]',
		'config'  => array(
			'type' => 'text',
			'cols' => 60,
			'rows' => 6,
			'defaultExtras' => 'richtext[]',
		)
	),
);


/**
 * Add additional fields to the table 'pages'
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $addColumnItarosArray);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages',',--div--;i-taros,tx_njitaros_nav_title,tx_njitaros_page_type,tx_njitaros_teaser_text');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages_language_overlay', $addColumnItarosArray);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(',pages_language_overlay','--div--;i-taros,tx_njitaros_nav_title,tx_njitaros_page_type,tx_njitaros_teaser_text');


$TCA['pages']['ctrl']['requestUpdate'] = $TCA['pages']['ctrl']['requestUpdate'] ? $TCA['pages']['ctrl']['requestUpdate'] . ',tx_njitaros_page_type' : 'tx_njitaros_page_type';
$TCA['pages_language_overlay']['ctrl']['requestUpdate'] = $TCA['pages_language_overlay']['ctrl']['requestUpdate'] ? $TCA['pages_language_overlay']['ctrl']['requestUpdate'] . ',tx_njitaros_page_type' : 'tx_njitaros_page_type';