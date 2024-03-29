<?php
    include 'Poll.class.php';
    $poll = new Poll;
    $pollData = $poll->getPolls();
?>
<div class="pollContent">
    <?php echo !empty($statusMsg)?'<p class="stmsg">'.$statusMsg.'</p>':''; ?>
    <form action="" method="post" name="pollFrm">
    <h3><?php echo $pollData['poll']['subject']; ?></h3>
    <ul>
        <?php foreach($pollData['options'] as $opt){
            echo '<li><input type="radio" name="voteOpt" value="'.$opt['id'].'" >'.$opt['name'].'</li>';
        } ?>
    </ul>
    <input type="hidden" name="pollID" value="<?php echo $pollData['poll']['id']; ?>">
    <input type="submit" name="voteSubmit" class="button" value="Vote">
    <a href="results.php?pollID=<?php echo $pollData['poll']['id']; ?>">Results</a>
    </form>
</div>

<?php
if(isset($_POST['voteSubmit'])){
    $voteData = array(
        'poll_id' => $_POST['pollID'],
        'poll_option_id' => $_POST['voteOpt']
    );
    
    $voteSubmit = $poll->vote($voteData);
    if($voteSubmit){
        setcookie($_POST['pollID'], 1, time()+60*60*24*365);
        
        $statusMsg = 'Your vote has been submitted successfully.';
    }else{
        $statusMsg = 'Your vote already had submitted.';
    }
}
?>