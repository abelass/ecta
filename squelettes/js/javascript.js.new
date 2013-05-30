/* ****************************** MENU ****************************** */
var rwd;

var menu = 
{
    open:function(obj)
    {
        obj.parent().addClass('on');
        $('ul', obj.parent()).removeClass('hide');
    },
    
    closeall:function()
    {
        $('#menu ul li ul').addClass('hide');
    },
    
    close:function()
    {
        $('#menu ul li').each(function(){
            if( $(this).data('close')==true )
            {
                $('ul', $(this)).addClass('hide');
            }
            });
    },

    init:function()
    {
        $('#menu ul').removeClass('hide');
        $('#menu ul li').removeClass('hide');
        $('#menu ul li a:eq(0)').unbind('click');
        $('#menu ul li ul').addClass('hide');
        $('#menu ul li').css({display:'inline-block'});
        if( rwd=='desktop' )
        {
            $('#menu ul li.js_d').hide();
        }
        if (rwd=='tablet')
        {
            $('#menu ul li.js_t').hide();
        }
        
        $('#menu ul li > a').bind('mouseover focus click', function(e){
            if( rwd=='desktop' && $('ul', $(this) ).length==1 )
            {
                //e.preventDefault();
            }
            $(this).parent().data('close', false);
            if( !$(this).hasClass('on') )
            {
                menu.open($(this));
            }
            });
        $('#menu ul li > a').bind('mouseout blur', function(){
            $(this).parent().data('close', true);
            window.setTimeout( menu.close, 100);
            });
        $('#menu ul li ul li a')
            .bind('mouseover focus', function(){ $(this).parent().parent().parent().data('close', false); })
            .bind('mouseout', function(){ $(this).parent().parent().parent().data('close', true); });
    }
    
}

var menu2 = 
{
    state:false,
    
    open:function()
    {
        $('#menu ul li').not('.js_m').css({display:'block'}).removeClass('hide');
        menu2.state = true;
    },
    
    close:function()
    {
        $('#menu ul li:gt(0)').addClass('hide');
        menu2.state = false;
    },
    
    init:function()
    {
        $('#menu ul').css({zIndex:100});
        $('#menu ul li').css({display:'block'});
        $('#menu ul li:gt(0)').addClass('hide');
        $('#menu ul li ul li').addClass('sub').hide();
        $('#menu ul li a').unbind('click mouseover mouseout');
        
        $('#menu ul li a:eq(0)').bind('click', function(e){
            e.preventDefault();
            if( menu2.state==false )
            {
                menu2.open();
            }
            else
            {
                menu2.close();
            }
            });
        
        $('#main').bind('click', function(){
            if( menu2.state==true ) menu2.close();
            });
        
    }
}
/* ****************************** RWD & BANNER REPLACE ****************************** */

var elements_relocation = function()
{
    if( document.documentElement.clientWidth<=480 )
    {
        rwd = 'mobile';
        menu2.init();
    }
    else if( document.documentElement.clientWidth<=1024 && document.documentElement.clientWidth>480 )
    {
        $('#side-banners').insertAfter( $('#side-events') );
        rwd = 'tablet';
        menu.init();
    }
    else
    {
        $('#side-banners').insertBefore( $('#side-events') );
        rwd = 'desktop';
        menu.init();
    }
}

$(window).resize(function(){
    elements_relocation();
    });
$(document).ready(function(){
    elements_relocation();
    });

/* ****************************** MAIN CAROUSEL BOX ****************************** */

var carousel =
{
    counter:0,
    st:null,
    delay:3000,
    show:function(n)
    {
        carousel.counter = n;
        $('div.carousel div.carouselcontent div').fadeOut(600, 'swing').promise().done( function(){
            $('div.carousel div.carouselcontent div:eq(' + n + ')').fadeIn(100, 'swing');
            $('div.carousel ul li a').removeClass('active');
            $('div.carousel ul li a:eq(' + n + ')').addClass('active');
            });
    },
    
    timeout:function()
    {
        carousel.show( carousel.counter<($('div.carousel ul li').length-1)? carousel.counter+1:0 );
        carousel.st = window.setTimeout(carousel.timeout, carousel.delay);
    },
    
    init:function()
    {
        $('div.carousel div.carouselcontent div:gt(0)').hide();
        $('div.carousel ul li a:eq(0)').addClass('active');
        $('div.carousel ul li a').click(function(e){
            e.preventDefault();
            window.clearTimeout(carousel.st);
            carousel.show($('div.carousel ul li a').index($(this)));
            carousel.st = window.setTimeout(carousel.timeout, carousel.delay);
            });
        
        carousel.st = window.setTimeout(carousel.timeout, carousel.delay);
    }
}
carousel.init();

/* ****************************** MAIN TABS BOX ****************************** */

var tabs =
{
    show:function(n)
    {
        $('div.tabs div.tabcontent div').animate({opacity: 0}).promise().done( function(){
            //$('div.tabs div.tabcontent div:eq(' + n + ')').fadeIn(10, 'swing');
            $('div.tabs div.tabcontent div').hide();
            $('div.tabs div.tabcontent div:eq(' + n + ')').show(300);
            $('div.tabs div.tabcontent div:eq(' + n + ')').animate({opacity: 1,height: 'auto'});
            $('div.tabs ul li a').removeClass('active');
            $('div.tabs ul li a:eq(' + n + ')').addClass('active');
            });
            
    },
    
    init:function()
    {
        $('div.tabs ul').css({zIndex:30});
        $('div.tabs div.tabcontent').css({zIndex:10});
        $('div.tabs div div:gt(0)').hide();
        $('div.tabs ul li a').click(function(e){
            e.preventDefault();
            tabs.show( $('div.tabs ul li a').index($(this)) );
            });
        
    }
}
tabs.init();
