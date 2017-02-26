<?php defined( '_JEXEC' ) or die( 'Restricted access' );?>
<!DOCTYPE html>
<html
    xmlns="http://www.w3.org/1999/xhtml"
    xml:lang="<?php echo $this->language; ?>"
    lang="<?php echo $this->language; ?>"
>

<head>

<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

<!-- Infinite scoll -->
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/jquery-ias.min.js"></script>

<!-- Instagram embed script -->
<script src="//platform.instagram.com/en_US/embeds.js"></script>

<!-- Adjust scaling for mobile devices -->
<meta id="meta" name="viewport" content="width=device-width, initial-scale=1.0">

<jdoc:include type="head" />

<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template.css" type="text/css" />
<!-- Dynamic styles -->
<style type="text/css">
    
</style>

</head>

<body>

<a name="top-anchor"></a>

<!-- Load the Facebook SDK -->
<script src="//connect.facebook.net/en_US/sdk.js#xfbml=1&amp;version=v2.5"></script>

<jdoc:include type="head" />

<div class="header">
    <a href="/#top-anchor">
        <!-- Module for title content -->
        <div id="title">
            <jdoc:include type="modules" name="title" />
        </div>
    </a>

    <!-- Module for content at the top of the page -->
    <div id="header-bar">
        <jdoc:include type="modules" name="header" />
    </div>
</div>

<a href="/#top-anchor">
    <img id="float" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/float.png"></img>
</a>

<div class="content">
    <!-- A place to insert a module with extra page content above whatever the
         page points to -->
    <jdoc:include type="modules" name="content" />

    <!-- Whatever the page is pointing to (for main page it's featured
         articles, for other pages it would be one article -->
    <jdoc:include type="component" />
</div>

<div class="sidebar" data-scroll-speed="1">
    <!-- Sidebar module -->
    <jdoc:include type="modules" name="sidebar" />
</div>

<jdoc:include type="message" />

<!-- General purpose modules -->
<jdoc:include type="modules" name="user1" />
<jdoc:include type="modules" name="user2" />

<div class="footer">
    <div id="footer-bar">
        <jdoc:include type="modules" name="footer" />
    </div>

    <div id="bottom-title">
        <jdoc:include type="modules" name="bottom-title" />
    </div>
</div>

<script>
    var ias = $.ias({
        container:  ".blog-featured",
        item:       ".items-row",
        pagination: ".pagination ul",
        next:       ".pagination-next a"
    });

    // Shows a spinner (a.k.a. loader)
    ias.extension(new IASSpinnerExtension({
        src: 'templates/<?php echo $this->template; ?>/images/float_small.gif'
    }));

    // Shows a trigger after page 3
    //ias.extension(new IASTriggerExtension({offset: 3}));

    // Override text when no pages left
    ias.extension(new IASNoneLeftExtension({
        text: 'No more posts'
    }));

    ias.on('loaded', function(data, items) {
        setTimeout(function(){
            window.instgrm.Embeds.process();
            console.log("Instagram process script called");
        }, 250);
    })
</script>

<script>
    $(window).scroll(function() {
        var height = $(window).scrollTop();

        var element = document.getElementById("float");
        if (height > 300) {
            element.className = ' scrolled';
        } else {
            element.className -= ' scrolled';
        }
    });
</script>

<script>
    $(window).bind('scroll',function(e){
        parallaxScroll();
    });

    function parallaxScroll(){
        var scrolled = $(window).scrollTop();
        $('.sidebar').css('top',(0+(scrolled * 0.6))+'px');
    }
</script>

<script>
    $(window).bind('resize', function(e) {
        changeSize();
    });
    function changeSize() {
        let titleDiv = $('#title');
        let floatImg = $('#float');

        if (typeof changeSize.setup == 'undefined') {
            changeSize.setup = 0;  // Don't do this setup next time

            const html = document.querySelector("html");
            const htmlStyles = window.getComputedStyle(html);

            let pixels = htmlStyles.getPropertyValue("--content-width");
            changeSize.contentWidth = parseFloat(pixels);

            pixels = htmlStyles.getPropertyValue("--background-height");
            changeSize.backgroundHeight = parseFloat(pixels);

            changeSize.floatWidth      = parseFloat(floatImg.css("width"));
            changeSize.floatTop        = parseFloat(floatImg.css("top"));
            changeSize.floatMarginLeft = parseFloat(floatImg.css("margin-left"));
        }
        
        let ratio = 1.0;
        const titleWidth = titleDiv.width();
        if (titleWidth < changeSize.contentWidth) {
            ratio = titleWidth / changeSize.contentWidth;
        }

        titleDiv.css('height', ratio * changeSize.backgroundHeight);

        floatImg.css('width',       ratio * changeSize.floatWidth);
        floatImg.css('margin-left', ratio * changeSize.floatMarginLeft);
    }

    $(function() {
        changeSize();
    });
</script>

</body>

</html>
