@extends('admin.layouts.master')

@section('title', 'Config')

@section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<form method="POST" action="{{ route('admin.config.update', $data->id) }}" accept-charset="UTF-8">
				<input name="_method" type="hidden" value="PUT">
				{!! method_field('PUT') !!}
				{!! csrf_field() !!}
				<div class="box-header">
					<h3 class="box-title">Config home</h3>
				</div>
				<div class="box-body">
					<div class="form-group" style="display: block;">
						<label for="code">Code</label>
						<p>Google analytics, facebook code...</p>
						<div class="row">
							<div class="col-sm-8">
								<textarea name="code" class="form-control" rows="5">{{ $data->code }}</textarea>
							</div>
						</div>
					</div>
					<div class="form-group" style="display: block;">
						<label for="facebook_app_id">Facebook App ID</label>
						<div class="row">
							<div class="col-sm-8">
								<input name="facebook_app_id" type="text" value="{{ $data->facebook_app_id }}" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group" style="display: none;">
						<label for="credit">Credit</label>
						<p>Đoạn giới thiệu cuối trang</p>
						<div class="row">
							<div class="col-sm-8">
								<textarea name="credit" class="form-control textarea" rows="5">{{ $data->credit }}</textarea>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-8">
							@include('admin.common.inputMeta', array('isEdit' => true))
						</div>
					</div>
					
				</div>
				<div class="box-footer">
					<input type="submit" class="btn btn-primary" value="Lưu lại" />
					<input type="reset" class="btn btn-default" value="Nhập lại" />
				</div>
			</form>
		</div>
	</div>
</div>

@stop