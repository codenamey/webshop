// === globally available "fake resize" helper (ADDED) =========================
function forceResize() {
  try {
    if (window.calendar && typeof window.calendar.updateSize === 'function') {
      window.calendar.updateSize(); // make FC recompute positions
    }
  } catch (e) {}
  // also trigger your existing jQuery(window).on('resize', ...) logic
  if (typeof jQuery !== 'undefined') {
    jQuery(window).trigger('resize');
  }
}
// ============================================================================

let calendar_html;
let calendar_view = "";
let calendar_view_tablet = "";
let calendar_view_phone = "";
var tooltip = null;
//console.log(myAjax.number_event_day);
let number_event_day=3;
number_event_day=myAjax.number_event_day=="1"?1:myAjax.number_event_day=="2"?2:myAjax.number_event_day=="3"?3:myAjax.number_event_day=="4"?4:myAjax.number_event_day=="5"?5:myAjax.number_event_day=="6"?6:myAjax.number_event_day=="7"?7:myAjax.number_event_day=="8"?8:myAjax.number_event_day=="9"?9:myAjax.number_event_day=="10"?10:myAjax.number_event_day=="default"?false:"";
//console.log(number_event_day);

//jQuery(".fc-widget-content").css('border', '0px solid');
// function GetCalendarDateRange() {
//   var calendar = $('#calendar').fullCalendar('getCalendar');
//   var view = calendar.view;
//   var start = view.start._d;
//   var end = view.end._d;
//   var dates = { start: start, end: end };
//   return dates;
// }
// jQuery(".fc-button-prev").on("click", function () {
//   alert("Hello! I am an alert box!!");
// });
jQuery(document).ready(function ($) {

//   setTimeout(()=>{
//     jQuery('.fc-day-top.fc-past').each(function () {
//       // Get the index of the past date column
//       var pastDateIndex = $(this).index();
//       ...
//   });
// },4500);

if(jQuery('.fc-right').is(':empty')) {
    jQuery('.fc-right').css("width", "20.5%");
}

  function handleTabVisibility() {
    if (document.visibilityState === 'visible') {
      setTimeout(function() {
        jQuery(document.body).on("click", 'td.fc-event-container', function() {
          var text = jQuery(this).find('.fc-content .fc-title .fc-calendar-title a').text();
          jQuery("#event_name_input").val(text);
        });

        var info_btn = myAjax.detail_below_calander;
        if (info_btn === 'off') {
          var style = `<style> @media screen and (max-width: 430px) {.fc-body .dec-tooltip{ display: none !important}} </style>`
          style = jQuery(style);
          jQuery("body").append(style);
        } else {
          const CheckCalender = setInterval(function () {
            if (jQuery("a.fc-day-grid-event.fc-h-event").length) {
              clearInterval(CheckCalender)
              setTimeout(function () {
                var style = `<style> div.dec-tooltip.active-event { position: relative !important;transform: inherit !important;visibility: visible !important;will-change: unset !important; display: block !important}@media screen and (max-width: 430px) {div.dec-tooltip { display: none !important; } div#calendar {height: 851px !important;} div.dec-tooltip.active-event { width: 100% !important;} img.attachment-post-thumbnail.size-post-thumbnail.wp-post-image {width: 110px !important;height: 70px !important;object-fit: cover !important;}.tooltip_main {display: flex !important;align-items: end !important;}} </style>`
                style = jQuery(style);
                jQuery("body").append(style);

                jQuery("body").on("click", "a.fc-day-grid-event.fc-h-event", function () {
                  let widthScreen = jQuery(window).width();
                  if (widthScreen < 430) {
                    jQuery(".custom-toolTip").before(jQuery("div.dec-tooltip"))
                    const checkTool = setInterval(function () {
                      if ($("div.dec-tooltip").length) {
                        clearInterval(checkTool)
                        jQuery("div.dec-tooltip").addClass("active-event");
                      }
                    }, 50)
                  }
                });
              }, 100)
            }
          }, 50);
        }
      }, 2000);
    }
  }

// Attach event listener to detect visibility change
//  document.addEventListener('visibilitychange', handleTabVisibility);

// Initial execution
//  handleTabVisibility();

  // Time Range code start
  var str = myAjax.hide_time_range_in_week_day;
  
  if (str === 'on') {

    function processTimeData() {
      const Z = [];
      const H = [];
      jQuery('.fc-axis.fc-time.fc-widget-content span').each(function () {
        let currentDataElement = $(this);
        var value = $(this).text();
        Z.push(value);
      });

      function convertTo24HourFormat(time) {
        const [hour, period] = time.match(/\d+|\D+/g);
        let hour24 = parseInt(hour, 10);
        
        if (period.toLowerCase() === 'pm' && hour24 !== 12) {
            hour24 += 12;
        } else if (period.toLowerCase() === 'am' && hour24 === 12) {
            hour24 = 0;
        }
        
        return hour24.toString().padStart(2, '0') + ':00:00';
      }

      function isTimeInRange(time, startTime, endTime) {
        const formattedTime = convertTo24HourFormat(time);
        const formattedStartTime = convertTo24HourFormat(startTime);
        const formattedEndTime = convertTo24HourFormat(endTime);
        return formattedTime >= formattedStartTime && formattedTime <= formattedEndTime;
      }

      var start = myAjax.start_point;
      var end = myAjax.end_point;

      const startTime = start;
      const endTime = end;

      jQuery('.fc-axis.fc-time.fc-widget-content span').each(function () {
        const time = $(this).text();
        if (isTimeInRange(time, startTime, endTime)) {
            H.push(time);
            $(this).hide();
            $(this).parent().parent().hide();
        }
      });

      // Handle half-hour intervals
      jQuery('tr.fc-minor').each(function () {
        const time = $(this).attr('data-time');
        if (isTimeInRange(time, startTime, endTime)) {
            H.push(time);
            $(this).hide();
        }
      });

      const newTimeArray = H.map(time => {
        const [hour, minute] = time.match(/\d+/g);
        const formattedHour = hour.padStart(2, '0');
        const formattedMinute = '30';
        const formattedTime = `${formattedHour}:${formattedMinute}:00`;

        if (time.toLowerCase().includes('pm')) {
          const adjustedHour = (parseInt(hour, 10) + 12).toString().padStart(2, '0');
          return `${adjustedHour}:${formattedMinute}:00`;
        }
        return formattedTime;
      });

      // After hiding rows, force FC to re-measure (ADDED)
      requestAnimationFrame(forceResize);
    }

    function handleButtonClick() {
      if ($(this).hasClass('fc-button-active')) {
        processTimeData();
      }
    }

    // Attach the function to the week button click event
    $('.fc-timeGridWeek-button.fc-button.fc-button-primary').on('click', handleButtonClick);

    // Attach the function to the day button click event
    $('.fc-timeGridDay-button.fc-button.fc-button-primary').on('click', handleButtonClick);

    // Attach the function to the prev button click event
    $('.fc-prev-button.fc-button.fc-button-primary').on('click', function () {
      if ($('.fc-timeGridWeek-button.fc-button.fc-button-primary').hasClass('fc-button-active') ||
          $('.fc-timeGridDay-button.fc-button.fc-button-primary').hasClass('fc-button-active')) {
        processTimeData();
      }
    });

    // Attach the function to the next button click event
    $('.fc-next-button.fc-button.fc-button-primary').on('click', function () {
      if ($('.fc-timeGridWeek-button.fc-button.fc-button-primary').hasClass('fc-button-active') ||
          $('.fc-timeGridDay-button.fc-button.fc-button-primary').hasClass('fc-button-active')) {
        processTimeData();
      }
    });   

    if ($('.fc-button').hasClass('fc-button-active')) {
      processTimeData();  // Run the function on page load if the class exists
    }
  }

  jQuery('.fc-list-empty').remove();
  // Time Range code end

  jQuery('.fc-view-container').append("<div class='fc-list-empty-wrap2'><div class='fc-list-empty-wrap1'><div class='fc-list-empty'><div class='spinner_calendar'><div class='bounce_calendar1'></div><div class='bounce_calendar2'></div><div class='bounce_calendar3'></div></div>Events are loading, please wait...</div></div></div>");

  jQuery('.fc-dayGridMonth-view, .fc-timeGridDay-view, .fc-timeGridWeek-view').addClass("ecs_is_loading_check");

  jQuery(window).on('resize', function () {
    if (jQuery(".decm_divi_event_calendar").parent().hasClass("et_pb_column_1_3") == true ||
      jQuery(".decm_divi_event_calendar").parent().hasClass("et_pb_column_1_4") == true || jQuery(".decm_divi_event_calendar").parent().hasClass("et_pb_column_1_5") == true || jQuery(".decm_divi_event_calendar").parent().hasClass("et_pb_column_1_6") == true || screen.width < 767) {

      jQuery(".fc-toolbar").css("display", "block");
      jQuery(".fc-day-number").css("font-size", "17px");
      jQuery(".fc-day-header").css("font-size", "12px");

    }
    else {
      jQuery(".fc-toolbar").css("display", "flex");
      jQuery(".fc-day-number").css("font-size", "24px");
      jQuery(".fc-day-header").css("font-size", "15px");
    }
  });

  // also call forceResize when prev/next clicked (ADDED)
  jQuery('body').on('click', ('button.fc-next-button,button.fc-prev-button'), function () {
    if (jQuery(".decm_divi_event_calendar").parent().hasClass("et_pb_column_1_3") == true || jQuery(".decm_divi_event_calendar").parent().hasClass("et_pb_column_1_4") == true || jQuery(".decm_divi_event_calendar").parent().hasClass("et_pb_column_1_5") == true || jQuery(".decm_divi_event_calendar").parent().hasClass("et_pb_column_1_6") == true || screen.width < 767) {

      jQuery(".fc-toolbar").css("display", "block");
      jQuery(".fc-day-number").css("font-size", "17px");
      jQuery(".fc-day-header").css("font-size", "12px");
    }
    else {
      jQuery(".fc-toolbar").css("display", "flex");
      jQuery(".fc-day-number").css("font-size", "24px");
      jQuery(".fc-day-header").css("font-size", "15px");
    }

    // ensure layout refresh (ADDED)
    setTimeout(forceResize, 0);
  });
});

