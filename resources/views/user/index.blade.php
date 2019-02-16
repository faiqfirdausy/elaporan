@extends('layouts.apps', ['title' => 'Daftar Laporan Bulanan'])

@section('content')
	<section class="content-header">
	  <h1>
	    Daftar User
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="#">Tables</a></li>
	    <li class="active">Simple</li>
	  </ol>
	</section>
	<div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="{{url('laporan/bulanan/unggah')}}" class="btn btn-primary btn-flat">Tambah User</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              	<table class="table table-bordered" id ="myTable">
	                <thead>
	                	<tr>
		                  <th style="width: 10px">#</th>
		                  <th>Nama User</th>
		                  <th>Email</th>
		                  <th>Aksi</th>
	                	</tr>
	              	</thead>
	              	<tbody>
	              		@php $no = 1; @endphp
	              		@foreach($users as $user)
	              		<tr>
	              			<td>{{ $no++ }}</td>
	              			<td>{{$user->name}}</td>
	              			<td>{{$user->email}}</td>
	              			<td><a href="{{url('user/ubah/'.$user->id.'')}}" class="btn btn-sm btn-warning btn-flat">Ubah</a> <button type="button" class="btn btn-sm btn-danger btn-flat" data-toggle="modal" data-target="#modal-warning">Hapus</button></td>
	              		</tr>
	              		@endforeach
	              	</tbody>
          		</table>
            </div>
          </div>
        </div> 
        <div class="modal modal-warning fade in" id="modal-warning">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi Hapus</h4>
              </div>
              <div class="modal-body">
                <p>Apakah Anda Yakin?</p>
              </div>
              <div class="modal-footer">
              	<form action="{{url('laporan/bulanan/unggah/delete')}}" method=POST>
               {!! csrf_field() !!}

				<input type="hidden" value="6" name="id_transaksi">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
                <button type="Submit" class="btn btn-outline">Hapus</button>
            </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

 @endsection