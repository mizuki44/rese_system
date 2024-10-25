<head>
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="/css/admin_shop_import.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>
    <div class="contact">
        <h1 class="contact-ttl">CSVファイルのインポート</h1>
        <form action="{{ url('/admin/shop/import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <table class="contact-table">
                <tr>
                    <th class="contact-item_title">{{ __('CSVファイル選択') }}
                    </th>
                    <td class="contact-body">
                        <input type="file" name="csvFile" class="" id="csvFile">
                    </td>
                </tr>
            </table>
            <div class="form__message">
                @if (session('error'))
                <div class="error_message">
                    {!! nl2br(e(session('error'))) !!}
                </div>
                @endif
                @if (session('message'))
                <div class="error_message">
                    {{ (session('message')) }}
                </div>
                @endif
                @if (session('success_message'))
                <div class="success_message">
                    {{ (session('success_message')) }}
                </div>
                @endif
            </div>
            <button type="submit" class="contact-submit">インポート</button>
        </form>
        <a class="return" href="{{ route('admin.index') }}">戻る</a>
    </div>
</body>