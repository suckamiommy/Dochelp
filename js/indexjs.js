jQuery(document).ready(function($){
  $('#form_user').submit(function(){
    var pass1 = $('input[name="Password"]').val();
    var pass2 = $('input[name="CPassword"]').val();
    if(pass1==pass2){
      return true;
    }else{
      swal("Error", "Password invalid", "error");
      return false;
    }
  });

  $('#form_doctor').submit(function(){
    var pass1 = $('input[name="Password_doc"]').val();
    var pass2 = $('input[name="CPassword_doc"]').val();
    if(pass1==pass2){
      return true;
    }else{
      swal("Error", "Password invalid", "error");
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
})(jQuery);
