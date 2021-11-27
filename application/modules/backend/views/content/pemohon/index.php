<div class="row">
  <div class="col-md-12 col-xl-12 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <i class="ti-files"></i> <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <div class="mb-1">
          <a href="<?=site_url("backend/pemohon/add")?>" id="add" class="btn btn-sm btn-success btn-icon-text"><i class="fa fa-file btn-icon-prepend"></i> <?=cclang("add_new")?></a>
          <button type="button" id="reload" class="btn btn-sm btn-info-2 btn-icon-text"><i class="mdi mdi-backup-restore btn-icon-prepend"></i> <?=cclang("reload")?></button>
          <a href="<?=site_url("backend/pemohon/filter/")?>" id="filter-show" class="btn btn-sm btn-primary btn-icon-text"><i class="mdi mdi-magnify btn-icon-prepend"></i> Filter</a>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
							<th>No Pendaftaran</th>
							<th>Jenis Identitas</th>
							<th>Id Identitas</th>
							<th>Tgl Pendaftaran</th>
							<th>Nama Pemilik</th>
							<th>Alamat Pemilik</th>
							<th>Jenis Kelamin</th>
							<th>Pekerjaan</th>
							<th>Username</th>
							<th>Email</th>
                <th>#</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function(){
var table;
//datatables
  table = $('#table').DataTable({

      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      "searching": false,
      // "info": false,
      "bLengthChange": false,
      oLanguage: {
          sProcessing: '<i class="fa fa-spinner fa-spin fa-fw"></i> Loading...'
      },

      // Load data for the table's content from an Ajax source
      "ajax": {
          "url": BASE_URL + "backend/pemohon/json",
          "type": "POST",
          "data":function(data){
		data.no_pendaftaran = $("#no_pendaftaran").val();
		data.jenis_identitas = $("#jenis_identitas").val();
		data.id_identitas = $("#id_identitas").val();
		data.tgl_pendaftaran = $("#tgl_pendaftaran").val();
		data.nama_pemilik = $("#nama_pemilik").val();
		data.alamat_pemilik = $("#alamat_pemilik").val();
		data.jenis_kelamin = $("#jenis_kelamin").val();
		data.pekerjaan = $("#pekerjaan").val();
		data.username = $("#username").val();
		data.email = $("#email").val();
          }
      },

      //Set column definition initialisation properties.
        "columnDefs": [
					{
              'orderable': true,
              'targets': 0
          },
					{
              'orderable': true,
              'targets': 1
          },
					{
              'orderable': true,
              'targets': 2
          },
					{
              'orderable': true,
              'targets': 3
          },
					{
              'orderable': true,
              'targets': 4
          },
					{
              'orderable': true,
              'targets': 5
          },
					{
              'orderable': true,
              'targets': 6
          },
					{
              'orderable': true,
              'targets': 7
          },
					{
              'orderable': true,
              'targets': 8
          },
					{
              'orderable': true,
              'targets': 9
          },
					{
              'className': 'text-center',
              'orderable': false,
              'targets': 10
          }
      ],
    });


$("#reload").click(function(){
	$("#no_pendaftaran").val("");
	$("#jenis_identitas").val("");
	$("#id_identitas").val("");
	$("#tgl_pendaftaran").val("");
	$("#nama_pemilik").val("");
	$("#alamat_pemilik").val("");
	$("#jenis_kelamin").val("");
	$("#pekerjaan").val("");
	$("#username").val("");
	$("#email").val("");
  table.ajax.reload();
});


$(document).on("click","#filter-show",function(e){
  e.preventDefault();
  $('.modal-dialog').addClass('modal-md');
  $("#modalTitle").text('Filter');
  $('#modalContent').load($(this).attr('href'));
  $("#modalGue").modal('show');
});

$(document).on("click","#delete",function(e){
  e.preventDefault();
  $('.modal-dialog').addClass('modal-sm');
  $("#modalTitle").text('<?=cclang("confirm")?>');
  $('#modalContent').html(`<p class="mb-4"><?=cclang("delete_description")?></p>
														<button type='button' class='btn btn-default btn-sm' data-dismiss='modal'><?=cclang("cancel")?></button>
	                          <button type='button' class='btn btn-primary btn-sm' id='yes-rmv' data-id=`+$(this).attr('alt')+`  data-url=`+$(this).attr('href')+`><?=cclang("delete_action")?></button>
														`);
  $("#modalGue").modal('show');
});


$(document).on('click','#yes-rmv',function(e){
  $(this).prop('disabled',true)
          .text('Processing...');
  $.ajax({
          url:$(this).data('url'),
          type:'POST',
          cache:false,
          dataType:'json',
          success:function(json){
            $('#modalGue').modal('hide');
            swal(json.msg, {
              icon:json.type_msg
            })
            $('#table').DataTable().ajax.reload();
          }
        });
});


});
</script>
