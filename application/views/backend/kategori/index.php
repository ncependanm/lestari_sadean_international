<?php 
$ada = true;
if($this->session->userdata('user_level') == '1'){
	$ada = true;
}
if(!$ada){ ?>
<section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>
        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
          <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="<?=base_url()?>dashboard">return to dashboard</a> or try using the search form.
          </p>
        </div>
      </div>
    </section>
<?php } else { ?>
<script src="<?=base_url();?>assets/pages/js/form-validation-jadwal.js" type="text/javascript"></script>
<script>
var save_method;
var table;

$(document).ready(function() {
    //datatables
	$("#data").show();
	table = $('#tableData').DataTable({ 
		"retrieve": true,
		"destroy": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('backend/kategori/loadTable')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });
});

function reset(){
	$("#data").hide();
	$("#inputan").hide();
	$("#upload").hide();
    $('[name="id"]').val('');
    $('[name="kategori_nama"]').val('');
}

function showData(){
	reset();
	$("#data").show();
	$('#tableData').DataTable().ajax.reload();
}

function showInputan(){
	reset();
	save_method = 'add';
	$("#inputan").show();
	$("input[name=kategori_nama]").focus();
	$("#btnSave").text('Save');	
	$('#alerERRInput').hide();
}
function showInputan2(){
	reset();
	save_method = 'add';
	$("#inputan").show();
	$("input[name=kategori_nama]").focus();
	$("#btnSave").text('Save');	
	$('#alerERRInput').hide();
}

function showUpload(){
	reset();
	$("#upload").show();
}

function save(){ //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
	var url;
	if(save_method == 'add') {
		$('#btnSave').text('Saving...');
        url = "<?php echo site_url('backend/kategori/save')?>";
		$("#msgSKS").text("Data Berhasil Ditambah !!");
		$("#msgERR").text("Data Gagal Ditambah !!");
    } else {
		$('#btnSave').text('Updating...');
        url = "<?php echo site_url('backend/kategori/update')?>";
		$("#msgSKS").text("Data Berhasil Diubah !!");
		$("#msgERR").text("Data Gagal Diubah !!");
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
				$("#alerSKS").show();
				showData();				
            } else {
				$("#alerERRInput").show();
				$("#msgERRInput").text(data.msg);
			}
				$('#btnSave').text('Save'); //change button text
				$('#btnSave').attr('disabled',false); //set button enable 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			$("#alerERR").show();
            $('#btnSave').text('Save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
        }
    });
}

function edit(id)
{
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('backend/kategori/prepareEdit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			showInputan2();
			save_method = 'update';
			$("#btnSave").text('Update');
            $('[name="id"]').val(data.kategori_id);
            $('[name="kategori_nama"]').val(data.kategori_nama);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
};

$(document).on("click","#hapusData",function(){
	var id=$(this).attr("data-id");
	swal({
		title:"Hapus Data",
		text:"Yakin akan menghapus data ini?",
		type: "warning",
		showCancelButton: true,
		confirmButtonText: "Hapus",
		closeOnConfirm: true,
	},
		function(){
		 $.ajax({
			url:"<?php echo site_url('backend/kategori/delete');?>"+'/'+id,
			data: id,
			success: function(data){
				$('#tableData').DataTable().ajax.reload();
				$("#msgSKS").text("Data Berhasil Dihapus !!");
				$("#alerSKS").show();
			} ,
			error: function ()
			{
				$("#msgERR").text("Data Gagal Dihapus !!");
				$("#alerERR").show();
			}
		 });
	});
});
</script>

<section class="content-header">
	<h1>
		<?=$titlePage?>
		<small><?=$titlePageSmall?></small>
	</h1>
</section>

<section class="content" id="data" style="display: none">
        <div class="row">
			<div class="col-xs-12">
              <div class="box">
                <div class="box-header">
				
		<div id="alerSKS" class="custom-alerts alert alert-success fade in" style="display: none">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<p id="msgSKS"></p>
		</div>
		<div id="alerERR" class="custom-alerts alert alert-warning fade in" style="display: none">
			<button type="button" class="close" data-dismiss="alert" >x</button>
			<p id="msgERR"></p>
		</div>
					<button class="btn btn-primary" onclick="showInputan()">Add Data</button>
					<!--<button class="btn btn-primary" onclick="showUpload()">Upload</button>-->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tableData" class="table table-bordered table-striped">
                    <thead>
                      <tr>
						  <th style="width: 5%">No</th>
						  <th style="width: 85%">Nama</th>
						  <th style="width: 10%">Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
</section>

<section class="content" id="inputan" style="display: none">
    <div class="row">
    <section class="content col-md-6">
        <form id="form" class="form-data" autocomplete="off" >		
		<div class="box box-default">
            <div class="box-header with-border">
			<div id="alerERRInput" class="custom-alerts alert alert-warning fade in" style="display: none" >
				<button type="button" class="close" data-dismiss="alert" >x</button>
				<p id="msgERRInput"></p>
			</div>
              <h3 class="box-title"><?=$titleInputan?></h3>
            </div><!-- /.box-header -->
			
			<input type="text" name="id" hidden>
            <div class="box-body">
              <div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Nama Kategori *</label>
						<input type="text" class="form-control" name="kategori_nama" placeholder="Nama Kategori" maxlength="100" >
					</div>
				</div>
			  </div>
			</div>
            <div class="box-footer text-center">
				<button class="btn btn-primary" type="submit" id="btnSave"></button>          
				<button class="btn btn-default" type="button" onclick="showData()">Cancel</button>          
			</div>
          </div><!-- /.box -->
		  </form>
    </div>
</section>

<?php } ?>