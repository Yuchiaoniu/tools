// 取得所有具有 "textEditable" 類別的元素
var textEditableElements = document.getElementsByClassName("textEditable");

// 將這些元素存儲在陣列中，將nodeList轉變為真正的陣列，以開始使用foreach等功能
var elementsArray = Array.from(textEditableElements);

// 遍歷陣列並更改每個元素的 id
for (var i = 0; i < tagIdArray.length; i++) {
    if (i < tagIdArray.length) { // 確保有足夠的新 id 值供使用
        elementsArray[i].id = tagIdArray[i];
    }
}