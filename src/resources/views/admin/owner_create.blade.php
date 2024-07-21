<head>
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="/css/admin_owner_create.css">
</head>

<body>

    <div class="contact">
        <h1 class="contact-ttl">店舗代表者を登録</h1>
        <form action="{{ route('admin.owner_store') }}" method="POST">
            @csrf
            <table class="contact-table">
                <tr>
                    <th class="contact-item">
                        {{ __('氏名') }}
                    </th>
                    <td class="contact-body">
                        <input type="text" class="form-text" name="name" id="name">
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">
                        <label for="owner_name">{{ __('role') }}</label>
                    </th>
                    <td class="contact-body">
                        <input type="radio" id="role_1" name="role" value="1" />
                        <label for="role_1" class="contact-role-txt">管理者</label>
                        <input type="radio" id="role_2" name="role" value="2" />
                        <label for="role_2" class="contact-role-txt">店舗代表者</label><br>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">
                        <label for="owner_name">{{ __('メールアドレス') }}</label>
                    </th>
                    <td class="contact-body">
                        <input type="email" class="form-text" name="email" id="email">
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">
                        <label for="owner_name">{{ __('パスワード') }}</label>
                    </th>
                    <td class="contact-body">
                        <input type="password" class="form-text" name="password" id="password"><br>
                    </td>
                </tr>
            </table>
            <button type="submit" class="contact-submit">
                {{ __('登録') }}
            </button>
        </form>
        <a class="return" href="{{ route('admin.index') }}">戻る</a>
    </div>
</body>