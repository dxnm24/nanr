@extends('admin.layouts.master')

@section('title', 'Sửa post')

@section('content')

<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ route('admin.post.index') }}" class="btn btn-success">Danh sách post</a>
		<a href="{{ route('admin.post.create') }}" class="btn btn-primary">Thêm post</a>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<form method="POST" action="{{ route('admin.post.update', $data->id) }}" accept-charset="UTF-8">
				<input name="_method" type="hidden" value="PUT">
				{!! method_field('PUT') !!}
				{!! csrf_field() !!}
				<div class="box-header">
					<h3 class="box-title">Sửa post</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-sm-8">
							<div class="form-group">
								<label for="name">Name</label>
								<div class="row">
									<div class="col-sm-12">
										<input name="name" type="text" value="{{ $data->name }}" class="form-control" onkeyup="convert_to_slug(this.value);">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="slug">Slug</label>
								<div class="row">
									<div class="col-sm-12">
										<input name="slug" type="text" value="{{ $data->slug }}" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group" style="display: none;">
								<label for="type">Dạng bài viết</label>
								<div class="row">
									<div class="col-sm-12">
									{!! Form::select('type', CommonOption::typePostArray(), $data->type, array('class' => 'form-control')) !!}
									</div>
								</div>
							</div>
							<div class="form-group" style="display: none;">
								<label for="url">Đường dẫn file</label>
								<div class="row">
									<div class="col-sm-12">
										<input name="url" type="text" value="{{ $data->url }}" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="start_date">Ngày đăng</label>
								<div class="row">
									<div class="col-sm-6">
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input name="start_date" type="text" value="{{ CommonMethod::datetimeToArray($data->start_date, 1) }}" class="form-control pull-right datepicker">
						                </div>
									</div>
									<div class="col-sm-6">
										<div class="bootstrap-timepicker">
											<div class="input-group">
												<input name="start_time" type="text" value="{{ CommonMethod::datetimeToArray($data->start_date, 2) }}" class="form-control timepicker">
												<div class="input-group-addon">
													<i class="fa fa-clock-o"></i>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
							@include('admin.common.inputStatusLang', array('isEdit' => true))
							@include('admin.common.inputContent', array('isEdit' => true))
							@include('admin.common.inputMeta', array('isEdit' => true))
						</div>
						<div class="col-sm-4">
							@include('admin.post.posttype', array('isEdit' => true, 'data' => $data))
							@include('admin.post.posttag', array('isEdit' => true, 'data' => $data))
							<div class="form-group">
								<label>Đây là bài viết thành phần/nguyên liệu</label>
								<div class="row">
									<div class="col-sm-12">
										{!! Form::select('is_material', CommonOption::statusArray(), $data->is_material, array('class' =>'form-control')) !!}
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Tên thành phần/nguyên liệu</label>
								<div class="row">
									<div class="col-sm-12">
										<input name="material" type="text" value="{{ $data->material }}" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Ảnh nguyên liệu</label>
								<p>Kích cỡ: 100x100. Định dạng jpg, jpeg, png. Tên thư mục & ảnh phải là không dấu, không chứa dấu cách + kí tự đặc biệt. Dung lượng ảnh nhẹ (< 1mb)<br>Auto crop thumbnail: 420x270</p>
								<div class="row">
									<div class="col-sm-12">
										<div class="row">
											<div class="col-sm-7">
												<input name="material_image" type="text" value="{{ $data->material_image }}" class="form-control" readonly id="url_abs3" onchange="GetFilenameFromPath2('url_abs3', 2);">
											</div>
											<div class="col-sm-5">
									            <a href="/adminlte/plugins/tinymce/plugins/filemanager/dialog.php?type=1&field_id=url_abs3&akey={{ AKEY }}" class="iframe-btn" type="button"><input class="btn btn-primary" type="button" value="Chọn hình..." /></a>
											</div>
										</div>
									</div>
								</div>
							</div>
							@include('admin.post.postmaterial', array('isEdit' => true, 'data' => $data))
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