<script type="text/javascript">
    $(document).ready(function(){	
        $(".group1").colorbox({rel:'group1'});
        
        //Scrolled by user interaction
        $('#image-roller').carouFredSel({
            auto: false,
            prev: '#prev2',
            next: '#next2',
            pagination: "#pager2",
            mousewheel: true,
            swipe: {
                onMouse: true,
                onTouch: true
            }
        });
		
        $('#banner-roller').carouFredSel({
            auto: true,
            prev: '',
            next: '',
            pagination: "#banner-pager",
            mousewheel: true,
            scroll	: 1500,
            auto		: 4000,
            swipe: {
                onMouse: true,
                onTouch: true
            }
        });			   			
    });
</script>

<div  class="girls-banner" >
    <div class="list_carousel-large">
        <ul id="banner-roller">
            <li><img src="<?php echo static_url(); ?>layout/images/frontend/banner01.jpg"/></li>
            <li><img src="<?php echo static_url(); ?>layout/images/frontend/banner02.jpg"/></li>					
            <li><img src="<?php echo static_url(); ?>layout/images/frontend/banner03.jpg"/></li>	            
        </ul>
    </div>				
</div>

<div style="float:left; width:222px;margin-left: 10px;">
    <div  class="mazengar-application">
        <a href="https://play.google.com/store/apps/details?id=com.mazengar&feature=search_result#?t=W251bGwsMSwyLDEsImNvbS5tYXplbmdhciJd" target="_blank">
            <img src="<?php echo static_url(); ?>layout/images/frontend/mazengar-application.jpg" />								
        </a>
    </div>			

    <div  class="life-demo" >
        <a href="<?php echo base_url();?>login">
        <img src="<?php echo static_url(); ?>layout/images/frontend/life-demo.jpg" />					
        </a>
    </div>

</div>
<div style="width:747px;float:left">

    <div class="pagination" id="banner-pager" style="display: block;">
        <a href="#" class="selected"><span>1</span></a><a href="#" class=""><span>2</span></a><a href="#" class=""><span>3</span></a></div>

</div>
<div id="fb-root"></div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=515417035153277";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="online-presence">
    <div style="margin-top: -10px;" class="fb-like" data-href="http://www.mazengar.com" data-send="false" data-width="350" data-show-faces="false"></div>
    <a href="http://www.facebook.com/mazengarapp" target="_blank" class="fb-icon"></a>
    <a href="https://twitter.com/MazengarApp" target="_blank" class="twitter-icon"></a>
    <a href="#" target="_blank" class="linkedin-icon"></a>
</div>
<div class="horizontal-seperator" style="margin-top: -15px;"></div>

<a id="prev2" class="prev" href="#"></a>
<div class="list_carousel">
    <ul id="image-roller">
        <li><a class="group1" href="<?php echo static_url(); ?>layout/images/frontend/home-pic-1_big.jpg"><img src="<?php echo static_url(); ?>layout/images/frontend/home-pic-1.jpg" /></a></li>
        <li><a class="group1" href="<?php echo static_url(); ?>layout/images/frontend/home-pic-2_big.jpg"><img src="<?php echo static_url(); ?>layout/images/frontend/home-pic-2.jpg"/></a></li>
        <li><a class="group1" href="<?php echo static_url(); ?>layout/images/frontend/home-pic-3_big.jpg"><img src="<?php echo static_url(); ?>layout/images/frontend/home-pic-3.jpg"/></a></li>
        <li><a class="group1" href="<?php echo static_url(); ?>layout/images/frontend/home-pic-4_big.jpg"><img src="<?php echo static_url(); ?>layout/images/frontend/home-pic-4.jpg"/></a></li>
        <li><a class="group1" href="<?php echo static_url(); ?>layout/images/frontend/home-pic-5_big.jpg"><img src="<?php echo static_url(); ?>layout/images/frontend/home-pic-5.jpg"/></a></li>
        <li><a class="group1" href="<?php echo static_url(); ?>layout/images/frontend/home-pic-6_big_big.jpg"><img src="<?php echo static_url(); ?>layout/images/frontend/home-pic-6.jpg"/></a></li>
        <li><a class="group1" href="<?php echo static_url(); ?>layout/images/frontend/home-pic-7_big.jpg"><img src="<?php echo static_url(); ?>layout/images/frontend/home-pic-7.jpg"/></a></li>
        <li><a class="group1" href="<?php echo static_url(); ?>layout/images/frontend/home-pic-8_big.jpg"><img src="<?php echo static_url(); ?>layout/images/frontend/home-pic-8.jpg"/></a></li>
        <li><a class="group1" href="<?php echo static_url(); ?>layout/images/frontend/home-pic-9_big.jpg"><img src="<?php echo static_url(); ?>layout/images/frontend/home-pic-9.jpg"/></a></li>        
    </ul>
