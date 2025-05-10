<?php
include_once "koneksi.php";

$sql = "SELECT * FROM forum_posting fp LEFT JOIN forum f ON fp.forum_id = f.forum_id 
                    LEFT JOIN user u ON fp.user_id = u.id 
                    ORDER BY fp.date_posted ASC";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    //print all forum posting here
    //display attachment
    //user image and name links to user page

    //get attachments
    $fpid = $row['posting_id'];
    $sql = "SELECT attachment FROM attachment WHERE forum_id = $fpid";
    $result = mysqli_query($con,$sql);


}
mysqli_close($con);
?>