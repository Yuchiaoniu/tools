let tagIdArray = ["t1", "t2", "t3", "t4", "t5", "t6", "t7", "t8", "t9", "t10", "t11", "t12"
    , "p1", "p2", "p3", "p4", "p5", "p6", "p7", "p8", "p9", "p10", "p11", "p12"];
// dom提交按紐和p標籤，將p標籤內容上傳到伺服器

// 從 tagIdArray 中取得所有標籤
for (var i = 0; i < tagIdArray.length; i++) {
    var tagId = tagIdArray[i];
    var element = document.getElementById(tagId);

    if (element) {
        // 如果找到具有相應 id 的標籤，添加 classname
        element.classList.add("textEditable");
    }
}