<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card">
      <div class="card-header bg-primary text-white">
        <i class="ti-pencil-alt"></i> <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <form id="form" action="<?=$action?>" autocomplete="off">
					<div class="form-group">
					<label>Tgl Pembayaran</label>
						<input type="datetime-local" class="form-control form-control-sm" name="tgl_pembayaran" id="tgl_pembayaran" value="<?=$tgl_pembayaran?>" />
					</div>

					<div class="form-group">
					<label>No Pendaftaran</label>
            <select class="form-control form-control-sm" name="no_pendaftaran" id="no_pendaftaran">
              <option selected disabled>pilih</option>
              <?php foreach ($pemohon as $key): ?>
                <option value="<?=$key->no_pendaftaran ?>" <?= ($no_pendaftaran == $key->no_pendaftaran) ? 'selected' : '' ; ?>><?=$key->no_pendaftaran ?> - <?=$key->nama_pemilik ?></option>
              <?php endforeach ?>
            </select>
					</div>

					<div class="form-group">
					<label>No Kendaraan</label>
            <select class="form-control form-control-sm" name="no_kendaraan" id="no_kendaraan">
            <option selected disabled>pilih no Pendaftaran dahulu</option> 
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
nopend = $('#no_pendaftaran').val();
seleted ='<?=$no_kendaraan ?>';

getOp()
$('#no_pendaftaran').change(function (e) {
  nopend=$('#no_pendaftaran').val();
  console.log(nopend);
  getOp();
});

function getOp() {
  if(nopend){
    $.ajax({
      url: '<?=base_url()?>backend/pembayaran/opKend',
      type: 'get',
      dataType:'html',
      data: {seleted:seleted,nopend:nopend},
      success: function (data) {
        $('#no_kendaraan').html(data);
        console.log(data);
      }
    });
  }
  
}

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
