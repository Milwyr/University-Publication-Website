<?php

/**
 * This class shows a list of data
 *
 * @author Milton Li <m.li24@ncl.ac.uk>
 * @copyright 2015-2016 Newcastle University
 *
 */
class Data extends Siteaction {

	/**
	 * Handle profile operations /data/xxxx
	 *
	 * @param object	$context	The context object for the site
	 *
	 * @return string	A template name
	 */
	public function handle($context) {
		$data = R::find('file', 'category = "data"');

		// Refine search result if the user searches in the text box
		$searchText = $context->mustpostpar('data_search_text', '');
		if (!empty($searchText)) {
			$searchText = '%' . $searchText . '%';
			$data = R::find('file', 'category like ? and name like ?', ["data", $searchText]);
		}

		$context->local()->addval('data', $data);
		return 'data.twig';
	}

}