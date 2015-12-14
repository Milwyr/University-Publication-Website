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
			if (!empty($_FILES['file_to_upload']['name']))
			{
	        	$allowedExtensions = array('docx', 'pdf', 'txt');
	        	$extensions = explode('.', $_FILES['file_to_upload']['name']);
	        	$extension = end($extensions);
	        	
	        	if (!in_array($extension, $allowedExtensions))
	        	{
	        		echo 'Wrong file type';
				}
				else
				{
					if (!empty($year = $_POST["publication-year"]) and (!empty($author = $_POST["author"])))
					{
						$target_directory = "assets/upload/".$author."/".$year."/";
					}
	
	                if (!file_exists($target_directory))
	                {
	                	mkdir($target_directory, 0777, true);
	                }
	
	                $target_file_path = $target_directory.basename($_FILES['file_to_upload']['name']);
	                
	                move_uploaded_file($_FILES['file_to_upload']['tmp_name'], $target_file_path);
	
					$ufile = R::dispense('file');
					$ufile->directory = $target_directory;
					$ufile->name = $_FILES['file_to_upload']['name'];
					$ufile->author = $_POST['author'];
					$ufile->year = $_POST['publication-year'];
					$ufile->description = $_POST['description'];
					$ufile->restriction = $_POST['restriction'];
					$ufile->information = $_POST['author-information'];
					$ufile->size = $_FILES['file_to_upload']['size']/1024; // File size in kB
					$ufid = R::store($ufile);
	            }
	        }
	
	            return 'upload.twig';
	    }
	}
?>