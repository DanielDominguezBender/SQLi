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
        $id=$_GET['id'];

        $sql = "SELECT * FROM News WHERE Id=$id;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo $row['Title']."<br><br>";;
                echo $row['DateTime']."<br><br>";
                echo $row['Body']."<br>";
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