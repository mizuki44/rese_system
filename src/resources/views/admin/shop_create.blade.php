@extends('layouts.app')


<head>
    <link rel="stylesheet" href="/css/sanitize.css">
</head>

<main>
    @section('content')




    <div class="container small">
        <h1>店舗を登録</h1>
        <form action="{{ route('admin.shop_store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <fieldset>
                <div class="form-group">
                    <label for="owner_name">{{ __('店舗名') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                    <input type="text" class="form-control" name="name" id="name"><br>

                    <label for="owner_name">{{ __('説明') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                    <input type="text" class="form-control" name="description" id="description"><br>

                    <label for="owner_name">{{ __('エリア') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                    <select class="create_area" id="area_id" name="area_id">
                        <option value="">area</option>
                        @foreach($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select><br>

                    <label for="owner_name">{{ __('ジャンル') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                    <select class="create_genre" id="genre_id" name="genre_id">
                        <option value="">genre</option>
                        @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                        @endforeach
                    </select><br>

                    <label for="owner_name">{{ __('image_url') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                    <input type="url" class="form-control" name="image_url" id="image_url"><br>

                    <input type="file" name="thumbnail" />
                    {{ csrf_field() }}

                    <button type="submit" class="btn btn-success">
                        {{ __('登録') }}
                    </button>
                </div>
            </fieldset>
        </form>
    </div>
    <a class="rounded-md bg-gray-800 text-white px-4 py-2" href="{{ route('admin.index') }}">戻る</a>
    @endsection
</main>