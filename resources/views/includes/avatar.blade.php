@if(Auth::user()->image)
<div class="container-avatar">
    <img class="avatar" src="{{ route('user.avatar', ['filename'=>Auth::user()->image]) }}" alt="avatar">
</div>
@endif