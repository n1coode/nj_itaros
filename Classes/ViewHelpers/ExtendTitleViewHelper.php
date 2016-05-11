<?php
namespace N1coode\NjItaros\ViewHelpers;

/**
 * @author n1coode
 * @package nj_itaros
 */
class ExtendTitleViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
	/**
	 *	Description
	 *
	 * @param string $text
	 * @param string $action	 
	 * @return string
	 */
	public function render($title = '')
	{	
		$tmp = '';
		$tmp = '<span class="i-taros color1">i</span><span class="i-taros color2">-</span><span class="i-taros color1">tar</span><span class="i-taros color2">o</span><span class="i-taros color1">s</span>.<span class="product">'.$title.'</span>';
		return $tmp;
	}
}