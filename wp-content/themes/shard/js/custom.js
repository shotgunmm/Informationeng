jQuery(document).ready(function($) {
    "use strict";

    $('body.preloader').jpreLoader({
        showSplash : false,
        loaderVPos : '50%',
    }).css('visibility','visible');


    $('#dz_main_slider').height($('.rev_slider_wrapper').height());

                        
    $(".scroll").click(function(e){
        e.preventDefault();
        var scroll_to = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(scroll_to).offset().top-20
        }, 1000);
    });

    if($('.loggedin').length>0){
      $('#nav-menu-item-588').hide();
      $('#nav-menu-item-593').show();
    }else{
      $('#nav-menu-item-588').show();
      $('#nav-menu-item-593').hide();
    }

    function randomIntFromInterval(min,max){
        return Math.floor(Math.random()*(max-min+1)+min);
    }

    var $bokah_bar=$('#title_breadcrumbs_bar.bokah_enabled');
    var bokah_max_x = $bokah_bar.width();
    var bokah_max_y = $bokah_bar.height();

    function bokah_animate($element) {
        var element_height = $element.height();
        $element.animate({
            top: randomIntFromInterval(-element_height,bokah_max_y+element_height/2),
            left: randomIntFromInterval(-element_height,bokah_max_x+element_height/2),
        }, randomIntFromInterval(37000,45000), 'linear',function(){
            bokah_animate($(this));
        });
    };

    if($bokah_bar.length > 0){
        for (var i = 1; i <= 7; i++) {
            $bokah_bar.append('<div class="bokah_circle bokah_circle_' + i + '" style="top:'+randomIntFromInterval(-100,bokah_max_y*1.3)+'px;left:'+randomIntFromInterval(-100,bokah_max_x*1.3)+'px;"></div>');
        };
        $('.bokah_circle').each(function(){
            bokah_animate($(this));
        });
    }



    $('.home.page .dnd_section_DD').waypoint(function(direction) {
        var section_id = $(this).attr('id');
        if(section_id!==undefined){
            $('.current-menu-item, .current-menu-ancestor').removeClass('current-menu-item').removeClass('current-menu-ancestor');
            if(direction==='down'){
                var $menu_item = $('#main_menu a[href=#'+section_id+']').parent();
                if($menu_item.length>0){
                    $menu_item.addClass('current-menu-item');
                }
                else{
                    $('#main_menu .current_page_item').addClass('current-menu-item');
                }
            }
            else if(direction==='up'){
                var previous_section_id = $(this).prevAll('[id]:first').attr('id');
                var $menu_item = $('#main_menu a[href=#'+previous_section_id+']').parent();
                if($menu_item.length>0){
                    $menu_item.addClass('current-menu-item');
                }
                else{
                    $('#main_menu .current_page_item').addClass('current-menu-item');
                }
            }
        }
    },{
      offset: 100
    });


    function header_menu_line() {
        $("#magic-line").remove();
        $("#topbar_and_header.th_style_1 #main_menu, #topbar_and_header.th_style_3 #main_menu").prepend("<li id='magic-line'></li>");
        var $magicLine = $("#magic-line");
        if($magicLine.length > 0){
            var position,width;
            var $selected_element = $('#main_menu .current-menu-ancestor a');
            if (!$selected_element.length > 0) $selected_element = $('#main_menu .current-menu-item a');
            if (!$selected_element.length > 0) $selected_element = $('#main_menu .current-post-ancestor a').closest('.menu-item-depth-0').find('a');

            if($selected_element.length > 0){
                position = $selected_element.position().left;
                width = $selected_element.outerWidth();
            }
            else{
                position=0;
                width = $("#main_menu > .menu-first > a").outerWidth();
                console.log(width);
            }
            var initial_position = position + width / 2;
            $magicLine.css('left', initial_position).animate({
                "left" : position,
                "width" : width
            }, 300, 'swing', function(){
                $(this).css({
                    "left" : position,
                    "width" : width
                }).data("origLeft", position).data("origWidth", $magicLine.outerWidth());
                $("#main_menu > li").hover(
                    function() {
                        var $link = $(this).find('a');
                        var position = $link.position().left; 
                        var width = $link.outerWidth(); 
                        $magicLine.stop().animate({
                            'left' : position,
                            'width' : width
                        }, 300);
                    }, 
                    function() {
                        $magicLine.stop().animate({
                            'left': $magicLine.data("origLeft"),
                            'width': $magicLine.data("origWidth")
                        }, 300);    
                    }
                );
            });
        }
    }
    $(window).load(function() { header_menu_line();} );


    function portfolio_filter_line() {
        $("#portfolio_magic-line").remove();
        $("#filters.portfolio_filter").prepend("<li id='portfolio_magic-line'></li>");
        var $portfoliomagicLine = $("#portfolio_magic-line");
        if($portfoliomagicLine.length > 0){
            var position,width;
            if($("#filters.portfolio_filter li a.selected").length > 0){
                position = $("#filters.portfolio_filter li a.selected").position().left;
                width = $("#filters.portfolio_filter li a.selected").outerWidth();
            }
            else{
                position=0;
                width = $("#filters.portfolio_filter > li a").outerWidth();
            }
            var initial_position = position + width / 2;
            $portfoliomagicLine.css('left', initial_position).animate({
                "left" : position,
                "width" : width
            }, 300, 'swing', function(){
                $(this).css({
                    "left" : position,
                    "width" : width
                }).data("origLeft", position).data("origWidth", $portfoliomagicLine.outerWidth());
                $("#filters.portfolio_filter > li").hover(
                    function() {
                        var $link = $(this).find('a');
                        var position = $link.position().left; 
                        var width = $link.outerWidth(); 
                        $portfoliomagicLine.stop().animate({
                            'left' : position,
                            'width' : width
                        }, 300);
                    }, 
                    function() {
                        $portfoliomagicLine.stop().animate({
                            'left': $portfoliomagicLine.data("origLeft"),
                            'width': $portfoliomagicLine.data("origWidth")
                        }, 300);    
                    }
                );
            });
        }
    }
    $(window).load(function() { portfolio_filter_line();} );

    $("#filters.portfolio_filter > li a").click(function(){
        var $portfoliomagicLine = $("#portfolio_magic-line");
        if($portfoliomagicLine.length > 0){
            var position,width;
            if($(this).length > 0){
                position = $(this).position().left;
                width = $(this).outerWidth();
            }
            $portfoliomagicLine.css({
                "left" : position,
                "width" : width
            }).data("origLeft", position).data("origWidth", $portfoliomagicLine.outerWidth());
        }
    });



    var $main_slider = $('#ABdev_main_slider');
    $main_slider.height('auto');
    

    $('.accordion-group').on('show', function() {
        $(this).find('i').removeClass('icon-plus').addClass('icon-minus');
    });
    $('.accordion-group').on('hide', function() {
        $(this).find('i').removeClass('icon-minus').addClass('icon-plus');
    });


    var sf, body;
    body = $('body');
    sf = $('#main_menu');
    if($('#ABdev_menu_toggle').css('display') === 'none') {
        // enable superfish when the page first loads if we're on desktop
        sf.superfish({
            delay:          300,
            animation:      {opacity:'show',height:'show'},
            animationOut:   {height:'hide'},
            speed:          'fast',
            speedOut:       'fast',            
            cssArrows:      false, 
            disableHI:      true /* load hoverIntent.js in header to use this option */,
            onBeforeShow:   function(){
                var ww = $(window).width();
                var locUL = this.parent().offset().left + this.width();
                var locsubUL = this.parent().offset().left + this.parent().width() + this.width();
                var par = this.parent();
                if(par.hasClass("menu-item-depth-0") && (locUL > ww)){
                    this.css('marginLeft', "-"+(locUL-ww+20)+"px");
                }
                else if (!par.hasClass("menu-item-depth-0") && (locsubUL > ww)){
                    this.css('left', "-"+(this.width())+"px"); 
                }
            }
        });
    }

    var $menu_responsive = $('#ABdev_main_header nav');
    $('#ABdev_menu_toggle').click(function(){
        $menu_responsive.animate({width:'toggle'},350);
    });



    $(".fancybox").fancybox({
        'transitionIn'      : 'elastic',
        'transitionOut'     : 'elastic',
        'titlePosition'     : 'over',
        'cyclic'            : true,
        'overlayShow'       : true,
        'titleFormat'       : function(title, currentArray, currentIndex) {
            return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
        }
    });
    

    $(".submit").click(function () {
        $(this).closest("form").submit();
    });


    $('input, textarea').placeholder();

    
    var $content = $("#timeline_posts");
    var $loader = $("#timeline_loading");
    var itemSelector = ('.timeline_post');
    function Timeline_Classes(){ 
        $content.find(itemSelector).each(function(){
           var posLeft = $(this).css("left");
           if(posLeft == "0px"){
               $(this).removeClass('timeline_post_right').addClass('timeline_post_left');          
           }
           else{
               $(this).removeClass('timeline_post_left').addClass('timeline_post_right');
           } 
        });
    }
    $content.imagesLoaded( function() {
        $content.masonry({
          columnWidth: ".timeline_post_first",
          gutter: 100,
          itemSelector: itemSelector,
        });
        Timeline_Classes();
        $loader.bind('inview', function(event, isInView) {
          if (isInView) {
            pageNumber++;
            load_posts();
          }
        });
    });
    var pageNumber = 1;
    var load_posts = function(){
            var url = $loader.data("ajaxurl") + '&pageNumber=' + pageNumber;
            var noPosts = $loader.data("noposts");
            $.ajax({
                type       : "GET",
                dataType   : "html",
                url        : url,
                beforeSend : function(){
                        $loader.addClass('timeline_loading_loader').html('');
                },
                success : function(data){
                    var $data = $(data);
                    if($data.length){
                            var $newElements = $data.css({ opacity: 0 });
                            $content.append( $newElements );
                        $content.imagesLoaded(function(){
                            $loader.removeClass('timeline_loading_loader');
                            $content.masonry( 'appended', $newElements, false );
                            $newElements.animate({ opacity: 1 });
                            Timeline_Classes();
                        }); 
                    } else {
                        $loader.removeClass('timeline_loading_loader').html(noPosts);
                    }
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                },
                complete : function(){
                    Timeline_Classes();
                }
        });
    };



    var $isotope_container = $('#ABdev_latest_portfolio');
    $isotope_container.imagesLoaded( function() {
        $isotope_container.isotope({
            itemSelector : '.portfolio_item',
            animationEngine: 'best-available',
        });
        var $optionSets = $('.option-set'),
            $optionLinks = $optionSets.find('a');
        $optionLinks.click(function(){
            var $this = $(this);
            if ( $this.hasClass('selected') ) {
                return false;
            }
            var $optionSet = $this.parents('.option-set');
            $optionSet.find('.selected').removeClass('selected');
            $this.addClass('selected');
            var options = {},
                key = $optionSet.attr('data-option-key'),
                value = $this.attr('data-option-value');
            value = value === 'false' ? false : value;
            options[ key ] = value;
            if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
                changeLayoutMode( $this, options );
            } else {
                $isotope_container.isotope( options );
            }
            return false;
        });
    });


    $(window).resize(function() {

        Timeline_Classes();

        $("#magic-line").remove();
        $("#portfolio_magic-line").remove();
        clearTimeout(this.id);
        this.id = setTimeout(on_timeout, 500);

        function on_timeout(){
            header_menu_line();
            portfolio_filter_line();
        }

        $('#dz_main_slider').height($('.rev_slider_wrapper').height());

        
        
        if($('#ABdev_menu_toggle').css('display') === 'none' && !sf.hasClass('sf-js-enabled')) {
            // you only want SuperFish to be re-enabled once (sf.hasClass)
            $menu_responsive.show();
            sf.superfish({
                delay:          300,
                animation:      {opacity:'show',height:'show'},
                animationOut:   {height:'hide'},
                speed:          'fast',
                speedOut:       'fast',            
                cssArrows:      false, 
                disableHI:      true /* load hoverIntent.js in header to use this option */,
                onBeforeShow:   function(){
                    var ww = $(window).width();
                    var locUL = this.parent().offset().left + this.width();
                    var locsubUL = this.parent().offset().left + this.parent().width() + this.width();
                    var par = this.parent();
                    if(par.hasClass("menu-item-depth-0") && (locUL > ww)){
                        this.css('marginLeft', "-"+(locUL-ww+20)+"px");
                    }
                    else if (!par.hasClass("menu-item-depth-0") && (locsubUL > ww)){
                        this.css('left', "-"+(this.width())+"px"); 
                    }
                }
            });
        } else if($('#ABdev_menu_toggle').css('display') != 'none' && sf.hasClass('sf-js-enabled')) {
            // smaller screen, disable SuperFish
            sf.superfish('destroy');
            $menu_responsive.hide();
        }
    });
    

});


