<?php
session_start(); 

if(!$_SESSION['signed_in'])
    {
      	header("Location:Authenticate.php");
    }
elseif($_SESSION['user_level']=="guest")
	{
		header("Location:redirect1.html");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>The Slant by Bryant Smith</title>
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


if($_SESSION['user_level']=="guest")
	{
		echo '<a href="AdminMaster.php">Master Page</a>';
		echo '&nbsp;';
		echo '&nbsp;';
		echo '&nbsp;';
		echo '<a href="CategoryIndex.php">Forum Main Page</a>';
		echo '&nbsp;';
		echo '&nbsp;';
		echo '&nbsp;';
		echo '<a href="NewDiscussions.php">Add new Topic</a>';
	}
else
	{
		echo '<a href="AdminMaster.php">Master Page</a>';
		echo '&nbsp;';
		echo '&nbsp;';
		echo '&nbsp;';
		echo '<a href="CategoryIndex.php">Forum Main Page</a>';
		echo '&nbsp;';
		echo '&nbsp;';
		echo '&nbsp;';
		echo '<a href="NewDiscussion.php">Add new Topic</a>';
		echo '&nbsp;';
		echo '&nbsp;';
		echo '&nbsp;';
		echo '<a href="NewCategories.php">Add new Category</a>';
		echo '&nbsp;';
		echo '&nbsp;';
		echo '&nbsp;';
	}
     
         
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
<p>
<?php
$con=mysql_connect("localhost","root","");
$db=mysql_select_db("learning",$con);  
$sql = "SELECT * FROM users";
$result = mysql_query($sql);
if(!$result)
	{
		echo 'Error while selecting from database. Please try again later.';
	}
	else
	{
					echo'<form method="POST" action="">
					&nbsp;
					<table border=0 align="center">
					<tr align="center">
					<td> 
					Select a user name to delete : 
					</td>
					</tr>
					<tr align="center">
					<td> 
					<select name="user_select">';
                    while($row = mysql_fetch_array($result))
                    {
                        echo '<option value="' . $row['user_cn'] . '">' . $row['user_name'] . '</option>';
                    }
                	echo '</select>
					</td>
					</tr>
					<tr align="center">
					<td> <input type="Submit" value="Delete User" name="delete" /> </form>';
					echo '  </td>  </tr></form>
					<tr><td>';
					
					if(isset($_POST['delete']))
					{
							$remove=$_POST['user_select'];
         					$sql = "delete from `users` WHERE user_cn = $remove";
							$success=mysql_query($sql,$con);
		 						
								
									if(!$success)
           							 {
               							 echo 'An error occured while executing';
										 $sql = "ROLLBACK;";
                    					 $success = mysql_query($sql);
									 }
									 else
									 {
										$sql = "COMMIT;";
                    					$success = mysql_query($sql);
										header("Location:AdminMaster.php");
									 }
					
					}
					
					
					echo'</td></tr>';
	}
	
	
					
					
					
					
						
					
					echo'</table>';
	
	
?>
</p>


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
