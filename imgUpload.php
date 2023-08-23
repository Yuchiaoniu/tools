<?php

echo'<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="imgUpload.php" method="post" enctype="multipart/form-data">
<label for="file">選擇要上傳的文檔：</label>
<input type="file" name="file" id="file"><br>
<!-- 隱藏的輸入元素，將使用者數據的 JSON 字串作為值 -->
<input type="hidden" name="user_data" id="user_data" value="">
<input type="hidden" name="tagName" id="a1" value="a1">
<input type="submit" value="上傳文檔">
</form>
</body>
</html>';


if(isset($_POST['user_data'])) {
    // Get the JSON user data from the hidden input element
    $userData = $_POST['user_data'];

    // Decode the JSON data to an associative array
    $userDataArray = json_decode($userData, true);

    // Access user properties
    $userName = $userDataArray['displayName'];
    $userEmail = $userDataArray['email'];

    // Do something with the user data (e.g., save to database)
    // ...

    // Send a response back to the JavaScript code
    $response = ['message' => 'User data received and processed'];
    echo json_encode($response);
    echo $userName;
}
// Get user data from AJAX POST request
$tagName = $_POST['tagName'];
echo var_dump($tagName);
$uploadedFileName = $_FILES["file"]["name"];

// 使用 pathinfo 函數獲取檔案資訊
$fileInfo = pathinfo($uploadedFileName);

// 提取副檔名部分
$extension = $fileInfo["extension"];

echo "副檔名: " . $extension;
    $customFileName = $userEmail.$tagName.'.'.$extension;

// Now you can work with the $user object in PHP
// For example, you can access user properties like $user->displayName

// Perform any necessary PHP operations here

// Return a response to the AJAX request (optional)
$uploadPath = "upload/".$customFileName; // 完整的上傳路徑
echo "User data received and processed";
if($_FILES["file"]["error"]>0)
{echo "錯誤代碼:".$_FILES["file"]["error"]."<br>";}else{
    echo "檔案名稱:".$_FILES["file"]["name"]."<br>";
    echo "檔案類型:".$_FILES["file"]["type"]."<br>";
    echo "檔案大小:".($_FILES["file"]["size"]/1024)."Kb<br>";
    echo "暫存名稱:".$_FILES["file"]["tmp_name"];
move_uploaded_file($_FILES["file"]["tmp_name"], $uploadPath);
}
// header("location:TextUpload.html");


?>