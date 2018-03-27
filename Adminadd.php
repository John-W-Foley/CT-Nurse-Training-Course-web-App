<?php include 'db.php'; ?>
<?php if (isset($_POST['Submit']))
{
$moduleid = $_POST['ModuleID'] ;
$questionnumber = $_POST['questionnumber'];
$questiontext = $_POST['questiontext'] ;
$complexity = $_POST['complexity'] ;
$correctans =$_POST['correctans'];
$activeq = $_POST['activeq'];
$choice=array();
$choice[1] = $_POST['choice1'] ;
$choice[2] = $_POST['choice2'] ;
$choice[3] = $_POST['choice3'] ;
$choice[4] = $_POST['choice4'] ;
$choice[5] = $_POST['choice5'] ;
$choice[6] = $_POST['choice6'] ;
$sqlque= "INSERT INTO `test_question` (`ModuleID`,`questionID`,`questiontext`,`complexity`,`createdBy`,`isActive`)
values ('$moduleid','$questionnumber','$questiontext','$complexity','Admin','$activeq')";
if (mysqli_query($conn, $sqlque)) {
    echo "New record created successfully";

print_r($choice) ;
foreach($choice as $chnum => $value)
{
  if ($value != " "){
    if ($correctans == $chnum) {
       $isAnswer= 1; }
       else {
         $isAnswer=0;
       }
      $sqlans = "INSERT INTO `test_answer`(`questionID`,`answertext`,`isAnswer`,`ModuleID`)
     values ('$questionnumber','$value','$isAnswer','$moduleid')";
     if (mysqli_query($conn,$sqlans))
      {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sqlans . "<br>" . mysqli_error($conn);
    }
  }
$msg = "Question and answer added";
}

}

else {
    echo "Error: " . $sqlque . "<br>" . mysqli_error($conn);
}
}

$nextque=0;
$sqltotal ="Select count(questionID) from test_question";
$totalque=mysqli_query($conn,$sqltotal);


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
    <h1> Add questions/answers to database</h1>
  </header>

<div class="container">
   <form name ="adminquiz"  action="Adminadd.php" method="post">
<?php
     if (isset($msg)) {
       echo '<p>'.$msg. '</p>';
     }
 ?>
 <p>
<label > Module ID </label>
<input type="text" name="ModuleID">
</p>
<p>
  <label > CreatedBy </label>
  <input type="text" name="createdBy">
</p>
<p>
  <label > UpdatedBy </label>
  <input type="text" name="updatedBy">
</p>
<p>
<label > Question Number </label>
<input type="number" name="questionnumber">
</p>

<p>
      <label> Complexity:</label>
      <select name="complexity" >
        <option value="H">H</option>
        <option value="M">M</option>
        <option value="L">L</option>
      </select>
  </p>
<p>
<label > Question Text </label>
<input type="text" name="questiontext">
</p>
<p>
  <label > Active </label>
  <input type="radio" name="activeq" value="y" >Yes
  <input type="radio" name="activeq" value="n" >No
</p>

<hr>
<p>
 Enter the details for Answer Choices .
</p>
<hr>
<p>
<label > Choice 1</label>
<input type="text" name="choice1">
</p>
<p>
<label > Choice 2</label>
<input type="text" name="choice2">
</p>
<p>
<label > Choice 3</label>
<input type="text" name="choice3">
</p>
<p>
<label > Choice 4</label>
<input type="text" name="choice4">
</p>
<p>
<label > Choice 5</label>
<input type="text" name="choice5">
</p>
<label > Choice 6</label>
<input type="text" name="choice6">
</p>
<label > CorrectAns</label>
<input type="number" name="correctans">

<div>
      <input type="Submit" name = "Submit" value="Submit">
</div>

  </form>
</div >

<footer>
copyright
</footer>

</body>

</html>
