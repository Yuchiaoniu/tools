// Convert user object to JSON string
const userStringify = JSON.stringify(user);
document.getElementById('user_data').value = userStringify;
// Send user data to PHP using AJAX
const xhr = new XMLHttpRequest();
xhr.open('POST', 'Upload.php', true);
xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        console.log('User data sent to PHP');
    }
};
xhr.send(JSON.stringify({ user: userStringify }));