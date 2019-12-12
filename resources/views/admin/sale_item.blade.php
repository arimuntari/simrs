
{{ $total = 0 }}
{{ $no = 0 }}
@foreach ($listitems as $key => $listitem)

{{ $no++ }}
{{ $total += $listitem['price_total'] }}
<tr>
	<td>{{ ($no) }}</td>
	<td>{{  $listitem['code']." | ".$listitem['name'] }}</td>
	<td>{{ $listitem['amount'] }}</td>
	<td> @rupiah($listitem['price']) </td>
	<td align="right">@rupiah($listitem['price_total']) </td>
	<td align="center"><button onclick="$('#list-item').load('{{ route("sale.destroyitem", $key) }}')" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button> </td>
</tr>
@endforeach
<tr>
	<td colspan="4" align="right">Total: </td>
	<td align="right">@rupiah($total) </td>
	<td></td>
</tr>
<input type="hidden" name="total" value="{{ $total }}">