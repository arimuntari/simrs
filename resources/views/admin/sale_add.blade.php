
@extends('admin/layout')

@section('title', $title)

@section('content')
<div class="container">
  <section class="content">
  <fieldset>
	  <legend><h4> {!! $icon." ".$title !!}</h4></legend>

    <form  action="{{ route('sale.store') }}" autocomplete="off" method="post" enctype="multipart/form-data">
      @csrf
    <div class="table table-responsive mt-3" style="margin-bottom: 0px;">
      <table class="table table-bordered" style="margin-bottom: 0px;">
        <tr class="bg-table">
          <th colspan="6">Penjualan</th>
        </tr>
        <tr bgcolor="#ccc">
            <td width:150px>Kode Penjualan</td>
            <td>:</td>
            <td><input type="text" name="code" class="form-control input-xs" style="width:auto" value="{{ Helper::codeSale() }}"></td>
            <td width:150px>Tanggal</td>
            <td>:</td>
            <td><input type="text" name="sale_date" class="form-control input-xs datepicker" style="width:auto" value="{{ date('Y-m-d') }}"></td>
        </tr>
      </table>
    </div>
	  <div class="table table-responsive">
		<table class="table table-bordered">
			<thead>
        <tr class="bg-table">
          <th colspan="6">Data Obat</th>
        </tr>
				<tr class="bg-table">
					<th width="50px">No. </th>
          <th >Kode | Nama Obat | Stok | Harga</th>
          <th width="150px">Jumlah</th> 
          <th width="150px">Harga</th>
          <th width="150px">Total Harga</th>
					<th width="100px"> &nbsp;</th>
				</tr>
        <tr>
          <th></th>
          <th><select type="text" class="form-control input-xs medicine" onchange="getMedicine()" id="medicine_id" name="medicine_id" style="width:100%;"></select></th>
          <th width="60px"><input type="text" class="form-control input-xs" onkeyup="checkAmount();" id="amount" name="amount" style="width:100%;"></th>
          <th width="100px"><input type="text" class="form-control input-xs" readonly id="price" name="price" style="width:100%;"></th>
          <th width="100px"><input type="text" class="form-control input-xs" readonly id="price_total" name="price_total" style="width:100%;"></th>
          <th style="text-align: center;"><button type="button" onclick="saveitem();" class="btn btn-success btn-sm " name="button-diagnosa"><i class="fa fa-save"></i></button></th>
        </tr>
			</thead>
      <tbody id="list-item">
      </tbody>
    </table>
  </div>
  <button type="submit" class="btn btn-success btn-sm">Simpan</button>
</form>
  </fieldset>
  </section>
  <!-- /.content -->
</div>
@endsection('content')
@section('script')
<script>
   $('.medicine').select2({
    placeholder: 'Cari Obat...',
    ajax: {
      url: '/autocomplete/medicine',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            return {
              text: item.code+" | "+item.name+" | "+item.stock+" | "+item.sell_price,
              code: item.code,
              stock: item.stock,
              price: item.sell_price,
              id: item.id
            }
          })
        };
      },
      cache: true
    }
  });
  function getMedicine(){
    var data = $('.medicine').select2('data'); 
    $("#price").val(data[0].price);
    checkAmount();
  }

  function checkAmount(){
    var data = $('.medicine').select2('data'); 
    amount =  $("#amount").val();
    if(parseInt(amount) > parseInt(data[0].stock) ){
      alert("Jumlah tidak boleh lebih besar dari stock!!");
      $("#amount").val(data[0].stock);
    }
    price = data[0].price;
    total = price * amount;
    $("#price_total").val(total);
  }

  function saveitem(){
    medicine_id = $('#medicine_id').val();
    amount = $('#amount').val(); 
    price = $('#price').val(); 
    var data = $('.medicine').select2('data');     
    stock = parseFloat(data[0].stock);

    if(data == ''){
      alert("Anda Belum Memilih Barang");
    }else if(amount == ''){
      alert("Anda Belum Memasukkan Jumlah");
    }else if(parseInt(stock) < parseInt(amount)){
      alert("Stok Kurang");
    }else{
      data = { medicine_id :medicine_id, amount : amount };
      $.ajax({
        url: "saveitem",
        data: data,
        success: function(result){
          $("#list-item").load("listitem");
        }
      });
    }
  }
</script>
@endsection('script')