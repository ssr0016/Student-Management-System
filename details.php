<?php
    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator"){
        echo "Welcome ".$_SESSION['UserLogin']."<br><br >";
    }else{
        echo header("Location: index.php");
    }

    include_once("connections/connection.php");

    $con = connection();

    $id = $_GET['id'];

    
    //QUERY
    $sql = "SELECT * FROM student_list WHERE id = '$id'";
    $students = $con->query($sql) or die ($con->error);
    $row = $students->fetch_assoc();
    // do{
    //     echo $row['first_name']." ".$row['last_name']."<br/>";

    // }while( $row = $students->fetch_assoc());

    //Itong method na ito isa lang ang na fefetch niya. pero kung gusto makuha lahat nang data.. kailangan iloop
    // print_r($row ); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="css/style.css">


</head>
<body>
        
        <form action="delete.php" method="post">
            
        <a href="index.php"><-Back</a>
        <a href="edit.php?id=<?php echo $row['id'];?>">Edit</a>

            <?php if(($_SESSION['Access'] == "administrator")){?>
            <button type="submit" name="delete">Delete</button>
            <?php } ?>


            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
        </form>

        <br>

        <h2><?php echo $row['first_name'];?> <?php echo $row['last_name'];?></h2>
       
    
</body>
</html>