<?php
    
    //______________________________________________________________________________________________________________________________________
    //Getting Referall ID
    
    $fbid=$_GET['fbid'];

    ?
<html xmlns:fb="http://ogp.me/ns/fb#">
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=694159134003863&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
    
    function setsize() {
    var width=document.width;
    var height= document.height;
    
    fblikebox.setAttr('data-width',width);
    fblikebox.setAttr('data-height',height);
    }
    </script>
    <style type="text/css">
    
        
        #fb-root
            {
              display: none;
            }

        .fb_iframe_widget, .fb_iframe_widget span, .fb_iframe_widget span iframe[style] 
            {
             
              width: 100% !important;
              height: 100% !important;
            }
    
    </style>
    <div onload=setsize()>
    <div  class="fb-like-box" data-href="https://www.facebook.com/delta.nit.trichy" data-width="1000" data-height="500" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="true" data-show-border="true"></div>
    </div>
    
    
    </body>
</html>