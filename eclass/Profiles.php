<!doctype html>  
<head>
<meta charset="UTF-8">
<title>Think simple - Home</title>
<link rel="icon" href="images/favicon.gif" type="image/x-icon"/>
 <!--[if lt IE 9]>
 <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

<link rel="shortcut icon" href="images/favicon.gif" type="image/x-icon"/> 
<link rel="stylesheet" type="text/css" href="css/styles.css"/>
<link type="text/css" href="css/css3.css" rel="stylesheet" />
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">

    </head>

<body>
  <!--start container-->

</div>
    
    <div id="container">

    <!--start header-->
<header>
    <!--start logo-->
   <h1><font style="font-size:70px"><b>eClass</b></font></h1>

	<!--end logo-->

   <!--start menu-->
	<nav>
    <ul>
    <li><a href="Home.html" title="navigate to home">Home</a></li>
    <li><a href="Authenticate.php" title="control your site through vaid authentication">Admin</a></li>
	<li><a href="#" title="get latest notifications">Notices</a></li>
	<li><a href="#">Student's</a></li>
    <li><a href="#" title="help us to improve by providing feeback">Feedback</a></li>
    
    </ul>
    </nav>
	<!--end menu-->
	

    <!--end header-->
	</header>
    
     <div class="holder_content">
         <div id="userbar">
<?php
session_start(); 

if($_SESSION['user_level']=="guest")
	{
		echo '<a href="NewDiscussions.php">Add new Topic</a>';
		echo '&nbsp;';
		echo '&nbsp;';
	}
else
	{
		echo '<a href="NewDiscussion.php">Add new Topic</a>';
		echo '&nbsp;';
		echo '&nbsp;';
		echo '<a href="NewCategories.php">Add new Category</a>';
		echo '&nbsp;';
		echo '&nbsp;';
	}
  

    if($_SESSION['signed_in'])
    {
        echo  'Hello ' . $_SESSION['user_name'];
		echo '&nbsp;';echo '&nbsp;';
		echo '<a href="Logout.php">SignOut</a>'; 
    }
?>

</div>
 <?php

echo $_GET['profile_id'];

$con=mysql_connect("localhost","root","");
$db=mysql_select_db("learning",$con);



$sql = "select * from users
		where user_cn = '$_GET[profile_id]' ; ";
$result = mysql_query($sql);
if(!$result)
{
    echo 'The profile could not be displayed, please try again later.' . mysql_error();
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo 'oops eror fetching link.';
    }
    else
    {
		$row = mysql_fetch_array($result);
		if ($row['user_status']=="hidden")
		{
			echo 'User profile is not for public viewing';
		}
		else
		{
			
        echo ' <section class="col1">';
        echo '<h2>Profile of ′' . $row['user_fname'] . $row['user_lname'] . '′</h2>';
        echo'</section>';
		echo'<section class="col1">';
		echo'<br>';
		echo'<br>';
		echo '<h5>First Name :&nbsp' . $row['user_fname'] .'</h5>';
		echo '<h5>First Name :&nbsp' . $row['user_lname'] .'</h5>';
		echo '<h5>First Name :&nbsp' . $row['user_name'] .'</h5>';
		echo '<h5>First Name :&nbsp' . $row['user_gender'] .'</h5>';
		echo '<h5>First Name :&nbsp' . $row['user_stream'] .'</h5>';
		echo '<h5>First Name :&nbsp' . $row['user_email'] .'</h5>';
		echo '<h5>First Name :&nbsp' . $row['user_level'] .'</h5>';
		echo'</section>';
		}
	}
}
	?>
    
	  
			