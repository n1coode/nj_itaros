<?php
/***************************************************************
 * Extension Manager/Repository config file for ext: "nj_collection"
***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'njs i-taros',
	'description' => 'Managing the features of the i-taros software.',
	'category' => 'plugin',
	'author' => 'Nico Jatzkowski',
	'author_email' => 'nico.jatzkowski@buit-services.com',
	'author_company' => 'B&IT Solutions',
	'shy' => '',
	'priority' => '',
	'module' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => '1',
	'createDirs' => 
	   'uploads/tx_njslider,
		uploads/tx_njslider/image',
	'modify_tables' => 'pages,pages_language_overlay',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'version' => '7.6.1',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'extbase' => '7.6.0-0.0.0',
			'fluid' => '7.6.0-0.0.0',
			'typo3' => '7.6.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => '',
);