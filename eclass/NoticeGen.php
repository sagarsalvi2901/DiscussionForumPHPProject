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
    <div id="container">

    <!--start header-->
<header>
    <!--start logo-->
   <h1><font style="font-size:80px"><b>eClass</b></font></h1>

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
   <form method="POST" name="frm1">
   <?php
   $flag=1;
   ?>
<table align="center">
<script>
    var mydate=new Date()
    var year=mydate.getYear()
    
    if (year < 1000)
        year+=1900
    
    var day=mydate.getDay()
    var month=mydate.getMonth()+1
    
    if (month<10)
        month="0"+month
    
    var daym=mydate.getDate()
    if (daym<10)
        daym="0"+daym
    
    document.write(year+"/"+month+"/"+daym)

</script>
    </table>
    <table align="center">
    <?php
    date_default_timezone_set('Africa/Nairobi');

   
    $date = date('Y-m-d H:i:s');
?>
    </table>
    <input type="text" name="id" placeholder="notice id" />
    <textarea name="notice" rows="5" cols="40" ></textarea>
    
    <input name="submit" type="submit" value="POST NOTICE" />
    
    
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
	
$a=$_POST['notice'];
$b=$_POST['id'];	
$my_date = date("Y-m-d H:i:s");
$query="INSERT INTO notice (`date`,`name`, `content`) VALUES (CURRENT_TIMESTAMP,'$b','$a');";

 $result=mysql_query($query,$connection);
if(!$result)
{
echo mysql_error();
}
else
{
echo "";
header("Location:redirect1.html");
}
}
?>
    
    </form>
</div>
</div>
</body>
</html>