<?php
    require_once('connectvars.php');
    require_once('authorize.php');
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"  charset="utf-8"/>

    <link rel="stylesheet" type="text/css" href="style.css" />
	<title>&#26032;&#22686;&#20998;&#25976;</title>
</head>
<body>

<h2>&#26032;&#22686;&#20998;&#25976;</h2>
<hr />

<?php
    
    $show = 0;
    if(isset($_POST['submit'])) {
        $ascore = $_POST['ascore'];
        $bscore = $_POST['bscore'];
        $cscore = $_POST['cscore'];
        $dscore = $_POST['dscore'];
        $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        $sum = 0;
        if(preg_match("/^\d+$/",$ascore) && preg_match("/^\d+$/",$bscore) && preg_match("/^\d+$/",$cscore) && preg_match("/^\d+$/",$dscore)) {
           if($ascore != 0) {
                $sum = $sum + $ascore;
                $ascore = -$ascore;
           }
           if($bscore != 0) {
                $sum = $sum + $bscore;
                $bscore = -$bscore;
                }
           if($cscore != 0) {
                $sum = $sum + $cscore;
                $cscore = -$cscore;
           }
           if($dscore != 0) {
                $sum = $sum + $dscore;
                $dscore = -$dscore;
           }
        
           if($ascore == 0)
                $ascore = $sum;
           else if($bscore == 0)
                $bscore = $sum;
           else if($cscore == 0)
                $cscore = $sum;
           else if($dscore == 0)
                $dscore = $sum;
        
           if(($ascore + $bscore + $cscore + $dscore == 0)) {
                $query = "INSERT INTO count (anum,bnum,cnum,dnum,date) VALUES" .
                "('$ascore','$bscore','$cscore','$dscore',NOW())";
                mysqli_query($dbc,$query) or die('&#30332;&#29983;&#37679;&#35492;&#65292;&#35531;&#37325;&#26032;&#22635;&#23531;');
            
                $_POST['ascore'] = "";
                $_POST['bscore'] = "";
                $_POST['cscore'] = "";
                $_POST['dscore'] = "";
            
                echo '<p class="suc">&#25104;&#21151;&#26032;&#22686;&#20998;&#25976;</p>';
                echo '<br /><a href="' . $_SERVER['PHP_SELF'] . '">&lt;&lt; &#32380;&#32396;&#26032;&#22686;&#20998;&#25976;</a><br />';
                echo '<a href="admin.php">&lt;&lt; &#21435;&#31649;&#29702;&#38913;&#38754;&#26597;&#30475;</a>';
           }
           else {
                $show = 1;
                echo '<p class="error">&#36039;&#26009;&#22635;&#23531;&#37679;&#35492;</p>';
           }
        }
        else {
           $show = 1;
           echo '<p class="error">&#26377;&#20123;&#36039;&#26009;&#22635;&#23531;&#37679;&#35492;</p>';
        }
    }
    else
        $show = 1;
    
    if($show == 1) {
?>

<?php
    $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_query($dbc,"SET NAMES 'UTF8'");
    $query = "SELECT * FROM name ORDER BY date";
    $result = mysqli_query($dbc,$query);
    $row = mysqli_fetch_array($result);
    $aname = $row['aname'];
    $bname = $row['bname'];
    $cname = $row['cname'];
    $dname = $row['dname'];
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="ascore"><?php echo $aname . ' : '; ?></label>
    <input type="text" id="ascore" name="ascore" size=6 maxlength=6 value="<?php if(isset($_POST['ascore']))
    echo $_POST['ascore']; ?>" /><br />
    <label for="bscore"><?php echo $bname . ' : '; ?></label>
    <input type="text" id="bscore" name="bscore" size=6 maxlength=6 value="<?php if(isset($_POST['bscore']))
    echo $_POST['bscore']; ?>" /><br />
    <label for="cscore"><?php echo $cname . ' : '; ?></label>
    <input type="text" id="cscore" name="cscore" size=6 maxlength=6 value="<?php if(isset($_POST['cscore']))
    echo $_POST['cscore']; ?>" /><br />
    <label for="dscore"><?php echo $dname . ' : '; ?></label>
    <input type="text" id="dscore" name="dscore" size=6 maxlength=6 value="<?php if(isset($_POST['dscore']))
    echo $_POST['dscore']; ?>" /><br />
    <input type="submit" id="submit" name="submit" value="&#36865;&#20986;" /><br />
</form>

<a href="admin.php">&lt;&lt; &#30452;&#25509;&#21435;&#31649;&#29702;&#38913;&#38754;</a>
<?php
    }
?>
</body>
</html>
