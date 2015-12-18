<?php
	/**
	 * This class shows a list of source code
	 *
	 * @author Milton Li <m.li24@ncl.ac.uk>
	 * @copyright 2015-2016 Newcastle University
	 *
	 */
	 class SourceCode extends Siteaction
	 {
		/**
	 	* Handle profile operations /code/xxxx
	 	*
	 	* @param object	$context	The context object for the site
	 	*
	 	* @return string	A template name
	 	*/
	 	public function handle($context)
	 	{
	 		$sourcecode = R::find('file', 'category = "source-code"');
	 		$context->local()->addval('sourcecode', $sourcecode);
	 		return 'sourcecode.twig';
	    }
	}
?>