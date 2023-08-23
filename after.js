// 找到第一個.target
const targetElement = document.querySelector('.target');

// 創建新的元素或內容
const newContent = document.createElement('p');
newContent.textContent = '新的內容';

// 在元素後面插入新的元素或內容
targetElement.after(newContent);

//=========================================================

// 找到所有具有 class="img_tag" 的元素
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
