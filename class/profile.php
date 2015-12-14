<?php
	/**
	 * A class that contains the code for the Profile class
	 *
	 * @author Milton Li <m.li24@ncl.ac.uk>
	 * @copyright 2015-2016 Newcastle University
	 *
	 */
	class Profile extends Siteaction
	{
		/**
		 * Handle profile operations /profile/xxxx
		 *
		 * @param object	$context	The context object for the site
		 *
		 * @return string	A template name
		 */
		 public function handle($context)
		 {
		 	if (($email = $context->postpar('email', '')) != '')
		 	{
		 		// There is a post
				$user = $context->user();
		 		$user->email = $email;
		 		R::store($user);
		 		$context->local()->addval('done', TRUE);
	        }
	        return 'profile.twig';
		}
	}
?>
