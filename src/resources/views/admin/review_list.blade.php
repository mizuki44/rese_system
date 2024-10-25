<head>
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="/css/admin_review_list.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<main>
    <h1 class="title">口コミ一覧</h1>

    <div class="list">
        <table class="review_list">
            <tr class="table-low">
                <th class="table-title_inner">ユーザー名</th>
                <th class="table-title_inner">店舗名</th>
                <th class="table-title_inner">評価</th>
                <th class="table-title_inner">コメント</th>
                <th class="table-title_inner">イメージ画像</th>
                <th class="table-title_inner">削除ボタン</th>
            </tr>
            @foreach($reviews as $review)

            @if(!empty($review))
            <tr class="table-low">
                <td class="table-inner" data-label="ユーザー名">{{$review->user->name}}</td>
                <td class="table-inner" data-label="店舗名">{{$review->shop->name}}</td>
                <td class="table-inner" data-label="評価">{{$review['star']}}</td>
                <td class="table-inner" data-label="コメント">{{$review['comment']}}</td>
                <td class="table-inner" data-label="イメージ画像"><img class="image" src="{{ $review['image_url'] }}" />
                </td>
                <td class="table-inner">
                    <div class="button_layout">
                        <form method="POST" action="{{url('/admin/review/delete')}}">
                            @csrf
                            <input type="hidden" name="review_id" class="review_id" value="{{ $review['id'] }}">
                            <button type="submit" class="button">削除</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endif

            @endforeach
        </table>
    </div>

    <a class="return" href="{{ route('admin.index') }}">戻る</a>
</main>