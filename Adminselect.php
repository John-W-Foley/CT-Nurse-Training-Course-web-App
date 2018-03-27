<?php include 'db.php'; ?>
<?php if (isset($_POST['Submit']))
{
$moduleid = $_POST['ModuleID'] ;
$activeq = $_POST['activeq'];
$testid = $_POST['TestID'];
$questionnumber = $_POST['questionnumber'] ;
$questiontext = $_POST['questiontext'] ;
$choice = array();
#if ( isset ($POST_['choice1'])) {
$choice['1'] = $_POST['choice1'] ;
#}
#if ( isset ($POST['choice2'])) {
$choice['2'] = $_POST['choice2'] ;
#}
#if ( isset ($_POST_['choice3'])) {
$choice['3'] = $_POST['choice3'] ;
#}
#if ( isset ($_POST_['choice4'])) {
$choice['4'] = $_POST['choice4'] ;
#}
#if ( isset ($_POST['choice5'])) {
$choice['5'] = $_POST['choice5'] ;
#}
#if ( isset ($_POST['choice6'])) {
$choice['6'] = $_POST['choice6'] ;
#}
$correctans =$_POST['correctans'];
if ($activeq == "y") {
$sqlsele=" SELECT * from `test_answer` where questionID = $questionnumber AND ModuleID = $moduleid";
$result = mysqli_query($conn,$sqlsele);
  # if (mysqli_num_rows($result) > 0) {
      // output data of each row
      $count = mysqli_num_rows($result);
      if ($count > "0") {
    foreach($choice as $chnum => $value) {
         echo "inside choice loop" ;
          $row = mysqli_fetch_assoc($result);
          if ($value == "on") {
            echo "inside value=on";
                $answerid = $row["answerID"] ;
            if ($correctans == $chnum) {
                   $isAnswer = '1'; }
                   else {
                     $isAnswer='0';
                   }

  $sqltest = "INSERT INTO `user_test`(`ModuleID`,`testID`,`questionID`,`answerID`,`iscorrect`,`createdBy`)
        values ('$moduleid','$testid','$questionnumber','$answerid','$isAnswer','admin')";
       if (mysqli_query($conn,$sqltest)) {
            echo "New record INSERTED successfully answerid" ;
                } else {
            echo "Error: " . $sqltest . "<br>" . mysqli_error($conn);
        }
    }
}
$msg = "Question and answer added to test";
echo $msg;
}
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
<title> Admin page </title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular-route.js"></script>
<link rel="stylesheet" href="quiz.css">
</head>
<body>
  <header>
    <h1> Select questions/answers to create test </h1>
  </header>

<div class="container">
   <form name ="adminquiz"  action="Adminselect.php" method="post">
<?php
     if (isset($msg)) {
       echo '<p>'.$msg. '</p>';
     }
 ?>
 <p>
<label > Module ID </label>
<input type="text" name="ModuleID" >
</p>
<p>
<label > Test ID </label>
<input type="text" name="TestID">
</p>
<p>
<label > UpdatedBy </label>
<input type="text" name="UpdateID">
</p>
<p>
<label > Question Number </label>
<input type="number" name="questionnumber" value="<?php echo $nextque; ?>">
</p>
<p>
  <label > Active </label>
  <input type="radio" name="activeq" value="y" >Yes
  <input type="radio" name="activeq" value="n" >No
</p>
<p>
<label > Question Text </label>
<input type="text" name="questiontext">
</p>
<hr>
<p>
 Choose the answer choices for the test .
</p>
<hr>
<p>
<label > Choice 1</label>
<input type="checkbox" name="choice1" >

</p>
<p>
<label > Choice 2</label>
<input type="checkbox" name="choice2" >
</p>
<p>
<label > Choice 3</label>
<input type="checkbox" name="choice3" >
</p>
<p>
<label > Choice 4</label>
<input type="checkbox" name="choice4" >
</p>
<p>
<label > Choice 5</label>
<input type="checkbox" name="choice5">
</p>
<label > Choice 6</label>
<input type="checkbox" name="choice6" >
</p>
<label > CorrectAns</label>
<input type="number" name="correctans">

<div>
      <input type="Submit" name ="Submit" value="Submit">
</div>

  </form>
</div >

<footer>
copyright
</footer>

</body>

</html>
