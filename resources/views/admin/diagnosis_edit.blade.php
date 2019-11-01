
@extends('admin/layout')

@section('title', $title)

@section('content')
<div class="container">
  <!-- Main content -->
  <section class="content">
  <fieldset>
	  <legend><h4> {!! $icon." Edit ".$title !!}</h4></legend>
      <div class="row">
        <div class="col-md-8">
            @include('admin.validasi')
            <form action="{{  route('diagnosis.update', $diagnosis->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              {{ method_field('PUT') }}
                <div class="form-group">
                  <label for="kode_customer" class="control-label">Nama Diagnosa</label>
                    <input class="form-control" type="text" required name="name" placeholder="Nama Diagnosa" value="{{ $diagnosis->name }}">
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