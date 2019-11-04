
@extends('admin/layout')

@section('title', $title)

@section('content')
<div class="container">
  <!-- Main content -->
  <section class="content">
  <fieldset>
    <legend><h4> {!! $icon." Edit ".$title !!}</h4></legend>

    @include('admin.validasi')
    <form action="{{  route('medicine.update', $medicine->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PUT') }}
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Kode Obat</label>
                  <input class="form-control" type="text" required name="code" placeholder="Kode Obat" value="{{ $medicine->code }}">
              </div>
              <div class="form-group">
                <label class="control-label">Nama Obat</label>
                  <input class="form-control" type="text" required name="name" placeholder="Nama Obat" value="{{ $medicine->name }}">
              </div>
              <div class="form-group">
                <label for="name" class="control-label">Stok Obat</label>
                  <input class="form-control" type="text" required name="stock" placeholder="Stok Obat" value="{{ $medicine->stock }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label  class="control-label">Harga Beli</label>
                  <input class="form-control" type="text" required name="purchase_price" placeholder="Harga Beli" value="{{ $medicine->purchase_price }}">
              </div>
              <div class="form-group">
                <label class="control-label">Harga Jual</label>
                  <input class="form-control" type="text" required name="sell_price" placeholder="Harga Jual" value="{{ $medicine->sell_price }}">
              </div>
              <div class="form-group">
                <label class="control-label">Satuan</label>
                  <input class="form-control" type="text" required name="unit" placeholder="Satuan"value="{{ $medicine->unit }}">
              </div>
            </div>
          </div>
        </div>
      </div>
    <a href="{{ route('medicine.index') }}" class="btn btn-default" id="btn-cancel">Batal</a>&nbsp;&nbsp;
    <button type="submit" class="btn btn-info">Simpan</button>
    </form>
  </fieldset>
  </section>
  <!-- /.content -->
</div>
@endsection('content')