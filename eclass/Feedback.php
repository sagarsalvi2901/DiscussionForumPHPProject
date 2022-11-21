<head>
<html>
<title>Feedback & Contact</title>
</head>
<body>

<form method="POST" name="frm1">

<br />
<img src="an/Untitled-1.png" align="right" hspace="40" />
<table>
<tr>
<td>&nbsp;  Name:<br /></td>
<td><input type="text" Name="name"></td>
</tr>
<tr>
<td></td>
<td>&nbsp;
<?php
$flag=1;
if(isset($_POST['submit']))
{
	$a=$_POST['name'];
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
<td>&nbsp;  Email Address:<br /></td>
<td><input name="email" type="text" size="20"  /></td>
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
<tr>
<td>&nbsp;  Comment:<br /></td>
<td><textarea name="message" rows="5" cols="40" ></textarea></td>
</tr>
<tr>
<td></td>
<td>&nbsp;
<?php
if(isset($_POST['submit']))
{
	$c=$_POST['message'];
	if(empty($c))
	{
		$flag=0;
		echo "<font color='red'>* Please enter Your Comments</font>";
	}
	elseif(strlen($c)<10)
	{ 
	$flag=0;
	echo "<font color='red'>* Too short! More than 10 words atleast. </font>";
	}
}
?>
</td>
</tr>
<tr>
<td colspan="3" align="center"><input name="submit" type="submit" value="Submit Your Comment" />
</td>
</tr>

</table>
                    
               <br />
               <br />
                            
                <p>
If you have any questions, comments or concerns about our services, please don't hesitate to contact us. We ensure that we will make your stay here an enjoyable and pleasant experience.<br />
<br />
Telephone: +63(034)432-1708<br />
Telefax: +63(034) 709-0886<br />
Mobile: 09820420420<br />
Address: 29 Marine Drive, Mumbai, 400020
</p>
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
	
$a=$_POST['name'];
$b=$_POST['email'];
$c=$_POST['message'];	
	
$query="INSERT INTO feedbacks(`name`, `email`, `content`) VALUES ('$a','$b','$c');";

 $result=mysql_query($query,$connection);
if(!$result)
{
echo mysql_error();
}
else
{
echo "";
header("Location:index.html");
}
}
?>
</body>
</html>