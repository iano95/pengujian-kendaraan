<div class="row">
  <div class="col-md-12 col-xl-12 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <i class="ti-files"></i> <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <div class="mb-1">
          <div class="row">
            <div class="col-10">
              <select class="form-control form-control-sm" name="tahun" id="tahun">
                <option value='' >Semua Tahun</option>
                <?php 
                $now=date("Y");
                for ($i=$now; $i > 2010 ; $i--):?>
                <option value='<?=$i?>' <?= ($i == $tahun) ? 'selected' : '' ;?> >Tahun <?=$i?></option>
                <?php endfor;?>
              </select>
            </div>
            <div class="col-2">
            <?php if ($data) :?>
              <button class="btn btn-success btn-md" id="btn-print">Print</button>
            <?php endif;?>
            </div>
          </div>
          <br>
          
        </div>
        <div class="d-none">
          <div id="hed" class="text-center">
            <h2>Dinas Perhubungan Kota Ambon</h2>
            <h3>Data Pemohon <?=$tahun?></h3>
            <hr style="borde-style:double;border-width:3px; border-color:black;">
          </div>
        </div>
        

        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama </th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Pendaftaran</th>
                <th>Pekerjaan</th>
                <th>Email</th>
                <th>Alamat</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!$data) {
                echo "<tr> <td colspan='7' > Tidak Ada Data di Tahun $tahun</td></tr>";
              }?>
              <?php  $no =1; foreach ($data as $row) :?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $row->nama_pemilik?></td>
                <td><?= $row->jenis_kelamin?></td>
                <td><?= $row->tgl_pendaftaran?></td>
                <td><?= $row->pekerjaan?></td>
                <td><?= $row->email?></td>
                <td><?= $row->alamat_pemilik?></td>
                
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
    $('#btn-print').text('Memproses...')
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
  
  
  $('#tahun').change(()=>{
    let tahun='';
    if ($('#tahun').val()!='') {
      tahun= '?tahun='+ $('#tahun').val();
    }
    window.location.replace('<?=base_url()?>backend/laporan_pemohon.html'+tahun)
  })
</script>
