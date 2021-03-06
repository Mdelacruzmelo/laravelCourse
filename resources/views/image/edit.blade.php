@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					Editar mi imagen
				</div>
				<div class="card-body">

					<form method="POST" action="{{ route('image.update') }}" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name='image_id' value="{{$image->id}}">
						<div class="form-group row">
							<label class="col-md-3 col-form-label text-md-right" for="image_path">Imagen</label>
							<div class="col-md-7">

								@if($image->user->image)
								<div class="pub_image_detail float-left">
									<img class="col-12 p-0" src="{{route('image.file',['filename'=>$image->image_path])}}">
								</div>
								@endif

								<input id="image_path" type="file" name="image_path" class="form-control {{$errors->has('image_path')? 'is-invalid' :''}}">
								@if($errors->has('image_path'))
								<span class="invalid-feedback d-inline" role='alert'>
									<strong>{{$errors->first('image_path')}}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-3 col-form-label text-md-right" for="description">Description</label>
							<div class="col-md-7">
								<textarea id="description"  
																		name="description" 
																		class="form-control {{$errors->has('description')? 'is-invalid' :''}}" 
																		required>{{$image->description}}</textarea>
								@if($errors->has('description'))
								<span class="invalid-feedback d-inline" role='alert'>
									<strong>{{$errors->first('description')}}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-6 offset-md-3">
								<input type="submit" class="btn btn-success" required value="Actualizar">
							</div>
						</div>

					</form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection