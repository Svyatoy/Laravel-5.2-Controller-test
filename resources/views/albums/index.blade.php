@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <h1>Albums</h1>
        </div>
        <div class="col-md-2" id="btn-book-create">
            <form action="/albums/create">
                <input class="btn btn-success" type="submit" value="Create new book">
            </form>
        </div>
    </div>

    <div class="row" >
        @foreach($books as $book)
            <a href="/books/{{$book->id}}">
                <div class="col-md-3" id="book_card">
                    <img class="img-rounded" src="
                    @if (!$book->image)
                    {{asset('images/'.'default_image.jpg')}}
                    @else
                    {{asset('images/'.$book->image)}}
                    @endif
                            " height="130" width="90">

                    <h2>{{'"'.$book->title.'"'}}</h2>
                    <h4>Rubrics:</h4>
                    @foreach($book->rubrics as $rubric)
                        @if ($rubric->id === $book->rubrics->lists('id')->last())
                            {{$rubric->title}}
                        @else
                            {{$rubric->title.','}}
                        @endif
                    @endforeach
                    <h4>Authors:</h4>
                    @foreach ($book->authors as $author)
                        @if($author->id === $book->authors->lists('id')->last())
                            {{$author['first_name'].' '.$author['last_name'] }}
                        @else
                            {{$author['first_name'].' '.$author['last_name'].','}}
                        @endif
                    @endforeach
                </div>
            </a>
        @endforeach
    </div>
    {{$books->render()}}
@stop
