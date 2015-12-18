<?php

/**
 * This class provides an implementation for uploading documents
 *
 * @author Milton Li <m.li24@ncl.ac.uk>
 * @copyright 2015-2016 Newcastle University
 *
 */
class Upload extends Siteaction {

	/**
	 * Handle profile operations /upload/xxxx
	 *
	 * @param object	$context	The context object for the site
	 *
	 * @return string	A template name
	 */
	public function handle($context) {
		$categories = $context->mustpostpar('categories', '');
		$publication_year = $context->mustpostpar('publication-year', '');
		$author = $context->mustpostpar('author', '');

		// A file has been selected to upload
		if (!empty($_FILES['file_to_upload']['name']) and ! empty($categories) and ! empty($publication_year) and ! empty($author)) {
			$file_to_upload = $_FILES['file_to_upload']['name'];

			$target_directory = "assets/upload/" . $author . "/" . $publication_year . "/";
			if (!file_exists($target_directory)) {
				mkdir($target_directory, 0777, true);
			}

			$allowedExtensions = $this->getAllowedExtensions($categories);
			$extensions = explode('.', $file_to_upload);
			$extension = end($extensions);

			if (!in_array($extension, $allowedExtensions)) {
				$context->local()->message('errmessage', 'Please choose a file with the correct extension.');
			}
			else {
				$target_file_path = $target_directory . basename($file_to_upload);

				move_uploaded_file($file_to_upload, $target_file_path);

				$upload_file = R::dispense('file');
				$upload_file->category = $categories;
				$upload_file->directory = $target_directory;
				$upload_file->name = $file_to_upload;
				$upload_file->author = $author;
				$upload_file->year = $context->mustpostpar('publication-year', '');
				$upload_file->description = $context->mustpostpar('description', '');
				$upload_file->restriction = $context->mustpostpar('restriction', '');
				$upload_file->information = $context->mustpostpar('author-information', '');
				$upload_file->size = $file_to_upload / 1024; // File size in kB
				$upload_file->extension = $extension;
				R::store($upload_file);

				$context->local()->addval('saved', TRUE);
			}
		}

		return 'upload.twig';
	}

	function getAllowedExtensions($category) {
		if ($category === 'apps') {
			return array('apk', 'ipa');
		} elseif ($category === 'data') {
			return array('xlsx', 'zip');
		} elseif ($category === 'publication') {
			return array('docx', 'pdf', 'txt');
		} else {
			return array('rar', 'zip');
		}
	}

}