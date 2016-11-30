@extends('admin.layouts.master')

@section('title', 'Liên hệ')

@section('content')

@include('admin.contact.search')

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Liên hệ</h3><i> - Total: {{ $data->total() }}</i>
			</div>
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Tel</th>
						<th>Msg</th>
						<th>Ngày tạo</th>
						<th style="width:100px;">Action</th>
					</tr>
					@foreach($data as $key => $value)
					<tr>
						<td>{{ $value->name }}</td>
						<td>{{ $value->email }}</td>
						<td>{{ $value->tel }}</td>
						<td style="word-break: keep-all; width:300px;">{{ $value->msg }}</td>
						<td>{{ $value->created_at }}</td>
						<td>
							<form method="POST" action="{{ route('admin.contact.destroy', $value->id) }}" style="display: inline-block;">
								{{ method_field('DELETE') }}
								{{ csrf_field() }}
								<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
							</form>
						</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
		{{ $data->links() }}
	</div>
</div>

@stop