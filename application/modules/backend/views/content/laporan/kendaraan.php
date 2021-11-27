<div class="row">
  <div class="col-md-12 col-xl-12 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <i class="ti-files"></i> <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <div class="mb-1">
          <div class="row">
            <div class="col-6 col-md-3">
              <select class="form-control form-control-sm" name="tahun" id="tahun">
                <option value='' >Semua Tahun</option>
                <?php 
                $now=date("Y");
                for ($i=$now; $i > 2000 ; $i--):?>
                <option value='<?=$i?>' <?= ($i == $tahun) ? 'selected' : '' ;?> >Tahun <?=$i?></option>
                <?php endfor;?>
              </select>
            </div>
            <div class="col-6 col-md-3">
              <select class="form-control form-control-sm" name="jenis" id="jenis">
                <option value='' >pilih Jenis</option>
                <?php $data=$this->db->get('tb_tarif')->result();?>
                <?php foreach ($data as $key): ?>
                  <option value="<?=$key->id_jenis?>" 
                    <?=($jenis==$key->id_jenis) ?'selected':''; ?>>
                    <?=$key->jenis_mobil?> - <?=$key->sub_jenis?> (<?=$key->sifat?>)  
                      
                  </option>
                <?php endforeach ?>
                
              </select>
            </div>
            <div class="col-6 col-md-3">
              <select class="form-control form-control-sm" name="merek" id="merek">
                <option value="">Semua Merek</option>
                <?php foreach ($dtMerek as $key): ?>
                  <option value="<?=$key->mrk_kendaraan ?>" 
                    <?=($merek==$key->mrk_kendaraan) ?'selected':''; ?>><?=$key->mrk_kendaraan ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="col-6 col-md-3">
              <a href="<?=base_url()?>backend/laporan_kendaraan.html" class="btn btn-danger btn-md mr-3" id="btn-rest">Reset</a>
            <?php if ($datat) :?>
              <button class="btn btn-success btn-md" id="btn-print">Print</button>
            <?php endif;?>
            </div>
          </div>
          <br>
          
        </div>
        <div class="d-none">
          <div id="hed" class="text-center">
            <h2>Dinas Perhubungan Kota Ambon</h2>
            <h3>Data Kendaraan <?=$tahun?></h3>
            <hr style="borde-style:double;border-width:3px; border-color:black;">
          </div>
        </div>
        

        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pemilik</th>
                <th>Nomor Mesin</th>
                <th>Nomor Rangka</th>
                <th>Merek</th>
                <th>Jenis</th>
                <th>Sub Jenis</th>
                <th>Sifat</th>
                <th>Tahun</th>
                <th>Masa Berlaku</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!$datat) {
                echo "<tr> <td colspan='10' > Tidak Ada Data</td></tr>";
              }?>
              <?php  $no =1; foreach ($datat as $row) :?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $row->no_mesin?></td>
                <td><?= $row->no_rangka?></td>
                <td><?= $row->nama_pemilik?></td>
                <td><?= $row->mrk_kendaraan?></td>
                <td><?= $row->jenis_mobil?></td>
                <td><?= $row->sub_jenis?></td>
                <td><?= $row->sifat?></td>
                <td><?= $row->thn_kendaraan?></td>
                <td><?= $row->masa_berlaku?></td>
                
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
  $('#btn-print').click(()=>{
    $('#btn-print').text('proses...')
    $('.table').printThis({
      header:$('#hed'),
      pageTitle:'Data Pemohon',
      importCSS:false,
      loadCSS: '<?=base_url()?>/_temp/backend/css/print.css',
      beforePrintEvent: ()=>{
        $('#btn-print').text('Print')
      },   
    })
  })
  
  
  $('select').change(()=>{
    let dta='';
    if ($('#tahun').val()!='') {
      dta += 'tahun='+ $('#tahun').val()+'&';
    }
    if ($('#merek').val()!='') {
      dta += 'merek='+ $('#merek').val()+'&';
    }
    if ($('#jenis').val()!='') {
      dta += 'jenis='+ $('#jenis').val();
    }
    window.location.replace('<?=base_url()?>backend/laporan_kendaraan.html?'+dta)
  })
</script>
