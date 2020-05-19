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
					<form action="{{ route('image.update') }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<input type="hidden" name="image_id" value="{{ $images->id }}">
						<div class="form-group row">
							<label for="image_path" class="col-md-4 col-form-label text-md-right">Imagen</label>
							<div class="col-md-7">
							<div class="container-avatar">
								<img src="{{ route('image.file',['filename'=>$images->image_path ]) }}" alt="" class="avatar">
							</div>
								<input type="file" id="image_path" name="image_path" class="form-control @error('image_path') is-invalid @enderror border-0">

							</div>
						</div>
						<div class="form-group row">
							<label for="description" class="col-md-4 col-form-label text-md-right">Descripcion</label>
							<div class="col-md-7">
								<textarea type="file" id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ $images->description }}</textarea>
								@error('description')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-6 offset-md-4">
								<input type="submit" class="btn btn-primary" value="Actualizar imagen">
							</div>
						</div>

					</form>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection
