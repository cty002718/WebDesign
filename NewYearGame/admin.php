<?php
    require_once('connectvars.php');
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"  charset="utf-8"/>

	<title>管理分數</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<h2>管理分數</h2>
	<hr />

<?php
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_query($dbc,"SET NAMES 'UTF8'") or die('error');
    
	$query = "SELECT * FROM count";
	$data = mysqli_query($dbc,$query);
    
    $i = 0;
    $asum = 0;
    $bsum = 0;
    $csum = 0;
    $dsum = 0;
    
    $awin = 0;
    $bwin = 0;
    $cwin = 0;
    $dwin = 0;

    while($row = mysqli_fetch_array($data)) {
        if($row['anum'] > 0) $awin = $awin + 1;
        if($row['bnum'] > 0) $bwin = $bwin + 1;
        if($row['cnum'] > 0) $cwin = $cwin + 1;
        if($row['dnum'] > 0) $dwin = $dwin + 1;
        $asum = $asum + $row['anum'];
        $bsum = $bsum + $row['bnum'];
        $csum = $csum + $row['cnum'];
        $dsum = $dsum + $row['dnum'];
        $i = $i + 1;
    }
    mysqli_query($dbc,"SET NAMES 'UTF8'");
    $query = "SELECT * FROM name ORDER BY date DESC";
    $result = mysqli_query($dbc,$query);
    $row = mysqli_fetch_array($result);
    $aname = $row['aname'];
    $bname = $row['bname'];
    $cname = $row['cname'];
    $dname = $row['dname'];
    
    $query = "SELECT * FROM count ORDER BY date DESC";
    $data = mysqli_query($dbc,$query);

    $j = 1;
	while($row = mysqli_fetch_array($data)) {
        if($j==1) {
            echo '<table>';
            echo "<tr><td></td>";
            echo "<td>$aname</td>";
            echo "<td>$bname</td>";
            echo "<td>$cname</td>";
            echo "<td>$dname</td></tr>";
            echo "<tr><td>總和</td>";
            if($asum >= 0) {
                echo "<td><span class = \"win\">$asum</span></td>";
            } else {
                echo "<td><span class = \"lose\">$asum</span></td>";
            }
            if($bsum >= 0) {
                echo "<td><span class = \"win\">$bsum</span></td>";
            } else {
                echo "<td><span class = \"lose\">$bsum</span></td>";
            }
            if($csum >= 0) {
                echo "<td><span class = \"win\">$csum</span></td>";
            } else {
                echo "<td><span class = \"lose\">$csum</span></td>";
            }
            if($dsum >= 0) {
                echo "<td><span class = \"win\">$dsum</span></td>";
            } else {
                echo "<td><span class = \"lose\">$dsum</span></td>";
            }
            echo "</tr>";
        }
        
        echo '<tr><td>' . $i . '.</td>';
        
        if($row['anum'] > 0) {
            echo '<td><span class= "game">' . $row['anum'] . '</span></td>';
        } else {
            echo '<td>' . $row['anum'] . '</td>';
        }
        if($row['bnum'] > 0) {
            echo '<td><span class= "game">' . $row['bnum'] . '</span></td>';
        } else {
            echo '<td>' . $row['bnum'] . '</td>';
        }
        if($row['cnum'] > 0) {
            echo '<td><span class= "game">' . $row['cnum'] . '</span></td>';
        } else {
            echo '<td>' . $row['cnum'] . '</td>';
        }
        if($row['dnum'] > 0) {
            echo '<td><span class= "game">' . $row['dnum'] . '</span></td>';
        } else {
            echo '<td>' . $row['dnum'] . '</td>';
        }
        echo '<td><a href="removedata.php?id='. $row['id'] . '&amp;anum=' . $row['anum'] .
        '&amp;bnum=' . $row['bnum'] . '&amp;cnum=' . $row['cnum'] .
        '&amp;dnum=' . $row['dnum'] . '&amp;aname=' . $aname . '&amp;bname=' . $bname .
        '&amp;cname=' . $cname . '&amp;dname=' . $dname . '">刪除</a>';
        echo '</td></tr>';
        $j = $j + 1;
        $i = $i - 1;
	}
    echo '</table>';
    
    echo '<table>';
    
    echo '</table>';
    if($j==1)
        echo '<p class="error">沒有任何資料</p>';
    
    echo '<a href="addscore.php">&lt;&lt; 新增分數</a><br />';
	mysqli_close($dbc);
?>
</body>
</html>
