jQuery(function ($) {
	$('#dec-filter-search__input').on('keyup', function () {
		if( $(this).val() ) {
		$(".close-icon").css({ "display": "block" });
	  }else{
		$(".close-icon").css({ "display": "none" });
	  }
	});
	
	var eventFilterHide = jQuery("input[name='filter-css-class_hide']").val();
	var eventFilterShow = jQuery("input[name='filter-css-class_show']").val();
	$('.dec-filter-bar .dec-filter-label').attr('tabindex', '0');
	//$(".decm_event_filter_child").show();
	//$("#dec-filter-remove").show();
	// $(window).on('resize', function() {
	// if ($(window).width() < 600) {
	//	$(".dec-search-filter").addClass("decem-icon-filters");
		// Set tabindex for the element
		
//	$(".events-empty-results").parent().removeClass('row_equal');
	$(".dec-filter-header").parent().parent().css({ "display": "block" });
    //$(".dec-filter-header-search").css({ "display": "flex" });


	$('.dec-recurring-list').on("click", function () {
		//alert("Recurring Click");
		$('.dec-recurring-filter-list').toggle();
	});

	$('.decm-filter-catrgory-list').on("click", function () {
		$('.dec-event-category-filter-list').toggle();
	});
	$('.dec-tag-list').on("click", function () {
		$('.dec-tag-filter-list').toggle();
	});
	$('.dec-location-list').on("click", function () {
		$('.dec-location-filter-list').toggle();
	});

	$('.dec-time-list').on("click", function () {
		$('.dec-time-filter-list').toggle();
	});

	$('.dec-organizer-list').on("click", function () {
		$('.dec-organizer-filter-list').toggle();
	});

	$('.dec-venue-list').on("click", function () {
		$('.dec-venue-filter-list').toggle();
	});


	$('.dec-country-list').on("click", function () {
		$('.dec-country-filter-list').toggle();
	});

	$('.dec-city-list').on("click", function () {
		$('.dec-city-filter-list').toggle();
	});
	$('.dec-state-list').on("click", function () {
		$('.dec-state-filter-list').toggle();
	});
	$('.dec-years-list').on("click", function () {
		$('.dec-year-filter-list').toggle();
	});

	$('.dec-months-list').on("click", function () {
		$('.dec-month-filter-list').toggle();
	});
	$('.dec-days-list').on("click", function () {
		$('.dec-day-filter-list').toggle();
	});

	$('.dec-status-list').on("click", function () {
		$('.dec-status-filter-list').toggle();
	});

	$('.dec-order-list').on("click", function () {
		$('.dec-order-filter-list').toggle();
	});
	$('.dec-future-past-list').on("click", function () {
		$('.dec-future-past-filter-list').toggle();
	});
	$(".show_collapse_show").show();
	$(".show_collapse_hide").hide();
	// 	}
	//    });

	let module_css_filter = jQuery("input[name='module-css-filter']").val();

	var mainClass = "";

	$('.decm_event_display').each(function (i, item) {

		var classfilter = jQuery(item).attr('class').split(/\s+/);

		// console.log("module class");
		//  console.log(classfilter);

		$.each(classfilter, function (index, item) {

			if (module_css_filter != '' && item != '') {
				if (item == module_css_filter) {
					mainClass = "." + item;

				}
			} else if (item.match(/decm_event_display_/g)) {
				mainClass = "." + item;

			}

		});
		//test


	});

	//console.log(mainClass,"main class");

	$('.dec-filter-event-inline li').on("click", function () {
		$('li.dec-filter-select ').removeClass('dec-filter-select ');
		$(this).addClass('dec-filter-select');
		var dataId = $(this).data("id");
		$(mainClass + ' #dec-eventfeed-category').val(dataId);
	});


	$('.custom__ul_boxes .custom__li_filter').on("click", function () {
		$(this).removeClass('dec-filter-select');
		$(this).addClass('dec-filter-select');
		var dataId = $(this).data("id");
		$(mainClass + ' #dec-eventfeed-category').val(dataId);
	});

	$('.custom__input').change(function() {
		var listItem = $(this).closest('div');
		
		if ($(this).prop('checked')) {
			console.log('Checkbox is checked');
			listItem.addClass('dec-filter-select');
		} else {
			console.log('Checkbox is unchecked');
			listItem.removeClass('dec-filter-select');
		}
	});

	$('#dec-filter-remove').click(function() {
		$('.dec-filter-select').removeClass('dec-filter-select');
	});

	$("#dec-event-filters-icon").on("click", function () {

		$(".dec-search-filter").toggle();

		if ($(".dec-search-filter").is(':visible')) {
			$(".dec_collapse_filters_events").html(eventFilterHide);
		} else {
			$(".dec_collapse_filters_events").html(eventFilterShow);
		}

	});


	$(document).on('mouseup', function (e) {

		var container = new Array();
		container.push($('.dec-organizer-filter-list'));
		container.push($('.dec-event-category-filter-list'));
		container.push($('.dec-price-filter-list'));
		container.push($('.dec-month-filter-list'));
		container.push($('.dec-tag-filter-list'));
		container.push($('.dec-venue-filter-list'));
		container.push($('.dec-day-filter-list'));
		container.push($('.dec-time-filter-list'));
		container.push($('.dec-year-filter-list'));
		container.push($('.dec-city-filter-list'));
		container.push($('.dec-country-filter-list'));
		container.push($('.dec-state-filter-list'));
		container.push($('.dec-location-filter-list'));
		container.push($('.dec-order-filter-list'));
		container.push($('.dec-recurring-filter-list'));
		container.push($('.dec-status-filter-list'));
		container.push($('.dec-future-past-filter-list'));

		$.each(container, function (key, value) {
			if (!$(value).is(e.target)
				&& $(value).has(e.target).length === 0) {
				$(value).fadeOut();
			}
		});

	});


	var Today = jQuery("input[name='dec-daterange-today-text']").val();
	var Tomorrow = jQuery("input[name='dec-daterange-tomorrow-text']").val();
	var Next_7_days = jQuery("input[name='dec-daterange-next-7-days-text']").val();
	var Next_30_days = jQuery("input[name='dec-daterange-next-30-days-text']").val();
	var This_month = jQuery("input[name='dec-daterange-this-month-text']").val();
	var Next_month = jQuery("input[name='dec-daterange-next-month-text']").val();
	var Custom_range = jQuery("input[name='dec-daterange-custom-range-text']").val();
//	var Custom = jQuery("input[name='dec-daterange-custom-range-text']").val();

	var dec_month_january = jQuery("input[name='dec-month-january-text']").val();
	var dec_month_february = jQuery("input[name='dec-month-february-text']").val();
	var dec_month_march = jQuery("input[name='dec-month-march-text']").val();
	var dec_month_april = jQuery("input[name='dec-month-april-text']").val();
	var dec_month_may = jQuery("input[name='dec-month-may-text']").val();
	var dec_month_june = jQuery("input[name='dec-month-june-text']").val();
	var dec_month_july = jQuery("input[name='dec-month-july-text']").val();
	var dec_month_august = jQuery("input[name='dec-month-august-text']").val();
	var dec_month_september = jQuery("input[name='dec-month-september-text']").val();
	var dec_month_october = jQuery("input[name='dec-month-october-text']").val();
	var dec_month_november = jQuery("input[name='dec-month-november-text']").val();
	var dec_month_december = jQuery("input[name='dec-month-december-text']").val();

	var dec_day_sunday = jQuery("input[name='dec-day-sunday-text']").val();
	var dec_day_monday = jQuery("input[name='dec-day-monday-text']").val();
	var dec_day_tuesday = jQuery("input[name='dec-day-tuesday-text']").val();
	var dec_day_wednesday = jQuery("input[name='dec-day-wednesday-text']").val();
	var dec_day_thursday = jQuery("input[name='dec-day-thursday-text']").val();
	var dec_day_friday = jQuery("input[name='dec-day-friday-text']").val();
	var dec_day_saturday = jQuery("input[name='dec-day-saturday-text']").val();

	var decCancelButton = jQuery("input[name='dec-cancel-button-text']").val();
	var decApplyButton = jQuery("input[name='dec-apply-button-text']").val();
	var decDateRange = jQuery("input[name='dec-date-range-text']").val();
	var decDateRangeCase = jQuery("input[name='dec-date-range-format']").val();
	var decDateRangeFormat = typeof decDateRangeCase === 'string' ? decDateRangeCase.toUpperCase() : 'MMMM D, YYYY';
	// var decDateRangeFormat = decDateRangeCase.toUpperCase();

	
	moment.updateLocale("de", {
		months : [
			dec_month_january,
			dec_month_february,
			dec_month_march,
			dec_month_april,
			dec_month_may,
			dec_month_june,
			dec_month_july,
			dec_month_august,
			dec_month_september,
			dec_month_october,
			dec_month_november,
			dec_month_december
		],	
	//	monthsShort : ['Jan', 'Feb', 'März', 'Apr', 'Mai', 'Juni', 'Juli', 'Aug', 'Sept', 'Okt', 'Nov', 'Dez']
	});
	

	$('#reportrange').daterangepicker({
		"locale": {
			format: decDateRangeFormat,
			cancelLabel: decCancelButton,
			applyLabel: decApplyButton,
			"daysOfWeek": [
				dec_day_sunday,
				dec_day_monday,
				dec_day_tuesday,
				dec_day_wednesday,
				dec_day_thursday,
				dec_day_friday,
				dec_day_saturday
			],
			"monthNames": [
				dec_month_january,
				dec_month_february,
				dec_month_march,
				dec_month_april,
				dec_month_may,
				dec_month_june,
				dec_month_july,
				dec_month_august,
				dec_month_september,
				dec_month_october,
				dec_month_november,
				dec_month_december
			],	
		},
		autoUpdateInput: false,
		ranges: {
			[Today] : [moment(), moment()],
			[Tomorrow] : [moment().add(1, 'days'), moment().add(1, 'days')],
			[Next_7_days] : [moment(), moment().add(6, 'days')],
			[Next_30_days] : [moment(), moment().add(29, 'days')],
			[This_month] : [moment().startOf('month'), moment().endOf('month')],
			[Next_month] : [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
		}
	});

	jQuery('[data-range-key="Custom Range"]').text(Custom_range);


	$('#reportrange').on('apply.daterangepicker', function (ev, picker) {
		$('#dec-date-current-select').html(picker.startDate.format(decDateRangeFormat) + ' - ' + picker.endDate.format(decDateRangeFormat));
		jQuery(mainClass + " input[name='EventstartDate']").val(picker.startDate.format('YYYY-MM-DD'));
		jQuery(mainClass + " input[name='EventendDate']").val(picker.endDate.format('YYYY-MM-DD'));
		jQuery('#reportrange').addClass("dec-filter-select");
		jQuery('.dec-date-range-remove').css({ "display": "initial" });
	});

	$(' #reportrange').on('cancel.daterangepicker', function (ev, picker) {
		$('#dec-date-current-select').html('<span>'+ decDateRange +'</span>');
		jQuery(mainClass + " input[name='EventstartDate']").val('');
		jQuery(mainClass + " input[name='EventendDate']").val('');
		jQuery('#reportrange').removeClass("dec-filter-select");
		jQuery('.dec-date-range-remove').css({ "display": "none" });
	});


	let maxCost = jQuery("input[name='EventcostValue']").val();
	let EventCurrencySymbol = jQuery("input[name='EventCurrencySymbol']").val();
	

	$("#eventCostslider").slider({
		range: true,
		min: 0,
		max: maxCost,
		values: [0, maxCost],
		slide: function (event, ui) {
			$("#Eventprice").val(EventCurrencySymbol + ui.values[0] + " - " + EventCurrencySymbol + ui.values[1]);
			jQuery(mainClass + " input[name='EventcostMax']").val(ui.values[1]);
			jQuery(mainClass + " input[name='EventcostMin']").val(ui.values[0]);
		}
	});

	$("#Eventprice").val(EventCurrencySymbol + $("#eventCostslider").slider("values", 0) +
		" - "+ EventCurrencySymbol + $("#eventCostslider").slider("values", 1));


	//   $('.dec-filter-header' ).parent().parent().css({"display": "block"});;
	$('.decm_event_display').parent().parent().css({ "z-index": "0" });

	jQuery('input[name=\'dec_filter_organizer\'], .dec-organizer-list').on("click", function () {

		var selectedOrganizer = new Array();
		var selectedOrganizerId = new Array();
		$(" input[name='dec_filter_organizer']:checked").each(function () {
			selectedOrganizer.push(" " + this.value);
			selectedOrganizerId.push(this.id);
		});

		if (selectedOrganizer.length > 0) {
			$(mainClass + ' #dec-eventfeed-organizer').val(selectedOrganizerId);
			$('#dec-organizer-current-select').html(": " + selectedOrganizer);
			$('#dec-organizer-current-select').parent().addClass("dec-filter-select");
			$('.dec-organizer-remove').css({ "display": "initial" });
		} else if (jQuery(this).text() != '') {
			var text = jQuery(this).text();
			var dataId = $(this).data("id");
			$(mainClass + ' #dec-eventfeed-organizer').val(dataId);
			//	$('.organizer-filter-selection-list' ).html("<span class='organizer-filter-selection'>"+ text +"</span>");	
			$('#dec-organizer-current-select').html(": " + text);
			$('#dec-organizer-current-select').parent().addClass("dec-filter-select");
			$('.dec-organizer-remove').css({ "display": "initial" });
		} else {
			$('#dec-eventfeed-organizer').val("");
			$('#dec-organizer-current-select').html("");
			$('#dec-organizer-current-select').parent().removeClass("dec-filter-select");
			$('.dec-organizer-remove').css({ "display": "none" });
		}


	});

	$('#dec-filter-search__input').on("click keydown", function (event) {
		var keycode = event.which;
		if (keycode == '13') {
			var filter_search = $('#dec-filter-search__input').val();
			$(mainClass + ' #dec-filter-search').val(filter_search);
		}
	});

	$('#dec-find-events').on("click", function () {
		var filter_search = $('#dec-filter-search__input').val();
		$(mainClass + ' #dec-filter-search').val(filter_search);
	});

	jQuery('input[name=\'dec_filter_category\'], .decm-filter-catrgory-list').on("click", function () {

		var selectedCategory = new Array();
		var selectedCategoryId = new Array();
		$(" input[name='dec_filter_category']:checked").each(function () {
			selectedCategory.push(" " + this.value);
			selectedCategoryId.push(this.id);
		});

		if (selectedCategory.length > 0) {
			$(mainClass + ' #dec-eventfeed-category').val(selectedCategoryId);
			$('.event-category-filter-selection-list').html("<span class='event-category-filter-selection'>" + selectedCategory + "</span>");
			$('#dec-event-current-select').html(": " + selectedCategory);
			$('#dec-event-current-select').parent().addClass("dec-filter-select");
			$('.dec-category-remove').css({ "display": "initial" });
		} else if (jQuery(this).text() != '') {
			//	console.log('event category if');
			var text = jQuery(this).text();
			var dataId = $(this).data("id");
			$(mainClass + ' #dec-eventfeed-category').val(dataId);
			$('.event-category-filter-selection-list').html("<span class='event-category-filter-selection'>" + text + "</span>");
			$('#dec-event-current-select').html(": " + text);
			$('#dec-event-current-select').parent().addClass("dec-filter-select");
			$('.dec-category-remove').css({ "display": "initial" });
		} else {
			$('#dec-event-current-select').parent().removeClass("dec-filter-select");
			$('.dec-category-remove').css({ "display": "none" });
			$('#dec-event-current-select').html("");
			$(mainClass + ' #dec-eventfeed-category').val("");
		}

		//	console.log(jQuery(this).text());
	});

	jQuery('input[name=\'dec_filter_tag\'], .dec-tag-list').on("click", function () {

		var selectedTag = new Array();
		var selectedTagId = new Array();
		$(" input[name='dec_filter_tag']:checked").each(function () {
			selectedTag.push(" " + this.value);
			selectedTagId.push(this.id);
		});

		if (selectedTag.length > 0) {
			$(mainClass + ' #dec-eventfeed-tag').val(selectedTagId);
			$('#dec-tag-current-select').html(": " + selectedTag);
			$('#dec-tag-current-select').parent().addClass("dec-filter-select");
			$('.dec-tag-remove').css({ "display": "initial" });
		} else if (jQuery(this).text() != '') {
			var text = jQuery(this).text();
			var dataId = $(this).data("id");
			$(mainClass + ' #dec-eventfeed-tag').val(dataId);
			$('#dec-tag-current-select').html(": " + text);
			$('#dec-tag-current-select').parent().addClass("dec-filter-select");
			$('.dec-tag-remove').css({ "display": "initial" });
		} else {
			$('#dec-eventfeed-tag').val("");
			$('#dec-tag-current-select').html("");
			$('#dec-tag-current-select').parent().removeClass("dec-filter-select");
			$('.dec-tag-remove').css({ "display": "none" });
		}

		//	console.log(jQuery(this).text(),"Tag click");
	});


	jQuery('input[name=\'dec_filter_venue\'], .dec-venue-list').on("click", function () {

		var selectedVenue = new Array();
		var selectedId = new Array();
		$(" input[name='dec_filter_venue']:checked").each(function () {
			selectedVenue.push(" " + this.value);
			selectedId.push(this.id);
		});


		if (selectedVenue.length > 0) {

			$(mainClass + ' #dec-eventfeed-venue').val(selectedId);
			//$('.dec-venue-filter-selection-list' ).html("<span class='venue-filter-selection'>"+ selectedVenue +"</span>");
			$('#dec-venue-current-select').html(": " + selectedVenue);
			$('#dec-venue-current-select').parent().addClass("dec-filter-select");
			$('.dec-venue-remove').css({ "display": "initial" });

		} else if (jQuery(this).text() != '') {
			var text = jQuery(this).text();
			var dataId = $(this).data("id");
			$(mainClass + ' #dec-eventfeed-venue').val(dataId);
			//$('.dec-venue-filter-selection-list' ).html("<span class='venue-filter-selection'>"+ text +"</span>");
			$('#dec-venue-current-select').html(": " + text);
			$('#dec-venue-current-select').parent().addClass("dec-filter-select");
			$('.dec-venue-remove').css({ "display": "initial" });
		} else {
			$(mainClass + ' #dec-eventfeed-venue').val("");
			//$('.dec-venue-filter-selection-list' ).html("<span class='venue-filter-selection'>"+ selectedVenue +"</span>");
			$('#dec-venue-current-select').html(" ");
			$('#dec-venue-current-select').parent().removeClass("dec-filter-select");
			$('.dec-venue-remove').css({ "display": "none" });
		}

		//	console.log(jQuery(this).text(),"Venue click");

	});

	jQuery('input[name=\'dec_filter_location\'], .dec-location-list').on("click", function () {

		var selectedLocation = new Array();
		//var selectedCityId = new Array();
		$(" input[name='dec_filter_location']:checked").each(function () {
			selectedLocation.push(" " + this.value);
			//	selectedCityId.push(this.id);
		});

		if (selectedLocation.length > 0) {
			$(mainClass + ' #dec-eventfeed-address').val(selectedLocation);
			$('#dec-location-current-select').html(": " + selectedLocation);
			$('#dec-location-current-select').parent().addClass("dec-filter-select");
			$('.dec-location-remove').css({ "display": "initial" });
		} else if (jQuery(this).text() != '') {
			var text = jQuery(this).text();
			//	var dataId = $(this).data("id");
			$(mainClass + ' #dec-eventfeed-address').val(text);
			$('.dec-location-filter-selection-list').html("<span class='location-filter-selection'>" + text + "</span>");
			$('#dec-location-current-select').html(": " + text);
			$('#dec-location-current-select').parent().addClass("dec-filter-select");
			$('.dec-location-remove').css({ "display": "initial" });
		} else {
			$('#dec-eventfeed-address').val('');
			$('#dec-location-current-select').html("");
			$('#dec-location-current-select').parent().removeClass("dec-filter-select");
			$('.dec-location-remove').css({ "display": "none" });
		}

	});


	jQuery('.dec-time-filter-list li').on("click", function () {
		var selectedTime = new Array();
		var selectedTimeId = new Array();
		$(" input[name='dec_filter_time']:checked").each(function () {
			selectedTime.push(" " + this.value);
			selectedTimeId.push(this.id);
		});


		if (selectedTime.length > 0) {
			$(mainClass + ' #dec-eventfeed-time').val(selectedTimeId);
			$('#dec-time-current-select').html(": " + selectedTime);
			$('#dec-time-current-select').parent().addClass("dec-filter-select");
			$('.dec-time-remove').css({ "display": "initial" });
		} else if (jQuery(this).text() != '') {
			var text = jQuery(this).text();
			var dataId = $(this).data("id");
			$(mainClass + ' #dec-eventfeed-time').val(dataId);
			// $('#event-time').val(selectedTime);
			$('#dec-time-current-select').html(": " + text);
			$('#dec-time-current-select').parent().addClass("dec-filter-select");
			$('.dec-time-remove').css({ "display": "initial" });
		} else {
			$(mainClass + ' #dec-eventfeed-time').val("");
			$('#dec-time-current-select').html("");
			$('#dec-time-current-select').parent().removeClass("dec-filter-select");
			$('.dec-time-remove').css({ "display": "none" });
		}
		//	console.log(jQuery(this).text(),"time click");

	});


	jQuery('input[name=\'dec_filter_days\'], .dec-days-list').on("click", function () {
		var selectedDays = new Array();
		var selectedDaysids = new Array();
		$(" input[name='dec_filter_days']:checked").each(function () {
			selectedDays.push(" " + this.value);
			selectedDaysids.push(" " + this.id);
		});

		if (selectedDays.length > 0) {
			$(mainClass + ' #dec-eventfeed-day').val(selectedDaysids);
			$('#dec-day-current-select').html(": " + selectedDays);
			$('#dec-day-current-select').parent().addClass("dec-filter-select");
			$('.dec-day-remove').css({ "display": "initial" });
		} else if (jQuery(this).text() != '') {
			var text = jQuery(this).text();
			var dataId = $(this).data("id");
			$(mainClass + ' #dec-eventfeed-day').val(dataId);
			$('#dec-day-current-select').html(": " + text);
			$('#dec-day-current-select').parent().addClass("dec-filter-select");
			$('.dec-day-remove').css({ "display": "initial" });
		} else {
			$(mainClass + '#dec-eventfeed-day').val("");
			$('#dec-day-current-select').html("");
			$('#dec-day-current-select').parent().removeClass("dec-filter-select");
			$('.dec-day-remove').css({ "display": "none" });
		}

		//	console.log(jQuery(this).text(),"Day click");
	});


	jQuery('input[name=\'dec_filter_city\'], .dec-city-list').on("click", function () {

		var selectedCity = new Array();
		//var selectedCityId = new Array();
		$(" input[name='dec_filter_city']:checked").each(function () {
			selectedCity.push(" " + this.value);
			//	selectedCityId.push(this.id);
		});

		if (selectedCity.length > 0) {
			$(mainClass + ' #dec-eventfeed-city').val(selectedCity);
			$('#dec-city-current-select').html(": " + selectedCity);
			$('#dec-city-current-select').parent().addClass("dec-filter-select");
			$('.dec-city-remove').css({ "display": "initial" });
		} else if (jQuery(this).text() != '') {
			var text = jQuery(this).text();
			//	var dataId = $(this).data("id");
			$(mainClass + ' #dec-eventfeed-city').val(text);
			$('#dec-city-current-select').html(": " + text);
			$('#dec-city-current-select').parent().addClass("dec-filter-select");
			$('.dec-city-remove').css({ "display": "initial" });
		} else {
			$(mainClass + ' #dec-eventfeed-city').val("");
			$('#dec-city-current-select').html("");
			$('#dec-city-current-select').parent().removeClass("dec-filter-select");
			$('.dec-city-remove').css({ "display": "none" });
		}


	});

	jQuery('input[name=\'dec_filter_state\'], .dec-state-list').on("click", function () {

		var selectedState = new Array();
		//var selectedCityId = new Array();
		$(" input[name='dec_filter_state']:checked").each(function () {
			selectedState.push(" " + this.value);
			//	selectedCityId.push(this.id);
		});

		if (selectedState.length > 0) {
			$(mainClass + ' #dec-eventfeed-state').val(selectedState);
			$('#dec-state-current-select').html(": " + selectedState);
			$('#dec-state-current-select').parent().addClass("dec-filter-select");
			$('.dec-state-remove').css({ "display": "initial" });
		} else if (jQuery(this).text() != '') {
			var text = jQuery(this).text();
			//	var dataId = $(this).data("id");
			$(mainClass + ' #dec-eventfeed-state').val(text);
			$('#dec-state-current-select').html(": " + text);
			$('#dec-state-current-select').parent().addClass("dec-filter-select");
			$('.dec-state-remove').css({ "display": "initial" });
		} else {
			$(mainClass + ' #dec-eventfeed-state').val("");
			$('#dec-state-current-select').html("");
			$('#dec-state-current-select').parent().removeClass("dec-filter-select");
			$('.dec-state-remove').css({ "display": "none" });
		}

	});


	jQuery('input[name=\'dec_filter_country\'], .dec-country-list').on("click", function () {

		var selectedCountry = new Array();
		$("input[name='dec_filter_country']:checked").each(function () {
			selectedCountry.push(" " + this.value);
		});

		if (selectedCountry.length > 0) {
			$(mainClass + ' #dec-eventfeed-country').val(selectedCountry);
			$('#dec-country-current-select').html(": " + selectedCountry);
			$('#dec-country-current-select').parent().addClass("dec-filter-select");
			$('.dec-country-remove').css({ "display": "initial" });
		} else if (jQuery(this).text() != '') {
			var text = jQuery(this).text();
			$(mainClass + ' #dec-eventfeed-country').val(text);
			$('#dec-country-current-select').html(": " + text);
			$('#dec-country-current-select').parent().addClass("dec-filter-select");
			$('.dec-country-remove').css({ "display": "initial" });
		} else {
			$(mainClass + ' #dec-eventfeed-country').val("");
			$('#dec-country-current-select').html("");
			$('#dec-country-current-select').parent().removeClass("dec-filter-select");
			$('.dec-country-remove').css({ "display": "none" });
		}

	});


	jQuery('input[name=\'dec_filter_months\'], .dec-months-list').on("click", function () {

		var selectedMonths = new Array();
		var selectedMonthsId = new Array();
		$("input[name='dec_filter_months']:checked").each(function () {
			selectedMonths.push(" " + this.value);
			selectedMonthsId.push(this.id);
		});

		if (selectedMonths.length > 0) {
			$(mainClass + ' #dec-eventfeed-month').val(selectedMonthsId);
			$('#dec-month-current-select').html(": " + selectedMonths);
			$('#dec-month-current-select').parent().addClass("dec-filter-select");
			$('.dec-month-remove').css({ "display": "initial" });
		} else if (jQuery(this).text() != '') {
			var text = jQuery(this).text();
			var dataId = $(this).data("id");
			$(mainClass + ' #dec-eventfeed-month').val(dataId);
			$('#dec-month-current-select').html(": " + text);
			$('#dec-month-current-select').parent().addClass("dec-filter-select");
			$('.dec-month-remove').css({ "display": "initial" });
		} else {
			$(mainClass + ' #dec-eventfeed-month').val("");
			$('#dec-month-current-select').html("");
			$('#dec-month-current-select').parent().removeClass("dec-filter-select");
			$('.dec-month-remove').css({ "display": "none" });
		}
		//$('.dec-month-filter-selection-list' ).html("<span class='venue-filter-selection'>"+ text +"</span>");
	});



	jQuery('input[name=\'dec_filter_status\'], .dec-status-list').on("click", function () {

		var selectedStatus = new Array();
		var selectedStatusId = new Array();
		$("input[name='dec_filter_status']:checked").each(function () {
			selectedStatus.push(" " + this.value);
			selectedStatusId.push(this.id);
		});

		if (selectedStatus.length > 0) {
			$(mainClass + ' #dec-eventfeed-status').val(selectedStatusId);
			$('#dec-status-current-select').html(": " + selectedStatus);
			$('#dec-status-current-select').parent().addClass("dec-filter-select");
			$('.dec-status-remove').css({ "display": "initial" });
		} else if (jQuery(this).text() != '') {
			var text = jQuery(this).text();
			var dataId = $(this).data("id");
			$(mainClass + ' #dec-eventfeed-status').val(dataId);
			$('#dec-status-current-select').html(": " + text);
			$('#dec-status-current-select').parent().addClass("dec-filter-select");
			$('.dec-status-remove').css({ "display": "initial" });
		} else {
			$(mainClass + ' #dec-eventfeed-status').val("");
			$('#dec-status-current-select').html("");
			$('#dec-status-current-select').parent().removeClass("dec-filter-select");
			$('.dec-status-remove').css({ "display": "none" });
		}
		//$('.dec-month-filter-selection-list' ).html("<span class='venue-filter-selection'>"+ text +"</span>");
	});


	jQuery('.dec-order-filter-list li').on("click", function () {

		var text = jQuery(this).text();
		var dataId = $(this).data("id");

		$(mainClass + ' #dec-eventfeed-order').val(dataId);
		$('#dec-order-current-select').html(": " + text);

		$('#dec-order-current-select').parent().addClass("dec-filter-select");
		$('.dec-order-remove').css({ "display": "initial" });

	});


	jQuery('.dec-recurring-filter-list li').on("click", function () {

		var text = jQuery(this).text();
		var dataId = $(this).data("id");
		$(mainClass + ' #dec-eventfeed-recurring').val(dataId);
		$('#dec-recurring-current-select').html(": " + text);


		$('#dec-recurring-current-select').parent().addClass("dec-filter-select");
		$('.dec-recurring-remove').css({ "display": "initial" });

	});

	jQuery('input[name=\'dec_filter_future_past\'], .dec-future-past-list').on("click", function () {

		var selectedStatus = new Array();
		var selectedStatusId = new Array();
		$("input[name='dec_filter_future_past']:checked").each(function () {
			selectedStatus.push(" " + this.value);
			selectedStatusId.push(this.id);
		});

		if (selectedStatus.length > 0) {
			$(mainClass + ' #dec-eventfeed-future-past').val(selectedStatusId);
			$('#dec-future-past-current-select').html(": " + selectedStatus);
			$('#dec-future-past-current-select').parent().addClass("dec-filter-select");
			$('.dec-future-past-remove').css({ "display": "initial" });
		} else if (jQuery(this).text() != '') {
			var text = jQuery(this).text();
			var dataId = $(this).data("id");
			$(mainClass + ' #dec-eventfeed-future-past').val(dataId);
			$('#dec-future-past-current-select').html(": " + text);
			$('#dec-future-past-current-select').parent().addClass("dec-filter-select");
			$('.dec-future-past-remove').css({ "display": "initial" });
		} else {
			$(mainClass + ' #dec-eventfeed-future-past').val("");
			$('#dec-future-past-current-select').html("");
			$('#dec-future-past-current-select').parent().removeClass("dec-filter-select");
			$('.dec-future-past-remove').css({ "display": "none" });
		}
		//$('.dec-month-filter-selection-list' ).html("<span class='venue-filter-selection'>"+ text +"</span>");
	});
	jQuery('input[name=\'dec_filter_years\'], .dec-years-list').on("click", function () {
		var selectedYear = new Array();
		var selectedYearId = new Array();
		$(" input[name='dec_filter_years']:checked").each(function () {
			selectedYear.push(" " + this.value);
			selectedYearId.push(this.id);
		});

		if (selectedYear.length > 0) {
			$(mainClass + ' #dec-eventfeed-year').val(selectedYearId);
			$('#dec-year-current-select').html(": " + selectedYear);
			$('#dec-year-current-select').parent().addClass("dec-filter-select");
			$('.dec-year-remove').css({ "display": "initial" });
		} else if (jQuery(this).text() != '') {
			var text = jQuery(this).text();
			var dataId = $(this).data("id");
			$(mainClass + ' #dec-eventfeed-year').val(dataId);
			$('#dec-year-current-select').html(": " + text);
			$('#dec-year-current-select').parent().addClass("dec-filter-select");
			$('.dec-year-remove').css({ "display": "initial" });
		} else {
			$(mainClass + ' #dec-eventfeed-year').val("");
			$('#dec-year-current-select').html("");
			$('#dec-year-current-select').parent().removeClass("dec-filter-select");
			$('.dec-year-remove').css({ "display": "none" });
		}

	});


	jQuery('#eventCostslider, #eventCostslider .ui-slider-range, #eventCostslider > .ui-slider-handle').on("click", function () {
		var EventcostMax = jQuery('#EventcostMax').val();
		var EventcostMin = jQuery('#EventcostMin').val();
		//	$('#dec-price-current-select' ).html("<span class='price-filter-selection'>"+ EventcostMin +"- " + EventcostMax +"</span>");
		$('#dec-price-current-select').html("("+EventCurrencySymbol+"): " + EventcostMin + "-" + EventcostMax);
		$('#dec-price-current-select').parent().addClass("dec-filter-select");
		$('.dec-price-remove').css({ "display": "initial" });
	});


	$('.dec-city-filter').on("click", function () {
		$('.dec-city-filter-list').toggle();
	});

	$('.dec-country-filter').on("click", function () {
		$('.dec-country-filter-list').toggle();
	});

	$('.dec-state-filter').on("click", function () {
		$('.dec-state-filter-list').toggle();
	});

	$('.dec-filter-order-by').on("click", function () {
		$('.dec-order-filter-list').toggle();

	});

	$('.dec-organizer-filter').on("click", function () {
		$('.dec-organizer-filter-list').toggle();
	});

	$('.dec-filter-cost').on("click", function () {
		$('.dec-price-filter-list').toggle();

	});

	$('.dec-filter-year').on("click", function () {
		$('.dec-year-filter-list').toggle();
	});

	$('.dec-filter-event-category').on("click", function () {
		$('.dec-event-category-filter-list').toggle();
	});


	$('.dec-filter-month').on("click", function () {
		$('.dec-month-filter-list').toggle();
	});
	$('.dec-filter-future-past-by').on("click", function () {
		$('.dec-future-past-filter-list').toggle();

	});

	$('.dec-filter-location').on("click", function () {
		$('.dec-location-filter-list').toggle();
	});


	$('.dec-filter-tag').on("click", function () {
		$('.dec-tag-filter-list').toggle();
	});


	$('.dec-venue-filter').on("click", function () {
		$('.dec-venue-filter-list').toggle();
	});


	$('.dec-filter-time').on("click", function () {
		$('.dec-time-filter-list').toggle();

	});

	$('.dec-filter-status').on("click", function () {
		$('.dec-status-filter-list').toggle();

	});

	$('.dec-filter-day').on("click", function () {
		$('.dec-day-filter-list').toggle();
	});

	$('.dec-filter-recurring').on("click", function () {
		$('.dec-recurring-filter-list').toggle();
	});


	jQuery('.dec-date-range-remove').on("click", function () {
		$('#dec-date-current-select').html('<span>'+ decDateRange +'</span>');
		$('#reportrange').removeClass("dec-filter-select");
		jQuery('.dec-date-range-remove').css({ "display": "none" });
		$(mainClass + ' #EventstartDate').val("");
		$(mainClass + ' #EventendDate').val("");
	});

	jQuery('.dec-organizer-remove').on("click", function () {
		$("input[name='dec_filter_organizer']").prop('checked', false);
		$('#dec-organizer-current-select').html("");
		$(mainClass + ' #dec-eventfeed-organizer').val("");
		$('.organizer-filter-selection-list').html("");
		$('#dec-organizer-current-select').parent().removeClass("dec-filter-select");
		$(this).css({ "display": "none" });
		$('.dec-venue-filter-list').hide();
		$('.dec-month-filter-list').hide();
	});

	jQuery('.dec-venue-remove').on("click", function () {
		$("input[name='dec_filter_venue']").prop('checked', false);
		$('#dec-venue-current-select').html("");
		$(mainClass + ' #dec-eventfeed-venue').val("");
		$('.dec-venue-filter-selection-list').html("");
		$('#dec-venue-current-select').parent().removeClass("dec-filter-select");
		$(this).css({ "display": "none" });
		$('.dec-venue-filter-list').hide();
	});

	jQuery('.dec-year-remove').on("click", function () {
		$("input[name='dec_filter_years']").prop('checked', false);
		$('#dec-year-current-select').html("");
		$(mainClass + ' #dec-eventfeed-year').val("");
		$('.dec-year-filter-selection-list').html("");
		$('#dec-year-current-select').parent().removeClass("dec-filter-select");
		$(this).css({ "display": "none" });
		$('.dec-year-filter-list').hide();
	});

	jQuery('.dec-price-remove').on("click", function () {
		$('#dec-price-current-select').html("");
		$(mainClass + ' #EventcostMax').val("");
		$(mainClass + ' #EventcostMin').val("");
		$('#dec-price-current-select').parent().removeClass("dec-filter-select");
		$(this).css({ "display": "none" });
		$('.dec-price-filter-list').hide();
	});

	jQuery('.dec-month-remove').on("click", function () {
		$("input[name='dec_filter_months']").prop('checked', false);
		$('#dec-month-current-select').html("");
		$(mainClass + ' #dec-eventfeed-month').val("");
		$('.dec-month-filter-selection-list').html("");
		$('#dec-month-current-select').parent().removeClass("dec-filter-select");
		$(this).css({ "display": "none" });
		$('.dec-month-filter-list').hide();
	});

	jQuery('.dec-day-remove').on("click", function () {
		$("input[name='dec_filter_days']").prop('checked', false);
		$('#dec-day-current-select').html("");
		$(mainClass + ' #dec-eventfeed-day').val("");
		$('.dec-day-filter-selection-list').html("");
		$('#dec-day-current-select').parent().removeClass("dec-filter-select");
		$(this).css({ "display": "none" });
		$('.dec-day-filter-list').hide();
	});


	jQuery('.dec-time-remove').on("click", function () {
		$("input[name='dec_filter_time']").prop('checked', false);
		$('#dec-time-current-select').html("");
		$(mainClass + ' #dec-eventfeed-time').val("");
		$('.dec-time-filter-selection-list').html("");
		$('#dec-time-current-select').parent().removeClass("dec-filter-select");
		$(this).css({ "display": "none" });
		$('.dec-time-filter-list').hide();
	});

	jQuery('.dec-tag-remove').on("click", function () {
		$("input[name='dec_filter_tag']").prop('checked', false);
		$('#dec-tag-current-select').html("");
		$('.tag-filter-selection-list').html("");
		$(mainClass + ' #dec-eventfeed-tag').val("");
		$('#dec-tag-current-select').parent().removeClass("dec-filter-select");
		$(this).css({ "display": "none" });
		$('.dec-tag-filter-list').hide();
	});

	jQuery('.dec-category-remove').on("click", function () {
		$("input[name='dec_filter_category']").prop('checked', false);
		$('#dec-event-current-select').html("");
		$(mainClass + ' #dec-eventfeed-category').val("");
		$('.event-category-filter-selection-list').html("");
		$(this).css({ "display": "none" });
		$('#dec-event-current-select').parent().removeClass("dec-filter-select");
		$('.dec-event-category-filter-list').hide();
	});

	jQuery('.dec-city-remove').on("click", function () {
		$("input[name='dec_filter_city']").prop('checked', false);
		$('#dec-city-current-select').html("");
		$(mainClass + ' #dec-eventfeed-city').val("");
		$(this).css({ "display": "none" });
		$('#dec-city-current-select').parent().removeClass("dec-filter-select");
		$('.dec-city-category-filter-list').hide();
	});

	jQuery('.dec-country-remove').on("click", function () {
		$("input[name='dec_filter_country']").prop('checked', false);
		$('#dec-country-current-select').html("");
		$(mainClass + ' #dec-eventfeed-country').val("");
		$(this).css({ "display": "none" });
		$('#dec-country-current-select').parent().removeClass("dec-filter-select");
		$('.dec-country-category-filter-list').hide();
	});


	jQuery('.dec-location-remove').on("click", function () {
		$("input[name='dec_filter_location']").prop('checked', false);
		$('#dec-location-current-select').html("");
		$(mainClass + ' #dec-eventfeed-address').val("");
		$(this).css({ "display": "none" });
		$('#dec-location-current-select').parent().removeClass("dec-filter-select");
		$('.dec-location-category-filter-list').hide();
	});

	jQuery('.dec-state-remove').on("click", function () {
		$("input[name='dec_filter_state']").prop('checked', false);
		$('#dec-state-current-select').html("");
		$(mainClass + ' #dec-eventfeed-state').val("");
		$(this).css({ "display": "none" });
		$('#dec-state-current-select').parent().removeClass("dec-filter-select");
		$('.dec-state-category-filter-list').hide();
	});

	jQuery('.dec-order-remove').on("click", function () {
		$("input[name='dec_filter_order']").prop('checked', false);
		$('#dec-order-current-select').html("");
		$(mainClass + ' #dec-eventfeed-order').val("");
		$(this).css({ "display": "none" });
		$('#dec-order-current-select').parent().removeClass("dec-filter-select");
		$('.dec-order-category-filter-list').hide();
	});
	jQuery('.dec-future-past-remove').on("click", function () {
		$("input[name='dec_filter_future_past']").prop('checked', false);
		$('#dec-future-past-current-select').html("");
		$(mainClass + ' #dec-eventfeed-future-past').val("");
		$(this).css({ "display": "none" });
		$('#dec-future-past-current-select').parent().removeClass("dec-filter-select");
		$('.dec-future-past-category-filter-list').hide();
	});
	jQuery('.dec-status-remove').on("click", function () {
		$("input[name='dec_filter_status']").prop('checked', false);
		$('#dec-status-current-select').html("");
		$(mainClass + ' #dec-eventfeed-status').val("");
		$(this).css({ "display": "none" });
		$('#dec-status-current-select').parent().removeClass("dec-filter-select");
		$('.dec-status-category-filter-list').hide();
	});

	jQuery('.dec-recurring-remove').on("click", function () {
		$("input[name='dec_filter_recurring']").prop('checked', false);
		$('#dec-recurring-current-select').html("");
		$(mainClass + ' #dec-eventfeed-recurring').val("");
		$(this).css({ "display": "none" });
		$('#dec-recurring-current-select').parent().removeClass("dec-filter-select");
		$('.dec-recurring-category-filter-list').hide();
	});

	jQuery('#dec-filter-remove').on("click", function () {
		$('li.dec-filter-select ').removeClass('dec-filter-select ');
		$(".dec-filter-label > button").hide();
		$("input[name='dec_filter_venue']").prop('checked', false);
		$("input[name='dec_filter_tag']").prop('checked', false);
		$("input[name='dec_filter_city']").prop('checked', false);
		$("input[name='dec_filter_future_past']").prop('checked', false);
		$("input[name='dec_filter_country']").prop('checked', false);
		$("input[name='dec_filter_location']").prop('checked', false);
		$("input[name='dec_filter_category']").prop('checked', false);
		$("input[name='dec_filter_organizer']").prop('checked', false);
		$("input[name='dec_filter_order']").prop('checked', false);
		$("input[name='dec_filter_months']").prop('checked', false);
		$("input[name='dec_filter_status']").prop('checked', false);
		$("input[name='dec_filter_time']").prop('checked', false);
		$("input[name='dec_filter_days']").prop('checked', false);
		$("input[name='dec_filter_years']").prop('checked', false);
		$("input[name='dec_filter_state']").prop('checked', false);
		$('#dec-tag-current-select').html("");
		$('#dec-order-current-select').html("");
		$('#dec-future-past-current-select').html("");
		$('#dec-venue-current-select').html("");
		$('#dec-event-current-select').html("");
		$('#dec-organizer-current-select').html("");
		$('#dec-month-current-select').html("");
		$('#dec-year-current-select').html("");
		$('#dec-price-current-select').html("");
		$('#dec-time-current-select').html("");
		$('#dec-day-current-select').html("");
		$('#dec-city-current-select').html("");
		$('#dec-state-current-select').html("");
		$('#dec-country-current-select').html("");
		$('#dec-location-current-select').html("");
		$('#dec-status-current-select').html("");
		$('#dec-recurring-current-select').html("");
		$('#dec-eventfeed-future-past').html("");
		$('#dec-filter-search__input').val("");
		$(mainClass + ' #dec-filter-search').val("");
		$(mainClass + ' #dec-eventfeed-location').val("");
		$(mainClass + ' #dec-eventfeed-country').val("");
		$(mainClass + ' #dec-eventfeed-city').val("");
		$(mainClass + ' #dec-eventfeed-order').val("");
		$(mainClass + ' #dec-eventfeed-tag').val("");
		$(mainClass + ' #dec-eventfeed-day').val("");
		$(mainClass + ' #dec-eventfeed-category').val("");
		$(mainClass + ' #dec-eventfeed-time').val("");
		$(mainClass + ' #dec-eventfeed-venue').val("");
		$(mainClass + ' #dec-eventfeed-organizer').val("");
		$(mainClass + ' #dec-eventfeed-month').val("");
		$(mainClass + ' #dec-eventfeed-year').val("");
		$(mainClass + ' #dec-eventfeed-state').val("");
		$(mainClass + ' #dec-eventfeed-address').val("");
		$(mainClass + ' #EventcostMax').val("");
		$(mainClass + ' #EventcostMin').val("");
		$(mainClass + ' #EventstartDate').val("");
		$(mainClass + ' #EventendDate').val("");
		$(mainClass + ' #dec-filter-search').val("");
		$(mainClass + ' #dec-eventfeed-status').val("");
		$(mainClass + ' #dec-eventfeed-recurring').val("");
		$(mainClass + ' #dec-eventfeed-future-past').val("");

		
		//	$(mainClass +' #eventfeed_current_page').val("0");
		
		$('#dec-date-current-select').html('<span>'+ decDateRange +'</span>');
		$('#dec-event-current-select').parent().removeClass("dec-filter-select");
		$('#dec-tag-current-select').parent().removeClass("dec-filter-select");
		$('#dec-month-current-select').parent().removeClass("dec-filter-select");
		$('#dec-year-current-select').parent().removeClass("dec-filter-select");
		$('#dec-venue-current-select').parent().removeClass("dec-filter-select");
		$('#dec-price-current-select').parent().removeClass("dec-filter-select");
		$('#dec-organizer-current-select').parent().removeClass("dec-filter-select");
		$('#dec-day-current-select').parent().removeClass("dec-filter-select");
		$('#dec-time-current-select').parent().removeClass("dec-filter-select");
		$('#dec-city-current-select').parent().removeClass("dec-filter-select");
		$('#dec-country-current-select').parent().removeClass("dec-filter-select");
		$('#dec-state-current-select').parent().removeClass("dec-filter-select");
		$('#dec-location-current-select').parent().removeClass("dec-filter-select");
		$('#dec-order-current-select').parent().removeClass("dec-filter-select");
		$('#dec-status-current-select').parent().removeClass("dec-filter-select");
		$('#dec-recurring-current-select').parent().removeClass("dec-filter-select");
		$('#dec-future-past-current-select').parent().removeClass("dec-filter-select");
		$('#reportrange').removeClass("dec-filter-select");
		$('.dec-filter-event-category-inline').removeClass("active");

	});

	var countOrganizer = $(".dec-organizer-filter-list").find("li").length;
	var countTag = $(".dec-tag-filter-list").find("li").length;
	var countVenue = $(".dec-venue-filter-list").find("li").length;
	var countCategory = $(".dec-event-category-filter-list").find("li").length;
	var countCity = $(".dec-city-filter-list").find("li").length;
	var countState = $(".dec-state-filter-list").find("li").length;
	var countCountry = $(".dec-country-filter-list").find("li").length;
	var countLocation = $(".dec-location-filter-list").find("li").length;

	// var countMonth = $(".dec-month-filter-list").find("li").length;
	// var countYear = $(".dec-year-filter-list").find("li").length;

	if (countOrganizer > 12) {
		$(".dec-organizer-filter-list").find("li").parent().addClass("dec-filter-scroll");
	}
	if (countTag > 12) {
		$(".dec-tag-filter-list").find("li").parent().addClass("dec-filter-scroll");
	}
	if (countVenue > 12) {
		$(".dec-venue-filter-list").find("li").parent().addClass("dec-filter-scroll");
	}
	if (countCategory > 12) {
		$(".dec-event-category-filter-list").find("li").parent().addClass("dec-filter-scroll");
	}

	if (countCity > 12) {
		$(".dec-city-filter-list").find("li").parent().addClass("dec-filter-scroll");
	}
	if (countState > 12) {
		$(".dec-state-filter-list").find("li").parent().addClass("dec-filter-scroll");
	}

	if (countCountry > 12) {
		$(".dec-country-filter-list").find("li").parent().addClass("dec-filter-scroll");
	}

	if (countLocation > 12) {
		$(".dec-location-filter-list").find("li").parent().addClass("dec-filter-scroll");
	}

});
