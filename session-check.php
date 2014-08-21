<?php
        session_start();
        $fbid=$_SESSION['fbid'];
        $access_token=$_SESSION['access_token'];
        
        if(!isset($_SESSION['fbid']))
        {
            ?>
                    <script type="text/javascript">
                        function redirect()
                            {
                                window.location="http://likestracker.com/index.php";
                            }
                        alert("Session Not initiated Properly");
                        setTimeout(redirect(), 1000);
                    </script>
            <?php
        }