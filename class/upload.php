<?php
	/**
	 * This class provides an implementation for uploading documents
	 *
	 * @author Milton Li <m.li24@ncl.ac.uk>
	 * @copyright 2015-2016 Newcastle University
	 *
	 */
	 class Upload extends Siteaction
	 {
		/**
	 	* Handle profile operations /upload/xxxx
	 	*
	 	* @param object	$context	The context object for the site
	 	*
	 	* @return string	A template name
	 	*/
	 	public function handle($context)
	 	{
	 		// A file has been selected to upload
			if (!empty($_FILES['file_to_upload']['name']) and !empty($_POST['categories']) and
				!empty($_POST["publication-year"]) and !empty($_POST["author"]))
			{
				$allowedExtensions = $this->getAllowedExtensions($_POST['categories']);
	        	$extensions = explode('.', $_FILES['file_to_upload']['name']);
	        	$extension = end($extensions);
				$target_directory = "assets/upload/".$_POST["author"]."/".$_POST['publication-year']."/";

	            if (!file_exists($target_directory))
	            {
	                mkdir($target_directory, 0777, true);
	            }

	            $target_file_path = $target_directory.basename($_FILES['file_to_upload']['name']);

	            move_uploaded_file($_FILES['file_to_upload']['tmp_name'], $target_file_path);

				$upload_file = R::dispense('file');
				$upload_file->category = $_POST['categories'];
				$upload_file->directory = $target_directory;
				$upload_file->name = $_FILES['file_to_upload']['name'];
				$upload_file->author = $_POST['author'];
				$upload_file->year = $_POST['publication-year'];
				$upload_file->description = $_POST['description'];
				$upload_file->restriction = $_POST['restriction'];
				$upload_file->information = $_POST['author-information'];
				$upload_file->size = $_FILES['file_to_upload']['size']/1024; // File size in kB
				$upload_file->extension = $extension;
				$upid = R::store($upload_file);

				$context->local()->addval('saved', TRUE);
	        }

	        return 'upload.twig';
	    }

		function getAllowedExtensions($category)
		{
			if ($category == 'apps')
			{
				return array('apk', 'ipa');
			}
			elseif ($category == 'data')
			{
				return array('xlsx', 'zip');
			}
			elseif ($category == 'publication')
			{
				return array('docx', 'pdf', 'txt');
			}
			else
			{
				return array('rar', 'zip');
			}
		}
	}
?>
