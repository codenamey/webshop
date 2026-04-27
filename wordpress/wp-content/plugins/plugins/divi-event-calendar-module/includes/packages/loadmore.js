jQuery(function ($) {

  jQuery('#eventfeed_current_page').val("1");

  jQuery(window).on("load", function () {


    let module_css_filter = jQuery("input[name='module-css-filter']").val();
    if (module_css_filter != "") {
      var mainClass = "." + module_css_filter;
    }

    if (module_css_filter == "" || module_css_filter == undefined) {
      let module_css_filter = jQuery("input[name='dec-eventfeed-module-class']").val();
      var mainClass = module_css_filter;
    }


    // $('.decm_event_display').each(function (i, item) {

    //   var classfilter = jQuery(item).attr('class').split(/\s+/);

    //   $.each(classfilter, function (index, item) {

    //     if (module_css_filter != '' && item != '') {
    //       if (item == module_css_filter) {
    //         mainClass = "." + item;
    //       }
    //     } else if (item.match(/decm_event_display_/g)) {
    //       mainClass = "." + item;
    //     }

    //   });
    //   //test

    // });

    let eventfeed_page = jQuery("input[name='eventfeed_page']").val();

    var eventFeed = $(window)[0][`eventFeed${mainClass.substr(1, mainClass.length)}`];

    let event_filter_page = jQuery(mainClass + " input[name='dec-eventfeed-page-translation']").val();
    let event_filter_page_first = jQuery(mainClass + " input[name='dec-eventfeed-first-translation']").val();
    let event_filter_page_last = jQuery(mainClass + " input[name='dec-eventfeed-last-translation']").val();
    let eventfeed_current_pagination_pages = jQuery(mainClass + " input[name='eventfeed_current_pagination_page']").val();
    let eventfeed_current_page = jQuery(mainClass + " input[name='eventfeed_current_page']").val();

    let eventfeed_prev_page = jQuery(mainClass + " input[name='eventfeed_prev_page']").val();
    let eventfeed_max_page = jQuery(mainClass + " input[name='eventfeed_max_page']").val();
  	let event_filter_search = jQuery(mainClass + " input[name='dec-filter-search']").val();
    //  let eventfeed_show_past = jQuery(mainClass + " input[name='dec-eventfeed-past-event']").val();

    var data = {
      action: "load_event_posts",
      atts: JSON.stringify(eventFeed.atts),
      type: "POST",
      dateType: "html",
      eventfeed_current_page: eventfeed_current_page,
      eventfeed_page: eventfeed_page,
      eventfeed_prev_page: eventfeed_prev_page,
      eventfeed_current_pagination_page: eventfeed_current_pagination_pages,
	    event_filter_search: event_filter_search,
      pagination_type: eventFeed.pagination_type,
      class_pagination: eventFeed.class_pagination,
      //  eventfeed_show_past:eventfeed_show_past,
      // security: eventFeed.security,
    };
    // console.log(eventFeed.class_pagination);
    //console.log(pagination_type);
    // console.log(categslug);

    $.post(eventFeed.ajaxurl, data, function () {

      let paging_max_page = jQuery("input[name='eventfeed_max_page']").val();
      var result = PagingEventDislay(1, paging_max_page, "ecs-page-numbers", "ecs-page-disable");
      jQuery(".ecs-event-pagination").html(result);
      //   console.log("run code");
      //  $('.actionButton.single-pet').attr("style", "display: inline !important");
      if (eventfeed_page == "numeric_pagination") {
        var result = PagingEventDislay(eventfeed_current_pagination_pages, eventfeed_max_page, "ecs-page-numbers", "ecs-page-disable", event_filter_page, event_filter_page_first, event_filter_page_last);
        jQuery(mainClass + ' .ecs-event-pagination').html('');
        jQuery(mainClass + ' .ecs-event-pagination').append(result);
      }
      // jQuery(".dec-page-text-display").attr("style", "display: none !important");
      // jQuery(".dec-page-text-display-none").attr("style", "display: inline !important");
    });

  });


  $('#dec-filter-search__input').on("click keydown", function (event) {

    var keycode = event.which;
    if (keycode == '13') {

      let module_css_filter = jQuery("input[name='module-css-filter']").val();
      var mainClass = "";

      $('.decm_event_display').each(function (i, item) {

        var classfilter = jQuery(item).attr('class').split(/\s+/);

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

      //   var mainClass = ".test123";

      var eventFeed = $(window)[0][`eventFeed${mainClass.substr(1, mainClass.length)}`];

      let event_filter_address = jQuery(mainClass + " input[name='dec-eventfeed-address']").val();
      let event_filter_state = jQuery(mainClass + " input[name='dec-eventfeed-state']").val();
      let event_filter_city = jQuery(mainClass + " input[name='dec-eventfeed-city']").val();
      let event_filter_country = jQuery(mainClass + " input[name='dec-eventfeed-country']").val();
      let event_startDate = jQuery(mainClass + " input[name='EventstartDate']").val();
      let event_endDate = jQuery(mainClass + " input[name='EventendDate']").val();
      let event_maxCost = jQuery(mainClass + " input[name='EventcostMax']").val();
      let event_minCost = jQuery(mainClass + " input[name='EventcostMin']").val();
      let event_filter_year = jQuery(mainClass + " input[name='dec-eventfeed-year']").val();
      let event_filter_month = jQuery(mainClass + " input[name='dec-eventfeed-month']").val();
      let event_filter_day = jQuery(mainClass + " input[name='dec-eventfeed-day']").val();
      let event_filter_time = jQuery(mainClass + " input[name='dec-eventfeed-time']").val();
      let event_filter_search = jQuery(mainClass + " input[name='dec-filter-search']").val();
      let filter_event_category = jQuery(mainClass + " input[name='dec-eventfeed-category']").val();
      let event_filter_organizer = jQuery(mainClass + " input[name='dec-eventfeed-organizer']").val();
      let event_filter_tag = jQuery(mainClass + " input[name='dec-eventfeed-tag']").val();
      let event_filter_venue = jQuery(mainClass + " input[name='dec-eventfeed-venue']").val();
      let event_filter_order = jQuery(mainClass + " input[name='dec-eventfeed-order']").val();
      let event_filter_page = jQuery(mainClass + " input[name='dec-eventfeed-page-translation']").val();
      let event_filter_page_first = jQuery(mainClass + " input[name='dec-eventfeed-first-translation']").val();
      let event_filter_page_last = jQuery(mainClass + " input[name='dec-eventfeed-last-translation']").val();
      let event_filter_status = jQuery(mainClass + " input[name='dec-eventfeed-status']").val();
      let event_filter_future_past = jQuery(mainClass + " input[name='dec-eventfeed-future-past']").val();

      let eventfeed_page = jQuery(mainClass + " input[name='eventfeed_page']").val();
      jQuery(mainClass + ' #eventfeed_current_page').val("1");
      let search_search_criteria = jQuery("input[name='search_search_criteria']").val();

      var data = {
        action: "filters_event_posts",
        atts: JSON.stringify(eventFeed.atts),
        type: "POST",
        dateType: "html",
        filter_event_category: filter_event_category,
        event_filter_organizer: event_filter_organizer,
        event_filter_tag: event_filter_tag,
        event_filter_venue: event_filter_venue,
        event_filter_search: event_filter_search,
        event_filter_time: event_filter_time,
        event_filter_day: event_filter_day,
        event_filter_month: event_filter_month,
        event_filter_year: event_filter_year,
        event_maxCost: event_maxCost,
        event_minCost: event_minCost,
        event_startDate: event_startDate,
        event_endDate: event_endDate,
        event_filter_country: event_filter_country,
        event_filter_city: event_filter_city,
        event_filter_state: event_filter_state,
        event_filter_address: event_filter_address,
        event_filter_order: event_filter_order,
        event_filter_future_past: event_filter_future_past, 
        event_filter_status: event_filter_status,
        search_search_criteria: search_search_criteria,

        // security: eventFeed.security,
      };

      $.post(eventFeed.ajaxurl, data, function (atts) {
        jQuery(mainClass + ' .append_events').html('');
        jQuery(mainClass + ' .append_events').append(atts);

        if (eventfeed_page == "load_more") {
          var max_page = jQuery(mainClass + ' #page_max').val();
          jQuery(mainClass + " input[name='eventfeed_max_page']").val(max_page);
          if (max_page == 1) {
            jQuery(mainClass + ' .event_ajax_load').hide();
          } else {
            jQuery(mainClass + ' .event_ajax_load').show();
          }
        }

        if (eventfeed_page == "numeric_pagination") {
          var eventfeed_max_page = jQuery(mainClass + ' #page_max').val();
          var eventfeed_current_pagination_pages = jQuery(mainClass + ' #current_page').val();
          jQuery(mainClass + ' #eventfeed_max_page').val(eventfeed_max_page);
          var result = PagingEventDislay(eventfeed_current_pagination_pages, eventfeed_max_page, "ecs-page-numbers", "ecs-page-disable", event_filter_page, event_filter_page_first, event_filter_page_last);
          jQuery(mainClass + ' .ecs-event-pagination').html('');
          jQuery(mainClass + ' .ecs-event-pagination').append(result);
          // jQuery(".dec-page-text-display").attr("style", "display: none !important");
          // jQuery(".dec-page-text-display-none").attr("style", "display: inline !important");

        }


        if ( eventfeed_page== "paged") {

          var max_page = jQuery(mainClass + ' #page_max').val();
          jQuery(mainClass + " input[name='eventfeed_max_page']").val(max_page);

          if (max_page == 1) {
            $(mainClass + ' .ecs-page_alignment_left').hide();
            $(mainClass + ' .ecs-page_alignment_right').hide();
          } else {
            $(mainClass + ' .ecs-page_alignment_left').hide();
            $(mainClass + ' .ecs-page_alignment_right').show();
          }

        }

      });
    }
    event.stopPropagation();
  });



  $("input[name='dec_filter_category'], input[name='dec_filter_tag'],  input[name='dec_filter_future_past'],  input[name='dec_filter_status'], input[name='dec_filter_venue'], input[name='dec_filter_organizer'], input[name='dec_filter_location'], input[name='dec_filter_days'], input[name='dec_filter_city'], input[name='dec_filter_state'], input[name='dec_filter_country'], input[name='dec_filter_months'], input[name='dec_filter_years'], .decm-filter-catrgory-list, .dec-years-list, .dec-status-list, .dec-tag-list, .dec-future-past-list, .dec-order-filter-list  ul li, .dec-organizer-list, .dec-venue-list, .dec-city-list, .dec-country-list, .dec-months-list, .dec-state-list, .dec-days-list, .dec-recurring-filter-list  ul li, .dec-filter-event-category-inline, .dec-time-list, .dec-location-list,  #dec-find-events, #dec-filter-remove, #eventCostslider .ui-slider-range, #eventCostslider > .ui-slider-handle, #reportrange, .dec-filter-label > button").on("click apply.daterangepicker cancel.daterangepicker'", function (event) {

    //  event.preventDefault();

    let module_css_filter = jQuery("input[name='module-css-filter']").val();

    var mainClass = "";

    $('.decm_event_display').each(function (i, item) {

      var classfilter = jQuery(item).attr('class').split(/\s+/);

      // console.log("module class");
      // console.log(classfilter);

      $.each(classfilter, function (index, item) {

        if (module_css_filter != '' && item != '') {
          if (item == module_css_filter) {
            mainClass = "." + item;

          }
        } else if (item.match(/decm_event_display_/g)) {
          mainClass = "." + item;
          // console.log(mainClass);
        }

      });
      //test


    });

    //   console.log(mainClass,'event filter');

    var eventFeed = $(window)[0][`eventFeed${mainClass.substr(1, mainClass.length)}`];

    //  console.log(mainClass);

    let event_filter_address = jQuery(mainClass + " input[name='dec-eventfeed-address']").val();
    let event_filter_state = jQuery(mainClass + " input[name='dec-eventfeed-state']").val();
    let event_filter_city = jQuery(mainClass + " input[name='dec-eventfeed-city']").val();
    let event_filter_country = jQuery(mainClass + " input[name='dec-eventfeed-country']").val();
    let event_startDate = jQuery(mainClass + " input[name='EventstartDate']").val();
    let event_endDate = jQuery(mainClass + " input[name='EventendDate']").val();
    let event_maxCost = jQuery(mainClass + " input[name='EventcostMax']").val();
    let event_minCost = jQuery(mainClass + " input[name='EventcostMin']").val();
    let event_filter_year = jQuery(mainClass + " input[name='dec-eventfeed-year']").val();
    let event_filter_month = jQuery(mainClass + " input[name='dec-eventfeed-month']").val();
    let event_filter_day = jQuery(mainClass + " input[name='dec-eventfeed-day']").val();
    let event_filter_time = jQuery(mainClass + " input[name='dec-eventfeed-time']").val();
    let event_filter_search = jQuery(mainClass + " input[name='dec-filter-search']").val();
    let filter_event_category = jQuery(mainClass + " input[name='dec-eventfeed-category']").val();
    let event_filter_organizer = jQuery(mainClass + " input[name='dec-eventfeed-organizer']").val();
    let event_filter_tag = jQuery(mainClass + " input[name='dec-eventfeed-tag']").val();
    let event_filter_venue = jQuery(mainClass + " input[name='dec-eventfeed-venue']").val();
    let event_filter_order = jQuery(mainClass + " input[name='dec-eventfeed-order']").val();
    let event_filter_page = jQuery(mainClass + " input[name='dec-eventfeed-page-translation']").val();
    let event_filter_page_first = jQuery(mainClass + " input[name='dec-eventfeed-first-translation']").val();
    let event_filter_page_last = jQuery(mainClass + " input[name='dec-eventfeed-last-translation']").val();
    let event_filter_status = jQuery(mainClass + " input[name='dec-eventfeed-status']").val();
    let event_filter_recurring = jQuery(mainClass + " input[name='dec-eventfeed-recurring']").val();
    let event_filter_future_past = jQuery(mainClass + " input[name='dec-eventfeed-future-past']").val();
    //  console.log('event category ajax value');
    //  console.log(filter_event_category,"class");

    let eventfeed_page = jQuery(mainClass + " input[name='eventfeed_page']").val();
    jQuery(mainClass + ' #eventfeed_current_page').val("1");
     let search_search_criteria = jQuery("input[name='search_search_criteria']").val();


    var data = {
      action: "filters_event_posts",
      atts: JSON.stringify(eventFeed.atts),
      type: "POST",
      dateType: "html",
      filter_event_category: filter_event_category,
      event_filter_organizer: event_filter_organizer,
      event_filter_tag: event_filter_tag,
      event_filter_venue: event_filter_venue,
      event_filter_search: event_filter_search,
      event_filter_time: event_filter_time,
      event_filter_day: event_filter_day,
      event_filter_month: event_filter_month,
      event_filter_year: event_filter_year,
      event_maxCost: event_maxCost,
      event_minCost: event_minCost,
      event_startDate: event_startDate,
      event_endDate: event_endDate,
      event_filter_country: event_filter_country,
      event_filter_city: event_filter_city,
      event_filter_state: event_filter_state,
      event_filter_address: event_filter_address,
      event_filter_page: event_filter_page,
      event_filter_order: event_filter_order,
      event_filter_future_past: event_filter_future_past, 
      event_filter_status: event_filter_status,
      event_filter_recurring: event_filter_recurring,
      search_search_criteria: search_search_criteria,
      // security: eventFeed.security,
    };

    $.post(eventFeed.ajaxurl, data, function (atts) {
      jQuery(mainClass + ' .append_events').html('');
      jQuery(mainClass + ' .append_events').append(atts);

      if (eventfeed_page == "load_more") {
        var max_page = jQuery(mainClass + ' #page_max').val();
        jQuery(mainClass + " input[name='eventfeed_max_page']").val(max_page);
        if (max_page == 1) {
          jQuery(mainClass + ' .event_ajax_load').hide();
        } else {
          jQuery(mainClass + ' .event_ajax_load').show();
        }
      }

      if (eventfeed_page == "numeric_pagination") {
        var eventfeed_max_page = jQuery(mainClass + ' #page_max').val();
        var eventfeed_current_pagination_pages = jQuery(mainClass + ' #current_page').val();
        jQuery(mainClass + ' #eventfeed_max_page').val(eventfeed_max_page);
        var result = PagingEventDislay(eventfeed_current_pagination_pages, eventfeed_max_page, "ecs-page-numbers", "ecs-page-disable", event_filter_page, event_filter_page_first, event_filter_page_last);
        jQuery(mainClass + ' .ecs-event-pagination').html('');
        jQuery(mainClass + ' .ecs-event-pagination').append(result);
        // jQuery(".dec-page-text-display").attr("style", "display: none !important");
        // jQuery(".dec-page-text-display-none").attr("style", "display: inline !important");

      }


      if (eventfeed_page == "paged") {

        var max_page = jQuery(mainClass + ' #page_max').val();
        jQuery(mainClass + " input[name='eventfeed_max_page']").val(max_page);

        if (max_page == 1) {
          $(mainClass + ' .ecs-page_alignment_left').hide();
          $(mainClass + ' .ecs-page_alignment_right').hide();
        } else {
          $(mainClass + ' .ecs-page_alignment_left').hide();
          $(mainClass + ' .ecs-page_alignment_right').show();
        }

      }

    });

    event.stopPropagation();
    //return false;

  });


  $(".event_ajax_load, .ecs-page_alignment_left, .ecs-page_alignment_right, .ecs-event-pagination").on("click", function () {

    let module_css_filter = jQuery("input[name='module-css-filter']").val();

    // var mainClass = "";

    var classList = jQuery(this).parents('.decm_event_display').attr('class').split(/\s+/);
    //console.log(jQuery(this));
    var mainClass = "";
    $.each(classList, function (index, item) {

      if (module_css_filter != '' && item != '') {
        if (item == module_css_filter) {
          mainClass = "." + item;
        }
      }
      if (item.match(/decm_event_display_/g)) {
        mainClass = "." + item;
      }

    });

    //  console.log(mainClass);
    var eventFeed = $(window)[0][`eventFeed${mainClass.substr(1, mainClass.length)}`];


    // console.log(mainClass,'button load class');
    // console.log(window,'window load class');
    //console.log(jQuery(this).parent('.decm_event_display').attr('class').split(/\s+/));
    $(mainClass + ' .event_ajax_load a').hide();
    // $('.append_events').addClass('ajax_load_img');
    // let eventfeed_current_pagination_page = jQuery('.active-page').data('value');

    let event_filter_address = jQuery(mainClass + " input[name='dec-eventfeed-address']").val();
    let event_filter_state = jQuery(mainClass + " input[name='dec-eventfeed-state']").val();
    let event_filter_city = jQuery(mainClass + " input[name='dec-eventfeed-city']").val();
    let event_filter_country = jQuery(mainClass + " input[name='dec-eventfeed-country']").val();
    let event_startDate = jQuery(mainClass + " input[name='EventstartDate']").val();
    let event_endDate = jQuery(mainClass + " input[name='EventendDate']").val();
    let event_maxCost = jQuery(mainClass + " input[name='EventcostMax']").val();
    let event_minCost = jQuery(mainClass + " input[name='EventcostMin']").val();
    let event_filter_year = jQuery(mainClass + " input[name='dec-eventfeed-year']").val();
    let event_filter_month = jQuery(mainClass + " input[name='dec-eventfeed-month']").val();
    let event_filter_day = jQuery(mainClass + " input[name='dec-eventfeed-day']").val();
    let event_filter_time = jQuery(mainClass + " input[name='dec-eventfeed-time']").val();
    let event_filter_search = jQuery(mainClass + " input[name='dec-filter-search']").val();
    let filter_event_category = jQuery(mainClass + " input[name='dec-eventfeed-category']").val();
    let event_filter_organizer = jQuery(mainClass + " input[name='dec-eventfeed-organizer']").val();
    let event_filter_tag = jQuery(mainClass + " input[name='dec-eventfeed-tag']").val();
    let event_filter_venue = jQuery(mainClass + " input[name='dec-eventfeed-venue']").val();
    let event_filter_order = jQuery(mainClass + " input[name='dec-eventfeed-order']").val();
    let event_filter_page = jQuery(mainClass + " input[name='dec-eventfeed-page-translation']").val();
    let event_filter_page_first = jQuery(mainClass + " input[name='dec-eventfeed-first-translation']").val();
    let event_filter_page_last = jQuery(mainClass + " input[name='dec-eventfeed-last-translation']").val();
    let event_filter_future_past = jQuery(mainClass + " input[name='dec-eventfeed-future-past']").val();
    let event_filter_status = jQuery(mainClass + " input[name='dec-eventfeed-status']").val();
    let event_filter_recurring = jQuery(mainClass + " input[name='dec-eventfeed-recurring']").val();
   

    //  console.log(filter_event_category,"class",mainClass);

    let eventfeed_current_pagination_pages = jQuery(mainClass + " input[name='eventfeed_current_pagination_page']").val();
    let eventfeed_current_page = jQuery(mainClass + " input[name='eventfeed_current_page']").val();
    let eventfeed_class_pagination = jQuery(mainClass + " input[name='eventfeed_class_pagination']").val();
    let eventfeed_page = jQuery(mainClass + " input[name='eventfeed_page']").val();
    let eventfeed_prev_page = jQuery(mainClass + " input[name='eventfeed_prev_page']").val();
    let eventfeed_max_page = jQuery(mainClass + " input[name='eventfeed_max_page']").val();
    let eventfeed_load_img = jQuery(mainClass + " input[name='eventfeed_load_img']").val();
    let event_image = '<img src="' + eventfeed_load_img + '" class="eventFeed_load_img">';
    // jQuery(".append_events").html('<img src="'+eventfeed_load_img+'">')
    //console.log(eventfeed_load_img);
    if (eventfeed_page == "paged" && jQuery(this)[0].className == "ecs-page_alignment_left") {
      eventfeed_current_page = eventfeed_prev_page - 1;
    }
    jQuery(mainClass + " .event_ajax_load").append(event_image);
	  
	   let search_search_criteria = jQuery("input[name='search_search_criteria']").val();

    // debugger;

    var data = {
      action: "load_event_posts",
      atts: JSON.stringify(eventFeed.atts),
      type: "POST",
      dateType: "html",
      eventfeed_current_page: eventfeed_current_page,
      eventfeed_page: eventfeed_page,
      eventfeed_prev_page: eventfeed_prev_page,
      eventfeed_current_pagination_page: eventfeed_current_pagination_pages,
      categId: eventFeed.categId,
      categslug: eventFeed.categslug,
      term_id: eventFeed.term_id,
      venue_page_id: eventFeed.venue_page_id,
      event_id_realted: eventFeed.event_id_realted,
			organizer_page_id: eventFeed.organizer_page_id,
			term_id_tag: eventFeed.term_id_tag,
      pagination_type: eventFeed.pagination_type,
      class_pagination: eventFeed.class_pagination,
      filter_event_category: filter_event_category,
      event_filter_organizer: event_filter_organizer,
      event_filter_tag: event_filter_tag,
      event_filter_venue: event_filter_venue,
      event_filter_search: event_filter_search,
      event_filter_time: event_filter_time,
      event_filter_day: event_filter_day,
      event_filter_month: event_filter_month,
      event_filter_year: event_filter_year,
      event_maxCost: event_maxCost,
      event_minCost: event_minCost,
      event_startDate: event_startDate,
      event_endDate: event_endDate,
      event_filter_country: event_filter_country,
      event_filter_city: event_filter_city,
      event_filter_state: event_filter_state,
      event_filter_address: event_filter_address,
      event_filter_order: event_filter_order,
      event_filter_future_past: event_filter_future_past, 
      event_filter_page: event_filter_page,
      event_filter_status: event_filter_status,
      event_filter_recurring: event_filter_recurring,
	    search_search_criteria: search_search_criteria,
      // security: eventFeed.security,
    };
    // console.log(eventFeed.class_pagination);
    //console.log(pagination_type);
    // console.log(categslug);

    $.post(eventFeed.ajaxurl, data, function (atts, event_image, pagination_type, class_pagination, eventfeed_class_pagination) {
      // $('.event_ajax_load').add();
      // if (response.type == "success") {
      // jQuery('.event_ajax_load').remove();
      // if ((search_str && trigger_from) || trigger_from) {
      //     jQuery('#contract_row > div').remove();
      // }
      // console.log(eventfeed_class_pagination);

      if (event_image == "success") {
        $(mainClass + ' .event_ajax_load img').remove();
        $(mainClass + ' .event_ajax_load a').show();
      }

      if (eventfeed_page == "load_more") {
        // jQuery( ".append_events" ).remove(html);
        jQuery(mainClass + ' .append_events').append(atts);
        // jQuery('.append_events').html(atts);
        jQuery(window).trigger('resize');
        eventfeed_current_page = parseInt(eventfeed_current_page) + 1;
        if (parseInt(eventfeed_current_page) + 1) {
          $(mainClass + ' .append_events').remove(event_image);
        }
        jQuery(mainClass + ' #eventfeed_current_page').val(eventfeed_current_page);
        if (eventfeed_max_page <= eventfeed_current_page) {
          jQuery(mainClass + ' .event_ajax_load').hide();
        }
      }

      if (eventfeed_page == "paged") {

        jQuery(mainClass + ' #eventfeed_current_pagination_page').val(eventfeed_current_pagination_page);
        jQuery('.current_page').html(eventfeed_current_pagination_page);

        //   if (eventfeed_max_page <= eventfeed_current_pagination_page) {
        //     jQuery('.pages').append('<span class="px-points d-none" data-point="0">...</span>');
        // }

        // jQuery(mainClass + " input[name='eventfeed_current_pagination_page']").val(eventfeed_current_pagination_pages);

        // jQuery( ".append_events" ).remove(html);
        jQuery(mainClass + ' .append_events').html(atts);
        // jQuery('.append_events').html(atts);
        jQuery(window).trigger('resize');
        eventfeed_current_page = parseInt(eventfeed_current_page) + 1;
        eventfeed_prev_page = parseInt(eventfeed_current_page) - 1;
        if (parseInt(eventfeed_current_page) + 1 && eventfeed_current_page > eventfeed_prev_page) {
          $(mainClass + ' .ecs-page_alignment_left').show();
          $(mainClass + ' .ecs-page_alignment_right').show();
          $(mainClass + ' .append_events').remove(event_image);
        }
        if (eventfeed_prev_page == 0) {
          $(mainClass + ' .ecs-page_alignment_left').hide();
          $(mainClass + ' .ecs-page_alignment_right').show();

        }

        jQuery(mainClass + ' #eventfeed_current_page').val(eventfeed_current_page);
        jQuery(mainClass + ' #eventfeed_prev_page').val(eventfeed_prev_page);
        if (eventfeed_max_page <= eventfeed_current_page) {
          jQuery(mainClass + ' .event_ajax_load').remove();
          $(mainClass + ' .ecs-page_alignment_right').hide();
        }

        jQuery(function() { 
          jQuery('html, body').animate({
             scrollTop: jQuery(mainClass).offset().top - 100}, 1000);
         });

      }

      if (eventfeed_page == "numeric_pagination") {

        jQuery(mainClass + ' .append_events').html(atts);

        var result = PagingEventDislay(eventfeed_current_pagination_pages, eventfeed_max_page, "ecs-page-numbers", "ecs-page-disable", event_filter_page, event_filter_page_first, event_filter_page_last);
        jQuery(mainClass + ' .ecs-event-pagination').html('');
        jQuery(mainClass + ' .ecs-event-pagination').append(result);
        // jQuery(".dec-page-text-display").attr("style", "display: none !important");
        // jQuery(".dec-page-text-display-none").attr("style", "display: inline !important");

        //  event.preventDefault();
        jQuery(function() { 
          jQuery('html, body').animate({
             scrollTop: jQuery(mainClass).offset().top - 100}, 1000);
         });
      }
  
      });

  
    // btn.prop('disabled', true);
  });

  function PagingEventDislay(PageNumber, TotalRecords, ClassName, DisableClassName, event_filter_page, event_filter_page_first, event_filter_page_last) {
    var ReturnValue = "";
    var TotalPages = TotalRecords;
    var event_filter_page = jQuery("input[name='dec-eventfeed-page-translation']").val();
    var event_filter_page_first = jQuery(" input[name='dec-eventfeed-first-translation']").val();
    var event_filter_page_last = jQuery(" input[name='dec-eventfeed-last-translation']").val();

    ReturnValue = ReturnValue + "<span class='dec-page-text-container' > <span class='dec-page-text-display'>"+ event_filter_page +"</span> <span class='dec-page-text-display-none'>" + event_filter_page + "</span>" + PageNumber + " of " + TotalPages + "</span> ";

    if (+PageNumber > 1) {
      if (+PageNumber == 2)
        ReturnValue = ReturnValue + "<a href='' pn='" + (1) + "' class='dec-page-text-display " + ClassName + "'>« "+ event_filter_page_first +"</a>  <a href='' pn='" + (1) + "' class='dec-page-text-display-none " + ClassName + "'>« " + event_filter_page_first + "</a>   ";

      else {
        ReturnValue = ReturnValue + "<a  href='' pn='";
        ReturnValue = ReturnValue + (1) + "' class='dec-page-text-display " + ClassName + "'>« "+ event_filter_page_first +"</a>   ";

        ReturnValue = ReturnValue + "<a href='' pn='";
        ReturnValue = ReturnValue + (1) + "' class='dec-page-text-display-none " + ClassName + "'>« " + event_filter_page_first + "</a>   ";

      }
    }
    else
      ReturnValue = ReturnValue + "<span style='display:none;' pn='" + i + "' class='dec-page-text-display " + DisableClassName + "'>« "+ event_filter_page_first +"</span> <span style='display:none;' pn='" + i + "' class='dec-page-text-display-none " + DisableClassName + "'>« " + event_filter_page_first + "</span>  ";
    if ((+PageNumber - 3) > 1)
      ReturnValue = ReturnValue + "<a href='' pn='1' class='" + ClassName + "'>1</a> ... ";
    for (var i = +PageNumber - 3; i <= +PageNumber; i++)
      if (i >= 1) {
        if (+PageNumber != i) {
          ReturnValue = ReturnValue + "<a href='' pn='";
          ReturnValue = ReturnValue + i + "' class='" + ClassName + "'>" + i + "</a>  ";
        }
        else {
          ReturnValue = ReturnValue + "<span class='current' pn='" + i + "' class='ecs-page-numbers' '>" + i + "</span>  ";
        }
      }
    for (var i = +PageNumber + 1; i <= +PageNumber + 3; i++)
      if (i <= TotalPages) {
        if (+PageNumber != i) {
          ReturnValue = ReturnValue + "<a href='' pn='";
          ReturnValue = ReturnValue + i + "' class='" + ClassName + "'>" + i + "</a>  ";
        }
        else {
          ReturnValue = ReturnValue + "<span class='current' pn='" + i + "' class='ecs-page-numbers' '>" + i + "</span>  ";
        }
      }
    if ((+PageNumber + 3) < TotalPages) {
      ReturnValue = ReturnValue + "... <a href='' pn='";
      ReturnValue = ReturnValue + TotalPages + "' class='" + ClassName + "'>" + TotalPages + "</a>";
    }
    if (+PageNumber < TotalPages) {
      ReturnValue = ReturnValue + "   <a href='' pn='";
      ReturnValue = ReturnValue + TotalPages + "' class='dec-page-text-display " + ClassName + "'>"+ event_filter_page_last + " »</a>";

      ReturnValue = ReturnValue + "   <a href='' pn='";
      ReturnValue = ReturnValue + TotalPages + "' class='dec-page-text-display-none " + ClassName + "'>" + event_filter_page_last + " »</a>";
    }
    else
      ReturnValue = ReturnValue + "   <span style='display:none;' pn='" + i + "' class='ecs-page-numbers' class='" + DisableClassName + "'>Next</span>";

    return (ReturnValue);
  }

 
});