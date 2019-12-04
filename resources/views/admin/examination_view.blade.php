
@extends('admin/layout')

@section('title', $title)

@section('content')
<div class="container">
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
        <div class="table table-responsive mt-3">
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
                <th><input type="text" class="diagnosis" name="diagnosis_id" style="width:100%;"></th>
                <th style="text-align: center;"><button type="button" class="btn btn-success btn-sm " name="button-diagnosa"><i class="fa fa-save"></i></button></th>
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
                  <a type="button" href="{{ route('exam.destroyDiagnosa', $register->id)}}"
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
       </div>
        <div class="table table-responsive mt-3">
          <table class="table table-bordered exam">
            <thead>
              <tr class="bg-table">
                <th colspan="4">Pemeriksaan Tindakan</th>
              </tr>
              <tr class="bg-table">
                <th width="30"></th>
                <th>Nama Tindakan</th>
                <th>Harga</th>
                <th></th>
              </tr>
              <tr class="bg-table">
                <th></th>
                <th ><input type="text" name="diagnosa_id" style="width:100%;"></th>
                <th></th>
                <th style="text-align: center;"><button type="button" class="btn btn-success btn-sm " name="button-diagnosa"><i class="fa fa-save"></i></button></th>
              </tr>
            </thead>
            <tbody>
              <?php  $no = 1 ; $bg = "";?>
              @if(!empty($diagnosis))
              @foreach($actions as $checkup)
              <tr class="<?php echo $bg;?>">
                <td>{{ $no }}. </td>
                <td nowrap>{!! $checkup->action->name !!}</td>
                <td>{!! $action->price !!}</td>
                <td style="text-align: center;"> 
                  <a type="button" href="{{ route('exam.destroyDiagnosa', $register->id)}}"
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
</script>
@endsection('script')