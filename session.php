<?php
session_start();// 开启session
echo 'session';
$_SESSION['user_name']='zhangsan';
$_SESSION['user_id']=124;
