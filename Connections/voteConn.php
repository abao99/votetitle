<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_voteConn = "localhost";
$database_voteConn = "votetitle";
$username_voteConn = "admin";
$password_voteConn = "123456";
$voteConn = mysql_pconnect($hostname_voteConn, $username_voteConn, $password_voteConn) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("set names utf8");
?>