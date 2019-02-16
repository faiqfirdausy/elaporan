@extends('layouts.apps', ['title' => 'Unggah Laporan Bulanan'])

@section('content')
  <section class="content-header">
    <h1>
      Unggah Laporan Bulanan
    </h1>
  </section>
  <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
            <form action="{{url('laporan/bulanan/unggah/store')}}" method="POST" role="form" enctype="multipart/form-data">
              {!! csrf_field() !!}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Keterangan</label>
                  <input type="text" class="form-control" name="keterangan" placeholder="Keterangan">
                </div>
                <div class="form-group">
                  <label>Unggah File pdf</label>
                  <input type="file" name="file_laporan">
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-flat btn-primary">Simpan</button>
              </div>
            </form>
          </div>
    </div>
  </div>
</section>
@endsection