<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card">
      <div class="card-header bg-primary text-white">
        <i class="ti-pencil-alt"></i> <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <form id="form" action="<?=$action?>" autocomplete="off">
					<div class="form-group">
					<label>No Pendaftaran</label>
					<select name="no_pendaftaran" id="no_pendaftaran" class="form-control form-control-sm">
						<option selected disabled="">--Pilih No Pendaftaran--</option>
							<?php if ($no_pendaftaran) :?>
								<option selected value="<?=$no_pendaftaran?>"><?=$no_pendaftaran?></option>
							<?php endif;?>
							<?php foreach ($pemohon as $key) :?>
								<option value="<?=$key->no_pendaftaran?>" 
									<?=($no_pendaftaran==$key->no_pendaftaran) ?'selected':''; ?> ><?=$key->no_pendaftaran?> <?=$key->nama_pemilik?></option>
							<?php endforeach;?>
						</select>
						<!-- <input type="text" class="form-control form-control-sm" name="no_pendaftaran" id="no_pendaftaran" value="<?=$no_pendaftaran?>" /> -->
					</div>

					<div class="form-group">
					<label>No Mesin</label>
						<input type="text" class="form-control form-control-sm" name="no_mesin" id="no_mesin" value="<?=$no_mesin?>" />
					</div>

					<div class="form-group">
					<label>No Rangka</label>
						<input type="text" class="form-control form-control-sm" name="no_rangka" id="no_rangka" value="<?=$no_rangka?>" />
					</div>

					<div class="form-group">
					<label>Mrk Kendaraan</label>
						<input type="text" class="form-control form-control-sm" name="mrk_kendaraan" id="mrk_kendaraan" value="<?=$mrk_kendaraan?>" />
					</div>

					<div class="form-group">
					<label>Thn Kendaraan</label>
						<input type="text" class="form-control form-control-sm" name="thn_kendaraan" id="thn_kendaraan" value="<?=$thn_kendaraan?>" />
					</div>

					<div class="form-group">
					<label>Jenis Kendaraan</label>
						<select class="form-control form-control-sm" name="jenis" id="jenis">
							<option selected disabled="">--Pilih Jenis Kendaraan--</option>
						
							<?php foreach ($jenism as $key) :?>
								<option value="<?=$key->id_jenis?>" 
									<?=($jenis==$key->id_jenis) ?'selected':''; ?>>
									<?=$key->jenis_mobil?> - <?=$key->sub_jenis?> (<?=$key->sifat?>)  
										
								</option>
							<?php endforeach;?>

						</select>
					</div>

					<div class="form-group">
					<label>Berat Jbkb (kg)</label>
						<input type="text" class="form-control form-control-sm" name="berat_jbkb" id="berat_jbkb" value="<?=$berat_jbkb?>" />
					</div>

					<div class="form-group">
					<label>Berta Kosong (kg)</label>
						<input type="text" class="form-control form-control-sm" name="berta_kosong" id="berta_kosong" value="<?=$berta_kosong?>" />
					</div>

					<div class="form-group">
					<label>Daya Barang (kg)</label>
						<input type="text" class="form-control form-control-sm" name="daya_barang" id="daya_barang" value="<?=$daya_barang?>" />
					</div>

					<div class="form-group">
					<label>Daya Orang</label>
						<input type="text" class="form-control form-control-sm" name="daya_orang" id="daya_orang" value="<?=$daya_orang?>" />
					</div>

					<div class="form-group">
					<label>Masa Berlaku</label>
						<input type="date" class="form-control form-control-sm" name="masa_berlaku" id="masa_berlaku" value="<?=$masa_berlaku?>" />
					</div>


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
