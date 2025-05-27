<?php 
include '../A_Model/user_model.php';

$term = $_GET['term'] ?? '';
$result = search_users($term);

while($row = mysqli_fetch_assoc($result)){
    $label = htmlspecialchars($row['username']);
    if($row['role'] === 'admin'){
        $label .= "(admin)";
    }
    echo "<li>". $label . "</li>";
}
?>