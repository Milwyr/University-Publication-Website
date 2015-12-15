<?php
	/**
	 * This class shows a list of data
	 *
	 * @author Milton Li <m.li24@ncl.ac.uk>
	 * @copyright 2015-2016 Newcastle University
	 *
	 */
	 class Data extends Siteaction
	 {
		/**
	 	* Handle profile operations /data/xxxx
	 	*
	 	* @param object	$context	The context object for the site
	 	*
	 	* @return string	A template name
	 	*/
	 	public function handle($context)
	 	{
	 		$data = R::find('file', 'category = "data"');
	 		$context->local()->addval('data', $data);
	 		return 'data.twig';
	    }
	}
?>