<?php
if(!defined('TYPO3_MODE')) die ('Access denied.');

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY] = unserialize($_EXTCONF);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'N1coode.'.$_EXTKEY,
	'Pi1',
	array(
		'Corporation' => 'list,tiny',
		'Form' => 'application,contact,infomail,support',
		'Carousel' => 'header',
		'Feature' => 'highlight',
		'Menu' => 'list,teaser,tiny',
		'News' => 'focus,list',
		'Product' => 'focus, header, index, list, listFeatures',
		'Solution' => 'focus, header, index, list, listFeatures'

	),
	// non-cacheable actions
	array(
		'Corporation' => 'list,tiny',
		'Form' => 'application,contact,infomail,support',
		'Carousel' => 'header',
		'Feature' => 'highlight',
		'Menu' => 'list,teaser,tiny',
		'News' => 'focus,list',
		'Product' => 'focus, header, index, list, listFeatures',
		'Solution' => 'focus, header, index, list, listFeatures'
	)
);


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript($_EXTKEY,
	'setup', trim('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TypoScript/CustomContent/CustomContentElementsSetup.ts">'),43);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:nj_itaros/Configuration/TypoScript/pageTsConfig.ts">');

$TYPO3_CONF_VARS['FE']['pageOverlayFields'] .= ',tx_njitaros_nav_title,tx_njitaros_page_type,tx_njitaros_teaser_text';
$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= ',tx_njitaros_nav_title,tx_njitaros_page_type,tx_njitaros_teaser_text';