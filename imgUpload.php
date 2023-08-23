<?php

echo'<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <!-- partial:index.partial.html -->
    <p class="tip"></p>
    <div class="cont">
        <div class="form sign-in">
            <h2>Welcome back</h2>
            <div style="color:white;" id="displayName"></div>
            <img id="dynamicImage" src="" alt="Dynamic Image">

            <button type="button" class="google-btn">Connect with <span>Google</span></button>
            <button type="button" id="logout-button">sign out <span>Google</span></button>

        </div>
    </div>
    <form action="Upload.php" method="post" enctype="multipart/form-data">
        <label for="file">選擇要上傳的文檔：</label>
        <input type="file" name="file" id="file"><br>
        <!-- 隱藏的輸入元素，將使用者數據的 JSON 字串作為值 -->
        <input type="hidden" name="user_data" id="user_data" value="">
        <input type="hidden" name="tagName" id="a1" value="a1">
        <input type="submit" value="上傳文檔">
    </form>
    <p id="textPlaceholder">這裡會動態插入文本內容</p>

    <script src="https://www.gstatic.com/firebasejs/10.1.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.1.0/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.1.0/firebase-auth.js"></script>
    <!-- Your JavaScript code goes here  -->

    <script type="module">

        // Import the required functions from Firebase Auth SDK
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-app.js";
        import { getAuth, signOut, GoogleAuthProvider, createUserWithEmailAndPassword, signInWithEmailAndPassword, signInWithPopup, getRedirectResult } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-auth.js";
        import { getDatabase, set, ref } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-database.js";

        // Your web app"s Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyB3hmaa5DKY70in7d8_HT8uLuPnsc58wyo",
            authDomain: "authentication-app-2d849.firebaseapp.com",
            databaseURL: "https://authentication-app-2d849-default-rtdb.firebaseio.com",
            projectId: "authentication-app-2d849",
            storageBucket: "authentication-app-2d849.appspot.com",
            messagingSenderId: "680172971072",
            appId: "1:680172971072:web:d9387667c8bc56052e2ba5"
        };

        // Initialize Firebase

        const resultString = sessionStorage.getItem("result");
        const result = JSON.parse(resultString);
        const userString = sessionStorage.getItem("user");
        const user = JSON.parse(userString);
        console.log(result);
        console.log(user);
        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);
        const provider = new GoogleAuthProvider();

        // Add an event listener to the "Join with Google" button
        document.querySelector(".google-btn").addEventListener("click", (e) => {
            console.log(auth);
            console.log(provider);
            signInWithPopup(auth, provider)
                .then((result) => {
                    console.log("this is result", result);
                    // Google sign-in successful
                    const user = result?.user;
                    alert("Hello " + user?.displayName + " ");
                    document.getElementById("displayName").innerText = "Hello " + user?.displayName + " (Google)";
                    sessionStorage.setItem("result", JSON.stringify(result));
                    sessionStorage.setItem("user", JSON.stringify(user));
                    location.reload();
                    // ...
                })
                .catch((error) => {
                    const errorMessage = error;
                    alert(errorMessage);
                    // ...
                });
        });
        if (user != null) { document.getElementById("displayName").innerText = "Hello " + user?.displayName + " (Google)"; }

        // Check for the Google sign-in redirect result after the "Join with Google" button is clicked
        document.addEventListener("DOMContentLoaded", () => {
            getRedirectResult(auth)
                .then((result) => {
                    if (result == null) {
                        return;
                    }
                    if (result.user) {
                        // Google sign-in successful
                        const user = result.user;
                        alert("Hello " + user?.displayName + " (Google)");

                    } else {

                    }
                })
                .catch((error) => {
                    const errorMessage = error;
                    alert(error);
                    // ...
                });
        });




        document.getElementById("logout-button").addEventListener("click", () => {

            const auth = getAuth();
            signOut(auth).then(() => {
                sessionStorage.removeItem("result");
                sessionStorage.removeItem("user");
                console.log("User signed out.");
                location.reload();
            }).catch((error) => {
                // An error happened.
            });

        });


        // Convert user object to JSON string
        const userStringify = JSON.stringify(user);
        document.getElementById("user_data").value = userStringify;
        // Send user data to PHP using AJAX
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "Upload.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                console.log("User data sent to PHP");
            }
        };
        xhr.send(JSON.stringify({ user: userStringify }));

        document.addEventListener("DOMContentLoaded", () => {
            const dynamicImage = document.getElementById("dynamicImage");
            const changeImageButton = document.getElementById("changeImage");

            // 初始圖片 URL
            let imageUrl = "./upload/" + user?.email + "a1" + ".jpg";

            console.log(imageUrl);
            console.log(dynamicImage);

            // 更新圖片 URL 並設定給 img 標籤的 src 屬性
            function updateImage() {
                dynamicImage.src = imageUrl;
            }


            // 初始設定
            updateImage();
        });


    </script>
</body>

</html>';


if(isset($_POST["user_data"])) {
    // Get the JSON user data from the hidden input element
    $userData = $_POST["user_data"];

    // Decode the JSON data to an associative array
    $userDataArray = json_decode($userData, true);

    // Access user properties
    $userName = $userDataArray["displayName"];
    $userEmail = $userDataArray["email"];

    // Do something with the user data (e.g., save to database)
    // ...

    // Send a response back to the JavaScript code
    $response = ["message" => "User data received and processed"];
    echo json_encode($response);
    echo $userName;
}
// Get user data from AJAX POST request
$tagName = $_POST["tagName"];
echo var_dump($tagName);
$uploadedFileName = $_FILES["file"]["name"];

// 使用 pathinfo 函數獲取檔案資訊
$fileInfo = pathinfo($uploadedFileName);

// 提取副檔名部分
$extension = $fileInfo["extension"];

echo "副檔名: " . $extension;
    $customFileName = $userEmail.$tagName.".".$extension;

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