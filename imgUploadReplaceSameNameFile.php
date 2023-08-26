<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user data from AJAX POST request
$userData = $_POST['user_data'];

// Decode the JSON data to an associative array
$userDataArray = json_decode($userData, true);

// Access user properties
$userName = $userDataArray['displayName'];
$userEmail = $userDataArray['email'];
    // Get user data from AJAX POST request
    $tagName = $_POST['tagName'];

    // 設定上傳的目錄
    $uploadDirectory = "./upload/";

    // 提取檔案資訊
    $uploadedFileName = $_FILES["file"]["name"];
    $fileInfo = pathinfo($uploadedFileName);

    // 提取副檔名
    $extension = $fileInfo["extension"];

    // 自訂檔案名稱
    $customFileName = $userEmail . $tagName . '.' . $extension;
    $NameCheck = $userEmail . $tagName;

    // 完整的上傳路徑
    $uploadPath = $uploadDirectory . $customFileName;
    $existingFiles = glob($uploadDirectory . $NameCheck . ".*");
    
    foreach ($existingFiles as $existingFile) {
        if (is_file($existingFile)) {
            unlink($existingFile);
        }
    }
    

    // 移動上傳的檔案到目標目錄
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadPath)) {
        echo "File uploaded successfully.";
    } else {
        echo "File upload failed.";
    }

    
}
$response = ['message' => 'User data received and processed'];
echo json_encode($response);
echo $userName;

// header("location:index.html");
?>