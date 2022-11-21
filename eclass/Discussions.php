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
        	<h1>eClass</h1>
            <ul>
           	  
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



$sql = "select topic_id, topic_subject from subject
		where subject.topic_id = '$_GET[topic_id]' ; ";
$result = mysql_query($sql);
if(!$result)
{
    echo 'The selection could not be displayed, please try again later.' . mysql_error();
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo 'This discussion topic does not exist.';
    }
    else
    {
       
        while($row = mysql_fetch_array($result))
        {
			echo '<h2>discussion about ′' . $row['topic_subject'] . '′</h2>';
        }
		
		
		$sql =" select comments.comment_topic, comments.comment_content, comments.comment_date, comments.comment_replier, 
				users.user_cn, users.user_name
				from comments LEFT JOIN users
				ON comments.comment_replier = users.user_cn
				WHERE comments.comment_topic = '$_GET[topic_id]'
				ORDER BY comments.comment_date ASC ; ";
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
							echo'<form method="POST" name="">';
							echo'<table border="1" >
								<tr>
								<th colspan="2">&nbsp;</th>
							  	</tr>';
								
								while($row = mysql_fetch_array($result))
									{
											echo'<tr>';
											echo'<td>';
											echo'<h5>';
											echo '<a href="Profiles.php?profile_id='.$row['user_cn'].'">'.$row['user_name'] .'</a>';
											echo '<br>';
											echo date('d-m-Y', strtotime($row['comment_date']));
											echo'</h5>';
											echo'</td>';
											echo'<td>';
											echo'<h4>';
											echo $row['comment_content'];
											echo'</h4>';
											echo'</td>';
											echo'</tr>';
									}
							echo'<tr>';
							echo'<td colspan="2">';
							echo'<textarea name="reply" rows="4" cols="50"  placeholder="type in your comment" ></textarea>';
							echo '&nbsp;';
							echo'<input name="post_ok" type="submit" value="Comment" />';
							
								$flag=1;
								if(empty($_POST['reply'])) 
								{
									$flag=0;
									echo '<font color="#FF0000">The comment field is empty.</font>';
								}
								elseif($flag=1 && isset($_POST['post_ok']))							
								{
									$a=$_POST['reply'];
									$b=$_SESSION['user_id'];
									$query="insert into comments
											(`comment_content`,`comment_date`, `comment_topic`,`comment_replier`) 
											values ('$a', CURRENT_TIMESTAMP, '$_GET[topic_id]', '$b')";

									$result=mysql_query($query);
									if(!$result)
									{
									echo mysql_error();
									}
									else
									{
									echo "";
									header("Location:Discussions.php?topic_id=$_GET[topic_id]");
							echo'</td>';
							echo'</tr>';
								}
							
							
								}
							echo'</table>';
							echo'</form>';
						}
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
