<form autocomplete="off">
  <div class="row">
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="no_pendaftaran" placeholder="No Pendaftaran" />
		</div>
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="jenis_identitas" placeholder="Jenis Identitas" />
		</div>
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="id_identitas" placeholder="Id Identitas" />
		</div>
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="tgl_pendaftaran" placeholder="Tgl Pendaftaran" />
		</div>
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="nama_pemilik" placeholder="Nama Pemilik" />
		</div>
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="alamat_pemilik" placeholder="Alamat Pemilik" />
		</div>
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="jenis_kelamin" placeholder="Jenis Kelamin" />
		</div>
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="pekerjaan" placeholder="Pekerjaan" />
		</div>
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="username" placeholder="Username" />
		</div>
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="email" placeholder="Email" />
		</div>

    <div class="col-sm-12 mt-2">
      <button type='button' class='btn btn-default btn-sm' data-dismiss='modal'><?=cclang("cancel")?></button>
      <button type="button" class="btn btn-primary btn-sm" id="filter">Filter</button>
    </div>
  </div>
</form>

<script type="text/javascript">
$("#filter").click(function(){
  $('#modalGue').modal('hide');
  $("#table").DataTable().ajax.reload();  //just reload table
});
</script>
