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
}
	 ?>
 <form method="post" enctype="multipart/form-data">
            <table>
            <tr align="center">
					<td> 
					<select name="topic_cat">
                    <?php
                    while($row = mysql_fetch_array($result))
                    {
                        echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                    }
                	echo '</select>';
					?>
					</td>
					</tr>
                <tr>
                    <td>please select a file</td></tr>
                <tr>
                    <td>
                        <input type="hidden" name="MAX_FILE_SIZE"
                               value="16000000">
                        <input name="userfile" type="file" id="userfile"> 
                    </td>
                    <td width="80"><input name="upload"
                                          type="submit" class="box" id="upload" value=" Upload "></td>
                </tr>
            </table>
        </form>
		<?php
if (isset($_POST['upload']) && $_FILES['userfile']['size'] > 0) {
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
        $fileName = addslashes($fileName);
    }
    $con = mysql_connect('localhost', 'root', '') or die(mysql_error());
    $db = mysql_select_db('learning', $con);
    if ($db) {
        $query = "INSERT INTO upload (name, size, type, content ) " .
                "VALUES ('$fileName', '$fileSize', '$fileType', '$content')";
        mysql_query($query) or die('Error, query failed');
        mysql_close();
        echo "<br>File $fileName uploaded<br>";
    } else {
        echo "file upload failed";
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
