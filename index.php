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

mysql_select_db($database_voteConn, $voteConn);
$query_Recordset1 = "SELECT * FROM votetitle ORDER BY titleNo ASC";
$Recordset1 = mysql_query($query_Recordset1, $voteConn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
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
</head>

<body>
<table width="500" border="0" align="center">
  <tr>
    <td width="29" height="30" valign="top"><img src="img/atable22-1.gif" width="29" height="28"></td>
    <td width="428" rowspan="2" class="bggg"><img src="img/title.gif" width="299" height="33"></td>
    <td width="29" valign="top"><img src="img/atable22-3.gif" width="29" height="28"></td>
  </tr>
  <tr>
    <td rowspan="3" valign="top" class="bgr">&nbsp;</td>
    <td rowspan="3" valign="top" class="bgl">&nbsp;</td>
  </tr>
  <tr>
    <td class="bggg">票選活動列表</td>
  </tr>
  <tr>
    <td><table width="500" border="1">
      <tr align="center" valign="middle" class="ttl">
        <td>票選主題</td>
        <td>活動期限</td>
        <td>動作</td>
      </tr></table>
      <?php do { 
	  		if($row_Recordset1['starDate'] <= date("Y-m-d")){
	  ?>
        <table width="500" border="1">
          <tr>
            <td width="250" rowspan="4" align="left" valign="middle"><img src="img/fast-forward.gif" width="16" height="16"><?php echo $row_Recordset1['voteTitle']; ?></td>
            <td width="150" align="center" valign="middle"><?php echo $row_Recordset1['starDate']; ?></td>
            <td width="100" rowspan="2" align="center" valign="middle">
            <?php if($row_Recordset1['endDate']>=date("Y-m-d")){?>
            <a href="govote.php?titleNo=<?php echo $row_Recordset1['titleNo']; ?>"><img src="img/govote.gif" width="80" height="24"></a>
            <?php }?>
            </td>
          </tr>
  <tr>
    <td width="150" rowspan="2" align="center" valign="middle">~</td>
    </tr>
          <tr>
            <td width="100" rowspan="2" align="center" valign="middle"><a href="showvote.php?titleNo=<?php echo $row_Recordset1['titleNo']; ?>"><img src="img/showvote.gif" width="80" height="24"></a></td>
          </tr>
          <tr>
            <td width="150" align="center" valign="middle"><?php echo $row_Recordset1['endDate']; ?></td>
          </tr>
        </table>
        <?php } } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?></td>
  </tr>
  <tr>
    <td valign="top" background="img/atable22-6.gif" style="background-repeat:no-repeat">&nbsp;</td>
    <td class="btu">&nbsp;</td>
    <td valign="top" background="img/atable22-8.gif" style="background-repeat:no-repeat">&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
