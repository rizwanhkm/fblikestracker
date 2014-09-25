<html>
    <head>
                
        <link rel="stylesheet" href="style1.css"/>
        <link rel="stylesheet" href="leaderboard.css"/>
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
    <body  onload="getleader()"> 
          
       <div class="nav">
       <ul class="left">
          <li><a href="https://www.facebook.com/delta.nit.trichy"><img src="./images/delta.png"></a> </li>
               <li><a href="leaderboard.php" >Leaderboard</a> </li>
               <li><a href="user-dashboard.php">Dashboard</a> </li>
               <li><a href="updates.php">Updates</a> </li>

       </ul>
        <ul class="right">
            <li><a href="index.php">Register</a></li>
            
        </ul>
       </div>
       <div class="content" id ="content">
                <div id="leaderboard" class="leaderboard"></div>
                <div id="leaderboardcontroller" class="leaderboardcontroller">
                        <a href="#" onclick="previous()">Previous</a>
                        <a href="#" onclick="next()">Next</a>
                    
                </div>
      </div>
    </body>
</html>



