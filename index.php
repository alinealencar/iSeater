<?php
$title = "iSeater";
require "includes/head.php";
?>
<body>
    <div id = "signinHeader">
        <a href = "/"><img src="images/logo2.png" alt = "iSeater logo"></a>
    </div>
    <div id = "signinBackground">
        <div id = "signinWindow">
            <br>
            <p id = "signIn">Sign In</p>
            <form id = "loginForm" action = "signin.php" method = "post">
                <label>Username: </label><input class = "whitebg" type="text" name="username">
                <br><br>
                <label>Password: </label><input class = "whitebg" type = "password" name="password">
                <br><br>
                <input class = "submitButton" type="submit" value="Sign In">
            </form>
            <br>
        </div>
    </div>
</body>
<?php
require "includes/footer.php";
?>