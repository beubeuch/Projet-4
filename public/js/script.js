tinymce.init({
	selector: '#tinyEditor',
	contextmenu: "link image imagetools table spellchecker",
	language_url: 'tinymce/langs/fr_FR.js',
	width: 100,
	height: 550
});

if (document.getElementById('closeAlert') != null) {
	document.getElementById('closeAlert').addEventListener('click', function(e) {
		ajaxPost('index.php?removeAlert', '', function() {
			document.getElementById('alertDiv').style.display = "none";
		});
	});
}