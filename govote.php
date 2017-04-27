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

if((isset($_POST["MM_updata"]))&&($_POST["MM_updata"]== "form1"))
{
	if(isset($_POST['radio'])){
	$updataSQL="UPDATE votemain SET itemNum=itemNum+1 WHERE itemNo=".$_POST['radio'];
	mysql_select_db($database_voteConn,$voteConn);
	$Recordset3 = mysql_query($updataSQL, $voteConn) or die(mysql_error());
	$updataGoTo = "showvote.php";
	if(isset($_SERVER['QUERY_STRING'])){
		$updataGoTo .= (strpos($updataGoTo,'?'))?"&":"?";
		$updataGoTo .=$_SERVER['QUERY_STRING'];
		} 
	header(sprintf("Location: %s",$updataGoTo));
	}
	else{
		header(sprintf("Location: %s","govote.php?titleNo=".$row_Recordset2['titleNo']));
		}
	}





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
    <td class="bggg"><table width="428" border="0">
  <tr>
    <td width="82">票選主題<img src="img/fast-forward.gif" width="16" height="16"></td>
    <td width="336"><?php echo $row_Recordset1['voteTitle']; ?></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td><form name="form1" method="post" action="">
      <table width="428" border="0">
        <?php do { ?>
          <tr>
            <td width="81" align="right" valign="middle"><input type="radio" name="radio" id="radio" value="<?php echo $row_Recordset2['itemNo']; ?>">
              <label for="radio"></label></td>
            <td width="337" valign="middle"><?php echo $row_Recordset2['itemName']; ?></td>
          </tr>
          <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
        <tr>
          <td colspan="2" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="middle"><input name="MM_updata" type="hidden" id="MM_updata" value="form1">
            <input type="image" name="imageField" id="imageField" src="img/dovote.gif">
            &nbsp; <a href="index.php"><img src="img/votemain.gif" width="80" height="24"></a></td>
          </tr>
      </table>
    </form></td>
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

mysql_free_result($Recordset2);
?>
