@extends("layouts.app")

@section("content")
    <div class="container" style="width:700px">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="alert alert-info">
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        @endif
        <div class="border shadow-sm p-4 rounded-3">
            <form action="{{url('/articles/add')}}" method="POST">
                @csrf
                <div>
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="" class="form-control">
                </div>
                <div class="my-2">
                    <label for="body" class="form-label">Body</label>
                    <input type="text" name="body" id="" class="form-control">
                </div>
                <div>
                    <label for="category_id">Category</label>
                    <select name="category_id" id="" class="form-select">
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">
                            {{$category->name}}
                        </option>
                        @endforeach

                    </select>
                </div>
                <button class="btn btn-outline-primary btn-sm mt-2 rounded-3">Add Article</button>
            </form>
        </div>

    </div>
@endsection
