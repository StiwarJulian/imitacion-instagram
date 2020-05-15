@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			@if(session('message'))
			<div class="alert alert-success"> {{ session('message') ?? 'is invalid'}} </div>
			@endif

			@foreach($images as $image)

			<div class="card pub_image">
				<div class="card-header">
					@if(Auth::user()->image)
					<div class="container-avatar">
						<img src="{{ route('user.avatar',['filename'=>Auth::user()->image ]) }}" alt="" class="avatar">
					</div>
					@endif

					<div class="data-user">
						<a href="{{ route('image.detail', ['id'=> $image->id]) }}">
							{{ $image->user->name.' '.$image->user->surname	}}
							<span class="nickname">
								{{' | @'.$image->user->nick }}
							</span>
						</a>
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
					<div class="likes" id="likes">

						<?php $user_like = false;?>
						@foreach($image->like as $likes)

							@if($likes->user->id == Auth::user()->id)
								<?php $user_like = true;?>
							@endif

						@endforeach

						@if($user_like)
							<img src="{{asset('img/heart-red.png')}}" data-id="{{ $image->id }}" id="btn-dislike" class="btn-dislike">
						@else
							<img src="{{asset('img/heart-black.png')}}"  data-id="{{ $image->id }}" id="btn-like" class="btn-like">
						@endif
						<span class="number-likes">
							{{ count($image->like) }}
						</span>
					</div>
					<div class="comments">
						<a href="{{ route('image.detail', ['id'=> $image->id]) }}" class="btn btn-warning btn-sm btn-comments">Comentarios( {{count($image->comment)}} )</a>
					</div>
				</div>
			</div>
			@endforeach
			<!-- PAGINACION -->
			<div class="clearfix"></div>
			{{$images->links()}}
		</div>

	</div>
</div>
@endsection
