<?php
    require_once('authorize.php');
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"  charset="utf-8"/>
	<title>&#30906;&#35469;&#21034;&#38500;&#20998;&#25976;</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<h2>&#21034;&#38500;&#20998;&#25976;</h2>
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
	}
	else if(isset($_POST['id'])) {

		$id = $_POST['id'];
	
    }
	else {
		echo '<p class="error">&#27794;&#26377;&#36039;&#26009;&#21487;&#20197;&#21034;&#38500;</p>';
	}

	if(isset($_POST['submit'])) {
		if($_POST['confirm'] == 'Yes') {

			$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
			$query = "DELETE FROM count WHERE id = $id LIMIT 1";
			mysqli_query($dbc,$query);
			mysqli_close($dbc);

			echo '<p>&#24050;&#25104;&#21151;&#21034;&#38500;</p>';
		}
		else {
			echo '<p class="error">&#27794;&#26377;&#21034;&#38500;&#20219;&#20309;&#36039;&#26009;</p>';
		}
	}

	else if(isset($id) && isset($anum) && isset($bnum) && isset($cnum) && isset($dnum)) {
        $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        mysqli_query($dbc,"SET NAMES 'UTF8'");
        $query = "SELECT * FROM name ORDER BY date";
        $result = mysqli_query($dbc,$query);
        $row = mysqli_fetch_array($result);
        $aname = $row['aname'];
        $bname = $row['bname'];
        $cname = $row['cname'];
        $dname = $row['dname'];
        
        echo '<p>&#20320;&#30906;&#23450;&#35201;&#21034;&#38500;&#20197;&#19979;&#36039;&#26009;?</p>';
		echo '<p><strong>'. $aname .': </strong>' . $anum . '<br /><strong>'. $bname .': </strong>' . $bnum .
			'<br /><strong>'. $cname . ': </strong>' . $cnum . '<br /><strong>'. $dname. ': </strong>' . $dnum .'</p>';
		echo '<form method="post" action="removedata.php">';
		echo '<input type="radio" name="confirm" value="Yes" /> &#26159; ';
		echo '<input type="radio" name="confirm" value="No" checked="checked" /> &#21542; <br />';
		echo '<input type="submit" value="&#36865;&#20986;" name="submit" />';

		echo '<input type="hidden" name="id" value="' . $id . '" />';
		echo '</form>';
	}

	echo '<p><a href="admin.php">&lt;&lt; &#22238;&#21040;&#31649;&#29702;&#38913;&#38754;</a></p>';
	
?>
</body>
</html>
