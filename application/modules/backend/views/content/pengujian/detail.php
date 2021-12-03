<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <i class="ti-file"></i> <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
					<tr>
						<td>No Pemeriksaan</td>
						<td><?=$no_pemeriksaan?></td>
					</tr>

					<tr>
						<td>Tgl Pemeriksaan</td>
						<td><?=$tgl_pemeriksaan?></td>
					</tr>

					<?php 
							$pem=$this->db->get_where('tb_kendaraan',['id_kendaraan'=>$no_kendaraan])->row();

							$nmpem=$this->db->get_where('tb_pemohon',['no_pendaftaran'=>$pem->no_pendaftaran])->row();

					 ?>

					<tr>
						<td>No Kendaraan - merek</td>
						<td><?=$no_kendaraan?> - <?=$pem->mrk_kendaraan ?></td>
					</tr>

					<tr>
						<td>Pemilik</td>
						<td><?=$nmpem->nama_pemilik?></td>
					</tr>

					<tr>
						<td>Peralatan</td>
						<td><?=$peralatan?></td>
					</tr>

					<tr>
						<td>Penerangan</td>
						<td><?=$penerangan?></td>
					</tr>

					<tr>
						<td>Kemudi</td>
						<td><?=$kemudi?></td>
					</tr>

					<tr>
						<td>Suspensi</td>
						<td><?=$suspensi?></td>
					</tr>

					<tr>
						<td>Ukuran Ban</td>
						<td><?=$ban?></td>
					</tr>

					<tr>
						<td>Rangka</td>
						<td><?=$rangka?></td>
					</tr>

					<tr>
						<td>Rem</td>
						<td><?=$rem?></td>
					</tr>

					<tr>
						<td>Keterangan</td>
						<td><?=$keterangan?></td>
					</tr>

        </table>

        <a href="<?=site_url("backend/".$this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
