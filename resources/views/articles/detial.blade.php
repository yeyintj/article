@extends("layouts.app")

@section("content")
<div class="container row row-cols row-cols-md row-cols-lg mx-auto" style="max-width: 50%">

    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-warning">
            {{$error}}
        </div>
        @endforeach
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif

    <div class="card mb-3">
        <div class="d-flex dropdown">
            <div class="card-body" style="--bs-card-spacer-x: 0rem">
                <a href="{{url("/articles")}}" class="icon-link text-decoration-none fs-lg-4 fs-sm-2 text-secondary">
                    <i class="fas fa-circle-user fa-lg"></i>
                    {{$article->user->name}}
                </a>
                <div class="cart-subtitle ms-lg-4" style="font-size: .5rem">
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
            </div>
            @auth
            <div class="mt-3">
                <i class="fas fa-ellipsis-vertical" data-bs-toggle="dropdown" type="button"></i>
                <ul class="dropdown-menu">
                    @if ($article->user_id === auth()->user()->id)
                    <a href="{{url("/articles/detail/delete/$article->id")}}" class="dropdown-item text-danger">
                        <i class="fas fa-trash me-2"></i>
                        Delete
                    </a>
                    <a href="{{url("/articles/detail/$article->id/edit")}}" class="dropdown-item">
                        <i class="fas fa-edit me-2"></i>
                        Edit
                    </a>
                    @endif
                    @if ($article->user_id !== auth()->user()->id)
                    <a href="{{url("/articles/detail/$article->id/edit")}}" class="dropdown-item">
                        <i class="fa-solid fa-exclamation me-3"></i>
                        Report
                    </a>
                    <a href="{{url("/articles/detail/$article->id/edit")}}" class="dropdown-item">
                        <i class="fa-solid fa-bookmark me-2"></i>
                        Save
                    </a>
                    @endif
                </ul>
            </div>
            @endauth
        </div>
    </div>
    <div class="my-1 border-bottom pb-3 d-flex">
        <form action="{{url("/articles/like")}}" method="POST">
            @csrf
            <input type="hidden" name="user_id" id="">
            <input type="hidden" name="article_id" id="" value="{{$article->id}}">
            {{-- @if (auth()->user()) --}}
            <button class="btn btn-sm botb">Like {{count($article->likes)}}</a></button>
            {{-- @else
            <button class="btn btn-sm botb">Like {{count($article->likes)}}</a></button>
            @endif --}}
        </form>


        <form action="" class="mx-auto">
            <label for="comm" class="btn btn-sm botb">
                Comment {{count($article->comments)}}
            </label>
            {{-- <button for="com"></a></button> --}}
        </form>
        <form action="">
            <button class="btn btn-sm botb">Share</button>
        </form>
    </div>


        <div class="d-flex bg">
            <ul class="list-group">
                @foreach ($article->comments as $comment)
                <li class="list-group">
                    <div class="dropdown">
                        <a href="" class="icon-link text-decoration-none text-secondary">
                            <i class="fas fa-circle-user fa-lg"></i>
                            {{$comment->user->name}} .
                            <small class="text-muted">
                                {{$comment->created_at->diffForHumans()}}
                            </small>
                        </a>
                        @auth
                        @if ($comment->user_id === auth()->user()->id)
                        <i class="fas fa-ellipsis-vertical ms-2" role="button" data-bs-toggle="dropdown"  style="font-size: .8rem"></i>
                        <ul class="dropdown-menu">
                            <a href="{{url("/articles/comment/delete/$comment->id")}}" class="dropdown-item">
                                <i class="fas fa-trash"></i>
                                Delete
                            </a>
                            <button class="dropdown-item" id="edit">
                                <i class="fas fa-edit"></i>
                                Edit
                            </button>
                        </ul>
                        @endif
                        @endauth
                    </div>
                    <p class="ms-4">
                        {{$comment->content}}
                    </p>
                    <form action="{{url("/articles/comment/$comment->id/edit")}}" method="POST">
                        @csrf
                        <div class="input" id="com">
                            <input type="text" name="content" id="" value="{{$comment->content}}" class="form-control">
                            <button class="btn btn-outline-secondary btn-sm" type="hidden">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>

                    </form>
                </li>
                @endforeach
            </ul>

            @auth
            <div class="d-none d-lg-block ms-auto">
                <label for="comm" role="button">
                    Comment :
                </label>
                <form action="{{url("/articles/comment/add")}}" method="POST" class="input-group" style="max-width: 500px">
                    @csrf
                    <input type="text" name="content" class="form-control rounded-start" id="comm">
                    <input type="hidden" name="article_id" id="" value="{{$article->id}}">
                    <button class="btn btn-outline-secondary btn-sm"><i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
            @endauth
        </div>


</div>
@endsection
