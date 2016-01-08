<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <base href="<?= $root ?>" >
        <link rel="stylesheet" href="Media/CSS/style.css" />
        <title><?= $title ?></title>
    </head>
    <body>
        <div id="bodyContent">
            <a href="">
                <h1 id="welcomeTitle">GoodWall Lite<img src="Media/Images/goodwall.jpeg" alt="goodWallLogo" style="width:50px;height:50px;">
                </h1>
            </a>

            <div id="authentication">
                <a href="<?= "connection/signup/"?>"><h2 id="signUp">Sign up</h2></a>
                <a href="<?= "connection/index/"?>"><h2 id="signIn">Sign in</h2></a>                
            </div>

            <div id="content">
                <?= $content ?>
            </div>

            <footer id="footer">
                <p> © Copyright 2015 Goodwall SA </p>
                <i> Back-End Coding Challenge: vanilla PHP using MVC pattern, HTML5 and CSS. </i>
            </footer>
        </div>
    </body>
</html>