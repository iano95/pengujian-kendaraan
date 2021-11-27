<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card">
      <div class="card-header bg-primary text-white">
        <i class="ti-pencil-alt"></i> <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <form id="form" action="<?=$action?>" autocomplete="off">
					<div class="form-group">
					<label>Nama</label>
						<input type="text" class="form-control form-control-sm" name="nama" id="nama" value="<?=$nama?>" />
					</div>

					<div class="form-group">
					<label>No Telepohone</label>
						<input type="text" class="form-control form-control-sm" name="no_telepohone" id="no_telepohone" value="<?=$no_telepohone?>" />
					</div>

					<div class="form-group">
					<label>Alamat</label>
						<textarea class="form-control" rows="3" name="alamat" id="alamat"><?=$alamat?></textarea>
					</div>

					<div class="form-group">
					<label>Jk</label>
          <select class="form-control form-control-sm" name="jk" id="jk">
            <option value="<?=$jk?>"><?=$jk?></option>    
            <option value="1">Pria</option>    
            <option value="2">Wanita</option>    
          </select>
					
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
