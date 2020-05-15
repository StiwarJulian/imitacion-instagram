<div class="card pub_image">
	<div class="card-header">
		<div class="container-avatar">
			<img src="{{ route('user.avatar',['filename'=>$image->user->image ]) }}" alt="" class="avatar">
		</div>


		<div class="data-user">
			<a href="{{ route('user.profile', ['id'=> $image->user->id]) }}">
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
