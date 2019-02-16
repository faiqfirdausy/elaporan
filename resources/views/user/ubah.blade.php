@extends('layouts.apps', ['title' => 'Ubah User'])

@section('content')
  <section class="content-header">
    <h1>
      Ubah Akun User
    </h1>
  </section>
  <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
            <form action="{{url('user/update')}}" method="POST" role="form" enctype="multipart/form-data">
              {!! csrf_field() !!}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama</label>
                  <input type="text" class="form-control" name="name" value ="{{$users->name}}">
                   <label for="exampleInputEmail1">Email</label>
                  <input type="text" class="form-control" name="email" value ="{{$users->email}}">

                  <label for="exampleInputEmail1">Password Baru</label>
                  <input type="password" class="form-control" name="password" >

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