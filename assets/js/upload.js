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

window.onload = function () {
	chooseUploadCategory();

	// Add available years in the year picker
	var currentYear = (new Date()).getFullYear();
	for (var year = currentYear; year >= 1900; year--) {
		var option = new Option(year, year);
		$('#yearpicker').append($(option));
	}
};