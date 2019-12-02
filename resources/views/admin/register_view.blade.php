
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
                 <a href="{{ route('register.index')  }}" class="btn btn-default btn-block"> <i class="fa fa-sync"></i> Refresh 
                 </a>
              </div> 
            </div> 
          </div>
          <div class="col-md-1">
          </div>
          <div class="col-md-7">
            <div class="row">
              <form method="get" autocomplete="off" class="form-horizontal" action="{{  route('register.index')  }}">
	              <div class="col-xs-12 col-md-2  col-lg-2">
	                <p class="form-control-static"><b>Pencarian:</b></p>
	              </div>
	              <div class="col-xs-9 col-md-8 col-lg-8">
	                <div class="input-group input-group-md">
	                  <input type="text" name="key" value="{{ $key }}" class="form-control datepicker" placeholder="Masukkan Tanggal">
	                  <span class="input-group-btn">
	                      <button type="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i> Tampil</button>
	                  </span>
	                </div>
	              </div>
		          <div class="col-xs-3 col-md-3  col-lg-2" style="font-size:13px;">
		          	<p class="form-control-static pull-right"><b>Total Data :  {{ $registers->count() }}</b></p>
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
      <form action="{{ route('register.store')  }}" method="POST">
         @csrf
		<table class="table table-bordered">
			<thead>
				<tr class="bg-table">
					<th  width="50px">No. </th>
          <th width="250px">Kode Pasien</th>
          <th>Nama Pasien </th>
          <th style="width:70px">Tgl. Lahir</th>
          <th width="150px">No. Telp</th>
          <th width="150px">Alamat</th>
					<th width="100px"> &nbsp;</th>
				</tr>
        <tr class="bg-table">
          <th  width="50px"></th>
          <th>
            <input type="hidden" name="code" id="code">
            <select type="text" class="id form-control input-xs" name="id" onchange="getDetail();"></select>
          </th>
          <th><input type="text" name="name" class="form-control input-xs" id="name"></th>
          <th><input type="text" name="birthdate" class="form-control input-xs datepicker" id="birthdate" style="width:100%;"></th>
          <th><input type="text" name="phone_number" class="form-control input-xs" id="phone_number"></th>
          <th><input type="text" name="address" class="form-control input-xs" id="address"></th>
          <th style="text-align: center"> <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i></button></th>
        </tr>
			</thead>
			<tbody>
        <?php  $no = 1 ; ?>
        @foreach($registers as $register)
				<tr>
					<td>{{ $no }}. </td>
          <td>{!! $register->patient->code." (".$register->no_register.")" !!}</td>
					<td>{!! $register->patient->name!!}</td>
          <td>{{ Helper::toIndo($register->patient->birthdate) }}</td>
          <td align="right">{{ $register->patient->phone_number }}</td>
          <td>{{ $register->patient->address }}</td>
          <td style="word-wrap: nowrap" align="center">
             <a type="button" href="{{ route('register.destroy', $register->id)}}"
              onclick="if(confirm('Apakah Anda yakin untuk Menghapus Data ini?')){ return true;}" 
              class="btn btn-danger btn-sm" 
              title="Tombol Untuk Hapus">
              <i class="fa fa-trash"></i>
             </a>
          </td>
				</tr>
        <?php  $no++ ;?>
        @endforeach
			</tbody>
		</table>
    </form>
	  </div>
  </fieldset>
  </section>
  <!-- /.content -->
</div>
@endsection('content')
@section('script')
<script>
   $('.id').select2({
    placeholder: 'Cari Patient...',
    ajax: {
      url: '/autocomplete/patient',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            return {
              text: item.code+" | "+item.name,
              id: item.id,
              code: item.code,
              name: item.name,
              birthdate: item.birthdate,
              phone_number: item.phone_number,
              address: item.address
            }
          })
        };
      },
      cache: true
    }
  });
   function getDetail(){
      var data = $('.id').select2('data'); 
      $("#code").val(data[0].code);
      $("#name").val(data[0].name);
      $("#birthdate").val(data[0].birthdate);
      $("#phone_number").val(data[0].phone_number);
      $("#address").val(data[0].address);
   }
</script>
@endsection('script')