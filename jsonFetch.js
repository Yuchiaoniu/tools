// 使用 XMLHttpRequest 抓取指定路徑的 .txt 檔案內容
function fetchTextFile() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'path/to/your/file.txt', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var fileContent = xhr.responseText;
                // 將內容填充到適當的元素中
                document.getElementById('contentElement').innerText = fileContent;
            } else {
                console.error('Error fetching file:', xhr.status);
            }
        }
    };
    xhr.send();
}

// 調用函數以抓取並填充內容
fetchTextFile();


// 使用 Fetch API 抓取指定路徑的 .txt 檔案內容
function fetchTextFile() {
    fetch('path/to/your/file.txt')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(fileContent => {
            // 將內容填充到適當的元素中
            document.getElementById('contentElement').innerText = fileContent;
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
}

// 調用函數以抓取並填充內容
fetchTextFile();