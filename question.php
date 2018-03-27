<?php include 'db.php'; ?>
<?php session_start (); ?>
<?php if (isset($_POST))
{
$qno = (int) $_GET['n'];
if ($qno=="" || $qno=="1")
{$qnooff=1;
}
else
{
$qnooff=$qno;
}
$totquery = "SELECT DISTINCT questionID FROM `user_test` where ModuleID = '1' and testID ='1' ";
$totsql = mysqli_query($conn,$totquery);
$totcount = mysqli_num_rows($totsql);
$testscore = $_SESSION['score'];
$sqlsel ="SELECT questionID FROM `user_test` WHERE ModuleID= '1' AND testid= '1' LIMIT $qnooff, 1";
$testque = mysqli_query($conn,$sqlsel);

if (mysqli_num_rows($testque) > '0') {
    // output data of each row
    while($row = mysqli_fetch_array($testque)) {
        $testqid = $row["questionID"];
        $quetext="SELECT questiontext FROM `test_question` where questionid= '$testqid' and ModuleID= '1'";
        $quetextsql=  mysqli_query($conn,$quetext);
        while($row = mysqli_fetch_assoc($quetextsql)) {
            $displayque = $row["questiontext"];

          }
        }
            #STARTING ANSWER SECION
          $sqlsela ="SELECT answerID FROM `user_test` WHERE questionid = $testqid and testid='1' and ModuleID='1'  ";
          $testans = mysqli_query($conn,$sqlsela);
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
<title> Question page </title>
<link rel="stylesheet" href="quiz.css">
</head>
<body>
  <header>
    <h1> Nursing Exam page </h1>
  </header>

<div class="container">
   <div class="currentq"> Total Questions <?php echo $totcount ?>  </div>
   <p class="question">
  <?php   echo $displayque; ?>
   </p>
<form name ="quiz"  action="process.php" method="post">
<ul class="multiplechoices">
<?php  while($row = mysqli_fetch_assoc($testans)) :?>
<?php  $testansid = $row['answerID'];
    #aNSWER CHOICES SECTION
    $anstextsql="SELECT answertext,answerID  FROM `test_answer` where answerID= $testansid";
    $testanssql=  mysqli_query($conn,$anstextsql);
     ?>
     <?php while($row = mysqli_fetch_assoc($testanssql)) :?>
       <li><input name="choice" type ="radio"  value="<?php echo $row["answerID"]; ?>" > <?php echo $row["answertext"] ; ?> </li>
<?php endwhile ; ?>
<?php endwhile ; ?>
</ul>
  <div>  <input type="Submit" value ="Submit" name="Submit">
</div>
<div>
    <input type="hidden" name="questionid" value="<?php echo $testqid; ?>" >
    <input type="hidden" name="qno" value = "<?php echo $qno ;?>" >

  </div>

  </form>

</div >

<footer>
copyright
</footer>

</body>

</html>
