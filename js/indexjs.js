jQuery(document).ready(function($){
  var register;
  var send;
  var loginstatus = 1;
  $('#form_user').submit(function(){
    var pass1 = $('input[name="Password"]').val();
    var pass2 = $('input[name="CPassword"]').val();
    if(pass1==pass2){
      register = [{
        "ID_user" : $('input[name="ID"]').val(),
        "Password" : $('input[name="Password"]').val(),
        "Username" : $('input[name="Name"]').val(),
        "Name" : $('input[name="Name"]').val(),
        "Lastname" : $('input[name="Lastname"]').val(),
        "Birthday" : $('input[name="Birthday"]').val(),
        "Phone_number" : $('input[name="phone"]').val(),
        "Email" : $('input[name="Email"]').val(),
        "Condi" : $('input[name="condi"]').val(),
        "Decondi" : $('#Decondi').val()
      }];
      send = JSON.stringify(register);
      $.ajax({
        type : 'POST',
        url : 'assets/Insert_user.php',
        data : {send:send},
        success : function(result){
          var status = result;
          if(status==1){
            swal("Good job!", "ทำการสมัครเข้าใช้งานเว็บไซต์เสร็จสิ้น", "success");
            $('input').val("");
            $('#Decondi').val("")
          }else if(status==2){
            swal("Error", "ไม่สามารถสมัครสมาชิกได้ อาจมีข้อมูลผิดพลาด", "error");
          }else{
            swal("Error", "ไม่สามารถสมัครสมาชิกได้ เนื่องจาก ID นี้มีอยู่แล้ว", "error");
          }
        }
      });
      return false;
    }else{
      swal("Error", "Password ที่กรอกไม่ตรงกัน", "error");
      return false;
    }
  });

  $('#form_doctor').submit(function(){
    var pass1 = $('input[name="Password_doc"]').val();
    var pass2 = $('input[name="CPassword_doc"]').val();
    if(pass1==pass2){
      register = [{
        "ID_doctor" : $('input[name="ID_doc"]').val(),
        "Password" : $('input[name="Password_doc"]').val(),
        "Username" : $('input[name="Name_doc"]').val(),
        "Name" : $('input[name="Name_doc"]').val(),
        "Lastname" : $('input[name="Lastname_doc"]').val(),
        "Birthday" : $('input[name="Birthday_doc"]').val(),
        "Phone_number" : $('input[name="phone_doc"]').val(),
        "Email" : $('input[name="Email_doc"]').val(),
        "Province" : $('select[name="province"]').val(),
        "Hospital" : $('select[name="hospital"]').val()
      }];
      send = JSON.stringify(register);
      $.ajax({
        type : 'POST',
        url : 'assets/Insert_doctor.php',
        data : {send:send},
        success : function(result){
          var status = result;
          if(status==1){
            swal("Good job!", "ทำการสมัครเข้าใช้งานเว็บไซต์เสร็จสิ้น", "success");
            $('input').val("");
            $('select').val("");
          }else if(status==2){
            swal("Error", "ไม่สามารถสมัครสมาชิกได้ อาจมีข้อมูลผิดพลาด", "error");
          }else{
            swal("Error", "ไม่สามารถสมัครสมาชิกได้ เนื่องจาก ID นี้มีอยู่แล้ว", "error");
          }
        }
      });
      return false;
    }else{
      swal("Error", "Password ที่กรอกไม่ตรงกัน", "error");
      return false;
    }
  });

  $('select[name="province"]').change(function(){
    var id_province = $(this).val();
    $.ajax({
      type: 'POST',
      url: 'assets/Select_hospital.php',
      data : {id:id_province},
      success : function(result){
        $('select[name="hospital"]').html(result);
      }
    });
  });

  $('#btn_user').click(function(){
    loginstatus = 1;
    $('#text').html("User ID <span>*</span>");
    $('input[name="login"]').val("");
    $('input[name="login_password"]').val("");
  });

  $('#btn_doc').click(function(){
    loginstatus = 2;
    $('#text').html("Doctor ID <span>*</span>");
    $('input[name="login"]').val("");
    $('input[name="login_password"]').val("");
  });

  $('#form_login').submit(function(){
    var id = $('input[name="login"]').val();
    var pass = $('input[name="login_password"]').val();

    $.ajax({
      type : 'POST',
      url : 'assets/Checklogin.php',
      data : {loginstatus:loginstatus,id:id,pass:pass},
      success : function(result){
        var login = result;
        if(login==1){
          window.location.assign('webboard.php');
        }else if(login==2){
          window.location.assign('webboard_doctor.php');
        }else{
          swal("Error", "ID หรือ Password ผิดพลาด", "error");
          console.log(id,pass);
          console.log(result);
        }
      }
    });
    return false;
  });
});
