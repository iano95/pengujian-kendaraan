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
            <h3>Data Karyawan - Tahun <?=date('Y')?></h3>
            <hr style="borde-style:double;border-width:2px; border-color:black;">
          </div>
        </div>
        

        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th>No</th>
                <th>Nip </th>
                <th>Nama</th>
                <th>Jenis kelamin</th>
                <th>Jabatan</th>
                <th>Alamat</th>
                <th>Telepon</th>

              </tr>
            </thead>
            <tbody>
              <?php if (!$data) {
                echo "<tr> <td colspan='7' > Tidak Ada Data di </td></tr>";
              }?>
              <?php  $no =1; foreach ($data as $row) :?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $row->nip?></td>
                <td><?= $row->nama?></td>
                <td><?= $row->jk?></td>
                <td><?= $row->jabatan?></td>
                <td><?= $row->alamat?></td>
                <td><?= $row->telepon?></td>
                
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
  
</script>
