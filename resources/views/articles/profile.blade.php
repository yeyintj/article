@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="cover">

        </div>
        <div class="card mx-auto" style="max-width: 50%">
            <div class="card-body dropdown">
                {{-- <img src="" alt="img" class="card-img"> --}}
                <name class="icon-link">
                    <i class="fas fa-circle-user bg-light border rounded" style="font-size: 2.5rem"></i>
                    {{auth()->user()->name}}
                </name>
                <a class="navbar-toggler float-end text-decoration-none text-dark" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-bars"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" id="card">
                    <li class="drop-drown-item"><a href="" class="text-decoration-none">One</a></li>
                    <li class="drop-drown-item"><a href="" class="text-decoration-none">Two</a></li>
                    <li class="drop-drown-item"><a href="" class="text-decoration-none">Four</a></li>
                </ul>
            </div>



        </div>

        {{-- <div class="cover position-relative">
            <div class="row">
                @foreach ($photos as $photo)
                    <div class="col-2">
                        @if (!$photo)
                            <i class="fas fa-user"></i>
                        @endif
                        <img src="{{ $photo->profile}}" alt="img" class="img-thumbnail position-absolute">
                        <label for="cam" type="button">
                            <i class="fas fa-camera"></i>
                        </label>
                        <form action="/articles/photo/{{$photo->id}}" method="POST">
                            @csrf

                            <button href="" class="small btn btn-outline-danger mt-2">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
        {{auth()->user()->name}} --}}

        <form action="{{url("/articles/photo")}}" enctype="multipart/form-data" class="input-group" method="POST" hidden>
            @csrf
            <input type="file" name="photo" id="cam">
            <input type="hidden" name="user_id" id="" value="{{auth()->user()->id}}">
            <button class="btn">Choose Photo</button>
        </form>
        {{-- <div class="row">
        @foreach ($photos as $photo)
            <div class="col-2">
                <img src="{{ $photo->original}}" alt="img" class="img-thumbnail">
                <form action="/articles/photo/{{$photo->id}}" method="POST">
                    @csrf

                    <button href="" class="small btn btn-outline-danger mt-2">Delete</button>
                </form>
            </div>
        @endforeach
        </div> --}}
    </div>
@endsection
