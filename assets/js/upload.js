function chooseUploadCategory()
{
    var categories = document.getElementById("categories");
    var selectedCategory = categories.options[categories.selectedIndex].value;

    document.getElementById("allowedExtensions").innerHTML = '';
    if (selectedCategory == "apps")
    {
        document.getElementById("allowedExtensions").innerHTML = '.apk .ipa';
        //document.getElementById("categories").style.display = 'none';
    } else if (selectedCategory == "data") {
        document.getElementById("allowedExtensions").innerHTML = '.xlsx .zip';
    } else if (selectedCategory == "publication") {
        document.getElementById("allowedExtensions").innerHTML = '.docx .pdf .txt';
    } else if (selectedCategory == "source-code") {
        document.getElementById("allowedExtensions").innerHTML = '.rar .zip';
    }
    getAcceptedCategories();
}
