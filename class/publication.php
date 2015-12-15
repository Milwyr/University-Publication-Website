<?php
	/**
	 * This class shows a list of publications
	 *
	 * @author Milton Li <m.li24@ncl.ac.uk>
	 * @copyright 2015-2016 Newcastle University
	 *
	 */
	 class Publication extends Siteaction
	 {
		/**
	 	* Handle profile operations /documentations/xxxx
	 	*
	 	* @param object	$context	The context object for the site
	 	*
	 	* @return string	A template name
	 	*/
	 	public function handle($context)
	 	{
	 		$publications = R::find('file', 'category = "publication"');
	 		$context->local()->addval('publications', $publications);
	 		return 'publication.twig';
	    }
	}
?>
