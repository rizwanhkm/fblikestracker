<?php
    
    //______________________________________________________________________________________________________________________________________
    //Getting Referall ID
    
    include 'session-check.php';    
?>
    <html>
        <head>
                
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
                        .result
                            {
                                border: 1px solid;
                                height: 20px;
                                width :100%;
                                border: 1px solid;
                                font-family:serif;
                                font-size:13px;
                                
                            }

                </style>
                <script>
                    //______________________________________________________________________________________________________________
                    //Facebook Javascript SDK 
                    (function(d, s, id){
                                          var js, fjs = d.getElementsByTagName(s)[0];
                                          if (d.getElementById(id)) return;
                                          js = d.createElement(s); js.id = id;
                                          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=694159134003863&version=v2.0";
                                          fjs.parentNode.insertBefore(js, fjs);
                                        }(document, 'script', 'facebook-jssdk'));
                    
                    //______________________________________________________________________________________________________________
                    //Sending Ajax Request when like button is clicked
                    
                    
                    function clicked(a)
                    {
                        var xmlhttp = new XMLHttpRequest();
                        if (a=='1')
                        {
                                xmlhttp.open("GET","http://likestracker.com/likesdbconnect.php?liked=1",true);
                        }
                        else
                        {
                                xmlhttp.open("GET","http://likestracker.com/likesdbconnect.php?liked=0",true);
                        }
                        xmlhttp.send();
                        xmlhttp.onreadystatechange=function()
                            {
                            if (xmlhttp.readyState==4 && xmlhttp.status==200) 
                                {
                                    var result = JSON.parse(xmlhttp.responseText);
                                    if ( result.redirect==1)
                                    {   
                                        alert('You Have Not Logged In');
                                        window.location="http://likestracker.com/likes.php?fbid=<? echo $_SESSION['fbid'];?>";
                                    }
                                    document.getElementById('result').innerHTML += result.data;

                                }
                            }
                        
                    }
                    
                    //______________________________________________________________________________________________________________
                    //Adding Evemt Listener to Like button
                    var page_like= function() {
                        
                        clicked('1');
                    }
                    var page_unlike= function() {
                        
                        clicked('0');
                    }

                    // In your onload handler
                    var liked = function(){
                       
                    FB.Event.subscribe('edge.create', page_like);
                    FB.Event.subscribe('edge.remove', page_unlike);
                    }
                    
                  
                </script>
            
        </head>
        <body onload=liked();>
        <div id="fb-root"></div>
                        <div id = result1 class="result1"></div>
            
            <div id = result class="result"></div>
            <div  class="fb-like-box" data-href="https://www.facebook.com/delta.nit.trichy" data-width="1000" data-height="500" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="true" data-show-border="true"></div>


        </body>
</html>