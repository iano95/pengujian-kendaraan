<form autocomplete="off">
  <div class="row">
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="jenis_mobil" placeholder="Jenis Mobil" />
		</div>
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="sub_jenis" placeholder="Sub Jenis" />
		</div>
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="sifat" placeholder="Sifat" />
		</div>
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="biaya" placeholder="Biaya" />
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
