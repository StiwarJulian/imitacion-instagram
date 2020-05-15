@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-7">
			@if(session('message') )
			<div class="alert alert-danger"> {{ session('message') }} </div>

			@endif

			<div class="card pub_image pub_image_detail">
				<div class="card-header">
					<div class="container-avatar">
						<img src="{{ route('user.avatar',['filename'=>$image->user->image ]) }}" alt="" class="avatar">
					</div>

					<div class="data-user">
						{{ $image->user->name.' '.$image->user->surname	}}
						<span class="nickname">
							{{' | @'.$image->user->nick }}
						</span>

					</div>
				</div>

				<div class="card-body">
					<div class="image-container image-detail">
						<img src="{{ route('image.file', ['filename'=>$image->image_path]) }}" alt="">
					</div>

					<div class="description">
						<span class="nickname">{{ '@'.$image->user->nick }}</span>
						<span class="nickname date">{{ ' | '.\Carbon\Carbon::now()->diffForHumans($image->created_at)	}}</span>
						<p> {{$image->description}}</p>
					</div>
					<div class="likes">
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
					<div class="clearfix"></div>
					<div class="comments">
						<h2> Comentarios {{count($image->comment)}}</h2>
						<hr>

						<form action="{{ route('comment.save') }}" METHOD="POST">
							@csrf

							<input type="hidden" name="image_id" value="{{$image->id}}">

							<p>
								<textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content"></textarea>
								@error('content')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</p>

							<button type="submit" class="btn btn-success">Enviar</button>
						</form>
						<hr>
						@foreach($image->comment as $comments)
						<div class="comment">
							<span class="nickname">{{ '@'.$comments->user->nick }}</span>
							<span class="nickname date">{{ ' | '.\Carbon\Carbon::now()->diffForHumans($comments->created_at)	}}</span>
							<p class="parrafo"> {{$comments->content}}

								@if(Auth::check() && (Auth::user()->id == $comments->user_id || $comments->image->user_id == Auth::user()->id))
								<a href="{{ route('comment.delete', ['id'=>$comments->id]) }}" style="margin-left: 10px">
									Eliminar
								</a>
								@endif
							</p>
						</div>

						@endforeach
					</div>
				</div>
			</div>

		</div>

	</div>
</div>
@endsection
