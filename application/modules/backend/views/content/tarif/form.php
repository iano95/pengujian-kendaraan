<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card">
      <div class="card-header bg-primary text-white">
        <i class="ti-pencil-alt"></i> <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <form id="form" action="<?=$action?>" autocomplete="off">
					<div class="form-group">
					<label>Jenis Mobil</label>
						<input type="text" class="form-control form-control-sm" name="jenis_mobil" id="jenis_mobil" value="<?=$jenis_mobil?>" />
					</div>

					<div class="form-group">
					<label>Sub Jenis</label>
						<input type="text" class="form-control form-control-sm" name="sub_jenis" id="sub_jenis" value="<?=$sub_jenis?>" />
					</div>

					<div class="form-group">
					<label>Sifat</label>
						<input type="text" class="form-control form-control-sm" name="sifat" id="sifat" value="<?=$sifat?>" />
					</div>

					<div class="form-group">
					<label>Biaya</label>
						<input type="number" class="form-control form-control-sm" name="biaya" id="biaya" value="<?=$biaya?>" />
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
