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
        // 將編輯的文字內容存儲在本地瀏覽器的 sessionStorage
        document.getElementById("saveButton").addEventListener("click", function () {
            var editedText = document.getElementById("editableText").innerText;
            sessionStorage.setItem("editedText", editedText);
            // 使用 AJAX 或表單提交將 editedText 傳送到伺服器
        });

        // 設定可編輯狀態
        function makeEditable(element) {
            element.contentEditable = true;
            element.focus();
        }

        // 檢查 sessionStorage 是否有保存的編輯內容，如果有，將其載入到 <p> 標籤
        window.onload = function () {
            var editedText = sessionStorage.getItem("editedText");
            if (editedText) {
                document.getElementById("editableText").innerText = editedText;
            }
        };
    </script>
</body>

</html>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $editedText = $_POST["editedText"];

    $fileName = "edited_text.txt";
    $filePath = "uploads/" . $fileName;

    file_put_contents($filePath, $editedText);

    echo "Text saved successfully.";
}
?>
