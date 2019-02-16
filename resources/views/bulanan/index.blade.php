@extends('layouts.apps', ['title' => 'Daftar Laporan Bulanan'])

@section('content')
	<section class="content-header">
	  <h1>
	    Daftar Laporan Bulanan
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="#">Tables</a></li>
	    <li class="active">Simple</li>
	  </ol>
	</section>
  <section class="content-header">
    <div class="row">
    	<div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="input-group">
                <div class="input-group-btn">
                  <a href="{{url('laporan/bulanan/unggah')}}" class="btn btn-primary btn-flat">Unggah Laporan</a>
                </div>
                <input type="text" class="form-control" placeholder="Cari Laporan Bulanan" id="searchBulanan">
              </div>
            </div>
            <div class="box-body">
              	<table class="table table-bordered" id ="myTable">
                  <thead>
                  	<tr>
                      <th style="width: 10px">#</th>
                      <th>Keterangan Laporan</th>
                      <th>Jenis Laporan</th>
                      <th>Bulan </th>
                      <th>Tahun Laporan</th>
                      <th>Nama File Laporan</th>
                      <th>Status </th>
                      <th>Aksi</th>
                  	</tr>
                	</thead>
                	<tbody>
                	</tbody>
          		</table>
            </div>
          </div>
      </div>
    </div>
  </section>

  <div class="modal modal-warning fade in" id="modal-warning">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{url('laporan/bulanan/unggah/delete')}}" method=POST>
          {!! csrf_field() !!}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Konfirmasi Hapus</h4>
          </div>
          <div class="modal-body" id="modalBody">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
            <button type="Submit" class="btn btn-outline">Hapus</button>
          </div>
        </form>
      </div>
    </div>
  </div>
 @endsection

@section('scripts')
  <script type="text/javascript">
    var table = $('#myTable').DataTable({
      processing: true,
      serverSide: true,
      searching: true,
      lengthChange: false,
      ordering: false,
      autoWidth: false,
      ajax: {
        url: "{{ url('laporan/bulanan/datatables') }}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
      },
      drawCallback: function() {
        $('#myTable_filter').addClass('hidden');
      }
    });

    $('#searchBulanan').keyup(function() {
      $('div.dataTables_wrapper div.dataTables_filter input').val($(this).val()).trigger('keyup');
    });

    $('#myTable').on('click', '.btn-delete', function(e){
      e.preventDefault();
      var id = $(this).data('id');
      var data = '<p>Apakah Anda Yakin?</p><input type="hidden" value="'+id+'" name="id_transaksi">';
      $('#modal-warning #modalBody').html(data);
      $('#modal-warning').modal('show');
    });
  </script>
@endsection