document.addEventListener('DOMContentLoaded', () => {
    let userEmail = user?.email; // 假設這是使用者的電子郵件地址
    let upperLimit = 15; // 自行設定上限值

    let tagIdArray = ["a1", "a2", "a3", "a4", "b1", "b2", "c1", "c2", "c3", "c4", "d1", "d2", "d3", "d4", "d5"]; // 假設這是 tagNames 陣列

    for (let i = 0; i < tagIdArray.length; i++) {
        let tagId = tagIdArray[i];
        let ImageUrl = `./upload/${user?.email}${tagId}.*`;
        const dynamicImage = document.getElementById(tagId);

        // 更新圖片 URL 並設定給 img 標籤的 src 屬性
        function updateImage() {
            dynamicImage.src = ImageUrl;
        }

        // 初始設定
        updateImage();

        // 新增的 HTML 內容
        const newHtmlContent = `
    <form id="uploadForm_${tagId}" action="imgUpload.php" method="post" enctype="multipart/form-data">
        <label for="file">選擇要上傳的文檔：</label>
        <input type="file" name="file" id="file"><br>
        <input type="hidden" name="user_data" id="user_data" value="">
        <input type="hidden" name="tag_name" value="${tagId}">
        <input id="submitButton" type="submit" value="upload">
    </form>
`;

        // 在每個 imgTagElement 之後插入新的 HTML 內容
        dynamicImage.insertAdjacentHTML('afterend', newHtmlContent);
    }
});