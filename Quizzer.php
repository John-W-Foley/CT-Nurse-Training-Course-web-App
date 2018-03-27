<?php include 'db.php';?>
<?php
$totquery = "SELECT DISTINCT questionID FROM `user_test` where ModuleID = '1' and testID ='1' ";
$totsql = mysqli_query($conn,$totquery);
$totcount = mysqli_num_rows($totsql);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
<title> Nursing Exam page </title>
<link rel="stylesheet" href="quiz.css">
</head>
<body>
  <header>
    <h1> Nursing Exam Page </h1>
  </header>

<div class="container">
<p>    This is a multiple choice quiz  </p>
 <ul>
   <li><strong>  Module number : </strong><?php echo "1"; ?></li>
   <li><strong> Number of Questions  :</strong><?php echo $totcount;?> </li>
   </ul>

<a href ="question.php?n=1"><button type="button"> Start quiz</button> </a>
</div >

<footer>
copyright
</footer>

</body>

</html>