//'dayGridMonth,timeGridWeek,timeGridDay'

// also bind "fake resize" to any toolbar button click: Month/Week/Day/List/Today (ADDED)
jQuery(document).on('click', '#calendar .fc-toolbar .fc-button', function () {
  setTimeout(forceResize, 0);
});

document.addEventListener("DOMContentLoaded", function () {
 // if (jQuery("#calendar").length <= 0) return false;
  var language = document.getElementsByTagName("html")[0].getAttribute("lang");

  var calendarEl = document.getElementById("calendar");
  
  if (myAjax.show_month_view_button == 'on') {
    calendar_view += "dayGridMonth,";
  }
  if (myAjax.show_week_view_button == 'on') {
    calendar_view += "timeGridWeek,";
  }

  if (myAjax.show_day_view_button == 'on') {
    calendar_view += "timeGridDay,";
  }
  if (myAjax.show_list_view_button == 'on') {
    calendar_view += myAjax.calendar_list_view_option;
  }
  var date1 = new Date();
  var date2 = new Date();

  if(myAjax.limit_event=="on"){
    var get_end_month = parseInt(myAjax.event_end_date) + 1;
    var get_start_month = parseInt(myAjax.event_start_date);
    get_end_month = new Date(date1.setMonth(date1.getMonth() + parseInt(get_end_month), 0));
    get_start_month = new Date(date2.setMonth(date2.getMonth() - parseInt(get_start_month), 1));

    jQuery('body').on('click', 'button.fc-prev-button', function () {
      jQuery(".fc-prev-button").addClass("ecs_next_class");
      var calendar_current_date = new Date(calendar.view.title);

      if (calendar_current_date.getTime() < get_start_month.getTime()) {
        if (myAjax.hide_month_range == "disable" ) {
          jQuery(".fc-prev-button").css("pointer-events", "none");
        }
      }
      if (calendar_current_date.getTime() < get_end_month.getTime()) {
        if (myAjax.hide_month_range == "disable") {
          jQuery(".fc-next-button").css("pointer-events", "visible");
        }
      }
      if (calendar.view.props.dateProfile.currentRange.start.getTime() < get_start_month.getTime()) {
        if (myAjax.hide_month_range == "disable") {
          jQuery(".fc-prev-button").css("pointer-events", "none");
        }
        if (myAjax.hide_month_range == "hide") {
          jQuery('.fc-view-container').append("<div class='fc-list-empty-wrap2'><div class='fc-list-empty-wrap1'><div class='fc-list-empty'>Sorry, there are no more events at this time</div></div></div>");
          jQuery('.fc-dayGridMonth-view, .fc-timeGridDay-view, .fc-timeGridWeek-view').addClass("ecs_is_loading_check");
        }
      }
      if (calendar.view.props.dateProfile.currentRange.start.getTime() > get_start_month.getTime()) {
        jQuery(".fc-next-button").css("pointer-events", "visible");
        if (myAjax.hide_month_range == "hide") {
          jQuery('.fc-list-empty-wrap2').remove();
          jQuery('.fc-dayGridMonth-view, .fc-timeGridDay-view, .fc-timeGridWeek-view').removeClass("ecs_is_loading_check");
        }
      }
    });

    jQuery('body').on('click', 'button.fc-next-button', function () {
      var calendar_current_date = new Date(calendar.view.title);

      jQuery(".fc-next-button").addClass("ecs_next_class");

      if (calendar_current_date.getTime() > get_start_month.getTime()) {
        if (myAjax.hide_month_range == "disable") {
          jQuery(".fc-prev-button").css("pointer-events", "visible");
        }
      }
      if (calendar_current_date.getTime() > get_end_month.getTime()) {
        if (myAjax.hide_month_range == "disable") {
          jQuery(".fc-next-button").css("pointer-events", "none");
        }
        jQuery('.fc-list-empty-wrap2').remove();
        jQuery('.fc-dayGridMonth-view, .fc-timeGridDay-view, .fc-timeGridWeek-view').addClass("ecs_is_loading_check");
      }
      if (calendar.view.props.dateProfile.currentRange.end.getTime() > get_start_month.getTime()) {
        if (myAjax.hide_month_range == "disable") {
          jQuery(".fc-prev-button").css("pointer-events", "visible");
        }
        if (myAjax.hide_month_range == "hide") {
          jQuery('.fc-list-empty-wrap2').remove();
          jQuery('.fc-dayGridMonth-view, .fc-timeGridDay-view, .fc-timeGridWeek-view').removeClass("ecs_is_loading_check");
        }
      }
      if (calendar.view.props.dateProfile.currentRange.end.getTime() > get_end_month.getTime()) {
        if (myAjax.hide_month_range == "disable") {
          jQuery(".fc-next-button").css("pointer-events", "none");
        }
        if (myAjax.hide_month_range == "hide") {
          jQuery('.fc-view-container').append("<div class='fc-list-empty-wrap2'><div class='fc-list-empty-wrap1'><div class='fc-list-empty'>Sorry, there are no more events at this time</div></div></div>");
          jQuery('.fc-dayGridMonth-view, .fc-timeGridDay-view, .fc-timeGridWeek-view').addClass("ecs_is_loading_check");
        }
      }
    });
  }

  if (myAjax.show_month_view_button_tablet == 'on' || (myAjax.show_month_view_button_tablet == "" && myAjax.show_month_view_button=="on")) {
    calendar_view_tablet += "dayGridMonth,";
  }
  if (myAjax.show_week_view_button_tablet == 'on' || (myAjax.show_week_view_button_tablet == ""&& myAjax.show_week_view_button=="on")) {
    calendar_view_tablet += "timeGridWeek,";
  }
  if (myAjax.show_day_view_button_tablet == 'on' || (myAjax.show_day_view_button_tablet == "" && myAjax.show_day_view_button=="on")) {
    calendar_view_tablet += "timeGridDay,";
  }
  if (myAjax.show_list_view_button_tablet == 'on' || (myAjax.show_list_view_button_tablet == "" && myAjax.show_list_view_button=="on")) {
    calendar_view_tablet += myAjax.calendar_list_view_option;
  }

  if (myAjax.show_month_view_button_phone == 'on' || (myAjax.show_month_view_button_phone == "" && myAjax.show_month_view_button=="on")) {
    calendar_view_phone += "dayGridMonth,";
  }
  if (myAjax.show_week_view_button_phone == 'on' || (myAjax.show_week_view_button_phone == "" && myAjax.show_week_view_button=="on")) {
    calendar_view_phone += "timeGridWeek,";
  }
  if (myAjax.show_day_view_button_phone == 'on' || (myAjax.show_day_view_button_phone == "" && myAjax.show_day_view_button=="on")) {
    calendar_view_phone += "timeGridDay,";
  }
  if (myAjax.show_list_view_button_phone == 'on' || (myAjax.show_list_view_button_phone == "" && myAjax.show_list_view_button=="on")) {
    calendar_view_phone += myAjax.calendar_list_view_option;
  }

  var week_start_on = "";
  if (myAjax.week_start_on == "Sunday") { week_start_on = 0 } if (myAjax.week_start_on == "Monday") { week_start_on = 1 } if (myAjax.week_start_on == "Tuesday") { week_start_on = 2 }
  if (myAjax.week_start_on == "Wednesday") { week_start_on = 3 } if (myAjax.week_start_on == "Thursday") { week_start_on = 4 } if (myAjax.week_start_on == "Friday") { week_start_on = 5 } if (myAjax.week_start_on == "Saturday") { week_start_on = 6 }
  calendar_view = calendar_view.slice(0, -1);
  calendar_view_tablet = calendar_view_tablet.slice(0, -1);
  calendar_view_phone = calendar_view_phone.slice(0, -1);

  var hide_past_event = myAjax.hide_past_event == "on" ? new Date() : "";

  var calendar = new FullCalendar.Calendar(calendarEl, {
    eventOrder: myAjax.calendar_eventorder,
    showNonCurrentDates: myAjax.hide_pre_nxt_event === 'on' ? false : true, 
    displayEventTime: false,
    // eventLimit: 2,
    plugins: ['dayGrid', 'timeGrid', 'list'],
    // selectable: true,
    defaultView: screen.width <= 981 && screen.width >= 767 && myAjax.calendar_default_view_tablet != "" ? myAjax.calendar_default_view_tablet : screen.width <= 766 && myAjax.calendar_default_view_phone != "" ? myAjax.calendar_default_view_phone : myAjax.calendar_default_view,
    fixedWeekCount: false,

    header: {
      left: 'prev,next today',
      center: 'title',
      right: screen.width <= 981 && screen.width >= 767 ? calendar_view_tablet : screen.width <= 766 ? calendar_view_phone : calendar_view,
    },
    
    hiddenDays: myAjax.hidden_day,
    firstDay: week_start_on,
    locales: language,

    eventLimit:number_event_day,
    nextDayThreshold:myAjax.multidaycutoff,

    views: {
      dayGridMonth: {
        columnHeaderFormat: {
          weekday: jQuery(".decm_divi_event_calendar").parent().hasClass("et_pb_column_1_3") == true || jQuery(".decm_divi_event_calendar").parent().hasClass("et_pb_column_1_4") == true || jQuery(".decm_divi_event_calendar").parent().hasClass("et_pb_column_1_5") == true || jQuery(".decm_divi_event_calendar").parent().hasClass("et_pb_column_1_6") == true || screen.width < 767 ? "narrow" : screen.width <= 981 && screen.width >= 767 && myAjax.day_of_the_week_name_tablet != "" ? myAjax.day_of_the_week_name_tablet : myAjax.day_of_the_week_name,
        }
      }
    },

    loading: function(bool) {
      if(bool==false){ 
        jQuery('.fc-list-empty-wrap2').remove();
        jQuery('.fc-dayGridMonth-view, .fc-timeGridDay-view, .fc-timeGridWeek-view').removeClass("ecs_is_loading_check");
        if(jQuery('button').hasClass("ecs_next_class")){
          // noop
        } else {
          jQuery('.fc-list-empty-wrap2').remove();
          jQuery('.fc-dayGridMonth-view, .fc-timeGridDay-view, .fc-timeGridWeek-view').removeClass("ecs_is_loading_check");
        }
      }
    },

    // Run after every date/view change (v4) -> trigger layout refresh (ADDED)
    datesRender: function () {
      forceResize();
    },

    windowResize: function (view) {
      // keep empty to avoid loops; your global $(window).on('resize') handles styling
    },

    eventRender: function (info) {
      let show_calendar_thumbnail= myAjax.show_calendar_thumbnail=="on"?info.event.extendedProps.feature_image_calendar:"";
      var date1 = new Date();
      var date2 = new Date();
      var get_end_month = parseInt(myAjax.event_end_date) + 1;
      var get_start_month = parseInt(myAjax.event_start_date);
      get_end_month = new Date(date1.setMonth(date1.getMonth() + parseInt(get_end_month), 0));
      get_start_month = new Date(date2.setMonth(date2.getMonth() - parseInt(get_start_month), 1));

      if (jQuery(".decm_divi_event_calendar").parent().hasClass("et_pb_column_1_3") == true || jQuery(".decm_divi_event_calendar").parent().hasClass("et_pb_column_1_4") == true || jQuery(".decm_divi_event_calendar").parent().hasClass("et_pb_column_1_5") == true || jQuery(".decm_divi_event_calendar").parent().hasClass("et_pb_column_1_6") == true || screen.width < 767 && calendar.view.type != 'timeGridDay') {
        jQuery(info.el).children(".fc-content").css("visibility", "hidden").css("width", "10px").css("height", "10px");
      }
      if (calendar.view.type == 'timeGridDay' && screen.width < 767) {
        jQuery(info.el).children(".fc-content").attr('style', "visibility: visible !important").css("width", "auto").css("height", "auto");
      }
      else { jQuery(info.el).children(".fc-content").css("visibility", "visible").css("width", "auto").css("height", "auto"); }

      if (calendar.view.type == 'dayGridMonth' || calendar.view.type == 'timeGridWeek' || calendar.view.type == 'timeGridDay') {
        if (info.event.extendedProps.event_start_time == null) {
          if (myAjax.hide_calendar_event_all_day == "on" ) {
            info.el.querySelector('.fc-title').innerHTML = show_calendar_thumbnail+ '<span class="fc-calendar-title">' + info.event.title + "</span>" ;
          }
          else{
            info.el.querySelector('.fc-title').innerHTML =show_calendar_thumbnail+ '<span class="fc-calendar-time">' + info.event.extendedProps.allDayEvent + '</span></br><span class="fc-calendar-title">' + info.event.title + "</span>";
          }
        }
        if((info.event.extendedProps.event_start_time !=null)){
          if (myAjax.hide_calendar_event_multi_days == "on" && info.event.extendedProps.event_end_date!=""  ) {
            info.el.querySelector('.fc-title').innerHTML = show_calendar_thumbnail+ '<span class="fc-calendar-title">' + info.event.title + "</span>" ;
          }
          else if (myAjax.hide_calendar_event_multi_days == "off" && info.event.extendedProps.event_end_date!=""  ) {
            info.el.querySelector('.fc-title').innerHTML = show_calendar_thumbnail+'<span class="fc-calendar-time">' + info.event.extendedProps.event_start_time + info.event.extendedProps.event_end_time + '</span></br><span class="fc-calendar-title">' + info.event.title + "</span>";
          }
          if (myAjax.show_calendar_event_date == "off" && info.event.extendedProps.event_end_date==""  ) {
            info.el.querySelector('.fc-title').innerHTML = show_calendar_thumbnail+ '<span class="fc-calendar-title">' + info.event.title + "</span>" ;
          }
          else if (myAjax.show_calendar_event_date == "on" && info.event.extendedProps.event_end_date==""  ) {
            info.el.querySelector('.fc-title').innerHTML = show_calendar_thumbnail+'<span class="fc-calendar-time">' + info.event.extendedProps.event_start_time + info.event.extendedProps.event_end_time + '</span></br><span class="fc-calendar-title">' + info.event.title + "</span>";
          }
        }

        if (myAjax.show_calendar_event_date === 'on' && info.event.extendedProps.event_start_time !=null) {
          let eventStartTime = info.event.extendedProps.event_start_time;
          let EndSeparator = info.event.extendedProps.event_end_time != '' ? myAjax.timeRangeSeparator: ''; 
          let eventEndTime = myAjax.calender_end_time ==="on"  ?  ' '+ EndSeparator + ' ' + info.event.extendedProps.event_end_time : "";
          let eventTimeHtml = '';
          let timeZoneHtml = myAjax.show_time_zone_on_calendar ==="on" ? '<span class="fc-calendar-show-time-zone">' + info.event.extendedProps.show_time_zone_on_calendar + '</span></br>' : "";

          if (eventStartTime || eventEndTime) {
              eventTimeHtml = '<span class="fc-calendar-time">' + (eventStartTime || '') +(eventEndTime || '') + '</span></br>';
          }

          let eventHtml = eventTimeHtml +
              '<span class="fc-calendar-title">' + info.event.title + '</span>';

          if (eventTimeHtml) {
            eventHtml = show_calendar_thumbnail+ eventTimeHtml + timeZoneHtml + '<span class="fc-calendar-title">' + info.event.title + '</span>';
          }

          info.el.querySelector('.fc-title').innerHTML = eventHtml;
        }

        if (myAjax.show_event_venue == "on" && info.event.extendedProps.show_event_venue) {
          info.el.querySelector('.fc-title').innerHTML += '<div class="fc-calendar-venue">' + info.event.extendedProps.show_event_venue + '</div>';
        }
      }

      if (calendar.view.type == 'listWeek'||calendar.view.type == 'listMonth'||calendar.view.type == 'listYear') {
        if (info.event.extendedProps.event_start_time == null) {
          if (myAjax.hide_calendar_event_all_day == "off" ) {
            jQuery(info.el).prepend('<td class="fc-list-item-time fc-widget-content">' +show_calendar_thumbnail+ info.event.extendedProps.calallday + '</td>');
          }
          else {
            jQuery(info.el).prepend('<td class="fc-list-item-time fc-widget-content">'+show_calendar_thumbnail+' </td>');
          }
        }
        if((info.event.extendedProps.event_start_time !=null)){
          if (myAjax.hide_calendar_event_multi_days == "on" && info.event.extendedProps.event_end_date!=""  ) {
            jQuery(info.el).prepend('<td class="fc-list-item-time fc-widget-content"> </td>');
          }
          else if (myAjax.hide_calendar_event_multi_days == "off" && info.event.extendedProps.event_end_date!=""  ) {
            let EndSeparator = info.event.extendedProps.event_end_time != '' ? myAjax.timeRangeSeparator: ''; 
            let eventEndTime = myAjax.calender_end_time ==="on"  ?  ' '+ EndSeparator + ' ' + info.event.extendedProps.event_end_time : "";
            jQuery(info.el).prepend('<td class="fc-list-item-time fc-widget-content">' +show_calendar_thumbnail+ info.event.extendedProps.event_start_time  + eventEndTime + '</td>');
          }
          if (myAjax.show_calendar_event_date == "off" && info.event.extendedProps.event_end_date==""  ) {
            jQuery(info.el).prepend('<td class="fc-list-item-time fc-widget-content">'+show_calendar_thumbnail+' </td>');
          }
          else if (myAjax.show_calendar_event_date == "on" && info.event.extendedProps.event_end_date==""  ) {
            let EndSeparator = info.event.extendedProps.event_end_time != '' ? myAjax.timeRangeSeparator: ''; 
            let eventEndTime = myAjax.calender_end_time ==="on"  ?  ' '+ EndSeparator + ' ' + info.event.extendedProps.event_end_time : "";
            jQuery(info.el).prepend('<td class="fc-list-item-time fc-widget-content">' +show_calendar_thumbnail+ info.event.extendedProps.event_start_time  + eventEndTime + '</td>');
          }
        }
        info.el.querySelector('.fc-list-item-title').innerHTML = info.event.title;
      }

      if (calendar.view.type == 'timeGridDay') {
        info.event.start = info.event.extendedProps.event_start_date + "T" + info.event.extendedProps.event_start_time;
      }

      if (info.event.extendedProps.category_data !== false) {
        for (let i = 0; i < info.event.extendedProps.category_data.length; i++) {
          jQuery(info.el).addClass(info.event.extendedProps.category_data[i].slug + '_dec_category');
        }
      }
      if (info.event.extendedProps.featured_class !== "") {
        jQuery(info.el).addClass(info.event.extendedProps.featured_class);
      }
    },

    eventMouseEnter: function(info) {
      var info = info;
      var nsfields = info.event.extendedProps;
      if (tooltip) {
        tooltip.dispose();
      }
      if (myAjax.show_tooltip == "on" && screen.width >= 981) {
        tooltip = new Tooltip(info.el, {
          title: nsfields.html,
          html: true,
          delay:10,
          placement: "left",
          trigger: "hover",
          container: "tbody"
        });
      }
      if ((myAjax.show_tooltip_tablet == "on" || (myAjax.show_tooltip_tablet == "" && myAjax.show_tooltip == "on")) && screen.width <= 981 && screen.width >= 767) {
        tooltip = new Tooltip(info.el, {
          title: nsfields.html,
          delay:10,
          html: true,
          placement: "left",
          trigger: "hover",
          container: "tbody"
        });
      }
      if ((myAjax.show_tooltip_phone == "on" || (myAjax.show_tooltip_phone == "" && myAjax.show_tooltip == "on")) && screen.width < 767) {
        tooltip = new Tooltip(info.el, {
          title: nsfields.html,
          delay:10,
          html: true,
          placement: "left",
          trigger: "hover",
          container: "tbody"
        });
      }
    },

    events: {
      url: myAjax.ajaxurl + "?action=fetch_Events&locale=" + language + "&dateformat=" + myAjax.date_format + "&timeformat=" + myAjax.time_format +  "&limit_event_title_length=" + myAjax.limit_event_title_length +  "&event_title_length=" + myAjax.event_title_length +"&timezone=" + myAjax.show_time_zone+ "&show_time_zone_on_calendar=" + myAjax.show_time_zone_on_calendar+ "&end_time=" + myAjax.end_time+ "&show_rsvp=" + myAjax.show_rsvp + "&show_tooltip_ticket=" + myAjax.show_tooltip_ticket+ "&show_event_venue=" + myAjax.show_event_venue + "&hide_pre_nxt_event=" + myAjax.hide_pre_nxt_event +"&timezone_abb=" + myAjax.show_time_zone_abb + "&venue=" + myAjax.show_venue + "&location=" + myAjax.show_location + "&street=" + myAjax.show_address + "&locality=" + myAjax.show_locality + "&postal=" + myAjax.show_postal +
        "&country=" + myAjax.show_country+ "&street_comma=" + myAjax.show_address_comma +"&state_comma=" + myAjax.show_state_comma+ "&locality_comma=" + myAjax.show_locality_comma + "&postal_comma=" + myAjax.show_postal_comma +
        "&country_comma=" + myAjax.show_country_comma+"&show_postal_code_before_locality="+myAjax.show_postal_code_before_locality + "&organizer=" + myAjax.show_organizer + "&categories=" +
        myAjax.included_categories + "&show_tooltip=" + myAjax.show_tooltip +"&show_tooltip_tablet="+ myAjax.show_tooltip_tablet+"&show_tooltip_phone="
        + myAjax.show_tooltip_phone+ "&show_image=" + myAjax.show_image +"&show_image_tablet=" + myAjax.show_image_tablet +"&show_image_phone=" + myAjax.show_image_phone + "&show_icon_label=" + myAjax.show_icon_label + "&stack_label_icon=" + myAjax.stack_label_icon + "&show_colon=" + myAjax.show_colon + "&show_excerpt=" + myAjax.show_excerpt + "&show_price="
        + myAjax.show_price + "&show_rsvp_feed=" + myAjax.show_rsvp_feed + "&show_title=" + myAjax.show_title + "&show_date=" + myAjax.show_date + "&show_time="
        + myAjax.show_time + "&calendar_eventorder=" + myAjax.calendar_eventorder + "&id=" + myAjax.id +
        "&show_month_view_button=" + myAjax.show_month_view_button + "&show_list_view_button=" + myAjax.show_list_view_button + "&show_week_view_button=" + myAjax.show_week_view_button + "&show_day_view_button="
        + myAjax.show_day_view_button + "&show_month_view_button_tablet=" + myAjax.show_month_view_button_tablet +
        "&show_list_view_button_tablet=" + myAjax.show_list_view_button_tablet + "&show_week_view_button_tablet=" +
        myAjax.show_week_view_button_tablet + "&show_day_view_button_tablet=" + myAjax.show_day_view_button_tablet +
        "&show_month_view_button_phone=" + myAjax.show_month_view_button_phone + "&show_list_view_button_phone=" +
        myAjax.show_list_view_button_phone + "&show_week_view_button_phone=" + myAjax.show_week_view_button_phone +
        "&show_day_view_button_phone=" + myAjax.show_day_view_button_phone + "&categslug=" + myAjax.categslug +
        "&categId=" + myAjax.categId + "&show_tooltip_category="
        + myAjax.show_tooltip_category + "&enable_category_link=" + myAjax.enable_category_link + "&custom_category_link_target=" + myAjax.custom_category_link_target
        + "&show_tooltip_weburl=" + myAjax.show_tooltip_weburl + "&hidden_day=" + myAjax.hidden_day + "&week_start_on=" + myAjax.week_start_on + "start="
        + myAjax.start + "&show_calendar_event_date=" + myAjax.show_calendar_event_date + "&calender_end_time=" + myAjax.calender_end_time +"&timeRangeSeparator=" + myAjax.timeRangeSeparator +  "&calendar_default_view=" +
        myAjax.calendar_default_view + "&calendar_default_view_tablet=" + myAjax.calendar_default_view_tablet +
        "&calendar_default_view_phone=" + myAjax.calendar_default_view_phone +"&calendar_list_view_option="+myAjax.calendar_list_view_option+ "&show_recurring_event=" +
        myAjax.show_recurring_event + '&hide_past_event=' + myAjax.hide_past_event + "&event_start_date=" + myAjax.event_start_date + "&event_end_date="
        + myAjax.event_end_date + "&day_of_the_week_name=" + myAjax.day_of_the_week_name +
        "&single_event_page_link=" + myAjax.single_event_page_link + "&disable_event_title_link="
        + myAjax.disable_event_title_link + "&disable_event_image_link=" + myAjax.disable_event_image_link
        + "&disable_event_calendar_title_link=" + myAjax.disable_event_calendar_title_link +
        "&custom_event_link_url=" + myAjax.custom_event_link_url + "&custom_event_link_target="
        + myAjax.custom_event_link_target + "&website_link=" + myAjax.website_link + "&custom_website_link_text="
        + myAjax.custom_website_link_text + "&custom_website_link_target=" + myAjax.custom_website_link_target +
        "&show_end_time=" + myAjax.show_end_time + "&included_organizer=" + myAjax.included_organizer + "&included_organizer_check="
        + myAjax.included_organizer_check + "&included_venue=" + myAjax.included_venue + "&included_venue_check="
        + myAjax.included_venue_check + "&included_series=" + myAjax.included_series + "&included_series_check="
        + myAjax.included_series_check+ "&enable_organizer_link=" + myAjax.enable_organizer_link + "&custom_organizer_link_target=" +
        myAjax.custom_organizer_link_target + "&enable_venue_link=" + myAjax.enable_venue_link + "&custom_venue_link_target=" +
        myAjax.custom_venue_link_target + "&state=" + myAjax.show_state + "&venue_id=" + myAjax.venue_id +
        "&organizer_id=" + myAjax.organizer_id + "&event_selection=" + myAjax.event_selection + "&show_postponed_canceled_event=" +
        myAjax.show_postponed_canceled_event + "&show_virtual_event=" + myAjax.show_virtual_event+ "&show_virtual_event=" + myAjax.show_virtual_event + "&show_hybrid_event=" + myAjax.show_hybrid_event 
        +"&number_event_day="+myAjax.number_event_day+ "&limit_event=" + myAjax.limit_event + "&hide_month_range=" + myAjax.hide_month_range + "&day_of_the_week_name_tablet=" + myAjax.day_of_the_week_name_tablet + "&button_classes=" + myAjax.button_classes + "&disable_event_button_link=" + myAjax.disable_event_button_link
        + "&custom_icon=" + myAjax.custom_icon + "&custom_icon_tablet=" + myAjax.custom_icon_tablet + "&custom_icon_phone=" + myAjax.custom_icon_phone + "&view_more_text=" + myAjax.view_more_text+"&button_classes="+myAjax.button_classes+"&custom_icon="+myAjax.custom_icon+"&custom_icon_tablet="+myAjax.custom_icon_tablet+"&custom_icon_phone="+myAjax.custom_icon_phone
        +"&view_more_text="+myAjax.view_more_text+"&module_class="+myAjax.module_class+'&event_time_format='+myAjax.event_time_format+'&show_calendar_thumbnail='+myAjax.show_calendar_thumbnail+
        "&hide_calendar_event_multi_days="+myAjax.hide_calendar_event_multi_days+"&hide_calendar_event_all_day="+myAjax.hide_calendar_event_all_day+"&multdaycutoff="+myAjax.multidaycutoff+"&show_tag="+myAjax.show_tag+"&hide_comma_tag="+myAjax.hide_comma_tag+"&custom_tag_link_target="+myAjax.custom_tag_link_target+"&custom_tag_link_target="+myAjax.custom_tag_link_target+"&enable_tag_links="+myAjax.enable_tag_links+"&hide_comma_cat="+myAjax.hide_comma_cat
        +"&category_detail_label="+myAjax.category_detail_label+"&time_detail_label="+myAjax.time_detail_label+"&date_detail_label="+myAjax.date_detail_label+"&venue_detail_label="+myAjax.venue_detail_label+"&location_detail_label="+myAjax.location_detail_label+"&organizer_detail_label="+myAjax.organizer_detail_label+"&price_detail_label="+myAjax.price_detail_label+"&rsvp_detail_label="+myAjax.rsvp_detail_label+"&price_ticket_label="+myAjax.price_ticket_label+"&tag_detail_label="+myAjax.tag_detail_label+"&website_detail_label="+myAjax.website_detail_label
        +"&event_series_label="+myAjax.event_series_label+"&event_series_name="+myAjax.event_series_name+"&custom_series_link_target="+myAjax.custom_series_link_target+"&enable_series_link="+myAjax.enable_series_link+ "&show_rsvp_feed_respond=" + myAjax.show_rsvp_feed_respond+ "&show_rsvp_feed_left=" + myAjax.show_rsvp_feed_left+ "&show_ticket_feed_left=" + myAjax.show_ticket_feed_left+"&show_ticket_feed_respond=" + myAjax.show_ticket_feed_respond+"&show_time_zone_abb_on_calender=" + myAjax.show_time_zone_abb_on_calender,

      type: 'POST',
      success: function () {},
      error: function () {
        alert("There was an error while fetching events.");
      },
    },
  });
  
  calendar.render();
  calendar.setOption('locale', language);

  // expose calendar globally for forceResize (ADDED)
  window.calendar = calendar;

  // optional: initial reflow after first render (ADDED)
  setTimeout(forceResize, 0);

  if(myAjax.show_specific_month == 'on'){
    let dateOne = new Date();
    let date = new Date(dateOne.getFullYear(), dateOne.getMonth(), 1);
    let no_of_months = getMonthFromString(myAjax.specific_month_start, myAjax.specific_years_start);
    date.setMonth(no_of_months);
    date.setFullYear(myAjax.specific_years_start);
    calendar.gotoDate(date);
  }
});

function getMonthFromString(mon,year){
  return new Date(Date.parse(mon +" 1, "+ year)).getMonth();
}
