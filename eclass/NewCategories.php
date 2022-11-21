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
<title>New Categories</title>
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
            	<h1>Add new Categories</h1>
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
    		echo 'Sorry, you have to be <a href="/forum/signin.php">signed in</a> to create a new Category.';
		}
	else
		{
			echo '<form method="POST" name="frm2">';
			$flag = 1;
			echo'&nbsp;
			<table border=0 align="center">
			<tr align="center">
			<td> 
			<input type="text" style="width: 200px; padding: 2px"  placeholder="type in new category name" autofocus="autofocus" name="cat_name" />
			</td>
			</tr>
			<tr align="center">
			<td> 
			<textarea name="cat_description" rows="4" cols="50"  placeholder="type in new category description" /></textarea>
			</td>
			</tr>
			<tr align="center">
			<td> 									
            <input type="submit" value="Add New Category" name="Add_Category" /> ';
			echo '  </td>  </tr> </form>
			<tr align="center">
			<td> 	';
			if(empty($_POST['cat_name'])) 
			{
				$flag=0;
				echo '<font color="#FF0000">The name is mandatory.</font>';
			}
			elseif(empty($_POST['cat_description']))
			{
				$flag=0;
				echo '<font color="#FF0000">The description is mandatory.</font>';
			}
			else
			{
				$connection = mysql_connect("localhost","root","");
				if (!$connection)
  				{
   					die("<h1 align=center>database connection failed: " . mysql_error()."</h1>");
  				}
				
				$db_select = mysql_select_db("learning", $connection);
				
				if($flag=1 && isset($_POST['Add_Category']))
				{
					$a=$_POST['cat_name'];
					$b=$_POST['cat_description'];
					$query="insert into categories (`cat_name`, `cat_description`) VALUES ('$a','$b');";
					$result=mysql_query($query);
						
						if(!$result)
						{
							echo mysql_error();
						}
						else
						{
							$sql = "COMMIT;";
                    		$result = mysql_query($sql);
							header("Location:CategoryIndex.php");
						}
				}
			}
		
		
		}
		
	echo'</table>';









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
