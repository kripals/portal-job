/*************************************
@@File: Job Stock  Template Custom Js

**************************************/

(function($){
"use strict";

	/*---Bootstrap wysihtml5 editor --*/
	$('.about').wysihtml5();

	/*---Bootstrap wysihtml5 editor --*/
	$('.resume').wysihtml5();

	// Category
	$('#jb-category').select2();

	// Category
	$('.jb-minimal').select2({
        minimumResultsForSearch: -1
    });

	// Skills
	$(".multiple-skill").select2({
		placeholder: "Key set of abilities related to employbility i.e. Leadership, Communication etc.",
        maximumSelectionLength: 6
	});

	// Skills
	$(".preferred-country").select2({
		placeholder: "Select preferred country"
	});

	// Skills
	$(".preferred-location").select2({
		placeholder: "Select preferred locations"
	});

	// language
	$(".language").select2({
		placeholder: "Choose language"
	});

	// Job Filter
	$('#jb-filter').select2();

	// Job Filter
	$('#jb-filter-date').select2();

	// Application Filter
	$('#application-status').select2();

	$('[data-toggle="tooltip"]').tooltip();

})(jQuery);
