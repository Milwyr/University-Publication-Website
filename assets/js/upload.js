window.onload = function () {
	chooseUploadCategory();
	// Add available years in the year picker
	var currentYear = (new Date()).getFullYear();
	for (var year = currentYear; year >= 1900; year--) {
		var option = new Option(year, year);
		$('#yearpicker').append($(option));
	}
};

/**
 * This method changes the allowed extensions dynamically depending on what category the user chosses.
 */
function chooseUploadCategory()
{
	var categories = document.getElementById("categories");
	var selectedCategory = categories.options[categories.selectedIndex].value;

	document.getElementById("allowedExtensions").innerHTML = getAcceptedExtensions(selectedCategory);
}

function getAcceptedExtensions(selectedCategory) {
	if (selectedCategory === "apps")
	{
		return '.apk, .ipa';
		//document.getElementById("categories").style.display = 'none';
	} else if (selectedCategory === "data") {
		return '.xlsx, .zip';
	} else if (selectedCategory === "publication") {
		return '.docx, .pdf, .txt';
	} else if (selectedCategory === "source-code") {
		return '.rar, .zip';
	}
}

/**
 * This method displays an error message if the user has not filled in all the boxes.
 */
function uploadButtonClick() {
	var author = document.getElementById("author").value;
	var year = document.getElementById("yearpicker").value;
	var description = document.getElementById("description").value;
	var restriction = document.getElementById("restriction").value;
	var authorInformation = document.getElementById("author-information").value;

	if (isNullOrEmpty(author) || isNullOrEmpty(year) || isNullOrEmpty(description) ||
			isNullOrEmpty(restriction) || isNullOrEmpty(authorInformation)) {
		alert("Please fill in all the boxes before uploading a document.");
	}
}

function isNullOrEmpty(s) {
	return (s === null || s === "");
}