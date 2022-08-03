<?php
    //superglobals
// echo $_SERVER['SERVER_NAME'] . '<br/>';
// echo $_SERVER['REQUEST_METHOD']. '<br/>'; 
// echo $_SERVER['PHP_SELF'].  '<br/>';
// echo $_SERVER['SCRIPT_FILENAME']. '<br/>';
// ECHO $_SERVER['REMOTE_ADDR'];
// echo exec('getmac');

if(isset($_POST['submit'])){
    //cookies for gender
    setcookie('gender', $_POST['gender'], time()+ 84600);

    //sessions
    session_start();

    $_SESSION['name'] = $_POST['name'];
    header('location:index.php');
    echo $_SESSION['name'];

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?> " method="POST">
        <input type="text" name="name">
        <select name="gender" id="">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        <input type="submit" name="submit" value="submit">

    </form>    

</body>
</html>