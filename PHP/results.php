<?php 
include 'Poll.class.php';
$poll = new Poll;

$pollResult = $poll->getResult($_GET['pollID']);
?>
<h3><?php echo $pollResult['poll']; ?></h3>
<p><b>Total Votes:</b> <?php echo $pollResult['total_votes']; ?></p>
<?php
if(!empty($pollResult['options'])){ $i=0;
    $barColorArr = array('azure','emerald','violet','yellow','red');
    foreach($pollResult['options'] as $opt=>$vote){
        //Calculate vote percent
        $votePercent = round(($vote/$pollResult['total_votes'])*100);
        $votePercent = !empty($votePercent)?$votePercent.'%':'0%';
        //Define bar color class
        if(!array_key_exists($i, $barColorArr)){
            $i=0;
        }
        $barColor = $barColorArr[$i];
?>
<div class="bar-main-container <?php echo $barColor; ?>">
  <div class="txt"><?php echo $opt; ?></div>
  <div class="wrap">
    <div class="bar-percentage"><?php echo $votePercent; ?></div>
    <div class="bar-container">
      <div class="bar" style="width: <?php echo $votePercent; ?>;"></div>
    </div>
  </div>
</div>
<?php $i++; } } ?>
<a href="index.php">Back To Poll</a>