<?php
$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$totalurl = basename($actual_link);
$parsedUrl = parse_url($totalurl, PHP_URL_PATH);
$filename = basename($parsedUrl);
// var_dump($filename);
?>
<link rel="stylesheet" href="partials/_registration_header.css">

<div class="navbar">
    <div class="header">
        <div class="logo"><span style="color:white;">Tech</span> 
            <br><span style="color:cyan;">HireHub</span>
        </div>
        <?php
                echo ($filename == 'user_registration.php' || $filename == 'reset_password_user.php' ) ? '<a href="index.php"><button id="agent_reg_login">LOGIN</button></a>' : ''; ?>
        
    </div>
</div>