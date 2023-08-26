//遍歷動態參數
//tagName是i
let userEmail = user?.email; // 假設這是使用者的電子郵件地址
let upperLimit = 10; // 自行設定上限值

for (let i = 0; i < upperLimit; i++) {
    let tagName = i;
    let imageUrl = `./upload/${userEmail} (${tagName}).jpg`;

    // 在這裡使用 imageUrl，例如更新 img 標籤的 src 屬性
    // ...

    console.log(imageUrl); // 輸出 imageUrl，以供測試
}

//tagName是陣列
let userEmail = user?.email; // 假設這是使用者的電子郵件地址
let tagNameAttray = ["0", "1", "2", "3", "4", "5"]; // 假設這是 tagNameAttray 陣列

for (let i = 0; i < tagNameAttray.length; i++) {
    let tagName = tagNameAttray[i];
    let imageUrl = `./upload/${userEmail}${tagName}.jpg`;

    // 在這裡使用 imageUrl，例如更新 img 標籤的 src 屬性
    // ...

    console.log(imageUrl); // 輸出 imageUrl，以供測試
}

//遍歷靜態參數
//也可以是用foreach===================================================
const imgTagElements = document.querySelectorAll('.img_tag');

// 新增的 HTML 內容
const newHtmlContent = `
<form action="imgUpload.php" method="post" enctype="multipart/form-data">
<label for="file">選擇要上傳的文檔：</label>
<input type="file" name="file" id="file"><br>
<input type="hidden" name="user_data" id="user_data" value="">
<input type="hidden" name="tagName" value="a1">
<input type="submit" value="upload">
</form>
`;

// 逐一插入新的 HTML 內容在每個 imgTagElement 之後
imgTagElements.forEach((imgTagElement) => {
    imgTagElement.insertAdjacentHTML('afterend', newHtmlContent);
});