<?php
    require_once 'PostDAO.php';
    session_start();
    
    $errors = array();
    
    $name = $_POST['name'];
    $title = $_POST['title'];
    $message = $_POST['message'];
    
    $image_name = PostDAO::upload();
    var_dump($image_name);
    $post = new Post($name, $title,$message,$image_name);
    $errors = $post->validate();
    

    
    if(count($errors) !== 0){
        $_SESSION['errors'] = $errors;
        header('Location: new.php');
        exit();
    }else{ 
        $_SESSION['post'] = $post;
        header('Location: new.done.php');
        exit;
    }