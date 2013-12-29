window.addEvent('domready', function() {
	document.formvalidator.setHandler('title',
		function (value) {
			regex=/[A-Za-z0-9_]/;
			return regex.test(value);
	});
});