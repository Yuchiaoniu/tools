if (window.location.pathname.includes('/wbloom-3/')) {
    ['userzone', 'generateButton'].forEach(id => document.getElementById(id)?.remove());
    //這裡的問號叫做可選鏈接，如果沒有的話則會返回undefind，而非錯誤
}