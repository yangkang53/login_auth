<?php
require_once 'Auth/Yubico.php';
include "config.php";

$username = htmlspecialchars($_REQUEST["username"]);
$password = $_REQUEST["password"];
$mode = htmlspecialchars($_REQUEST["mode"]);
$key = htmlspecialchars($_REQUEST["key"]);
if (isset($_REQUEST["passwordkey"])) {
  $passwordkey = $_REQUEST["passwordkey"];
} else {
  $passwordkey = "";
}

# Quit early on no input
if (!$key && !$passwordkey) {
  $authenticated = -1;
  return;
 }

# Prepare passwordkey using password and key variables
if (($password && $key) && !$passwordkey) {
  $passwordkey = $password . ':' . $key;
}

# Convert passwordkey fields into password + key variables
if ($passwordkey) {
  $ret = Auth_Yubico::parsePasswordOTP($passwordkey);
} else {
  $ret = Auth_Yubico::parsePasswordOTP($key);
}

$passwordkey = htmlspecialchars($passwordkey);

if (!$ret) {
  $authenticated = 31;
  return;
}

$identity = htmlspecialchars($ret['prefix']);
$key = htmlspecialchars($ret['otp']);

# Check OTP
$yubi = new Auth_Yubico($CFG['__CLIENT_ID__'], $CFG['__CLIENT_KEY__']);
$auth = $yubi->verify($key);
if (PEAR::isError($auth)) {
  $authenticated = 1;
  return;
 } else {
  $authenticated = 0;
 }


?>
