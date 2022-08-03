<?php
    include('config/db_connect.php');
    if(isset($_POST['delete'])){

        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
        $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

        if(mysqli_query($conn, $sql)){
            //success
            header('Location: index.php');}
           {
                echo 'query error: '. mysqli_error($conn);
            }
        
    }

    if(isset($_GET['id'])){

        $id = mysqli_real_escape_string($conn, $_GET['id']);
        
        $sql = "SELECT * FROM pizzas where id = $id";
        $result=mysqli_query($conn, $sql);
        //fetch a single item as an array
        $pizza = mysqli_fetch_assoc($result);
        mysqli_free_result($result );
        mysqli_close($conn);

        //print_r($pizza);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php'); ?>
        <div class="container center grey-text" >
            <?php if($pizza): ?> 
                <h4> <?php echo htmlspecialchars($pizza['title']); ?> </h4>
                <p>Created by: <?php echo htmlspecialchars($pizza['email']); ?></p>
                <p><?php echo date($pizza['created_at']); ?></p>
                <p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>

                <!---Delete Form-->
                <form action="details.php" method="post">
                    <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
                    <input type="submit" name="delete" value="Delete" class="btn brand z-0-depth">
                </form>

                
                <?php else: ?>
                    <h5>No such pizza exists</h5>
            <?php endif; ?>
        </div>
              
 
    <?php include('templates/footer.php'); ?>
</html>