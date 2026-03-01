document.querySelector("form").addEventListener("submit", function (e) {
  // Lấy giá trị từ các input
  const hoTen = document.getElementById("hoTen").value.trim();
  const email = document.getElementById("email").value.trim();
  const sdt = document.getElementById("sdt").value.trim();
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirmPassword").value;

  // Biểu thức chính quy
  const hoTenRegex =
    /^[AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ]+(\s+[AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ]+)*$/i;
  /*
    Regex Họ tên (hoTenRegex):
    Chỉ cho phép chữ cái tiếng Việt (bao gồm cả chữ hoa, chữ thường và có dấu)
    Cho phép nhiều từ (họ và tên)
    Không cho phép số và ký tự đặc biệt
    Từng từ phải bắt đầu bằng chữ hoa
     */
  const emailRegex = /^[a-zA-Z0-9._%+-]+@(gmail\.com|outlook\.com|yahoo\.com)$/;
  /*
      Regex Email (emailRegex):
      Cho phép ký tự chữ, số và một số ký tự đặc biệt trước @
      Hỗ trợ các domain phổ biến: gmail.com, outlook.com, yahoo.com
      Ngăn chặn email không hợp lệ
  */
  const sdtRegex = /^(0[3|5|7|8|9])[0-9]{8}$/;
  /*
      Regex Số điện thoại (sdtRegex):
      Bắt buộc bắt đầu bằng 03, 05, 07, 08 hoặc 09
      Sau đó là 8 chữ số
      Tổng cộng 10 chữ số
  */
  const passwordRegex =
    /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/;
  /* 
    Regex Mật khẩu (passwordRegex):
    Ít nhất 8 ký tự
    Bắt buộc có:
      Ít nhất 1 chữ hoa
      Ít nhất 1 chữ thường
      Ít nhất 1 chữ số
      Ít nhất 1 ký tự đặc biệt
    */

  // Kiểm tra từng trường
  if (!hoTenRegex.test(hoTen)) {
    alert(
      "Họ và tên không hợp lệ. Vui lòng nhập tên bằng chữ cái, có thể có dấu, không chứa số."
    );
    e.preventDefault();
    return;
  }

  if (!emailRegex.test(email)) {
    alert(
      "Email không hợp lệ. Vui lòng nhập email đúng định dạng (Gmail, Outlook, Yahoo) vd: abc123@gmail.com."
    );
    e.preventDefault();
    return;
  }

  if (!sdtRegex.test(sdt)) {
    alert(
      "Số điện thoại không hợp lệ. Vui lòng nhập đúng định dạng 10 số bắt đầu bằng 03, 05, 07, 08, hoặc 09."
    );
    e.preventDefault();
    return;
  }

  if (!passwordRegex.test(password)) {
    alert(
      "Mật khẩu không hợp lệ. Phải có ít nhất 8 ký tự, gồm 1 chữ hoa, 1 chữ thường, 1 số và 1 ký tự đặc biệt."
    );
    e.preventDefault();
    return;
  }
});
