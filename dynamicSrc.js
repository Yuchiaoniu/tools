let userEmail = user?.email; // 假設這是使用者的電子郵件地址
let upperLimit = 10; // 自行設定上限值

for (let i = 0; i < upperLimit; i++) {
    let tagName = i;
    let userEmail = 'xx@gmail.com';
    let imageUrl = `./upload/${userEmail} (${tagName}).jpg`;

    // 在這裡使用 imageUrl，例如更新 img 標籤的 src 屬性
    // ...

    console.log(imageUrl); // 輸出 imageUrl，以供測試
}
