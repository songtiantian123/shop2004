<?php
    session_start();// 开启session
    if(isset($_SESSION['uid'])){
        echo '欢迎回来：'.$_SESSION['user_name'];
    }else{
        echo '请先登录';
    }
