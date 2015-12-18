<?php

/**
 * This class shows a list of source code
 *
 * @author Milton Li <m.li24@ncl.ac.uk>
 * @copyright 2015-2016 Newcastle University
 *
 */
class SourceCode extends Siteaction {

	/**
	 * Handle profile operations /code/xxxx
	 *
	 * @param object	$context	The context object for the site
	 *
	 * @return string	A template name
	 */
	public function handle($context) {
		$sourcecode = R::find('file', 'category = "source-code"');

		// Refine search result if the user searches in the text box
		$searchText = $context->mustpostpar('sourcecode_search_text', '');
		if (!empty($searchText)) {
			$searchText = '%' . $searchText . '%';
			$sourcecode = R::find('file', 'category like ? and name like ?', ["source-code", $searchText]);
		}

		$context->local()->addval('sourcecode', $sourcecode);
		return 'sourcecode.twig';
	}

}