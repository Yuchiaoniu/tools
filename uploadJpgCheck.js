var uploadForm = document.getElementById('uploadForm');
var submitButton = document.getElementById('submitButton');
var fileInput = document.getElementById('file');

// 在表單提交之前進行檔案檢查
uploadForm.addEventListener('submit', function (event) {
    var selectedFile = fileInput.files[0];

    // 檢查檔案是否存在且是 jpg 檔案
    if (!selectedFile || selectedFile.type !== 'image/jpeg') {
        event.preventDefault(); // 阻止表單提交
        alert('請選擇一個 jpg 檔案進行上傳。');
    }
});