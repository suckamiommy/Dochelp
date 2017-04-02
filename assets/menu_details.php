<ul class="cd-projects">
  <li>
    <div class="preview-image">
      <div class="cd-project-title">
        <h2>Register</h2>
        <p>สมัครสมาชิกสำหรับผู้ใชทั่วไป</p>
      </div>
    </div>

    <div class="cd-project-info">
      <p>
        การสมัครสมาชิกสำหรับบุคคลทั่วไปที่ต้องการเข้ามาสอบถามปัญหาโรคที่ตนเองพบอยู่และต้องการคำแนะนำจากแพทย์
      </p>
      <!-- form -->
      <?php require("assets/Form_User.php"); ?>
      <!-- form -->
    </div> <!-- .cd-project-info -->
  </li>

  <li>
    <div class="preview-image">
      <div class="cd-project-title">
        <h2>Register for Doctor</h2>
        <p>สมัครสมาชิกสำหรับแพทย์</p>
      </div>
    </div>

    <div class="cd-project-info">
      <p>
        การสมัครสมาชิกสำหรับแพทย์ที่ยอมรับและต้องการให้คำปรึกษาแก่คนไข้ที่จะปรึกษาปัญหาโรคที่เป็นอยู่
      </p>
      <!-- form -->
      <?php require("assets/Form_Doctor.php"); ?>
      <!-- form -->
    </div> <!-- .cd-project-info -->
  </li>

  <li>
    <div class="preview-image">
      <div class="cd-project-title">
        <h2>Posts</h2>
        <p>ตั้งกระทู้สอบถามปัญหา</p>
      </div>
    </div>

    <div class="cd-project-info">
      <center>
        <button type="button" name="button" class="button" id="btn_user" style="vertical-align:middle"><span>ผู้ป่วย </span></button>
        <button type="button" name="button" class="button" id="btn_doc" style="vertical-align:middle"><span>แพทย์ </span></button>
      </center>
      <!-- form -->
      <?php require("assets/Form_login.php"); ?>
      <!-- form -->
    </div> <!-- .cd-project-info -->
  </li>

  <li>
    <div class="preview-image">
      <div class="cd-project-title">
        <h2>Admin</h2>
        <p>Admin เข้าสู่ระบบ</p>
      </div>
    </div>

    <div class="cd-project-info">
      <!-- form -->
      <?php require("assets/Form_admin.php"); ?>
      <!-- form -->
    </div> <!-- .cd-project-info -->
  </li>
</ul> <!-- .cd-projects -->
