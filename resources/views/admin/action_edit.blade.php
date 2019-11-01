
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
            <form action="{{  route('action.update', $action->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              {{ method_field('PUT') }}
                <div class="form-group">
                  <label for="name" class="control-label">Nama Tindakan</label>
                    <input class="form-control" type="text" required name="name" placeholder="Nama Tindakan" value="{{ $action->name }}">
                </div>
                <div class="form-group">
                  <label for="price" class="control-label">Biaya</label>
                    <input class="form-control" type="text" required name="price" placeholder="Biaya" value="{{ $action->price }}">
                </div>
                <a href="{{ route('action.index') }}" class="btn btn-default" id="btn-cancel">Batal</a>&nbsp;&nbsp;
                <button type="submit" class="btn btn-info">Simpan</button>
            </form>
      </div>
    </div>
  </fieldset>
  </section>
  <!-- /.content -->
</div>
@endsection('content')