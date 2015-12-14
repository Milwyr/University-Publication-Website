<?php
	/**
	 * This class provides an implementation for uploading documents
	 *
	 * @author Milton Li <m.li24@ncl.ac.uk>
	 * @copyright 2015-2016 Newcastle University
	 *
	 */
	 class Documentations extends Siteaction
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
	 		$documents = R::findall('file');
	 		$context->local()->addval('documents',$documents);
	 		return 'documentations.twig';
	    }
	}
?>