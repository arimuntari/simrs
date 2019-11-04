
@extends('admin/layout')

@section('title', $title)

@section('content')
<div class="container">
  <section class="content">
  <fieldset>
	  <legend><h4> {!! $icon." ".$title !!}</h4></legend>
        <div class="row ">
          <div class="col-md-4">
            <div class="row">
              <div class="col-xs-6">
                <a href="{{ route('medicine.create')  }}" class="btn btn-info btn-block"> <i class="fa fa-plus"></i> Tambah 
                </a>
              </div>
              <div class="col-xs-6">
                 <a href="{{ route('medicine.index')  }}" class="btn btn-default btn-block"> <i class="fa fa-sync"></i> Refresh 
                 </a>
              </div> 
            </div> 
          </div>
          <div class="col-md-1">
          </div>
          <div class="col-md-7">
            <div class="row">
              <form method="get" class="form-horizontal" action="{{  route('medicine.index')  }}">
	              <div class="col-xs-12 col-md-2  col-lg-2">
	                <p class="form-control-static"><b>Pencarian:</b></p>
	              </div>
	              <div class="col-xs-9 col-md-8 col-lg-8">
	                <div class="input-group input-group-md">
	                  <input type="text" name="key" value="{{ $key }}" class="form-control" placeholder="Masukkan Nama Obat">
	                  <span class="input-group-btn">
	                      <button type="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i> Tampil</button>
	                  </span>
	                </div>
	              </div>
		          <div class="col-xs-3 col-md-3  col-lg-2" style="font-size:13px;">
		          	<p class="form-control-static pull-right"><b>Total Data :  {{ $medicines->total() }}</b></p>
		          </div>
              </form>
            </div>
          </div>
        </div>
      @if(Session::has('success'))<br>
        <span class="label label-success">
			{{ Session::get('success') }}
		</span>
      @endif
      @if(Session::has('fail'))<br>
        <span class="label label-danger">
			{{ Session::get('fail') }}
		</span>
      @endif
	  <div class="table table-responsive mt-3">
		<table class="table table-bordered">
			<thead>
				<tr class="bg-table">
					<th  width="50px">No. </th>
          <th width="150px">Kode Obat</th>
          <th>Nama Obat </th>
          <th width="150px">Stok</th>
          <th width="150px">Harga Jual</th>
          <th width="150px">Satuan</th>
					<th width="100px"> &nbsp;</th>
				</tr>
			</thead>
			<tbody>
        <?php  $no = 1*$medicines->currentPage() ; ?>
        @foreach($medicines as $medicine)
				<tr>
					<td>{{ $no }}. </td>
          <td>{!! Helper::highLight($medicine->code, $key) !!}</td>
					<td>{!! Helper::highLight($medicine->name, $key) !!}</td>
          <td>{{ $medicine->stock }}</td>
          <td align="right">@rupiah($medicine->sell_price) </td>
          <td>{{ $medicine->unit }}</td>
          <td style="word-wrap: nowrap" align="center">
            <form id="delform" action="{{ route('medicine.destroy', $medicine->id ) }}" method="POST"> 
            {{ method_field('DELETE') }}
            @csrf
            <a href="{{ route('medicine.edit', $medicine->id ) }}" 
            class="btn btn-warning btn-sm" 
            title="Tombol Untuk Edit">
              <i class="fa fa-edit"></i>
            </a>&nbsp;&nbsp;
             <button type="button" 
              onclick="if(confirm('Apakah Anda yakin untuk Menghapus Data ini?')){ submit();}" 
              class="btn btn-danger btn-sm" 
              title="Tombol Untuk Hapus">
              <i class="fa fa-trash"></i>
             </button>
             </form>
          </td>
				</tr>
        <?php  $no++ ;?>
        @endforeach
			</tbody>
		</table>
	  </div>

      {{ $medicines->links() }}
  </fieldset>
  </section>
  <!-- /.content -->
</div>
@endsection('content')