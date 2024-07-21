<head>
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="/css/admin_mail_send.css">
</head>




<!-- お知らせメールの作成 -->

<body>

    <div class="contact">
        <h1 class="contact-ttl">お知らせメールの作成</h1>
        <form method="POST" action="{{ url('admin/mail/send') }}">
            @csrf
            <div>
                {{ session('message') }}
            </div>
            <!-- <div>
                @foreach($users as $user)
                <label for="email" class="block">メールアドレス</label>
                <div class="drop_email">
                    <select name="email" class="email" id="email">
                        <option value="{{ $user->email }}" lable="{{ $user->email }}" hidden>選択してください</option>
                    </select>
                </div>
                @endforeach
            </div> -->
            <table class="contact-table">
                <tr>
                    <th class="contact-item">{{ __('タイトル') }}
                    </th>
                    <td class="contact-body">
                        <input type="text" name="title" class="form-text" >
                        @error('title')
                        <p class='error_message'>{{$message}}</p>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">{{ __('内容') }}</label>
                    </th>
                    <td class="contact-body">
                        <textarea name="content" class="form-textarea" value="content" ></textarea>
                        @error('content')
                        <p class='error_message'>{{$message}}</p>
                        @enderror
                    </td>
                </tr>
            </table>
            <button type="submit" class="contact-submit">送信</button>
        </form>
        <a class="return" href="{{ route('admin.index') }}">戻る</a>
    </div>
</body>