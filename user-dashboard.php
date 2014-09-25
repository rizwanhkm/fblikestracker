
<html>
    <head>
        
        <link rel="stylesheet" href="style1.css"/>
        <link rel="stylesheet" href="leaderboard.css"/>
        
        <script type="text/javascript" src="user-dashboard.js"></script>
        <script type="text/javascript">
         start=1;
                function previous()
                {
                    if(start<=6){
                        start =1;

                    }
                    else {
                        start-=6;
                    }
                        ajaxcall(start);
                }
                function next()
                {
                    start+=6;
                    ajaxcall(start);
                }

                function getleader ()
                    {

                        ajaxcall(1);
                    }
                function ajaxcall(a)
                {
                    var ul=document.getElementById("leaderboard");
                        ul.innerHTML= "";
                        var xmlhttp=new XMLHttpRequest();
                        var url="get-leaders.php?start="+a+"&number=6";
                        xmlhttp.open("GET",url,true);
                        xmlhttp.send();

                        xmlhttp.onreadystatechange=function()
                        {
                            if (xmlhttp.readyState==4 && xmlhttp.status==200)
                            {

                                var result=JSON.parse(xmlhttp.responseText);
                                var numberofleaders= result.numberofleaders;

                                var i=0;
                                for (i=0;i<numberofleaders;i++)
                                {
                                    var tag;
                                    tag = '<div id="leader'+i+'" class="leader">'; 
                                        tag += '<img src ="<?php echo $dirname?>/';
                                        tag += result.leader[i].profilepic.substr(2);
                                        tag += '" class="profilepicleader">';
                                        tag += '<div class="details" id="leaderdetails'+i+'">'+result.leader[i].name+' refered '+result.leader[i].counter+' likers';
                                            tag += '<div class = "likers" id="likers'+i+'">';
                                            var j;
                                            var numberoflikers=result.leader[i].likers[0].rows;
                                            for (j=0;j<numberoflikers;j++)
                                            {
                                                tag += '<a href = "https://facebook.com/'+result.leader[i].likers[0].liker[j].invitees_id+'"><div class ="liker"><img src ="'+result.leader[i].likers[0].liker[j].profile_pic.substr(2)+'" class="profilepicliker"></div></a>';
                                            }

                                            tag += '</div>';
                                        tag += '</div>';
                                    tag += '</div>';
                                    ul.innerHTML+=tag;
                                }
                            }
                        }
                }
        </script>

    </head>
    <body id='body' onload='showdashboard()'> 
        <?php
        include 'app-details.php';
        include 'session-check.php';
        require 'connect.php';
        
        $query="SELECT * FROM `$reg_users` where `fbid` ='$fbid' ";
        $result = $db->query($query) or die ('There was an error during database access [' . $db->error . ']');

        if ($result->num_rows>1)
        {
            ?>
                <script type="text/javascript">
                    function redirect()
                    {
                        window.location="https://www.facebook.com/dialog/oauth?client_id=<?php echo $app_id;?>&redirect_uri=<?php echo $dirname; ?>/login-process.php&scope=public_profile,user_friends,email";
            }
                        alert("Database Error");
                        setTimeout(redirect(), 1000);
                </script>
            <?php
        }
        $data=$result->fetch_assoc();

        ?>
    
       <div class="nav">
            <ul class="left">
               <li><a href="https://www.facebook.com/delta.nit.trichy"><img src="./images/delta.png"></a> </li>
               <li><a href="#" onclick="showleaderboard()">Leaderboard</a> </li>
               <li><a href="#" onclick="showdashboard()">Dashboard</a> </li>
               <li><a href="updates.php">Updates</a> </li>

            </ul>
            <ul class="right">
                <li><a href="logout.php">Logout</a></li>

            </ul>
       </div>
        
       <div class="content">
            <div class="dashboard" id="dashboardcontainer">
                <?php echo "Hello " . $data['display_name']; ?>
                <br><br>
                <img class="profile_pic" src='<?php echo $data['profile_pic']?>' >        
                <br>
                <p id="refferal_link"> Your Referal Link is <a href = "<?php echo $dirname; ?>/likes.php?fbid=<?php echo $fbid ?>"> <?php echo $dirname; ?>/likes.php?fbid=<?php echo $fbid ?></a></p>
                <p id="likes"> You Refered <?php echo $data['counter']; ?> friends to like our page</p>
            </div>
           
           <div class="leaderboardcontainer" id="leaderboardcontainer">
                <div id="leaderboard" class="leaderboard"></div>
                <div id="leaderboardcontroller" class="leaderboardcontroller">
                        <a href="#" onclick="previous()">Previous</a>
                        <a href="#" onclick="next()">Next</a>
                    
                </div>
           </div>
           
        </div>

   
    </body>

</html>



