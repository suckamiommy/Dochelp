<form id="form_doctor">
  <h1 style="text-align: center;">สมัครสมาชิกเพื่อเข้าใช้งานเว็บไซต์</h1>

  <div class="contentform">
    <div id="sendmessage">ขอบคุณที่ใช้บริการเว็บไซต์</div>

      <div class="form-group">
        <p>ID <span>*</span></p>
        <span class="icon-case"><i class="fa fa-male"></i></span>
        <input type="text" name="ID_doc" id="ID_doc" required="required">
        <div class="validation"></div>
      </div>

      <div class="form-group">
        <p>Password <span>*</span></p>
        <span class="icon-case"><i class="fa fa-user"></i></span>
        <input type="password" name="Password_doc" id="Password_doc" required="required">
        <div class="validation"></div>
      </div>

      <div class="form-group">
        <p>Confirm Password <span>*</span></p>
        <span class="icon-case"><i class="fa fa-envelope-o"></i></span>
        <input type="password" name="CPassword_doc" id="CPassword_doc" required="required">
        <div class="validation"></div>
      </div>

      <hr>

      <div class="form-group">
        <p>Name <span>*</span></p>
        <span class="icon-case"><i class="fa fa-home"></i></span>
        <input type="text" name="Name_doc" id="Name_doc" required="required">
        <div class="validation"></div>
      </div>

      <div class="form-group">
        <p>Lastname <span>*</span></p>
        <span class="icon-case"><i class="fa fa-location-arrow"></i></span>
        <input type="text" name="Lastname_doc" id="Lastname_doc" required="required">
        <div class="validation"></div>
      </div>

      <div class="form-group">
        <p>Birth day <span>*</span></p>
        <span class="icon-case"><i class="fa fa-map-marker"></i></span>
        <input type="date" name="Birthday_doc" id="Birthday_doc" required="required">
        <div class="validation"></div>
      </div>

      <div class="form-group">
        <p>Phone number <span>*</span></p>
        <span class="icon-case"><i class="fa fa-phone"></i></span>
        <input type="text" name="phone_doc" id="phone_doc" required="required" pattern="[0-9]{10,10}">
        <div class="validation"></div>
      </div>

      <div class="form-group">
        <p>Email <span>*</span></p>
        <span class="icon-case"><i class="fa fa-phone"></i></span>
        <input type="email" name="Email_doc" id="Email_doc" required="required">
        <div class="validation"></div>
      </div>

      <div class="form-group">
        <p>Province <span>*</span></p>
        <span class="icon-case"><i class="fa fa-info"></i></span>
        <select class="Province" name="province" required="required">
          <option value="">กรุณาเลือกจังหวัด</option>
          <?php
          require("connectdb.php");
          $sql = "SELECT * FROM province";
          $result = $conn->query($sql);
          if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
              echo "<option value='".$row['province_id']."'>".$row['province_name']."</option>";
            }
          }else{
            echo "result 0 row";
          }
          $conn->close();
          ?>
        </select>
        <div class="validation"></div>
      </div>

      <div class="form-group">
        <p>Hospital <span>*</span></p>
        <span class="icon-case"><i class="fa fa-info"></i></span>
        <select class="Hospital" name="hospital" required="required">
        </select>
        <div class="validation"></div>
      </div>
    </div>
  <button type="submit" class="bouton-contact">Send</button>
</form>
