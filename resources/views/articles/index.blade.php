@extends("layouts.app")

@section("content")
    <div class="container row row-cols row-cols-md row-cols-lg mx-auto" style="max-width: 50%">

        {{$articles->links()}}

        @if (session('info'))
        <div class="alert alert-info">
            {{session('info')}};
        </div>
        @endif

        @forelse ($articles as $article)
        <div class="card mb-3">
            <div class="card-body" style="--bs-card-spacer-x: 0rem">
                <a href="{{url("/articles/photo")}}" class="icon-link text-decoration-none text-secondary" role="button">
                    <i class="fas fa-circle-user fa-lg"></i>
                    {{$article->user->name}}
                </a>
                <div class="card-subtitle ms-lg-4" style="font-size: .5rem">
                    {{$article->created_at->diffForHumans()}} .
                    {{$article->category->name}} .
                    Comment : {{count($article->comments)}}
                </div>
                <h5 class="card-title">
                    {{$article->title}}
                </h5>
                <p class="card-text">
                    {{$article->body}}
                </p>
                <a href="{{url("/articles/detail/$article->id")}}" class="text-decoration-none">View Detail &raquo;</a>
            </div>
        </div>
        @empty
        <div class="card-body">
            <h1 class="h4 text-muted card-header text-center mt-5">There is no article, to creat please login.</p>
        </div>
        @endforelse

    </div>
@endsection
