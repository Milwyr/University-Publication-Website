<?php

/**
 * This class shows a list of apps
 *
 * @author Milton Li <m.li24@ncl.ac.uk>
 * @copyright 2015-2016 Newcastle University
 *
 */
class Apps extends Siteaction {

	/**
	 * Handle profile operations /apps/xxxx
	 *
	 * @param object	$context	The context object for the site
	 *
	 * @return string	A template name
	 */
	public function handle($context) {
		$apps = R::find('file', 'category = "apps"');
		$searchText = $context->mustpostpar('apps_search_text', '');
		
		// Refine search result if the user searches in the text box
		if (!empty($searchText)) {
			$searchText = '%' . $searchText . '%';
			$apps = R::find('file', 'category like ? and name like ?', ["apps", $searchText]);
		}

		$context->local()->addval('apps', $apps);
		return 'apps.twig';
	}

}