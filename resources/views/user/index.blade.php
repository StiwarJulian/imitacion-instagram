@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<h1>Gente</h1>
			<form action="{{route('user.index')}}" method="get" id="buscador">
				<div class="row">
					<div class="form-group col">
						<input type="text" class="form-control" id="search" placeholder="buscar">
					</div>
					<div class="form-group col btn-search">
						<input type="submit" class="btn btn-success" value="Buscar">
					</div>
				</div>
			</form>
			<hr>
			@foreach($users as $user)
				<div class="profile-user">
					<div class="container-avatar">
						<img src="{{ route('user.avatar',['filename'=> $user->image]) }}" alt="">
					</div>

					<div class="user-info">
						<h2>{{$user->name.' '.$user->surname}}</h2>
						<h3>{{'@'.$user->nick}}</h3>
						<span class="nickname date">{{ 'Se unio hace '.\Carbon\Carbon::now()->diffForHumans($user->created_at)	}}</span>
						<br/><a href="{{ route('user.profile',['id'=>$user->id]) }}" class="">Ver Perfil</a>
					</div>
				</div>
				<hr>
			@endforeach

			<!-- PAGINACION -->
			<div class="clearfix"></div>
			{{$users->links()}}
		</div>

	</div>
</div>
@endsection
