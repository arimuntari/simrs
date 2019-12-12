
@extends('admin/layout')

@section('title', $title)

@section('content')
<?php $harga = 0;?>
<div class="container exam-content">
  <section class="content">
  <fieldset>
	  <legend><h4> {!! $icon." ".$title !!}</h4></legend>
      <div class="row">
        <div class="col-md-6">    
          <div class="row ">
            <div class="col-md-4">
              <div class="row">
                <div class="col-xs-12">
                   <a href="{{ route('exam.index')  }}" class="btn btn-default btn-block btn-sm"> <i class="fa fa-sync"></i> Refresh 
                   </a>
                </div> 
              </div> 
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-7">
              <div class="row">
                <form method="get" autocomplete="off" class="form-horizontal" action="{{  route('exam.index')  }}">
  	              <div class="col-xs-9 col-md-8 col-lg-8">
  	                <div class="input-group input-group-md">
  	                  <input type="text" name="key" value="{{ $key }}" class="form-control datepicker input-sm" placeholder="Masukkan Tanggal">
  	                  <span class="input-group-btn">
  	                      <button type="submit" class="btn btn-warning btn-flat btn-sm"><i class="fa fa-search"></i> Tampil</button>
  	                  </span>
  	                </div>
  	              </div>
  		          <div class="col-xs-3 col-md-3  col-lg-4" style="font-size:13px;">
  		          	<p class="form-control-static pull-right"><b>Total Data :  {{ $registers->count() }}</b></p>
  		          </div>
                </form>
              </div>
            </div>
          </div>
      @if(Session::has('success'))<br>
        <span class="label label-success">{{ Session::get('success') }} </span>
      @endif
      @if(Session::has('fail'))<br>
        <span class="label label-danger">{{ Session::get('fail') }}</span>
      @endif
  	  <div class="table table-responsive mt-3">
        @csrf
    		<table class="table table-bordered table-hover exam">
    			<thead>
    				<tr class="bg-table">
    					<th  width="50px">No. </th>
              <th nowrap>Kode Pasien</th>
              <th nowrap>Nama Pasien </th>
              <th>Tgl. Lahir</th>
              <th nowrap>Jam. Register</th>
    				</tr>
    			</thead>
    			<tbody>
            <?php  $no = 1 ; $bg = "";?>
            @foreach($registers as $register)
            <?php $bg = '';?>
            @if($register->status==1) @php $bg = 'bg-danger' @endphp @endif
    				<tr class="<?php echo $bg;?>"  onclick="window.location.href = '{{route('exam.view', $register->id)}}';">
    					<td>{{ $no }}. </td>
              <td nowrap>{!! $register->patient->code." (".$register->no_register.")" !!}</td>
    					<td nowrap>{!! $register->patient->name!!}</td>
              <td nowrap align="center">{{ Helper::toIndo($register->patient->birthdate) }}</td>
              <td nowrap align="center">{{ $register->time }}</td>
    				</tr>
            <?php  $no++ ;?>
            @endforeach
    			</tbody>
    		</table>
  	  </div>
    </div>
      <div class="col-md-6">
        <div class="table table-responsive my-0">
          <form action="{{ route('exam.store.diagnosis') }}" method="POST">
            @csrf
          <input type="hidden" name="register_id" value="{{ $register_id }}"> 
          <table class="table table-bordered exam">
            <thead>
              <tr class="bg-table">
                <th colspan="3">Pemeriksaan Diagnosa</th>
              </tr>
              <tr class="bg-table">
                <th  width="30">No</th>
                <th>Nama Diagnosa</th>
                <th></th>
              </tr>
              <tr class="bg-table">
                <th></th>
                <th><select type="text" class="diagnosis" name="diagnosis_id" style="width:100%;"></select></th>
                <th style="text-align: center;"><button type="submin" class="btn btn-success btn-sm " name="button-diagnosa"><i class="fa fa-save"></i></button></th>
              </tr>
            </thead>
            <tbody>
              <?php  $no = 1 ; $bg = "";?>
              @if(!empty($diagnosis))
              @foreach($diagnosis as $checkup)

              <tr class="<?php echo $bg;?>">
                <td>{{ $no }}. </td>
                <td nowrap>{!! $checkup->diagnosis->name !!}</td>
                <td style="text-align: center;"> 
                  <a type="button" href="{{ route('exam.destroy.diagnosis', $checkup->id)}}"
                     onclick="if(confirm('Apakah Anda yakin untuk Menghapus Data ini?')){ return true;}" 
                    class="btn btn-danger btn-sm" 
                    title="Tombol Untuk Hapus">
                    <i class="fa fa-trash"></i>
                  </a>
                </td>
              </tr>
              <?php  $no++ ;?>
              @endforeach
              @endif
            </tbody>
          </table>
          </form>
       </div>
        <div class="table table-responsive my-0">
          <form action="{{ route('exam.store.action') }}" method="POST">
            @csrf
          <input type="hidden" name="register_id" value="{{ $register_id }}"> 
          <table class="table table-bordered exam">
            <thead>
              <tr class="bg-table">
                <th colspan="4">Pemeriksaan Tindakan</th>
              </tr>
              <tr class="bg-table">
                <th width="30"></th>
                <th>Nama Tindakan</th>
                <th width="50">Harga</th>
                <th></th>
              </tr>
              <tr class="bg-table">
                <th></th>
                <th><select type="text" class="form-control input-xs action" onchange="getAction()" name="action_id" style="width:100%;"></select></th>
                <th width="100px"><input type="text" class="form-control input-xs" readonly id="price" name="price" style="width:100%;"></th>
                <th style="text-align: center;"><button type="submit" class="btn btn-success btn-sm " name="button-diagnosa"><i class="fa fa-save"></i></button></th>
              </tr>
            </thead>
            <tbody>
              <?php  $no = 1 ; $bg = "";$totalAction = 0;?>
              @if(!empty($actions))
              @foreach($actions as $checkup)
              <?php $totalAction += $checkup->price;?>
              <tr class="<?php echo $bg;?>">
                <td>{{ $no }}. </td>
                <td nowrap>{!! $checkup->action->name !!}</td>
                <td align="right">@rupiah($checkup->price)</td>
                <td style="text-align: center;"> 
                  <a type="button" href="{{ route('exam.destroy.action', $checkup->id)}}"
                     onclick="if(confirm('Apakah Anda yakin untuk Menghapus Data ini?')){ return true;}" 
                    class="btn btn-danger btn-sm" 
                    title="Tombol Untuk Hapus">
                    <i class="fa fa-trash"></i>
                  </a>
                </td>
              </tr>
              <?php  $no++ ;?>
              @endforeach
              <tr>
                <td colspan="2" align="right">Total Tindakan:</td>
                <td align="right">@rupiah($totalAction)</td>
                <td></td>
              </tr>
              @endif
            </tbody>
          </table>
          </form>
       </div>
        <div class="table table-responsive my-0">
          <form action="{{ route('exam.store.medicine') }}" method="POST">
            @csrf
          <input type="hidden" name="register_id" value="{{ $register_id }}"> 
          <table class="table table-bordered exam">
            <thead>
              <tr class="bg-table">
                <th colspan="5">Pemeriksaan Obat</th>
              </tr>
              <tr class="bg-table">
                <th width="30"></th>
                <th>Nama Obat</th>
                <th width="50">Jumlah</th>
                <th width="50">Harga</th>
                <th></th>
              </tr>
              <tr class="bg-table">
                <th></th>
                <th><select type="text" class="form-control input-xs medicine" onchange="getMedicine()" name="medicine_id" style="width:100%;"></select></th>
                <th width="60px"><input type="text" class="form-control input-xs" onkeyup="checkAmount();" id="amount" name="amount" style="width:100%;"></th>
                <th width="100px"><input type="text" class="form-control input-xs" readonly id="price2" name="price" style="width:100%;"></th>
                <th style="text-align: center;"><button type="submit" class="btn btn-success btn-sm " name="button-diagnosa"><i class="fa fa-save"></i></button></th>
              </tr>
            </thead>
            <tbody>
              <?php  $no = 1 ; $bg = "";$totalMedicine = 0;?>
              @if(!empty($medicines))
              @foreach($medicines as $checkup)
              <?php $totalMedicine += $checkup->price;?>
              <tr class="<?php echo $bg;?>">
                <td>{{ $no }}. </td>
                <td nowrap>{!! $checkup->medicine->name !!}</td>
                <td nowrap>{!! $checkup->amount !!}</td>
                <td align="right">@rupiah($checkup->price)</td>
                <td style="text-align: center;"> 
                  <a type="button" href="{{ route('exam.destroy.medicine', $checkup->id)}}"
                     onclick="if(confirm('Apakah Anda yakin untuk Menghapus Data ini?')){ return true;}" 
                    class="btn btn-danger btn-sm" 
                    title="Tombol Untuk Hapus">
                    <i class="fa fa-trash"></i>
                  </a>
                </td>
              </tr>
              <?php  $no++ ;?>
              @endforeach
              <tr>
                <td colspan="3" align="right">Total Obat:</td>
                <td align="right">@rupiah($totalMedicine)</td>
                <td></td>
              </tr>
              @endif
              <tr>
                <td colspan="3" align="right">Total Pembayaran:</td>
                <td align="right">@rupiah($totalMedicine+$totalAction)</td>
                <td></td>
              </tr>
            </tbody>
          </table>
          </form><br>
          <form action="{{ route('exam.save') }}" method="POST">
            @csrf
            <input type="hidden" name="register_id" value="{{ $register_id}}">
            <input type="hidden" name="price_total" value="{{ $totalMedicine+$totalAction}}">
            <button type="submit" class="btn btn-success btn-sm">Selesai Pemeriksaan</button>
          </form>
       </div>
      </div>
    </div>
  </fieldset>
  </section>
  <!-- /.content -->
</div>
@endsection('content')

@section('script')
<script>
  $('.diagnosis').select2({
    placeholder: 'Cari Diagnosis...',
    ajax: {
      url: '/autocomplete/diagnosis',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            return {
              text: item.name,
              id: item.id
            }
          })
        };
      },
      cache: true
    }
  });

  $('.action').select2({
    placeholder: 'Cari Tindakan...',
    ajax: {
      url: '/autocomplete/action',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            return {
              text: item.name+" | "+item.price,
              price: item.price,
              id: item.id
            }
          })
        };
      },
      cache: true
    }
  });

  function getAction(){
    var data = $('.action').select2('data'); 
    $("#price").val(data[0].price);
  }

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
    $("#price2").val(data[0].price);
    checkAmount();
  }

  function checkAmount(){
    var data = $('.medicine').select2('data'); 
    amount =  $("#amount").val();
    if(amount > data[0].stock ){
      alert("Jumlah tidak boleh lebih besar dari stock!!");
      $("#amount").val(data[0].stock);
    }
  }
</script>
@endsection('script')