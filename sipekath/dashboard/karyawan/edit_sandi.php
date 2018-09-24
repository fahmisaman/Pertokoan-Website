<?php

  setHeader("Ganti Sandi","fa fa-lock");
  // include '../functions/generate.php';

?>
<script type="text/javascript">
  $(document).ready(function(){

  });


  function cek_sandi(){
    var username = $("#username_ku").val();
    var sandi_lama = $("#sandi_lama").val();
    // alert(username);
    $.ajax({
      url:"<?php echo $proses; ?>",
      data:"op=cek_sandi&sandi_lama="+sandi_lama+"&username="+username,
      success:function(data){
        // alert(data);
        $("#label_sandilama").attr('class',data);
      }
    })
  }

  function cek_sandibaru(){
    var sandi_baru = $("#sandi_baru").val();
    var konfirm_sandi = $("#konfirm_sandi").val();
    if (sandi_baru != konfirm_sandi) {
      $("#labelkonfirm").attr('class',"form-group has-error");
      $("#btn_ganti").attr("disabled","disabled");      
    }else{
      $("#labelkonfirm").attr('class',"form-group has-success");
      $("#btn_ganti").removeAttr("disabled");      
    }
  }

  function editpass(){  
    $.ajax({
      url:"<?php echo $proses; ?>",
      data:"op=editpass&"+$('form[name="form_editpass"]').serialize(),
      success:function(data){
        alert(data);
        // refresh();
        location.reload();
      }
    })
  }


</script>
<div class="well bs-component" id="ep">
  <form class="form-horizontal" method="POST" name="form_editpass" action="javascript:editpass();">
    <fieldset>
      <legend>
        <div style='background-color:#fe0000;color:white;' class="alert alert-dismissible">
          <strong>Form Ganti Sandi</strong>
        </div>
      </legend>
      <div class="form-group" >
        <label class="col-lg-2 control-label" for="inputDefault">Nama Pengguna</label>
        <div class="col-lg-10">
          <input class="form-control" id="username_ku" name="username_ku" type="text" value="<?php echo $_SESSION['username']; ?>" readonly>
        </div>
      </div>
      <div class="form-group" id="label_sandilama">
        <label class="col-lg-2 control-label" for="inputDefault">Sandi Lama</label>
        <div class="col-lg-10">
          <input class="form-control" id="sandi_lama" type="password" name="sandi_lama" onkeyup="javascript:cek_sandi();" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-2 control-label" for="inputDefault">Sandi Baru</label>
        <div class="col-lg-10">
          <input class="form-control" id="sandi_baru" type="password" name="sandi_baru" onkeyup="javascript:cek_sandibaru();" required>
        </div>
      </div>
      <div class="form-group" id="labelkonfirm">
        <label class="col-lg-2 control-label" for="inputDefault">Konfirmasi Sandi Baru</label>
        <div class="col-lg-10">
          <input class="form-control" id="konfirm_sandi" type="password" name="konfirm_sandi" onkeyup="javascript:cek_sandibaru();" required>
        </div>
      </div>
      
      <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
          <input type="reset" class="btn btn-default" value="Batal">
          <input type="submit" class="btn btn-primary" id="btn_ganti" value="Ganti">
        </div>
      </div>
    </fieldset>
  </form>
</div>

