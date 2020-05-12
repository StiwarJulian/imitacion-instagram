@if(Auth::user()->image)
<div class="container-avatar">
	<img src="{{ Route('user.avatar', ['filename' => Auth::user()->image] ) }}" alt="" class="avatar">
</div>
@endif
