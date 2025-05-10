<?php
include_once "koneksi.php";
$uid = $_POST['user_id'];
$fid = $_POST['forum_id'];
$msg = $_POST['msg'];

//insert post
$sql = "INSERT INTO forum_posting VALUES (null,'$uid','$fid','$msg',null);";
mysqli_query($con,$sql);
$pid = mysqli_insert_id($con);

//rearrange files 3d array to use foreach
function reArrayFiles(&$file_post){
    $isMulti    = is_array($file_post['name']);
    $file_count    = $isMulti?count($file_post['name']):1;
    $file_keys    = array_keys($file_post);

    $file_ary    = []; 
    for($i=0; $i<$file_count; $i++)
        foreach($file_keys as $key)
            if($isMulti)
                $file_ary[$i][$key] = $file_post[$key][$i];
            else
                $file_ary[$i][$key]    = $file_post[$key];

    return $file_ary;
}

//Upload File
if($_FILES["upload"]){
    if($_FILES["upload"]["error"] > 0){
        echo "Return Code: " . $_FILES["upload"]["error"] . "<br>";
    } else {
        $file_ary = reArrayFiles($_FILES['upload']);

        $num = 0;
        foreach ($file_ary as $file) {
            $temp = explode(".",$file['name']);
            $path = "attachments/" . $temp[0] . time()+$uid+$num . $temp[1];
            move_uploaded_file($file['tmp_name'], $path);
            $num++;

            //insert attachment path to db
            $sql = "INSERT INTO attachments VALUES ($pid,$path);";
            mysqli_query($con,$sql);
        }
    }
} else {
    echo "Invalid file";
}
//Upload File end

mysqli_close($con);





?>