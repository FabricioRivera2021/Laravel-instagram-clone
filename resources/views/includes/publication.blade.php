<div class="card pub_image">
    <div class="card-header">

        <div class="container-avatar">
            @if ($image->user->image)
                <img class="avatar" src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" alt="avatar">
            @endif
        </div>

        <div class="data-user">
            <a href="{{ route('profile', ['id' => $image->user->id]) }}">
                {{ $image->user->name . ' ' . $image->user->surname }}
                <span class="nickname">{{ ' - @' . $image->user->nick }}</span>
                <span class="date">
                    {{ $image->created_at->diffForHumans() }}
                </span>
            </a>
        </div>
    </div>

    <div class="card-body">

        <div class="image-container">
            <img class="post-img" src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="post-img">
        </div>
        <div class="likes">
        </div>
        <div class="description">
            <p>{{ $image->description }}</p>
        </div>
        <div class="comment_likes">
            <a href="{{ route('image.detail', ['id' => $image->id]) }}"
                class="btn btn-warning btn-sm btn-comments">Comentarios ({{ count($image->comments) }}) </a>
            {{-- usando el count() se puede mostrar la cantidad de algo que halla en la DB vinculado a algo en este caso los coments --}}
            <?php $user_like = false; ?>
            @foreach ($image->likes as $like)
                {{-- Con el foreach se puede entrar a los arrays que contienen la data de los id de usuario --}}
                @if ($like->user->id == Auth::user()->id)
                    <?php $user_like = true; ?>
                @endif
            @endforeach

            @if ($user_like)
                <span class="heart-container fa fa-stack" data-id="{{ $image->id }}">
                    <i class="heart redheart fa fa-stack-2x fa-heart fa-2x"><a href="#"></a></i>
                    <i class="likes-counter fa fa-stack-1x">{{ count($image->likes) }}</i>
                </span>
            @else
                <span class="heart-container fa fa-stack" data-id="{{ $image->id }}">
                    <i class="heart fa fa-stack-2x fa-heart fa-2x"><a href="#"></a></i>
                    <i class="likes-counter fa fa-stack-1x">0</i>
                </span>
            @endif

        </div>
    </div>
</div>
