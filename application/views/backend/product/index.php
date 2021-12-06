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
<script src="<?=base_url();?>assets/pages/js/form-validation-pendaftar.js" type="text/javascript"></script>
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
            "url": "<?php echo site_url('backend/product/loadTable')?>",
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

	$('#galery_ubah').change(function () {
		var type = $('#galery_ubah option:selected').val();
		if (type == "Y") {
			$("#gambar").show();
		} else  {
			$("#gambar").hide();
		}
	});
});

function reset(){
	$("#data").hide();
	$("#inputan").hide();
	$("#upload").hide();
	$("#gambar").hide();
	$("#gambarTmp").hide();
    $('[name="file"]').val('');
    $('[name="galery_ket"]').val('');
    $('[name="galery_kategori"]').val('');
}

function showData(){
	reset();
	$("#data").show();
	$('#tableData').DataTable().ajax.reload();
}

function showInputan(){
	reset();
	save_method = 'add';
	$("#gambar").show();
	$("#inputan").show();
	$("#gambarTmp").hide();
	$("input[name=file]").focus();
    $('[name="id"]').val('add');
	$("#btnSave").text('Save');	
	$('#alerERRInput').hide();
}
function showInputan2(){
	reset();
	save_method = 'add';
	$("#inputan").show();
	$("#gambar").hide();
	$("#gambarTmp").show();
	$("input[name=file]").focus();
	$("#btnSave").text('Save');	
	$('#alerERRInput').hide();
}

function edit(id)
{
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('backend/product/prepareEdit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			showInputan();
			$("#gambar").hide();
			$("#gambarTmp").show();
			save_method = 'update';
			$("#btnSave").text('Update');
            $('[name="id"]').val(data.data.galery_id);
            $('[name="galery_ket"]').val(data.data.galery_ket);
            $('[name="galery_kategori"]').val(data.data.galery_kategori);
            $('#gambarTmpIsi').html(data.gambar);
            $('[name="galery_kategori"]').focus();
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
			url:"<?php echo site_url('backend/product/delete');?>"+'/'+id,
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
				<?php if($this->session->flashdata('msgUpload') == 'Sukses Upload Foto'){?>
							<div id="alerERRInput" class="custom-alerts alert alert-success fade in">
								<button type="button" class="close" data-dismiss="alert" >x</button>
								<p id="msgERRInput">
									<?=$this->session->flashdata('msgUpload')?>
								</p>
							</div>
							<?php } else if($this->session->flashdata('msgUpload') == 'Sukses Update'){?>
							<div id="alerERRInput" class="custom-alerts alert alert-success fade in">
								<button type="button" class="close" data-dismiss="alert" >x</button>
								<p id="msgERRInput">
									<?=$this->session->flashdata('msgUpload')?>
								</p>
							</div>
							<?php } else if($this->session->flashdata('msgUpload') != '') { ?>
							<div id="alerERRInput" class="custom-alerts alert alert-warning fade in">
								<button type="button" class="close" data-dismiss="alert" >x</button>
								<p id="msgERRInput">
									<?=$this->session->flashdata('msgUpload')?>
								</p>
							</div>
							<?php } ?>
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
                <div class="box-body" style="overflow: auto">
                  <table id="tableData" class="table table-bordered table-striped">
                    <thead>
                      <tr>
						  <th style="width: 5%">No</th>
						  <th style="width: 15%">Kategori</th>
						  <th style="width: 40%">Keterangan</th>
						  <th style="width: 30%">Foto</th>
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
        <form action="<?=base_url();?>backend/product/uploadFoto" method="post" class="form-data" enctype="multipart/form-data">		
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
				<div class="col-md-12" id="gambarTmp">
					<div class="form-group" id="gambarTmpIsi">
					</div>
					<div class="form-group">
						<label>Ubah</label>
						<select class="form-control" name="galery_ubah" id="galery_ubah">
							<option value="T">Tidak</option>
							<option value="Y">Ya</option>
						</select>
					</div>
				</div>
				<div class="col-md-12" id="gambar">
					<div class="form-group">
						<label>Cari File</label>
						<input type="file" class="form-control" name="file"/>
						<i>notes : 1450 x 960 px</i>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Kategori</label>
						<select class="form-control" name="galery_kategori">
							<option value="">Pilih Kategori</option>
							<?php foreach($dataKategori as $k){ ?>
								<option value="<?=$k->kategori_id?>"><?=$k->kategori_nama?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Keterangan</label>
						<textarea class="form-control" name="galery_ket" placeholder="Keterangan" maxlength="250"></textarea>
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