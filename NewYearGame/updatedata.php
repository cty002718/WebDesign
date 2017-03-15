<?php
    require_once('authorize.php');
?>


<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"  charset="utf-8"/>
	<title>&#26356;&#26032;&#20998;&#25976;</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<h2>&#26356;&#26032;&#20998;&#25976;</h2>
    <hr />
<?php
	require_once('connectvars.php');

	if(isset($_GET['id']) && isset($_GET['anum']) && isset($_GET['bnum']) &&
		isset($_GET['cnum']) && isset($_GET['dnum'])) {

		$id = $_GET['id'];
		$anum = $_GET['anum'];
		$bnum = $_GET['bnum'];
		$cnum = $_GET['cnum'];
		$dnum = $_GET['dnum'];
        $aname = $_GET['aname'];
        $bname = $_GET['bname'];
        $cname = $_GET['cname'];
        $dname = $_GET['dname'];
        
	}
	else if(isset($_POST['id'])) {

		$id = $_POST['id'];
	
    }
	else {
		echo '<p class="error">&#27794;&#26377;&#36039;&#26009;&#21487;&#20197;&#26356;&#26032;</p>';
	}

	if(isset($_POST['submit'])) {
        $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        $id = $_POST['id'];
        $anum = $_POST['anum'];
        $bnum = $_POST['bnum'];
        $cnum = $_POST['cnum'];
        $dnum = $_POST['dnum'];
        
        if(($ascore + $bscore + $cscore + $dscore == 0)) {
            $query = "UPDATE count SET anum='$anum', bnum='$bnum',cnum='$cnum',dnum='$dnum'" .
                        ", date = NOW() WHERE id = $id";

            mysqli_query($dbc,$query);
            mysqli_close($dbc);
            echo '<p>&#24050;&#25104;&#21151;&#26356;&#26032;</p>';
        }
        else {
            echo '<p class = "error">&#36039;&#26009;&#26377;&#35492;</p>';
        }
	}

	else if(isset($id) && isset($anum) && isset($bnum) && isset($cnum) && isset($dnum)) {
?>
        <p>&#20320;&#30906;&#23450;&#35201;&#26356;&#26032;&#20197;&#19979;&#36039;&#26009;&#65311;</p>
        <form method="post" action="updatedata.php">
        <label for="anum"><?php echo $aname; ?> : </label>
        <input type="text" id="anum" name="anum" value="<?php echo $anum; ?>" /><br />
        <label for="bnum"><?php echo $bname; ?> : </label>
        <input type="text" id="bnum" name="bnum" value="<?php echo $bnum; ?>" /><br />
        <label for="cnum"><?php echo $cname; ?> : </label>
        <input type="text" id="cnum" name="cnum" value="<?php echo $cnum; ?>" /><br />
        <label for="dnum"><?php echo $dname; ?> : </label>
        <input type="text" id="dnum" name="dnum" value="<?php echo $dnum; ?>" /><br />
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="submit" id="submit" name="submit" value="&#36865;&#20986;" /><br />
        </form>

<?php
	}
	echo '<p><a href="admin.php">&lt;&lt; &#22238;&#21040;&#31649;&#29702;&#38913;&#38754;</a></p>';
	
?>
</body>
</html>
