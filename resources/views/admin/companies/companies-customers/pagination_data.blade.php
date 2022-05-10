@foreach($users as $key => $row)
<tr>
 <td>{{ ++$key}}</td>
 <td>{{ $row->name }}</td>
 <td>{{ $row->email }}</td>
 <td>{{ $row->phone }}</td>
 <td>{{ $row->city }}</td>
 <td>{{ $row->country }}</td>
 <td>{{ $row->payment_status == '1' ? 'Paying' : 'Not Paying' }}</td>
 <td>{{ $row->transactions_count }}</td>
 <td></td>
</tr>
@endforeach
<tr>
 <td colspan="9" align="center">
  {!! $users->links() !!}
 </td>
</tr>