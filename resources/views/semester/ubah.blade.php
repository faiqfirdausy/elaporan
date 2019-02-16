@extends('layouts.apps', ['title' => 'Unggah Laporan Semester'])

@section('content')
  <section class="content-header">
    <h1>
      Ubah Laporan Semester
    </h1>
  </section>
  <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
            <form action="{{url('laporan/bulanan/unggah/update')}}" method="POST" role="form" enctype="multipart/form-data">
              {!! csrf_field() !!}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Keterangan</label>
                  <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" value ="{{$laporan->keterangan}}">
                  <input type="hidden" name="id_transaksi" value ="{{$laporan->id_transaksi}}">
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1">Semester Laporan</label>
                  <select class="form-control" name="detillaporan">
                  <option value ="">--Pilih Semester--</option>

                    <option value =1>Semester 1</option>
                    <option value =2>Semester 2</option>
                  </select>

                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tahun Laporan</label>
                  <select class="form-control" name="tahun">
                  <option value ="">--Pilih Tahun Laporan--</option>

                    <option value =2017>2017</option>
                    <option value =2018>2018</option>
                    <option value =2019>2019</option>
                    <option value =2020>2020</option>
                    <option value =2021>2021</option>
                    <option value =2022>2022</option>
                    <option value =2023>2023</option>
                    <option value =2024>2024</option>
                    <option value =2025>2025</option>
                    <option value =2026>2026</option>
                    <option value =2027>2027</option>
                    <option value =2028>2028</option>
                    <option value =2029>2029</option>
                  </select>

                </div>
                <div class="form-group">
                  <label>Pilih Tipe Laporan</label>
                  <select class="form-control" name ="tipelaporan">
                  <option value ="">--Pilih Tipe Laporan--</option>

                    @foreach($lap as $tip)

                    <option value ="{{$tip->id}}">{{$tip->nama}}</option>
                   @endforeach

                  </select>

                </div>
                <div class="form-group">
                  <label>Ubah File pdf</label>
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