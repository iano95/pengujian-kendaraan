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
						<td>No Mesin</td>
						<td><?=$no_mesin?></td>
					</tr>

					<tr>
						<td>No Rangka</td>
						<td><?=$no_rangka?></td>
					</tr>

					<tr>
						<td>Mrk Kendaraan</td>
						<td><?=$mrk_kendaraan?></td>
					</tr>

					<tr>
						<td>Thn Kendaraan</td>
						<td><?=$thn_kendaraan?></td>
					</tr>

					<?php $j=$this->db->get_where('tb_tarif',['id_jenis'=>$jenis])->row(); ?>
					<tr>
						<td>Jenis</td>
						<td> <?=$j->jenis_mobil; ?></td>
					</tr>

					<tr>
						<td>Sub Jenis</td>
						<td> <?=$j->sub_jenis; ?></td>
					</tr>

					<tr>
						<td>Sifat</td>
						<td> <?=$j->sifat; ?></td>
					</tr>

					<tr>
						<td>Berat</td>
						<td><?=$berat_jbkb?> kg</td>
					</tr>

					<tr>
						<td>Berta Kosong </td>
						<td><?=$berta_kosong?> kg</td>
					</tr>

					<tr>
						<td>Daya Barang </td>
						<td><?=$daya_barang?> kg</td>
					</tr>

					<tr>
						<td>Daya Orang</td>
						<td><?=$daya_orang?> orang</td>
					</tr>

					<tr>
						<td>Masa Berlaku</td>
						<td><?=$masa_berlaku?></td>
					</tr>

        </table>

        <a href="<?=site_url("backend/".$this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
