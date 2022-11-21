<?php
session_start(); 
 if(!$_SESSION['signed_in'])
    {
      header("Location:Authenticate.php");
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Mater Page</title>
</head>

<body>
    <div id="page">
		
        <div id="header">
        	<h1>The Slant</h1>
            <ul>
           	   	<li><a href="#">Home</a></li>
               	<li><a href="Authenticate.php">Services</a></li>
                <li><a href="#">Notifications</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
  
        <div id="main">
        
        	<div class="main_top">
            	<h1>Page Title</h1>
            </div>
            
           	<div class="main_body">
    <div id="menu">
    
 <?php



     
         
      echo' <div id="userbar">';
  

    if($_SESSION['signed_in'])
    {
        echo  'Hello, Welcome ' . $_SESSION['user_fname']  . '&nbsp;' . $_SESSION['user_lname'];
		echo '&nbsp;';
		echo '<a href="Logout.php">Sign Out</a>';
    }
	  echo '</div>';
?>
&nbsp;
</div>

        <?php
			if($_SESSION['user_level']=="admin")
			{
				echo'<section>  
            	<br>
            	<h3>Manage Users</h3>
				<ul class="list2">
				<li>link to add new admin<br/><a href="NewAdmin.php">add a new admin</a></li><br/>
				<li>link to delete a user<br/><a href="DeleteUser.php">delete a existing user</a></li><br/>
				</ul>';
			    echo'</section> ';
		   }
      ?>
      <?php
			if($_SESSION['user_level']=="admin")
			{
				  echo'<section>
				  <br>
				  <h3>Forum Tools</h3>
				  <ul class="list2">
				  <li>link to forum home<br/><a href="CategoryIndex.php">go to forum main page</a></li><br/>
				  <li>link to delete a category<br/><a href="DeleteCategories.php">delete a category</a></li><br/>
				  <li>link to delete a topic<br/><a href="DeleteTopics.php">delete a topic</a></li><br/>
				  </ul>
				  </section> ';
		 	}
			elseif($_SESSION['user_level']=="guest")
			{
				  echo'<section>
				  <br>
				  <h3>Forum Tools</h3>
				  <ul class="list2">
				  <li>link to forum home<br/><a href="CategoryIndex.php">go to forum main page</a></li><br/>
				  </ul>
				  </section> ';

				
		
			}
       ?>
         <section>
          <br>
          <h3>Share Study Maerial [Documents, PDFs, Images etc.]</h3>
              <ul class="list2">
              <li>link to upload contents<br/><a href="Uploading.php">Share Contents</a></li><br/>
              <li>link to download contents<br/><a href="#">Download Contents</a></li><br/>
             </ul>
         </section> 
         
         <section>
          <br>
          <h3>Account Settings</h3>
              <ul class="list2">
              <li>link to chnage password<br/><a href="CategoryIndex.php">change password</a></li><br/>
              <li>link to chnage profile picture<br/><a href="#">change profile picture</a></li><br/>
              <li>link to change profile visibility<br/><a href="Class.php">chnage profile visibility</a></li><br/>
             </ul>
         </section> 
         
         <?php
			if($_SESSION['user_level']=="admin")
			{
				echo'<section>  
            	<br>
            	<h3>Notifications & Feedbacks</h3>
				<ul class="list2">
				<li>link to add new admin<br/><a href="NoticeGen.php">add new notification</a></li><br/>
				<li>link to delete a user<br/><a href="Seefeedback.php">view user feedbacks</a></li><br/>
				</ul>';
			    echo'</section> ';
		   }
      ?>
      
    
            </div>
            
           	<div class="main_bottom"></div>
            
        </div>
        
        
        
        <div id="footer">
        <p>
        
        </p>
        </div>
        
        </div>
</body>
</html>