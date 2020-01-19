
@extends('admin/layout')

@section('title', $title)

@section('content')
<div class="container">
  <!-- Main content -->
  <section class="content">
   <h4><i class="fa fa-chart"></i> Home</h4>
   <div class="row">
      <div class="col-md-6">
         <div class="panel panel-warning">
           <div class="panel-heading">Chart Laporan Pengeluaran dan Pemasukan</div>
           <div class="panel-body" id="cart-outcome">Panel Content</div>
       </div>
   </div>
   <div class="col-md-6">
     <div class="panel panel-primary">
       <div class="panel-heading">Laporan Stok</div>
       <div class="panel-body"  id="cart-now">
           
           <div class="table table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-table">
                        <th  width="50px">No. </th>
                        <th width="150px">Kode Obat</th>
                        <th width="150px">Nama Obat</th>
                        <th width="150px">Stok Awal</th>
                        <th width="150px">Stok Beli</th>
                        <th width="150px">Stok Jual</th>
                        <th width="150px">Stok Sisa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  $no= 1; ?>
                    @foreach($items as $item)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{!! $item['code'] !!}</td>
                        <td>{!! $item['name'] !!}</td>
                        <td>{{ $item['stock']-$item['stock_plus']+$item['stock_minus'] }}</td>
                        <td>{{ $item['stock_plus'] }}</td>
                        <td>{{ $item['stock_minus'] }}</td>
                        <td>{{ $item['stock'] }}</td>
                    </tr>
                    <?php  $no++ ;?>
                    @endforeach
                </tbody>
            </table>
        </div>         
    </div>
</div>
</div>
</div>
</section>
<!-- /.content -->
</div>
@endsection('content')
@section('script')
<script>
	Highcharts.chart('cart-outcome', {

        title: {
            text: 'Laporan Pengeluaran dan Pemasukan Harian'
        },

        subtitle: {
            text: ''
        },

        yAxis: {
            title: {
                text: 'Total'
            }
        },
        xAxis: {
            categories: <?php echo json_encode($date);?>
        },
        legend: {
            align: 'left',
            verticalAlign: 'top',
            borderWidth: 0
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
            }
        },

        series: [{
            name: 'Pengeluaran',
            data: <?php echo json_encode($purchase)?>
        }, {
            name: 'Pendapatan',
            data: <?php echo json_encode($sale)?>
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
</script>
@endsection('script')