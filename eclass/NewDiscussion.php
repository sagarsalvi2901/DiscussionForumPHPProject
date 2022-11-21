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
elseif($_SESSION['user_level']=="admin")
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

<?php
$con=mysql_connect("localhost","root","");
$db=mysql_select_db("learning",$con);  
mysql_query("SET AUTOCOMMIT=0");
mysql_query("BEGIN");
  if($_SESSION['signed_in'] == false)
{
    
    echo 'Sorry, you have to be <a href="/forum/signin.php">signed in</a> to create a topic.';
}
else
{
     $sql = "SELECT cat_id, cat_name, cat_description FROM categories";
     $result = mysql_query($sql);
        
		if(!$result)
        {
            
            echo 'Error while selecting from database. Please try again later.';
        }
        else
        {
            if(mysql_num_rows($result) == 0)
            {
                
                if($_SESSION['user_level'] == 'admin')
                {
                    echo 'You have not created categories yet.';
                }
                else
                {
                    echo 'Before you can post a topic, you must wait for an admin to create some categories.';
                }
            }
            else
            {
         
                echo '<form method="POST" action="">
					
					&nbsp;
					<table border=0 align="center">
					<tr align="center">
					<td> 
					<input type="text" style="width: 200px; padding: 2px" name="Discussion_Subject" placeholder="type new discussion topic to start" />
					</td>
					</tr>
					<tr align="center">
					<td> 
					<select name="topic_cat">';
                    while($row = mysql_fetch_array($result))
                    {
                        echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                    }
                	echo '</select>
					</td>
					</tr>
					<tr align="center">
					<td>  
					<textarea name="Post_Content" placeholder="add a comment to start off discussion"
					rows="4" cols="50"></textarea>	
					</td></tr>
					<tr align="center">
					<td> 									
                	<input type="Submit" value="Add new topic" name="Add_Subject" /> </form>';
					echo '  </td>  </tr>
					<tr><td>';
			
					$flag=1;
						 
		    		if(empty($_POST['Discussion_Subject']))
        				{
							$flag=0;
							echo '<font color="#FF0000">please enter a title for new discussion</font>';
						}
					elseif($flag=1 && isset($_POST['Add_Subject']))
						{
							$one=$_POST['Discussion_Subject'];
							$three=$_SESSION['user_id'];
							$four=$_POST['topic_cat'];
         					$sql = "insert into subject(`topic_subject`, `topic_date`, `topic_cat`, `topic_by`)
                  	 		VALUES('$one',CURRENT_TIMESTAMP,'$four','$three')";
		 					$success=mysql_query($sql,$con);
		 						
								
									if(!$success)
           							 {
               							 echo 'An error occured while creating new discussion';
										 $sql = "ROLLBACK;";
                    					 $success = mysql_query($sql);
									 }
									else
									 {
										 $two=$_POST['Post_Content'];
										 $five=$_SESSION['user_id'];
										 $subjectid = mysql_insert_id();
										 $sql = "insert into comments(`comment_content`, `comment_date`, `comment_topic`, `comment_replier`) values ('$two', CURRENT_TIMESTAMP, '$subjectid', '$five')";
										 $success=mysql_query($sql,$con);
										 		
												if(!$success)
           							 					{
               							 					echo 'An error occured while generating post';
										 					$sql = "ROLLBACK;";
                    										$success = mysql_query($sql);
									 					}
												elseif($two == "")
           							 					{
               							 					echo '<font color="#FF0000">add a comment to start off discussion</font>';
										 					$sql = "ROLLBACK;";
                    										$success = mysql_query($sql);
									 					}
												else
														{
															$sql = "COMMIT;";
                    										$success = mysql_query($sql);
															header("Location:CategoryIndex.php");
														}
									 }
						}
		 
		 
		 
		 echo'</td></tr></table>';
		    }
      
	    }
   

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
