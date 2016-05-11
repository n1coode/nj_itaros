<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$tca = array(
	'types' => array(
		'njitaros_teaser' => array(
			'showitem' => '--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
				header;Überschrift,
				image;Teaser-Bild,
				subheader;Subheadline,
				bodytext;Teaser-Text;;richtext:rte_transform[flag=rte_enabled|mode=ts_css],
				header_link;Link,
				--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
				--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
				--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
				--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended'
    	)
	),
	'columns' => array(
		'CType' => array(
			'config' => array(
				'items' => array(
					'njitaros_teaser' => array(
						'Teaser', // Name des Inhaltselementes
						'njitaros_teaser', // TCA Name des Inhaltselementes
						'EXT:nj_itaros/Resources/Public/Icons/CustomContentElements/teaser.png' // Bild des Inhaltelementes
    				)
				)
    		)
    	)
    )
);
     
$GLOBALS['TCA']['tt_content'] = array_replace_recursive($GLOBALS['TCA']['tt_content'], $tca);