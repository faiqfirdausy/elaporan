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
                  <label for="exampleInputEmail1">Bulan Laporan</label>
                  <select class="form-control" name="detillaporan">
                  <option value ="">--Pilih Bulan Laporan--</option>

                    <option value =1>Januari</option>
                    <option value =2>Februari</option>
                    <option value =3>Maret</option>
                    <option value =4>April</option>
                    <option value =5>Mei</option>
                    <option value =6>Juni</option>
                    <option value =7>Juli</option>
                    <option value =8>Agusutus</option>
                    <option value =9>September</option>
                    <option value =10>Oktober</option>
                    <option value =11>November</option>
                    <option value =12>Desember</option>
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