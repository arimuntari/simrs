
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
                <a href="{{ route('purchase.create')  }}" class="btn btn-info btn-block"> <i class="fa fa-plus"></i> Tambah 
                </a>
              </div>
              <div class="col-xs-6">
                 <a href="{{ route('purchase.index')  }}" class="btn btn-default btn-block"> <i class="fa fa-sync"></i> Refresh 
                 </a>
              </div> 
            </div> 
          </div>
          <div class="col-md-1">
          </div>
          <div class="col-md-7">
            <div class="row">
              <form method="get" class="form-horizontal" action="{{  route('purchase.index')  }}">
	              <div class="col-xs-12 col-md-2  col-lg-2">
	                <p class="form-control-static"><b>Pencarian:</b></p>
	              </div>
	              <div class="col-xs-9 col-md-8 col-lg-8">
	                <div class="input-group input-group-md">
	                  <input type="text" name="key" value="{{ $key }}" class="form-control" placeholder="Masukkan Kode Penjualan">
	                  <span class="input-group-btn">
	                      <button type="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i> Tampil</button>
	                  </span>
	                </div>
	              </div>
		          <div class="col-xs-3 col-md-3  col-lg-2" style="font-size:13px;">
		          	<p class="form-control-static pull-right"><b>Total Data :  {{ $purchases->total() }}</b></p>
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
          <th width="150px">Kode Pembelian</th>
          <th width="150px">Tanggal &  Jam </th>
          <th width="150px">Total Harga</th>
          <th width="150px">Admin</th>
					<th width="100px"> &nbsp;</th>
				</tr>
			</thead>
			<tbody>
        <?php  $no = 1*$purchases->currentPage() ; ?>
        @foreach($purchases as $purchase)
				<tr>
					<td>{{ $no }}. </td>
          <td>{!! Helper::highLight($purchase->code, $key) !!}</td>
          <td>{{ Helper::toIndo($purchase->sale_date) }}</td>
          <td align="right"> @rupiah($purchase->price_total)</td>
          <td>{{ $purchase->User->name }}</td>
          <td style="word-wrap: nowrap" align="center">
              <form id="delform" action="{{ route('purchase.destroy', $purchase->id ) }}" method="POST"> 
                 @csrf
                <a href="{{ route('purchase.detail', $purchase->id) }}" 
                class="btn btn-default btn-sm" 
                title="Tombol Untuk View">
                <i class="fa fa-search"></i>
               </a>
               &nbsp;&nbsp;
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

      {{ $purchases->links() }}
  </fieldset>
  </section>
  <!-- /.content -->
</div>
@endsection('content')