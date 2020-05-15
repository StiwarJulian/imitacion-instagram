@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">

			<div class="profile-user">


					<div class="container-avatar">
						<img src="{{ route('user.avatar',['filename'=> $user->image]) }}" alt="">
					</div>

				<div class="user-info">
					<h2>{{$user->name.' '.$user->surname}}</h2>
					<h1>{{'@'.$user->nick}}</h1>
					<span class="nickname date">{{ 'Se unio hace '.\Carbon\Carbon::now()->diffForHumans($user->created_at)	}}</span>
				</div>
			</div>
			<hr>

			<div class="clearfix"></div>
			@foreach($user->images as $image)
				@include('includes.image',['image'=>$image])
			@endforeach
		</div>

	</div>
</div>
@endsection
