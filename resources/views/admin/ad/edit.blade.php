@extends('admin.layouts.master')

@section('title', 'Sửa Quảng cáo')

@section('content')

<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ route('admin.ad.index') }}" class="btn btn-success">Danh sách Quảng cáo</a>
		<a href="{{ route('admin.ad.create') }}" class="btn btn-primary">Thêm Quảng cáo</a>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<form method="POST" action="{{ route('admin.ad.update', $data->id) }}" accept-charset="UTF-8">
				<input name="_method" type="hidden" value="PUT">
				{!! method_field('PUT') !!}
				{!! csrf_field() !!}
				<div class="box-header">
					<h3 class="box-title">Sửa Quảng cáo</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label for="name">Name</label>
						<div class="row">
							<div class="col-sm-8">
								<input name="name" type="text" value="{{ $data->name }}" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="position">Vị trí</label>
						<div class="row">
							<div class="col-sm-8">
							{!! Form::select('position', CommonOption::adPositionArray(), $data->position, array('class' =>'form-control')) !!}
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="code">Mã quảng cáo</label>
						<div class="row">
							<div class="col-sm-8">
								<textarea name="code" class="form-control" rows="5">{{ $data->code }}</textarea>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-8">
							@include('admin.common.inputStatusLang', array('isEdit' => true))
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