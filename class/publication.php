<?php

/**
 * This class shows a list of publications
 *
 * @author Milton Li <m.li24@ncl.ac.uk>
 * @copyright 2015-2016 Newcastle University
 *
 */
class Publication extends Siteaction {

	/**
	 * Handle profile operations /documentations/xxxx
	 *
	 * @param object	$context	The context object for the site
	 *
	 * @return string	A template name
	 */
	public function handle($context) {
		$publications = R::find('file', 'category = "publication"');

		// Refine search result if the user searches in the text box
		$searchText = $context->mustpostpar('publication_search_text', '');
		if (!empty($searchText)) {
			$searchText = '%'.$searchText.'%';
			$publications = R::find('file', 'category like ? and name like ?',["publication", $searchText]);
		}

		$context->local()->addval('publications', $publications);
		return 'publication.twig';
	}

}