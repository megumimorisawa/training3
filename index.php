

<?php
    require_once "PostDAO.php";
    session_start();
        
    $posts = PostDAO::get_all_posts();
    
    include_once "index_view.php";
?>

    

