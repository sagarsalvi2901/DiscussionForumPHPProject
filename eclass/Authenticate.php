
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Authentication</title>
<script>
window.location.hash="no-back-button";
window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
window.onhashchange=function(){window.location.hash="no-back-button";}
</script> 
</head>

<body>
    <div id="page">
		
        <div id="header">
        	<h1>The Slant</h1>
            <ul>
           	   	<li><a href="index.html">Home</a></li>
               	<li><a href="#">Services</a></li>
                <li><a href="#">Notices</a></li>
                <li><a href="#">Feedback</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </div>
  
        <div id="main">
        
        	<div class="main_top">
            	<h1>Page Title</h1>
            </div>
            
           	<div class="main_body">
      <FORM METHOD=POST name=form > 

<table border=0 align="center">
<tr align="center">
<td >
<INPUT TYPE="TEXT" style="width: 200px; padding: 4px" Name="username" placeholder="type in username" autofocus="autofocus" >
</td></tr>
<tr align="center"><td>
<INPUT TYPE="PASSWORD" style="width: 200px; padding: 4px" NAME="password" placeholder="type in password"> 
</td></tr>
<tr colspan=2 align="center">
<td align=center>
<INPUT TYPE="SUBMIT" NAME="validate" VALUE="Authenticate"> 
</td></tr>
<tr align="center">
<td>
<?php
echo '&nbsp';
if(isset($_POST['validate']))
{




	$user=$_POST['username'];
	$pass=$_POST['password'];
	if(empty($user)&&empty($pass))
	{
		
		echo "<font color='#FF0000'>The username & password fields must not be empty.</font>";
	}
	
	
elseif(isset($_POST['validate']))
{
	$user=$_POST['username'];
	$pass=$_POST['password'];


$con=mysql_connect("localhost","root","root");
$db=mysql_select_db("learning",$con);

$query= "SELECT user_cn,user_name,user_fname,user_lname,user_key,user_level FROM users
          WHERE user_name = '$user' AND user_key = '$pass';";

$result=mysql_query($query);
$row = mysql_fetch_array($result);

$datauser = $row['user_name'];
$datakey = $row['user_key'];
$datalevel = $row['user_level'];
$login_user=strcmp($user,$datauser);
$login_key=strcmp($pass,$datakey);

if($login_user==0 && $login_key==0)
{
session_start(); 
$_SESSION['signed_in'] = true;
$_SESSION['user_id']    = $row['user_cn'];
$_SESSION['user_name']  = $row['user_name'];
$_SESSION['user_fname']  = $row['user_fname'];
$_SESSION['user_lname']  = $row['user_lname'];
$_SESSION['user_level'] = $row['user_level'];
$_SESSION['user_status'] = $row['user_status'];
header("Location:MasterPage.php");
}
else
echo "<font color='#FF0000'>Your userid or password is incorrect.</font>";
}
}
?>
</td></tr>
<tr align="center">
<td>
Not a user.&nbsp;<a href="SignNew.php">SignUp here</a>
</td></tr>
</table>
</FORM>
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