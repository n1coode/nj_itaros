<?php
namespace N1coode\NjItaros\ViewHelpers;

/**
 * @author n1coode
 * @package nj_itaros
 */
class ListProductsViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
	/**
	 *	Description
	 *
	 * @param string $text
	 * @param string $action	 
	 * @return string
	 */
	public function render($text = '', $action = '')
	{	
		$tmp = '';
 		if(!empty($text))
 		{
			if(!empty($action))
			{
				if($action === 'ucfirst')
				{
					$tmp = ucfirst($text);
				}
			}
 		}
 	
		return $tmp;
	}
} //end of class \N1coode\NjItaros\ViewHelpers\ListProductsViewHelper
?>