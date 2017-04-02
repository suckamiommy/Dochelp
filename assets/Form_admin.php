<form id="form_login" action="admin/CheckLogin.php" method="post">
<h1 style="text-align: center;">Admin เข้าสู่ระบบ</h1>

  <div class="contentform">
    <div id="sendmessage">ขอบคุณที่ใช้บริการเว็บไซต์</div>

      <div class="form-group">
        <p id="text">ID <span>*</span></p>
        <span class="icon-case"><i class="fa fa-male"></i></span>
        <input type="text" name="login_admin" required="required">
        <div class="validation"></div>
      </div>

      <div class="form-group">
        <p>Password <span>*</span></p>
        <span class="icon-case"><i class="fa fa-user"></i></span>
        <input type="password" name="login_password_admin" required="required">
        <div class="validation"></div>
      </div>

    </div>
  <button type="submit" class="bouton-contact">Send</button>
</form>
