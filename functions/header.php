<?php
    session_start();
    if (!isset($_SESSION['id']))
    {
        echo '
            <nvli><a href="signup/signup.php">Sign up</a></nvli>
            <nvli><a href="login/login.php">Login</a></nvli>';
    }
    else
    {
        echo '
        <nvli><a href="login/logout.php">Logout</a></nvli>
        <nvli><a href="user/post.php">Post</a></nvli>
        <nvli><a href="user/viewposts.php">View Posts</a></nvli>
        <nvli><a href="user/profile.php">' . $_SESSION['username'] . '</a></nvli>';
    }
    ?>