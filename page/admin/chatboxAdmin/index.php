<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Chatbox Quản lý</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <style>
  * {
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
  }

  body {
    margin: 0;
    height: 100vh;
    background-color: #f0f2f5;
  }

  .user-list {
    width: 260px;
    border-right: 1px solid #ddd;
    background-color: #fff;
    overflow-y: auto;
    padding: 10px;
  }

  .user {
    display: flex;
    align-items: center;
    padding: 10px;
    margin-bottom: 6px;
    border-radius: 8px;
    background-color: #f8f9fa;
    cursor: pointer;
    transition: background-color 0.2s;
  }

  .user:hover {
    background-color: #e2e6ea;
  }

  .avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: #007bff;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
    font-weight: bold;
    font-size: 16px;
  }

  .chat-container {
    flex: 1;
    display: flex;
    flex-direction: column;
    height: 100%;
  }

  .chat-messages {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    background-color: #e9edf0;
    display: flex;
    flex-direction: column;
  }

  .chat-input {
    display: flex;
    padding: 15px;
    border-top: 1px solid #ccc;
    background-color: #fff;
  }

  .chat-input input {
    flex: 1;
    padding: 12px 15px;
    border: 1px solid #ccc;
    border-radius: 25px;
    font-size: 14px;
    outline: none;
  }

  .chat-input button {
    margin-left: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 25px;
    padding: 12px 20px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .chat-input button:hover {
    background-color: #0056b3;
  }

  .message {
    max-width: 70%;
    padding: 12px 15px;
    margin-bottom: 12px;
    border-radius: 18px;
    line-height: 1.4;
    font-size: 14px;
    position: relative;
    white-space: pre-line;
    word-wrap: break-word;
  }

  .chat-left {
    background-color: #ffffff;
    color: #333;
    align-self: flex-start;
    border: 1px solid #ddd;
  }

  .chat-right {
    background-color: #007bff;
    color: white;
    align-self: flex-end;
  }

  .message b {
    font-size: 12px;
    display: block;
    margin-bottom: 5px;
    opacity: 0.8;
  }
  
  .badge {
  background-color: red;
  color: white;
  border-radius: 50%;
  padding: 2px 6px;
  font-size: 12px;
  position: absolute;
  top: -6px;
  right: -10px;
}
</style>
</head>
<body>

<div style="display: flex; height: 100vh;">
  <div class="user-list" id="userList"></div>

  <div class="chat-container">
    <div class="chat-messages" id="chatMessages"></div>
    <div class="chat-input">
      <input type="text" id="chatInput" placeholder="Nhập tin nhắn..." />
      <button onclick="sendMessage()">Gửi</button>
    </div>
  </div>
</div>

<script>
  const messagesDiv = document.getElementById('chatMessages');
  const input = document.getElementById('chatInput');

  let currentUserId = null;
  let adminId = 2; // giả định id quản trị viên là 2
  let refreshInterval;

  function fetchMessages() {
  if (!currentUserId) return;

  // Đánh dấu là đã xem các tin nhắn gửi từ user hiện tại đến admin
  fetch('page/admin/chatboxAdmin/daXem.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `maNguoiGui=${currentUserId}&maNguoiNhan=${adminId}`
  });

  fetch('page/admin/chatboxAdmin/tai_tin_nhan.php?maNguoiGui=' + currentUserId + '&maNguoiNhan=' + adminId)
    .then(res => res.json())
    .then(data => {
      const isNearBottom = messagesDiv.scrollHeight - messagesDiv.scrollTop - messagesDiv.clientHeight < 100;
      messagesDiv.innerHTML = '';
      let lastDateLabel = '';

      data.forEach((msg, index) => {
        const isAdmin = msg.maNguoiGui == adminId;
        const formatted = formatDateTime(msg.ngayGui, msg.thoiGianGui);

        if (formatted.fullDate !== lastDateLabel) {
          const dateLabel = document.createElement('div');
          dateLabel.style.textAlign = 'center';
          dateLabel.style.margin = '10px 0';
          dateLabel.style.color = '#666';
          dateLabel.innerText = formatted.fullDate;
          messagesDiv.appendChild(dateLabel);
          lastDateLabel = formatted.fullDate;
        }

        const div = document.createElement('div');
        div.className = 'message ' + (isAdmin ? 'chat-right' : 'chat-left');
        div.innerHTML = `<b>${isAdmin ? 'Bạn' : 'KH'} [${formatted.time}]</b><br>${msg.noiDung}`;
        messagesDiv.appendChild(div);
      });

      if (isNearBottom) {
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
      }
    });
}

  function loadMessages(userId) {
    currentUserId = userId;
    messagesDiv.innerHTML = '';
    fetchMessages();

    clearInterval(refreshInterval);
    refreshInterval = setInterval(fetchMessages, 2000);
  }

  function sendMessage() {
    const text = input.value.trim();
    if (!text || !currentUserId) return;

    fetch('page/admin/chatboxAdmin/luu_tin_nhan.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `maNguoiGui=${adminId}&maNguoiNhan=${currentUserId}&noiDung=${encodeURIComponent(text)}`
    })
    .then(res => res.text())
    .then(time => {
      if (time !== 'fail') {
        fetchMessages();
        input.value = ''; // Xóa nội dung sau khi gửi
      }
    });
  }

  input.addEventListener('keypress', e => {
    if (e.key === 'Enter') sendMessage();
  });

  fetch('page/admin/chatboxAdmin/list_KhachHang.php')
    .then(res => res.json())
    .then(data => {
      const userList = document.getElementById('userList');
      data.forEach(user => {
        const div = document.createElement('div');
        div.className = 'user';
        div.onclick = () => loadMessages(user.maNguoiDung);
        div.innerHTML = `
          <div class="avatar">${user.ten.charAt(0).toUpperCase()}</div>
          <div class="username">${user.ten}</div>
        `;
        userList.appendChild(div);
      });
    });

  function formatDateTime(ngay, gio) {
    const weekdays = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];
    const dateObj = new Date(`${ngay}T${gio}`);
    const day = weekdays[dateObj.getDay()];

    const formattedDate = dateObj.toLocaleDateString('vi-VN', {
      day: '2-digit',
      month: '2-digit',
      year: 'numeric'
    });

    const formattedTime = dateObj.toLocaleTimeString('vi-VN', {
      hour: '2-digit',
      minute: '2-digit',
      hour12: false
    });

    return {
      fullDate: `${day} ${formattedDate}`,
      time: formattedTime
    };
  }
  function fetchUserList() {
  fetch('page/admin/chatboxAdmin/list_KhachHang.php')
    .then(res => res.json())
    .then(data => {
      const userList = document.getElementById('userList');
      userList.innerHTML = ''; // Xóa danh sách cũ trước khi cập nhật

      data.forEach(user => {
        const div = document.createElement('div');
        div.className = 'user';
        div.onclick = () => loadMessages(user.maNguoiDung);
        div.innerHTML = `
          <div class="avatar">${user.ten.charAt(0).toUpperCase()}</div>
          <div class="username" style="flex: 1; position: relative;">
            ${user.ten}
            ${user.chuaDoc > 0 ? `<span class="badge">${user.chuaDoc}</span>` : ''}
          </div>
        `;
        userList.appendChild(div);
      });
    });
}
fetchUserList(); // gọi ban đầu
setInterval(fetchUserList, 2000); // cập nhật mỗi 2 giây
</script>

</body>
</html>