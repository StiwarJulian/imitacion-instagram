@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			@if(session('message'))
			<div class="alert alert-success"> {{ session('message') ?? 'is invalid'}} </div>
			@endif

			<div class="card pub_image">
				<div class="card-header">
					@if(Auth::user()->image)
					<div class="container-avatar">
						<img src="{{ route('user.avatar',['filename'=>Auth::user()->image ]) }}" alt="" class="avatar">
					</div>
					@endif

					<div class="data-user">
						{{ $image->user->name.' '.$image->user->surname	}}
						<span class="nickname">
							{{' | @'.$image->user->nick }}
						</span>

					</div>
				</div>

				<div class="card-body">
					<div class="image-container">
						<img src="{{ route('image.file', ['filename'=>$image->image_path]) }}" alt="">
					</div>

					<div class="description">
						<span class="nickname">{{ '@'.$image->user->nick }}</span>
						<span class="nickname date">{{ ' | '.\Carbon\Carbon::now()->diffForHumans($image->created_at)	}}</span>
						<p> {{$image->description}}</p>
					</div>
					<div class="likes">
						<img src="{{asset('img/heart-black.png')}}" alt="">
					</div>
					<div class="comments">
						<a href="" class="btn btn-warning btn-sm btn-comments">Comentarios( {{count($image->comment)}} )</a>
					</div>
				</div>
			</div>

		</div>

	</div>
</div>
@endsection