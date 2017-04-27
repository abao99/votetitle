<?php require_once('Connections/voteConn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_Recordset1 = "-1";
if (isset($_GET['titleNo'])) {
  $colname_Recordset1 = $_GET['titleNo'];
}
mysql_select_db($database_voteConn, $voteConn);
$query_Recordset1 = sprintf("SELECT * FROM votetitle WHERE titleNo = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $voteConn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['titleNo'])) {
  $colname_Recordset2 = $_GET['titleNo'];
}
mysql_select_db($database_voteConn, $voteConn);
$query_Recordset2 = sprintf("SELECT * FROM votemain WHERE titleNo = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $voteConn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname_totalRec = "-1";
if (isset($_GET['titleNo'])) {
  $colname_totalRec = $_GET['titleNo'];
}
mysql_select_db($database_voteConn, $voteConn);
$query_totalRec = sprintf("SELECT titleNo,Sum(itemNum) As totalNum  FROM votemain WHERE titleNo = %s GROUP By titleNo", GetSQLValueString($colname_totalRec, "int"));
$totalRec = mysql_query($query_totalRec, $voteConn) or die(mysql_error());
$row_totalRec = mysql_fetch_assoc($totalRec);
$totalRows_totalRec = mysql_num_rows($totalRec);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<style type="text/css">
.bggg {
	background-image: url(img/atable22-2.gif);
	background-repeat: repeat-x;
}
.btu {
	background-image: url(img/atable22-7.gif);
	background-repeat: repeat-x;
}
.bgr {
	background-image: url(img/atable22-4.gif);
	background-repeat: repeat-y;
}
.bgl {
	background-image: url(img/atable22-5.gif);
	background-repeat: repeat-y;
}
.ttl {
	color: #FFF;
	background-color: #09C;
}
</style>
<body>
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="29" background="img/atable22-1.gif"><img src="img/atable22-1.gif" width="29" height="28" /><img src="img/atable22-4.gif" alt="" width="29" height="18" /></td>
    <td width="592" background="img/atable22-2.gif"><a href="index.php"><img src="img/title.gif" alt="網路票選" width="272" border="0" /></a></td>
    <td width="29"><img src="img/atable22-3.gif" width="29" height="28" /><img src="img/atable22-5.gif" width="29" height="18" /></td>
  </tr>
  <tr>
    <td><img src="img/atable22-6.gif" width="29" height="11" /></td>
    <td background="img/atable22-7.gif"><img src="img/atable22-7.gif" width="25" height="11" /></td>
    <td><img src="img/atable22-8.gif" width="29" height="11" /></td>
  </tr>
  
  <tr>
    <td background="img/atable22-4.gif">&nbsp;</td>
    <td>票選主題:<img src="img/fast-forward.gif" width="16" height="16" align="absmiddle" /><?php echo $row_Recordset1['voteTitle']; ?><br />
      總投票數:<img src="img/fast-forward.gif" alt="" width="16" height="16" align="absmiddle" /><?php echo $row_totalRec['totalNum']; ?>票
<table width="650" border="0" cellpadding="2" cellspacing="2">
        <tr>
          <td width="300" bgcolor="#F3C0DF"><div align="center" class="style32"><span class="style30">項目</span></div></td>
          <td width="53" bgcolor="#F3C0DF"><div align="center" class="style32"><span class="style30">得票數</span></div></td>
          <td width="277" bgcolor="#F3C0DF"><div align="center" class="style32"><span class="style30">得票率</span></div></td>
        </tr>
        <?php do { ?>
          <tr>
            <td><?php echo $row_Recordset2['itemName']; ?></td>
            <td align="right"><?php echo $row_Recordset2['itemNum']; ?></td>
            <td><span class="style34"> <img src="img/r.gif" width="<?php 
		  			if($row_Recordset2['itemNum']==0)
						echo(0);
					else
						echo(200*$row_Recordset2['itemNum']/$row_totalRec['totalNum']);
		  		?>" height="10" />(
              <?php
                	if($row_Recordset2['itemNum']==0)
						echo(0);
					else
						echo(number_format(100*$row_Recordset2['itemNum']/$row_totalRec['totalNum'],2));
				?>
              %) </span></td>
          </tr>
          <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
</table>
      <div align="center"><a href="index.php"><br />
        <img src="img/votemain.gif" width="80" height="24" border="0" /></a><br />
    </div></td>
    <td background="img/atable22-5.gif">&nbsp;</td>
  </tr>
  <tr>
    <td><img src="img/atable22-6.gif" width="29" height="11" /></td>
    <td background="img/atable22-7.gif"><img src="img/atable22-7.gif" width="25" height="11" /></td>
    <td><img src="img/atable22-8.gif" width="29" height="11" /></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($totalRec);
?>
