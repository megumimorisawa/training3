<?php
    require_once 'HumanDAO.php';
    session_start();
    
    $errors = array();
    
    $name = $_POST['name'];
    $title = $_POST['title'];
    $message = $_POST['message'];
    // $image = $_FILES['image'];
    
    // $tmp = $_FILES;
    
    $image_name = HumanDAO::upload();
    $human = new Human($name, $title,$message,$image_name);
    

    // $errors = $human->validate();

    
    if(count($errors) !== 0){
        $_SESSION['errors'] = $errors;
        header('Location: new.php');
        exit();
    }else{ 
        $_SESSION['human'] = $human;
        // $_SESSION['tmp'] = $tmp;
        header('Location: new.done.php');
        exit;
    }