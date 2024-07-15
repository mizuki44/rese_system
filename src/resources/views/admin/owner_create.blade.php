@extends('layouts.app')


<head>
    <link rel="stylesheet" href="/css/sanitize.css">
</head>

<main>
    @section('content')




    <div class="container small">
        <h1>店舗代表者を登録</h1>
            <form action="{{ route('admin.owner_store') }}" method="POST">
            @csrf
            <fieldset>
                <div class="form-group">
                    <label for="owner_name">{{ __('氏名') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                    <input type="text" class="form-control" name="name" id="name"><br>

                    <label for="owner_name">{{ __('role') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                    <input type="radio" id="role_1" name="role" value="1" />
                    <label for="role_1">管理者</label>
                    <input type="radio" id="role_2" name="role" value="2" />
                    <label for="role_2">店舗代表者</label><br>


                    <label for="owner_name">{{ __('メールアドレス') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                    <input type="email" class="form-control" name="email" id="email"><br>

                    <label for="owner_name">{{ __('パスワード') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                    <input type="password" class="form-control" name="password" id="password"><br>



                    <button type="submit" class="btn btn-success">
                        {{ __('登録') }}
                    </button>
                </div>
            </fieldset>
        </form>
    </div>

    @endsection
</main>