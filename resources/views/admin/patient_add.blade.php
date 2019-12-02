
@extends('admin/layout')

@section('title', $title)

@section('content')
<div class="container">
  <!-- Main content -->
  <section class="content">
  <fieldset>
	  <legend><h4> {!! $icon." Tambah ".$title !!}</h4></legend>
            @include('admin.validasi')
    <form action="{{ route('patient.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label">Kode Pasien</label>
            <input class="form-control" type="text" readonly="" required name="code" placeholder="Kode Pasien" value="{{ Helper::codePatient() }}">
        </div>
        <div class="form-group">
          <label class="control-label">Nama Pasien</label>
            <input class="form-control" type="text" required name="name" placeholder="Nama Pasien">
        </div>
        <div class="form-group">
          <label for="name" class="control-label">Tgl. Lahir</label>
            <input class="form-control datepicker" type="text" required name="birthdate" placeholder="Tgl. Pasien">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label  class="control-label">No. Telp</label>
            <input class="form-control" type="text" required name="phone_number" placeholder="No. Telp">
        </div>
        <div class="form-group">
          <label class="control-label">Alamat</label>
            <input class="form-control" type="text" required name="address" placeholder="Alamat">
        </div>
      </div>
    </div>
    <a href="{{ route('patient.index') }}" class="btn btn-default" id="btn-cancel">Batal</a>&nbsp;&nbsp;
    <button type="submit" class="btn btn-info">Simpan</button>
    </form>
  </fieldset>
  </section>
  <!-- /.content -->
</div>
@endsection('content')