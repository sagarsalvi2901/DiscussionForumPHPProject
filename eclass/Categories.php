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
            	<h1>Discussion Topics</h1>
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

	
	
$sql = "SELECT `cat_id`, `cat_name`, `cat_description` FROM categories
        WHERE cat_id = '$_GET[cat_id]' ; ";
 
$result = mysql_query($sql);

if(!$result)
{
    echo 'The category could not be displayed, please try again later.' . mysql_error();
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo 'This category does not exist.';
    }
    else
    {
       
        while($row = mysql_fetch_array($result))
        {
            echo '<h3>Category : ' . $row['cat_name'] . '</h3>';
			echo'<br>';
        }
     
        $sql = "SELECT topic_id, topic_subject, topic_date, topic_cat FROM subject
                WHERE topic_cat = '$_GET[cat_id]' ; ";
        $result = mysql_query($sql);
				
				if(!$result)
				{
    				echo 'The discussion topics could not be displayed, please try again later.';
				}
				else
				{
    					if(mysql_num_rows($result) == 0)
       					{
            				echo 'There are no discussion topics in this category yet.';
       					}
    					else
       					{
							echo '<table border="1">
							<tr>
							<th>Topic</th>
							<th>Created at</th>
							</tr>'; 
								 
							while($row = mysql_fetch_array($result))
							{               
								echo '<tr>';
								echo '<td>';
								echo '<h4><a href="Discussions.php?topic_id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '		</a></h4>';
								echo '</td>';
								echo '<td>';
								echo date('d-m-Y', strtotime($row['topic_date']));
								echo '</td>';
								echo '</tr>';
							}
						}
        }
  
echo'</table>';

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
