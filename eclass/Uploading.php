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
		
	}
elseif($_SESSION['user_level']=="admin")
	{
		
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
         
                	echo '<form method="post" enctype="multipart/form-data">
					&nbsp;
					<table border=0 align="center">
					<tr align="center">
					<td> 
					<input type="text" style="width: 200px; padding: 2px" name="Upload_Title" placeholder="add a title for your upload" />
					</td>
					</tr>
					<tr align="center">
					<td> 
					Select a related category :
					</td>
					</tr>
					<tr align="center">
					<td> 
					<select name="select_cat">';
                    while($row = mysql_fetch_array($result))
                    {
                        echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                    }
                	echo '</select>
					</td>
					</tr>
					<tr align="center">
					<td>  
					<input type="hidden" name="MAX_FILE_SIZE" value="16000000">
                    <input name="userfile" type="file" id="userfile"> 
					</td></tr>
					<tr align="center">
					<td> 
					<input name="upload" type="submit" class="box" id="upload" value=" Upload ">
					</td>
					</tr>
					<tr><td>';
					
					$flag=1;
						 
		    		if(empty($_POST['Upload_Title']))
        				{
							$flag=0;
							echo '<font color="#FF0000">please enter a title for new discussion</font>';
						}
					elseif($flag=1 && isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
						{
							$fileName = $_FILES['userfile']['name'];
							$tmpName = $_FILES['userfile']['tmp_name'];
							$fileSize = $_FILES['userfile']['size'];
							$fileType = $_FILES['userfile']['type'];
							$fileType = (get_magic_quotes_gpc() == 0 ? mysql_real_escape_string(
													$_FILES['userfile']['type']) : mysql_real_escape_string(
													stripslashes($_FILES['userfile'])));
							$fp = fopen($tmpName, 'r');
							$content = fread($fp, filesize($tmpName));
							$content = addslashes($content);
							fclose($fp);
							if (!get_magic_quotes_gpc()) {
								$fileName = addslashes($fileName);}
							$uno = $_SESSION['user_id'];
							$dos = $_POST['select_cat'];
							$con = mysql_connect('localhost', 'root', '') or die(mysql_error());
    						$db = mysql_select_db('learning', $con);
    						if ($db) 
							{
        						$query = "insert into upload(`name`, `size`, `category`, `uploader`, `type`, `content`)
                						 values('$fileName', '$fileSize', '$dos', '$uno', '$fileType', '$content')";
        						
								mysql_query($query) or die('Error, query failed');
        						mysql_close();
        						echo "<br>File $fileName uploaded<br>";
    						} else {
        						echo "file upload failed";
    						}
}
					
					
					
					
					
					
					
					
					
					echo'
					</td>
					</tr>
					</table>
					</form>';
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
