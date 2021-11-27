<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <i class="ti-file"></i> <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
					<tr>
						<td>Nama</td>
						<td><?=$nama?></td>
					</tr>

					<tr>
						<td>No Telepohone</td>
						<td><?=$no_telepohone?></td>
					</tr>

					<tr>
						<td>Alamat</td>
						<td><?=$alamat?></td>
					</tr>

					<tr>
						<td>Jk</td>
						<td><?=$jk?></td>
					</tr>

					<tr>
						<td>Foto</td>
						<td><?=$Foto?></td>
					</tr>

        </table>

        <a href="<?=site_url("backend/".$this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
