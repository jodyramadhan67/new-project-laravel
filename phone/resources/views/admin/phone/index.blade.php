@extends('layouts.admin')
@section('header', 'Phone')

@section('content')
<div class="row">
	<div class="card">
		<div class="card-header">
			<a href="{{ url('phones/create') }}" class="btn btn-sm btn-primary pull-right">Add New Phone</a>
		</div>
		 
		<div class="card-body">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th style="width: 50px">No</th>
						<th class="text-center">Brand</th>
						<th class="text-center">Type</th>
						<th class="text-center">Imei</th>
                        <th class="text-center">Spec</th>
						<th class="text-center">Created At</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($phones as $key => $phone)
					<tr>
						<td>{{ $key+1 }}</td>
						<td>{{ $phone->brand }}</td>
                        <td>{{ $phone->type }}</td>
                        <td>{{ $phone->imei }}</td>
                        <td>{{ $phone->spec }}</td>
						<td>{{ convert_date($phone->created_at) }}</td>
						<td class="text-center">
							<a href="{{ url('phones/'.$phone->id.'/edit') }}" class="btn btn-warning btn-sm">Edit</a>

							<form action="{{ url('phones', ['id' => $phone->id]) }}" method="post">
								<input class="btn btn-danger btn-sm" type="submit" value="delete" onclick="return confirm('Are you sure?')">
								@method('delete')
								@csrf
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>					
			</table>
		</div>

	<!-- <div class="card-footer clearfix">
			<ul class="pagination pagination-sm m-0 float-right">
				<li class="page-item"><a class="page-link" href="#">«</a></li>
				<li class="page-item"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item"><a class="page-link" href="#">»</a></li>
			</ul>
		</div> -->
		</div>
	</div>
</div>
@endsection
