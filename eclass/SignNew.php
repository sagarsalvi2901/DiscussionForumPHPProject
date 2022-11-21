<head>
<html>
<title>Feedback & Contact</title>
</head>
<body>
<caption align="left" ><font style="font-family:Verdana, Geneva, sans-serif; font-size:36px">&nbsp;<b>THE UNIVERSAL REGENCY</b></font></caption>




<form method="POST" >


<table align="center">
<tr>
<td>&nbsp;  First Name:<br /></td>
<td><input type="text" style="width: 200px; padding: 2px" Name="firstname"></td>
</tr>
<tr>
<td></td>
<td>&nbsp;
<?php
$flag=1;
if(isset($_POST['submit']))
{
	$a=$_POST['firstname'];
	if(empty($a))
	{
		$flag=0;
		echo "<font color='red'>* Please enter Your Name </font>";
	}
	elseif(strlen($a)<2)
	{ 
	    $flag=0;
	echo "<font color='red'>* Name Too short! </font>";
	}
}
?>
</td>
</tr>

<tr>
<td>&nbsp;  Last Name:<br /></td>
<td><input type="text" Name="lastname" style="width: 200px; padding: 2px"></td>
</tr>
<tr>
<td></td>
<td>&nbsp;
<?php
$flag=1;
if(isset($_POST['submit']))
{
	$b=$_POST['lastname'];
	if(empty($b))
	{
		$flag=0;
		echo "<font color='red'>* Please enter Your Name </font>";
	}
	elseif(strlen($b)<2)
	{ 
	    $flag=0;
	echo "<font color='red'>* Name Too short! </font>";
	}
}
?>
</td>
</tr>
<tr>
<td>&nbsp;  User Name:<br /></td>
<td><input type="text" Name="username" style="width: 200px; padding: 2px"></td>
</tr>
<tr>
<td></td>
<td>&nbsp;
<?php


$flag=1;
if(isset($_POST['submit']))
{
	$c=$_POST['username'];
	$con=mysql_connect("localhost","root","");
	$db=mysql_select_db("learning",$con);
	$sql = "select `user_name` from users where user_name = '$a' ; ";
	
	$result = mysql_query($sql);
	
	if(mysql_num_rows($result) > 0)
	{
		$flag=0;
    	echo "That username is already taken";
	}
	elseif(empty($c))
	{
		$flag=0;
		echo "<font color='red'>* Please enter a User Name </font>";
	}
	elseif(strlen($c)<5)
	{ 
	    $flag=0;
		echo "<font color='red'>* username is Too Short! </font>";
	}
	
}

?>
</td>
</tr>
<tr>
<td>&nbsp;  Type Your Password:<br /></td>
<td><input type="password" Name="password1" style="width: 200px; padding: 2px"></td>
</tr>
<tr>
<td></td>
<td>&nbsp;
<?php
$flag=1;
if(isset($_POST['submit']))
{
	$d=$_POST['password1'];
	if(empty($d))
	{
		$flag=0;
		echo "<font color='red'>* Please enter Your Name </font>";
	}
	elseif(strlen($d)<6)
	{ 
	    $flag=0;
	echo "<font color='red'>* Name Too short! </font>";
	}
}

?>
</td>
</tr>
<tr>
<td>&nbsp;  Retype:<br /></td>
<td><input type="password" Name="password2" style="width: 200px; padding: 2px"></td>
</tr>
<tr>
<td></td>
<td>&nbsp;
<?php
$flag=1;
if(isset($_POST['submit']))
{
	$e=$_POST['password2'];
	
	if (strlen($_POST['password1'])>6 && $_POST['password1'] != $e) 
	{
  		$flag=0;
		echo 'passwords do not match';
	}

}
?>
</td>
</tr>
<tr>
<td>&nbsp;  Email Address:<br /></td>
<td><input name="email" type="text" style="width: 200px; padding: 2px" /></td>
</tr>
<tr>
<td></td>
<td>&nbsp;
<?php
if(isset($_POST['submit']))
{
	$b=$_POST['email'];
	if(empty($b))
	{
		$flag=0;
		echo "<font color='red'>* Please enter e-mail id </font>";
	}
	elseif(!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $b)) 
    	{ 
	$flag=0;
	echo "<font color='red'>* Invalid email address format </font>";
	}
}
?>
</td>
</tr>

</table>
 <input name="submit" type="submit" value="Submit Your Comment" />                   

</form>

<?php
if($flag==1&&isset($_POST['submit']))
{
$connection = mysql_connect("localhost","root","");
if (!$connection)
	{
		die("<h1 align=center>database connection failed: " . mysql_error()."</h1>");
	}

$select = mysql_select_db("learning", $connection);
if(!$select)
	{
		die("<h1 align=center> database selection failed:" . mysql_error()."</h1>");
	}
	
$a=$_POST['username'];
$b=$_POST['email'];
$c=$_POST['message'];	
	
$query="insert into users (`user_name`) VALUES ('$a');";

 $result=mysql_query($query,$connection);
if(!$result)
{
	echo mysql_error();
}
else
{
	echo "";
	header("Location:Authenticate.php");
}
}

?>
</body>
</html>