@extends("layouts.app")

@section("content")
    <div class="container border rounded-2 shadow-sm p-4 " style="width:700px">
        <form action="{{url("/articles/detail/$article->id/edit")}}" method="post">
            @csrf
            <div>
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="" class="form-control" value="{{$article->title}}">
            </div>
            <div>
                <label for="body" class="form-label">Body</label>
                <input type="text" name="body" id="" class="form-control" value="{{$article->body}}">
            </div>
            <select name="category_id" id="" class="form-select my-3">
                @foreach ($categories as $category)
                <option value="{{$category->id}}" @if ($article->category_id === $category->id)
                    selected
                @endif>
                    {{$category->name}}
                </option>
                @endforeach
            </select>
            <a href="{{url("/articles/detail/$article->id")}}" class="btn btn-outline-secondary btn-sm me-2 rounded-3"><i class="fas fa-arrow-left me-2"></i>Back</a>
            <button class="btn btn-outline-primary btn-sm rounded-2">Edit Article</button>
        </form>
    </div>
@endsection
