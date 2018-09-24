<?php 
	function login_modal(){
?>
<!-- Login Modal -->

<!-- Modal -->
<div class="modal fade" id="mycity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-lock"></span> Login</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="javascript:login();" name="form_login" method="POST">
        <div class="form-group">
          <label for="inputUsername" class="col-lg-2 control-label">Username</label>
          <div class="col-lg-10">
            <input class="form-control" name="username" id="inputUsername" placeholder="Username" type="text">
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword" class="col-lg-2 control-label">Password</label>
          <div class="col-lg-10">
          <input class="form-control" name="password" id="inputPassword" placeholder="Password" type="password">
          </div>
        </div>

        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button type="reset" class="btn btn-primary">Batal</button>
            <input type="submit" value="Masuk" class="btn btn-primary">
          </div>
        </div>
    </form>
      </div> 
    </div>
  </div>
</div>

<!-- Login Modal -->

<?php } ?>

<?php 
	function edit_nip_modal(){
?>
<!-- Modal ganti NIP-->
<div class="modal fade" id="edit_nip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-pencil-square-o"></span> Edit NIP</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="javascript:en();" name="form_en" method="POST">
        <div class="form-group">
          <label for="inputUsername" class="col-lg-2 control-label">NIP Lama</label>
          <div class="col-lg-10">
            <input class="form-control" name="nl" id="nl" type="text" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword" class="col-lg-2 control-label">NIP Baru</label>
          <div class="col-lg-10">
          <input class="form-control" name="nb" id="nb" type="text" placeholder="Masukkan NIP Baru">
          </div>
        </div>

        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button type="reset" class="btn btn-default">Batal</button>
            <button type="submit" class="btn btn-primary" id="button_login">Perbarui</button>
          </div>
        </div>
    </form>
      </div>
    </div>
  </div>
</div>

<!-- NIP Modal -->


<?php } ?>