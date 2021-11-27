<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <i class="ti-file"></i> <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
					<tr>
						<td>Tgl Pembayaran</td>
						<td><?=$tgl_pembayaran?></td>
					</tr>

					<tr>
						<td>No Pendaftaran - Nama Pemilik</td>
						<td><?=$no_pendaftaran?></td>
					</tr>
					
					<tr>
						<td>Kendaraan</td>
						<td><?=$no_kendaraan?></td>
					</tr>
					<tr>
						<td>Jenis</td>
						<td><?=$jenis?></td>
					</tr>
					<tr>
						<td>Sub Jenis</td>
						<td><?=$sub_jenis?></td>
					</tr>
					<tr>
						<td>Sifat</td>
						<td><?=$sifat?></td>
					</tr>
					<tr>
						<td>Biaya </td>
						<td><?= "Rp. ".number_format($biaya,2,',','.')?></td>
					</tr>

        </table>

        <a href="<?=site_url("backend/".$this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