</div>
<a id="next2" class="next" href="#"></a>



<div class="horizontal-seperator"></div>

<img style="float: left;margin-left: -1px;margin-top: 22px;" src="<?php echo static_url(); ?>layout/images/frontend/mazengar-title.png" />
<p class="full-width-text">Mazengar is an application that creates your own application. This is not a joke. This is the simple truth. Mazengar gives you the ability to create your own portfolio for your products or services either as a standalone application or a part within a comprehensive directory and listings application for residents. 
    <br/> 
    <br/>

    We offer different packages for clients depending on their needs and budgets. As you read this introduction you may start to wonder about how Mazenger could be beneficial for you as a merchant or service provider. Allow us to explain it in very simple terms.

</p>   

<img style="float: left;margin-left: -1px;margin-top: 22px;" src="<?php echo static_url(); ?>layout/images/frontend/want-to-title.png" />

<div class="build-application-wrapper">
    <div class="inside-content">
        <img style="float: left;margin-left: 0px;" src="<?php echo static_url(); ?>layout/images/frontend/build-your-application.jpg" />
        <div style="width: 414px;float: left;margin-left: 30px;clear: left;">
            <p class="sub-title-banner"><span style="color: black">Case One:</span> The Standalone Application</p>
            <p class="full-width-text" style="color:#767676;text-align:justify;font-size:16px">When you choose this option, you will simply fill a few pages via a very easy to use website which will immediately relay this information to your own application. In this application, you will be able to post your products, services, offers, discounts and sales pitches with pictures, descriptions managed by you at all times without the need for a developer or a designer. 
                <br/>When choose this package, you will automatically be added to the comprehensive directory and listings application as well, getting you more exposure within a vast collection of other restaurants and shops. 

                <br/>
                <br/>When choose this package, you will automatically be added to the comprehensive directory and listings application as well, getting you more exposure within a vast collection of other restaurants and shops. 
            </p>
        </div>				
    </div>				
</div>			

<div class="share-products-wrapper">
    <div class="inside-content">
        <img style="float: left;margin-left: 0px;" src="<?php echo static_url(); ?>layout/images/frontend/share-your-products.jpg" />
        <div style="width: 414px;float: left;margin-left: 30px;clear: left;">
            <p class="sub-title-banner"><span style="color: black">Case Two:</span> The comprehensive directory and listings application</p>
            <p class="full-width-text" style="color:#767676;text-align:justify;font-size:16px">With this option, you will also have to fill your own information, photos, logos, offers and discounts on the website, which will correspond to be listed within the directory. As a service provider, you will gain so much exposure among peers of the same trade or simply, if your shop sells menswear and is located in Maadi, when the user searches for menswear in his area, the GPS locator will suggest your place as one of the menswear shops around him or her. 
                <br/>
                <br/>
                There will be no more need for you to post things on Facebook or pay for Ads or hire developers and designers to create a website. An application of this size guarantees a large number of users instantly which means for customers for you without the added expense of marketing or PR campaigns.
            </p>
        </div>				
    </div>				
</div>					

<div class="horizontal-seperator"></div>

<img src="<?php echo static_url(); ?>layout/images/frontend/mazengar-benefits.png" />