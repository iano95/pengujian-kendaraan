<div class="row">
  <div class="col-md-12 col-xl-12 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <i class="ti-files"></i> <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <div class="mb-1">
          <?php if (is_allowed('pengujian_add')) :?>
          <a href="<?=site_url("backend/pengujian/add")?>" id="add" class="btn btn-sm btn-success btn-icon-text"><i class="fa fa-file btn-icon-prepend"></i> <?=cclang("add_new")?></a>
          <?php endif;?>
          <button type="button" id="reload" class="btn btn-sm btn-info-2 btn-icon-text"><i class="mdi mdi-backup-restore btn-icon-prepend"></i> <?=cclang("reload")?></button>
          <a href="<?=site_url("backend/pengujian/filter/")?>" id="filter-show" class="btn btn-sm btn-primary btn-icon-text"><i class="mdi mdi-magnify btn-icon-prepend"></i> Filter</a>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
							<th>No Pemeriksaan</th>
							<th>Tgl Pemeriksaan</th>
              <th>No Kendaraan (Merek)</th>
							<th>Nama Pemilik</th>
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
          "url": BASE_URL + "backend/pengujian/json",
          "type": "POST",
          "data":function(data){
		data.no_pemeriksaan = $("#no_pemeriksaan").val();
		data.tgl_pemeriksaan = $("#tgl_pemeriksaan").val();
		data.no_kendaraan = $("#no_kendaraan").val();
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
              'className': 'text-center',
              'orderable': false,
              'targets': 3
          }
      ],
    });


$("#reload").click(function(){
	$("#no_pemeriksaan").val("");
	$("#tgl_pemeriksaan").val("");
	$("#no_kendaraan").val("");
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
