<?php

echo '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit and Upload Text</title>
</head>

<body>
    <p id="editableText" class="editable" ondblclick="makeEditable(this)">Double-click to edit me</p>
    <button id="saveButton">Save Text</button>

    <script>
        // 將編輯的文字內容保存到 .txt 檔案，並上傳到伺服器
        document.getElementById("saveButton").addEventListener("click", function () {
            var editedText = document.getElementById("editableText").innerText;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "textUpload.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    console.log("Text saved successfully.");
                }
            };
            xhr.send("editedText=" + encodeURIComponent(editedText));
            alert("update!");
        });

        // 設定可編輯狀態
        function makeEditable(element) {
            element.contentEditable = true;
            element.focus();
        }


        //抓取檔案內容
        // 使用 Fetch API 抓取指定路徑的 .txt 檔案內容
        function fetchTextFile() {
            fetch("upload/text.txt")
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.text();
                })
                .then(fileContent => {
                    // 將內容填充到適當的元素中
                    document.getElementById("editableText").innerText = fileContent;
                })
                .catch(error => {
                    console.error("Fetch error:", error);
                });
        }

        // 調用函數以抓取並填充內容
        fetchTextFile();
    </script>
</body>

</html>';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $editedText = $_POST["editedText"];

    $fileName = "text.txt";
    $filePath = "upload/" . $fileName; // 請確保 "upload" 資料夾存在並具有適當的權限

    file_put_contents($filePath, $editedText);

    echo "Text saved successfully.";
}

?>