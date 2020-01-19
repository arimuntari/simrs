
@extends('admin/layout')

@section('title', $title)

@section('content')
<div class="container">
  <section class="content">
  <fieldset>
	  <legend><h4> {!! $icon." ".$title !!}</h4></legend>
    <div class="table table-responsive mt-3" style="margin-bottom: 0px;">
      <table class="table table-bordered" style="margin-bottom: 0px;">
        <tr class="bg-table">
          <th colspan="6">Pembelian</th>
        </tr>
        <tr bgcolor="#ccc">
            <td width:150px>Kode Pembelian</td>
            <td>:</td>
            <td>{{ $purchase["detail"]->code }}</td>
            <td width:150px>Tanggal</td>
            <td>:</td>
            <td>{{ Helper::formatIndo($purchase["detail"]->purchase_date) }}</td>
        </tr>
      </table>
    </div>
	  <div class="table table-responsive">
		<table class="table table-bordered">
			<thead>
        <tr class="bg-table">
          <th colspan="7">Data Obat</th>
        </tr>
				<tr class="bg-table">
					<th width="50px">No. </th>
          <th width="150px">Kode Obat</th>
          <th>Nama Obat</th> 
          <th width="150px">Harga</th>
          <th width="150px">Jumlah</th> 
          <th width="150px">Total Harga</th>
				</tr>
			</thead>
      <tbody id="list-item">
        <?php  $no = 0;$total=0; ?>
        @foreach ($purchase["item"] as $key => $item)
        <?php  $no++ ;$total+=($item->price* $item->amount); ?>
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $item->medicine->code}}</td>
            <td>{{ $item->medicine->name}}</td>
            <td  align="right">@rupiah($item->price)</td>
            <td>{{ $item->amount}}</td>
            <td align="right">@rupiah($item->price* $item->amount)</td>
        </tr>
        @endforeach
        <tr>
          <td colspan="5" align="right">Total Harga :</td>
          <td align="right" >@rupiah($total) </td>
        </tr>
      </tbody>
    </table>
  </div>
  </fieldset>
  </section>
  <!-- /.content -->
</div>
@endsection('content')