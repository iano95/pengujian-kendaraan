<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Registrasi Pemohon</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/css/style.css">
  <link rel="shortcut icon" href="<?=base_url()?>_temp/backend/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid ">

      <div class="row">
        <div class="col-md-12 col-xl-8 my-5 mx-auto animated fadeIn delay-2s">
          <div class="card">
            <div class="card-header">
              <i class="ti-pencil-alt"></i> Registrasi Pemohon
            </div>
            <div class="card-body">
              <form id="form" action="<?=site_url("backend/register/action")?>" autocomplete="off">
              

                <div class="form-group">
                <label>Jenis Identitas</label>
                  <select name="jenis_identitas" id="jenis_identitas" class="form-control form-control-sm">
                    <option selcted disabled>--Pilih Jenis Identitas--</option>
                    <?php if ($jenis_identitas) :?>
                      <option selcted value="<?=$jenis_identitas?>"><?=$jenis_identitas?></option>
                    <?php endif?>
                    <option value="KTP">KTP</option>
                    <option value="SIM">SIM</option>
                  </select>
                </div>

                <div class="form-group">
                <label>Id Identitas</label>
                  <input type="text" class="form-control form-control-sm" name="id_identitas" id="id_identitas" value="<?=$id_identitas?>" />
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
                  <select class="form-control form-control-sm" name="jenis_kelamin" id="jenis_kelamin">
                      <option value="Pria">Pria</option>
                      <option value="Wanita">Wanita</option>
                  </select>
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

                <div class="form-group">
                <label>Password</label>
                  <input type="password" class="form-control form-control-sm" name="password" id="password" value="<?=$password?>" />
                </div>


              <div class="mt-4">
                <a href="<?=site_url("backend/login")?>" class="btn btn-sm btn-danger">Batal</a>
                <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary">Daftar</button>
              </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- container-scroller -->
  <script src="<?=base_url()?>_temp/backend/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?=base_url()?>_temp/backend/js/off-canvas.js"></script>
  <script src="<?=base_url()?>_temp/backend/js/hoverable-collapse.js"></script>
  <script src="<?=base_url()?>_temp/backend/js/template.js"></script>
  <script src="<?=base_url()?>_temp/backend/js/settings.js"></script>
  <script src="<?=base_url()?>_temp/backend/js/todolist.js"></script>
  <script src="<?=base_url()?>_temp/backend/vendors/sweetalert/sweetalert.min.js"></script>



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
                      .html('Simpan');
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
</body>
</html>
