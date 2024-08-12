<head>
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="/css/admin_owner_list.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<main>
    <h1 class="title">店舗代表者一覧</h1>
    <form method="GET" action="{{ url('/admin/owner/create') }}">
        @csrf
        <button type="submit" class="button">新規登録</button>
    </form>

    <form action="/admin/create" method="get">
        @csrf
        <div class="list">
            <table class="owner_list">
                <tr class="table-low">
                    <th class="table-title_inner">名前</th>
                    <th class="table-title_inner">役割</th>
                    <th class="table-title_inner">メールアドレス</th>
                </tr>
                @foreach($admins as $admin)
                <form action="/admin/index" method="get">
                    @if(!empty($admin))
                    <tr class="table-low">
                        <td class="table-inner" data-label="氏名">{{$admin['name']}}</td>
                        @if($admin['role'] === 1)
                        <td class="table-inner" data-label="役割">管理者</td>
                        @else
                        <td class="table-inner" data-label="役割">店舗代表者</td>
                        @endif
                        <td class="table-inner" data-label="メールアドレス">{{$admin['email']}}</td>
                    </tr>
                    @endif
                </form>
                @endforeach
            </table>
        </div>
        <a class="return" href="{{ route('admin.index') }}">戻る</a>
</main>