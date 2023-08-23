// 獲取具有 "target" class 的元素
const targetElement = document.querySelector('.target');

// 創建新的元素或內容
const newContent = document.createElement('p');
newContent.textContent = '新的內容';

// 在元素後面插入新的元素或內容
targetElement.after(newContent);