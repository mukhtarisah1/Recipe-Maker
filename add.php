<?php
include('config/db_connect.php');

$title=$email=$ingredients='';
$errors = array('email'=>'', 'title'=>'', 'ingredients'=>'');

if(isset($_POST['submit'])){
    
    //check for email
    if(empty($_POST['email'])){
        $errors['email']= 'An email is required <br>';
    }else{
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email']= 'please insert a valid email';
        }
    }

    if(empty($_POST['title'])){
        $errors['title']= 'A title is required <br>';
    }else{
            $title =  $_POST['title'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
                $errors['title']= 'Title must be letters and spaces only';
            }
    }

    if(empty($_POST['ingredients'])){
        $errors['ingredients']= 'At least one ingredient is required <br>';
    }else{
        $ingredients =  $_POST['ingredients'];
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*s/', $ingredients)){
            $errors['ingredients']= 'Igredients must be a comma seperated list ';
        }
    }
    if(array_filter($errors)){
        //echo 'errors in the form';
    }else{

        $email= mysqli_real_escape_string($conn, $_POST['email']);
        $title= mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients= mysqli_real_escape_string($conn, $_POST['ingredients']);

        $sql = "insert into pizzas (title, email, ingredients) values ('$title', '$email', '$ingredients' )";

        if(mysqli_query($conn, $sql)){
            header('location: index.php');
        }
        else{
            echo 'query error: '. mysqli_error($conn);
        }
        //echo 'form is valid';
        
        
    }
}

?>
<!Doctype html>
<html>
    <?php include('templates/header.php'); ?>

    <section class="container grey-text">
        <h4 class="center"> Add a Pizza</h4>
        <form class="white form" action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
            <label>Your Email:</label>
            <input type="text" name="email"  value="<?php echo $email; ?>">
            <div class="red-text"><?php echo $errors['email'];  ?></div>

            <label>Pizza Title:</label>
            <input type="text" name="title"  value="<?php echo $title; ?>">
            <div class="red-text"><?php echo $errors['title'];  ?></div>

            <Label>Ingedients (comma seperated):</label>
            <input type="text" name="ingredients"  value="<?php echo $ingredients; ?>" >
            <div class="red-text"><?php echo $errors['ingredients'];  ?></div>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
</html>