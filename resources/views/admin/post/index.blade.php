@extends('admin.layouts.master')

@section('title', 'Posts')

@section('content')

@include('admin.post.search')

<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ route('admin.post.index') }}" class="btn btn-success">Danh sách post</a>
		<a href="{{ route('admin.post.create') }}" class="btn btn-primary">Thêm post</a>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Posts</h3><i> - Total: {{ $data->total() }}</i>
			</div>
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<tr>
						<th>Image</th>
						<th>Name</th>
						<th>Thể loại chính</th>
						<!-- <th>Loại post</th> -->
						<th>Lượt xem</th>
						<th>Ngày đăng</th>
						<th>Status</th>
						<th style="width:240px;">Action</th>
					</tr>
					@foreach($data as $key => $value)
					<?php 
						$thumbnail = str_replace('/images/', '/thumbs/', $value->image);
						$thumbnail = str_replace('/thumb/', '/', $thumbnail);
					?>
					<tr>
						<td><img height="30px" src="{{ $thumbnail }}" /></td>
						<td>{{ $value->name }}</td>
						<td>{{ CommonQuery::getFieldById('post_types', $value->type_main_id, 'name') }}</td>
						<!-- <td>{{-- CommonOption::getTypePost($value->type) --}}</td> -->
						<td>{{ getZero($value->view) }}</td>
						<td>{!! CommonMethod::startDateLabel($value->start_date) !!}</td>
						<td><a id="status_{{ $value->id }}" onclick="updateStatus({{ $value->id }}, 'status')" style="cursor: pointer;" title="Click to change">{!! CommonOption::getStatus($value->status) !!}</a></td>
						<td>
							<a href="{{ CommonUrl::getUrl($value->slug) }}" class="btn btn-success" target="_blank">Xem</a>
							<a href="{{ route('admin.post.edit', $value->id) }}" class="btn btn-primary">Sửa</a>
							<form method="POST" action="{{ route('admin.post.destroy', $value->id) }}" style="display: inline-block;">
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
		{!! $data->appends($request->except('page'))->render() !!}
	</div>
</div>

@include('admin.post.script')

@stop