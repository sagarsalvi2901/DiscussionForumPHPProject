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

    </head>
    <body>
	
    <!--start container-->
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
	<li><a href="Notice.php" title="get latest notifications" class="current">Notices</a></li>
	<li><a href="#">Student's</a></li>
    <li><a href="#" title="help us to improve by providing feeback">Feedback</a></li>
    
    </ul>
    </nav>
	<!--end menu-->
	

    <!--end header-->
	</header>
    
    <div class="holder_content">
   <marquee behavior=scroll direction="up" scrollamount="4" onMouseOver="this.stop();" onMouseOut="this.start();"> 
    <?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("learning" , $con);
$result = mysql_query("SELECT * FROM notice ORDER BY date DESC");

echo "<table align='center' width='80%' height='120%' cellspacing='2' cellpadding='7'>
<tr bordercolor='#9F000F' border='1'>
<th>Notice Id</th>
<th>Notice Content</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
echo "<tr border='1' bordercolor='#9F000F'>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['content'] . "</td>";
echo "</tr>";
 }
echo "</table>";

mysql_close($con)
?>

</marquee>
</div>
</div>
</body>
</html>