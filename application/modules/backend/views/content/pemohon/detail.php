<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <i class="ti-file"></i> <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
					<tr>
						<td>No Pendaftaran</td>
						<td><?=$no_pendaftaran?></td>
					</tr>

					<tr>
						<td>Jenis Identitas</td>
						<td><?=$jenis_identitas?></td>
					</tr>

					<tr>
						<td>Id Identitas</td>
						<td><?=$id_identitas?></td>
					</tr>

					<tr>
						<td>Tgl Pendaftaran</td>
						<td><?=$tgl_pendaftaran?></td>
					</tr>

					<tr>
						<td>Nama Pemilik</td>
						<td><?=$nama_pemilik?></td>
					</tr>

					<tr>
						<td>Alamat Pemilik</td>
						<td><?=$alamat_pemilik?></td>
					</tr>

					<tr>
						<td>Jenis Kelamin</td>
						<td><?=$jenis_kelamin?></td>
					</tr>

					<tr>
						<td>Pekerjaan</td>
						<td><?=$pekerjaan?></td>
					</tr>

					<tr>
						<td>Username</td>
						<td><?=$username?></td>
					</tr>

					<tr>
						<td>Email</td>
						<td><?=$email?></td>
					</tr>

					<tr>
						<td>Password</td>
						<td><?=$password?></td>
					</tr>

        </table>

        <a href="<?=site_url("backend/".$this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
