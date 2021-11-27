<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card">
      <div class="card-header bg-primary text-white">
        <i class="ti-pencil-alt"></i> <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <form id="form" action="<?=$action?>" autocomplete="off">
					<div class="form-group">

					<div class="form-group">
					<label>Jenis Identitas</label>
						<input type="text" class="form-control form-control-sm" name="jenis_identitas" id="jenis_identitas" value="<?=$jenis_identitas?>" />
					</div>

					<div class="form-group">
					<label>Id Identitas</label>
						<input type="text" class="form-control form-control-sm" name="id_identitas" id="id_identitas" value="<?=$id_identitas?>" />
					</div>

					<div class="form-group">
					<label>Tgl Pendaftaran</label>
						<input type="date" class="form-control form-control-sm" name="tgl_pendaftaran" id="tgl_pendaftaran" value="<?=$tgl_pendaftaran?>" />
					</div>

					<div class="form-group">
					<label>Nama Pemilik</label>
						<input type="text" class="form-control form-control-sm" name="nama_pemilik" id="nama_pemilik" value="<?=$nama_pemilik?>" />
					</div>

					<div class="form-group">
					<label>Alamat Pemilik</label>
						<textarea class="form-control" rows="3" name="alamat_pemilik" id="alamat_pemilik"><?=$alamat_pemilik?></textarea>
					</div>

					<div class="form-group">
					<label>Jenis Kelamin</label>
						<input type="text" class="form-control form-control-sm" name="jenis_kelamin" id="jenis_kelamin" value="<?=$jenis_kelamin?>" />
					</div>

					<div class="form-group">
					<label>Pekerjaan</label>
						<input type="text" class="form-control form-control-sm" name="pekerjaan" id="pekerjaan" value="<?=$pekerjaan?>" />
					</div>

					<div class="form-group">
					<label>Username</label>
						<input type="text" class="form-control form-control-sm" name="username" id="username" value="<?=$username?>" />
					</div>

					<div class="form-group">
					<label>Email</label>
						<input type="text" class="form-control form-control-sm" name="email" id="email" value="<?=$email?>" />
					</div>

					<?php if (isset($add)) :?>
						<div class="form-group">
					<label>Password</label>
						<input type="text" class="form-control form-control-sm" name="password" id="password" value="<?=$password?>" />
					</div>
					<?php else :?>
						<div class="form-group d-none">
					<label>Password</label>
						<input type="hidden" class="form-control form-control-sm" name="password" id="password" value="<?=$password?>" />
					</div>
					<?php endif;?>

					


          <input type="hidden" name="params" value="<?=strtolower($params)?>">

        <div class="mt-4">
          <a href="<?=site_url("backend/".$this->uri->segment(2))?>" class="btn btn-sm btn-danger"><?=cclang("cancel")?></a>
          <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary"><?=cclang("save")?></button>
        </div>

        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
$("#form").submit(function(e){
e.preventDefault();
var me = $(this);
$("#submit").prop('disabled',true).html('Loading...');
$(".form-group").find('.text-danger').remove();
$.ajax({
      url             : me.attr('action'),
      type            : 'post',
      data            :  new FormData(this),
      contentType     : false,
      cache           : false,
      dataType        : 'JSON',
      processData     :false,
      success:function(json){
        if (json.success==true) {
          location.href = json.redirect;
          return;
        }else {
          $("#submit").prop('disabled',false)
                      .html('<?=cclang("save")?>');
          $.each(json.alert, function(key, value) {
            var element = $('#' + key);
            $(element)
            .closest('.form-group')
            .find('.text-danger').remove();
            $(element).after(value);
          });
        }
      }
    });
});
</script>
