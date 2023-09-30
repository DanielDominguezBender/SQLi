<?php
    include_once 'includes/dbh_inc.php';
    include 'header.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>
        </title>
    </head>
    
    <body>
    <?php
        // Get parameter
        $email=$_GET['email'];

        $sql = "SELECT * FROM Users WHERE Email=$email;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo $row['Name']."<br>";;
                echo $row['Password']."<br>";
                echo $row['AccountId']."<br>";
            }
        }
    ?>

    <table>
        <tr>
            <td>
                <a href=news.php>Back</a>
            </td>
        </tr>
    </table>
    </body>
</html>