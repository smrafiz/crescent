/**
 * Welcome Admin Page script.
 */

'use strict';

(function($) {
	$(document).on('ready', function() {
		// Variables.
		var $tabNav = $('#crescent-content-tab .nav > .nav-tab'),
			$tabNavFirst = $('#crescent-content-tab .nav > .nav-tab:first'),
			$tabContent = $('#crescent-content-tab .tab-pane'),
			$tabContentFirst = $('#crescent-content-tab .tab-pane:first'),
			$button = $('#crescent-content-tab .button-primary');

		// Initially hide all content.
		$tabContent.hide();

		// Activate first tab.
		$tabContentFirst.show();
		$tabNavFirst.addClass('nav-tab-active');

		// Check for on click event.
		$tabNav.on('click', function(event) {
			event.preventDefault();

			$tabNav.removeClass('nav-tab-active');
			$(this).addClass('nav-tab-active');
			$tabContent.hide();

			// Detection for current tab.
			var selectTab = $(this).attr('href');
			$(selectTab).fadeIn();
		});

		$("#crescent-content-tab .tab-pane > div a[href^='#']").on('click', function(event) {
			event.preventDefault();
			var targetID = $(this).attr('href');
			$('#crescent-content-tab .nav > .nav-tab[href="' + targetID + '"').click();
			return false;
		});
	});
})(jQuery);
