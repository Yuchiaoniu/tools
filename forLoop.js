//經典案例，如果要在for迴圈裏面放另外一個for迴圈，請把裡面的迴圈改成以下樣式
//const mainDiv = document.getElementsByClassName('mainDiv')[i];
for (let i = 0; i < tagIdArray2.length; i++) {
    let tagId2 = tagIdArray2[i];
    let ImageUrl2 = `./upload/${user?.email}${tagId2}.jpg`;
    const dynamicImage2 = document.getElementById(tagId2);

    // Send user data to PHP using AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'Upload.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            console.log('User data sent to PHP');
        }
    };

    // 更新圖片 URL 並設定給 img 標籤的 src 屬性
    function updateImage() {
        dynamicImage2.src = ImageUrl2;
    }

    // 初始設定
    updateImage();

    // 新增的 HTML 內容
    const newHtmlContent2 = `
        <form id="uploadForm_${tagId2}" class="form2" method="post" enctype="multipart/form-data">
            <label for="file">選擇要上傳的文檔：</label>
            <input type="file" class="file" name="file" id="file"><br>
            <input type="hidden" name="user_data" class="user_data_field" value="">
            <input type="hidden" name="tag_name" value="${tagId2}">
            <input class="submitButton" type="submit" value="upload">
        </form>
    `;
    const mainDiv = document.getElementsByClassName('mainDiv')[i];
    mainDiv.insertAdjacentHTML('afterend', newHtmlContent2);
    const user_data_field2 = document.querySelector(`#uploadForm_${tagId2} .user_data_field`);
    user_data_field2.value = userEmail;
}