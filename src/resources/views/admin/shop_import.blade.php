<head>
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="/css/admin_shop_create.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container mt-5">
        <form action="{{ url('/admin/shop/import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                <div class="custom-file text-left">
                    <input type="file" name="csvFile" class="" id="csvFile">
                    <label class="custom-file-label" for="customFile">CSVファイル選択</label>
                </div>
            </div>
            <div class="form__error">
                @if (session('error'))
                <div class="alert alert-danger">
                    {!! nl2br(e(session('error'))) !!}
                </div>
                @endif
                @if (session('message'))
                <div class="alert alert-danger">
                    {{ (session('message')) }}
                </div>
                @endif
            </div>
            <button class="btn btn-primary btn-lg">インポート</button>
        </form>
    </div>
</body>