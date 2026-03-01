<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <style>
    /* Nút tròn mở chat */
    #chatToggle {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 60px;
      height: 60px;
      background-color: #f7444e;
      border-radius: 50%;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 28px;
      cursor: pointer;
      z-index: 10000;
    }

    /* Hộp chat */
    #chatbox {
      position: fixed;
      bottom: 90px;
      right: 20px;
      width: 300px;
      height: 400px;
      background-color: white;
      border: 1px solid #ccc;
      border-radius: 10px;
      overflow: hidden;
      display: none;
      flex-direction: column;
      z-index: 9999;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      transition: all 0.3s ease;
    }

    #chatHeader {
      background-color: #f7444e;
      color: white;
      padding: 10px;
      text-align: center;
      font-weight: bold;
    }

    #chatMessages {
      flex: 1;
      padding: 10px;
      overflow-y: auto;
      font-size: 14px;
    }

    #chatInput {
      border: none;
      border-top: 1px solid #ccc;
      padding: 10px;
      font-size: 14px;
      outline: none;
      width: 100%;
      box-sizing: border-box;
    }
    .chat-message {
      max-width: 80%;
      margin: 5px 0;
      padding: 8px 12px;
      border-radius: 15px;
      clear: both;
      word-wrap: break-word;
    }

    .chat-left {
      background-color: #f1f1f1;
      float: left;
      text-align: left;
    }

    .chat-right {
      background-color: #dcf8c6;
      float: right;
      text-align: right;
    }
    .chat-date-divider {
      text-align: center;
      margin: 10px 0;
      font-weight: bold;
      color: #666;
    }
  </style>
</head>
<body>

  <!-- Biểu tượng tròn mở chat -->
  <div id="chatToggle">💬
  <span id="unreadBadge" style="
    position: absolute;
    top: 5px;
    right: 5px;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
    display: none;
  "></span>
  </div>

  <!-- Khung chat -->
  <div id="chatbox">
    <div id="chatHeader">Chat hỗ trợ</div>
    <div id="chatMessages"></div>
    <input type="text" id="chatInput" placeholder="Nhập tin nhắn..." />
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  const toggle = document.getElementById('chatToggle');
  const chatbox = document.getElementById('chatbox');
  const input = document.getElementById('chatInput');
  const messages = document.getElementById('chatMessages');

  const maNguoiGui = <?php echo $_SESSION['maNguoiDung']; ?>;  // Giả sử đây là maNguoiDung của người đang gửi (ví dụ khách hàng hoặc nhân viên)
   const maNguoiNhan = 2; // Giả sử đây là maNguoiDung của người nhận (ví dụ admin)
   let refreshInterval; // Dùng để clear interval cũ
   setInterval(checkUnreadMessages, 1000); // kiểm tra mỗi 2 giây
   
   toggle.addEventListener('click', function () {
  const isHidden = chatbox.style.display === 'none' || chatbox.style.display === '';
  chatbox.style.display = isHidden ? 'flex' : 'none';

  // Nếu vừa mở hộp chat, tải lại tin nhắn
  if (isHidden) {
    loadMessages(); // gọi ngay khi mở chat

    clearInterval(refreshInterval); // dọn interval cũ (nếu có)
    refreshInterval = setInterval(loadMessages, 2000); // cập nhật mỗi 2 giây
    // Cập nhật tin nhắn đã xem sau khi mở chat
    $.post('page/chatbox/upload_daXem.php', {
      maNguoiGui: maNguoiNhan, // người gửi là admin
      maNguoiNhan: maNguoiGui  // người nhận là người dùng
    });
  } else {
    clearInterval(refreshInterval); // dừng cập nhật khi đóng chat
  }
});

   input.addEventListener('keypress', function (e) {
   if (e.key === 'Enter') {
      const text = input.value.trim();
      if (text) {
         input.value = '';
         messages.scrollTop = messages.scrollHeight;

         $.ajax({
            url: 'page/chatbox/luu_tin_nhan.php',
         method: 'POST',
         data: {
            maNguoiGui: maNguoiGui,
            maNguoiNhan: maNguoiNhan,
            noiDung: text
         },
         success: function (response) {
          if (response.trim() !== 'fail') {
            const timeSent = response.trim();
            messages.innerHTML += `<div class="chat-message chat-right"><b>Bạn [${timeSent}]:</b> ${text}</div>`;
            messages.scrollTop = messages.scrollHeight;
          } else {
            messages.innerHTML += `<div><i>Lỗi gửi tin nhắn.</i></div>`;
          }
        },
         error: function () {
            messages.innerHTML += `<div><i>Lỗi kết nối server.</i></div>`;
         }
         });
      }
   }
   });

   function loadMessages() {
    $.ajax({
      url: 'page/chatbox/tai_tin_nhan.php',
      method: 'GET',
      data: {
        maNguoiGui: maNguoiGui,
        maNguoiNhan: maNguoiNhan
      },
      success: function (response) {
        // Thêm dòng này để kiểm tra vị trí cuộn trước khi làm rỗng
        const isAtBottom = messages.scrollTop + messages.clientHeight >= messages.scrollHeight - 20;
        messages.innerHTML = '';
        const data = JSON.parse(response);
        let lastDate = '';

      data.forEach(msg => {
        const currentDate = msg.ngayGui;
        const isSender = msg.maNguoiGui == maNguoiGui;
        const label = isSender ? "Bạn" : "Hỗ trợ";
        const sideClass = isSender ? "chat-right" : "chat-left";

        // Hiển thị ngày nếu khác ngày trước đó
        if (currentDate !== lastDate) {
          const formattedDate = currentDate.split('-').reverse().join('/');
          messages.innerHTML += `<div class="chat-date-divider">—— ${formattedDate} ——</div>`;
          lastDate = currentDate;
        }

        messages.innerHTML += `<div class="chat-message ${sideClass}"><b>${label} [${msg.thoiGianGui}]:</b> ${msg.noiDung}</div>`;
      });
      if (isAtBottom) {
        messages.scrollTop = messages.scrollHeight;
      }
      },
      error: function () {
        messages.innerHTML = '<div><i>Lỗi tải tin nhắn.</i></div>';
      }
    });
  }
  // check tin chưa đọc
  function checkUnreadMessages() {
  $.ajax({
    url: 'page/chatbox/demTinChuaDoc.php',
    method: 'GET',
    data: {
      maNguoiGui: maNguoiNhan, // Người gửi là admin
      maNguoiNhan: maNguoiGui  // Người nhận là người dùng hiện tại
    },
    success: function (response) {
      const data = JSON.parse(response);
      const badge = document.getElementById('unreadBadge');
      if (data.unread > 0 && chatbox.offsetParent === null) {
        badge.style.display = 'inline';
        badge.textContent = data.unread > 9 ? '9+' : data.unread;
      } else {
        badge.style.display = 'none';
      }
    }
  });
}
</script>
</body>
</html>