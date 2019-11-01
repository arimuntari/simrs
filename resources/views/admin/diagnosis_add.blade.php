
@extends('admin/layout')

@section('title', $title)

@section('content')
<div class="container">
  <!-- Main content -->
  <section class="content">
  <fieldset>
	  <legend><h4> {!! $icon." Tambah ".$title !!}</h4></legend>
      <div class="row">
        <div class="col-md-8">
            @include('admin.validasi')
            <form action="{{ route('diagnosis.store') }}" method="post" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                  <label for="kode_customer" class="control-label">Nama Diagnosa</label>
                    <input class="form-control" type="text" required name="name" placeholder="Nama Diagnosa">
                </div>
                <a href="{{ route('diagnosis.index') }}" class="btn btn-default" id="btn-cancel">Batal</a>&nbsp;&nbsp;
                <button type="submit" class="btn btn-info">Simpan</button>
            </form>
      </div>
    </div>
  </fieldset>
  </section>
  <!-- /.content -->
</div>
@endsection('content')