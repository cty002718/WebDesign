<?php
    require_once('connectvars.php');
?>

<html>
<head>
<meta charset="utf-8" />
<title>更改姓名</title>
<link rel="stylesheet"  type="text/css" href="style.css" />
</head>
<body>

<h2>更改姓名</h2>
<hr />

<?php
    $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_query($dbc,"SET NAMES 'UTF8'");
    $query = "SELECT * FROM name ORDER BY date DESC";
    $result = mysqli_query($dbc,$query);
    $row = mysqli_fetch_array($result);
    $aname = $row['aname'];
    $bname = $row['bname'];
    $cname = $row['cname'];
    $dname = $row['dname'];
    
    $show = 0;
    if(isset($_POST['submit'])) {
        $aname = $_POST['aname'];
        $bname = $_POST['bname'];
        $cname = $_POST['cname'];
        $dname = $_POST['dname'];
        if(!empty($aname) && !empty($bname) && !empty($cname) && !empty($dname)) {
            mysqli_query($dbc,"SET NAMES 'UTF8'");
            $query="DELETE FROM name WHERE date < NOW()";
            mysqli_query($dbc,$query) or die('haha');
            $query = "INSERT INTO name (aname,bname,cname,dname,date) VALUES " .
            "(N'$aname',N'$bname',N'$cname',N'$dname',NOW())";
            mysqli_query($dbc,$query) or die('發生錯誤，請重新填寫');
            echo '<p>你已成功更改以下資料</p>';
            echo 'A玩家名稱：' . $aname . '<br />';
            echo 'B玩家名稱：' . $bname . '<br />';
            echo 'C玩家名稱：' . $cname . '<br />';
            echo 'D玩家名稱：' . $dname . '<br />';
            $_POST['aname'] = "";
            $_POST['bname'] = "";
            $_POST['cname'] = "";
            $_POST['dname'] = "";
            echo '<br /><a href="' . $_SERVER['PHP_SELF'] . '">&lt;&lt; 還想修改名字</a><br />';
        }
        else {
            $show = 1;
            echo '<p class="error">有些資料沒有填到</p>';
        }
    }
    else
    $show = 1;
    
    if($show == 1) {
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<label for="aname">A玩家名稱:</label>
<input type="text" id="aname" name="aname" value="<?php echo $aname; ?>" /><br />
<label for="bname">B玩家名稱:</label>
<input type="text" id="bname" name="bname" value="<?php echo $bname; ?>" /><br />
<label for="cname">C玩家名稱:</label>
<input type="text" id="cname" name="cname" value="<?php echo $cname; ?>" /><br />
<label for="dname">D玩家名稱:</label>
<input type="text" id="dname" name="dname" value="<?php echo $dname; ?>" /><br />
<input type="submit" id="submit" name="submit" value="送出" /><br />
</form>

<?php
    }
?>
</body>
</html>
