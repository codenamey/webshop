

(function($) {

    $(document).ready(function() {
        $('.owl-carousel').each(function() {
            var items = $(this).attr('data');
            var itemsTablet = $(this).attr('data-items-tablet');
            var itemsPhone = $(this).attr('data-items-phone');
            var loopStatus = $(this).attr('loopstatus')=="1"?true:false;
            var show_arrows = $(this).attr('show_arrows')=="on" ? true:false;
            var show_arrows_phone="";
            var show_arrows_tablet = ""; //$(this).attr('show_arrows_tablet')=="off" || $(this).attr('show_arrows_tablet') == "" ? false:true;
            var show_more=$(this).attr('show_arrows_phone')==""?true:false;

            if($(this).attr('show_arrows_phone')=="on" || $(this).attr('show_arrows_phone')=="" && $(this).attr('show_arrows')=="on"){
               show_arrows_phone=true;
            }
            if($(this).attr('show_arrows')=="off" && $(this).attr('show_arrows_phone') =="on"){
               show_arrows_phone=true;
            }
            if($(this).attr('show_arrows')=="on" && $(this).attr('show_arrows_phone') =="off"){
               show_arrows_phone=false;
            }
            if($(this).attr('show_arrows')=="off" && $(this).attr('show_arrows_phone') ==""){
              show_arrows_phone=false;
           }
           if($(this).attr('show_arrows_tablet')=="on" || $(this).attr('show_arrows_tablet')=="" && $(this).attr('show_arrows')=="on"){
            show_arrows_tablet=true;
         }
         if($(this).attr('show_arrows')=="off" && $(this).attr('show_arrows_tablet') =="on"){
            show_arrows_tablet=true;
         }
         if($(this).attr('show_arrows')=="on" && $(this).attr('show_arrows_tablet') =="off"){
            show_arrows_tablet=false;
         }
         if($(this).attr('show_arrows')=="off" && $(this).attr('show_arrows_tablet') ==""){
           show_arrows_tablet=false;
        }

            // else{
            //    show_arrows_phone=true;
            // }
            //var show_arrows_phone = $(this).attr('show_arrows_phone')=="on" || $(this).attr('show_arrows_phone')!="undefined" ? true:$(this).attr('show_arrows')=="off" && $(this).attr('show_arrows_phone') =="on" ?true:$(this).attr('show_arrows')=="on" || $(this).attr('show_arrows_phone') =="off"?false:true;
            var show_control = $(this).attr('show_control')=="on" ? true:false;
            var autoplay = $(this).attr('data-autoplay') == "on" ? true : false;
            var hoverpause = $(this).attr('data-hoverpause') == "on" ? false : true;
            var mousedrag = $(this).attr('data-mouse-drag') == "on" ? true : false;
            var touchdrag = $(this).attr('data-touch-drag') == "on" ? true : false;
            var autowidth = $(this).attr('data-auto-width') == "on" ? true : false;
            var prev_link = $(this).attr('prev_link');
            var next_link = $(this).attr('next_link');
            var columns_type = $(this).attr('columns_type');
            if(columns_type=="1"&&($(this).attr('image_align')=="topimage_bottomdetail"||$(this).attr('image_align')=="leftimage_rightdetail"||$(this).attr('image_align')=="rightimage_leftdetail")  ){
                items=1;
            }
            if(columns_type=="2"&&($(this).attr('image_align')=="topimage_bottomdetail"||$(this).attr('image_align')=="leftimage_rightdetail"||$(this).attr('image_align')=="rightimage_leftdetail")  ){
              items=2;
          }
       
            var rewind = $(this).attr('data-rewind') == "on" ? true : false;
            //var loop = loopStatus == 'on' ? true : false;
            var slideby = $(this).attr('data-slide-by');
            var autoplay_speed = $(this).attr('data-autoplaytimeout');
            var lazyload = $(this).attr('data-lazy-load') == "on" ? true : false;
            if(typeof itemsTablet == "undefined" || itemsTablet == '') {
                itemsTablet = 2;
            }
            if(typeof itemsPhone == "undefined" || itemsPhone == '') {
                itemsPhone = 1;
            }
  
            $(this).owlCarousel({
                autoplay: autoplay,
                autoplayHoverPause: hoverpause,
                items: items,
               // margin:20,
                //transitionStyle : "fade",
                loop: loopStatus,
                merge:true,
                autoHeight : true,
                nav: show_arrows,
                dots: show_control,
                mouseDrag: mousedrag, 
                touchDrag: touchdrag,
                autoplayTimeout:autoplay_speed,
                lazyLoad: true,
                responsive : {
                    980: {
                      mergeFit:true,
                        items: items,
                        nav:show_arrows,
                        dots:show_control,
                        mouseDrag: mousedrag, 
                        touchDrag: touchdrag,
                        autoHeight:true,
                    
                    },
                    767: {
                        items: itemsTablet,
                        nav: show_arrows_tablet,
                        dots: show_control,
                        autoplay: autoplay,   
                        mouseDrag: mousedrag, 
                        touchDrag: touchdrag,
                    },
                    0 : {
                      nav: show_arrows_phone,
                        items: itemsPhone,
                        autoplay: autoplay,
                    }
                }
            });
   
        });
    });
  })(jQuery);