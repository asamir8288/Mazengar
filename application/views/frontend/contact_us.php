<div  class="girls-banner" style="height: 243px;">
    <img src="<?php echo static_url(); ?>layout/images/frontend/girls-banner-about.jpg" />								
</div>

<div style="float:left; width:222px;margin-left: 10px;">
    <div  class="mazengar-application" >
        <a href="https://play.google.com/store/apps/details?id=com.mazengar&feature=search_result#?t=W251bGwsMSwyLDEsImNvbS5tYXplbmdhciJd" target="_blank">
            <img style="border: none;" src="<?php echo static_url(); ?>layout/images/frontend/mazengar-application.jpg" />	
        </a>							
    </div>			

</div>


<div class="horizontal-seperator"></div>
<div style="clear: both;"></div>
<div style="margin-top:  30px;">
    <div style="float: left;width: 500px;color: #404040;font-family: calibri, arial, sans-serif;font-size: 17px;">
        <strong style="font-size: 19px;font-weight: bold;text-transform: uppercase;">Dominos Media, LLC</strong> <br />
        14 Mosadak St. - Flat 83<br />
        Dokki - Giza - Egypt<br />
        <br />
        Tel. +20 100 373 8818<br />
        <a href="mailto:mail@mazengar.com">mail@mazengar.com</a><br />

    </div>

    <div style="float: left;">
        <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
        <div id="map" style="border: 4px solid #E5E3DF;width: 450px; height: 260px;">            
        </div> 
        <script type="text/javascript">
            var locations = [
                ['Dominos Media <br/>14 Mosadak St. - Flat 83', '30.0405839', '31.2105018', 4],
                           
            ];

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: new google.maps.LatLng(30.0405839, 31.2105018),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            })
            var infowindow = new google.maps.InfoWindow();
            var marker, i;
            for (i = 0; i < locations.length; i++) {  
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map
                });
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        </script>
    </div>
</div>

<div style="clear: both;height: 150px;"></div>
