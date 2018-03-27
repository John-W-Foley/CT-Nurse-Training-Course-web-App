<?php include 'db.php'; ?>
<?php session_start (); ?>
<?php

if (!isset ($_SESSION['score'])) {
 $_SESSION['score'] = 0;
  }
if (isset ($_POST['Submit']))  {
  $qno = $_POST['qno'];
  $useranswer=$_POST['choice'];
  $quenumber =$_POST['questionid'];
  echo"questionnumber";
  echo $quenumber;
  echo"userselected";
  print_r($useranswer);
  echo "pageno";
  echo $qno;
  echo "pstarray";
  print_r($_POST);
  echo"postchoice";
  print_r($_POST['choice']);

  #get total number of Questions in a module
  $totquery = " SELECT questionid FROM `user_test` where ModuleID ='1' and testID ='1' ";
  $totsql = mysqli_query($conn,$totquery);
  $totalsql = mysqli_num_rows($totsql);
    # to check the user entry
  echo $quenumber;
  echo $totalsql;
  $querycount = "SELECT answerID from `user_test` where ModuleID='1' and questionID = $quenumber and testID='1' ";
  $qresultc = mysqli_query($conn,$querycount);
  $qresultcount = mysqli_num_rows($qresultc);
  $next = $qno+$qresultcount;
  $query = "SELECT answerID from `user_test` where ModuleID='1' and questionID = $quenumber and iscorrect='1' and testID='1'";
  $qresult = mysqli_query($conn,$query);
  while ($row = mysqli_fetch_assoc($qresult)) {
  $correctanswer=$row['answerID'];
  if ($useranswer == $correctanswer) {
    $_SESSION['score']++ ;

}
    }
  }
   if ($next > $totalsql){
    header ("Location: Final.php") ;
  } else {
    header ("Location: question.php?n=".$next) ;
    exit();
  }


  ?>
