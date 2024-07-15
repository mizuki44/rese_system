<!-- お知らせメールの作成 -->
<div>
    <h1 class="">お知らせメールの作成</h1>
    <div class="">
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

            <div class="form-group">
                <div>
                    <label for="category-id">{{ __('タイトル') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                    <input type="text" name="title" class="ml-3" value="">
                </div>
                <div>
                    <label for="category-id">{{ __('内容') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                    <textarea name="content" class="w-72 h-32 ml-3"></textarea>
                </div>
            </div>

            <div class="my-3 mx-auto">
                <button type="submit" class="text-blue-800 bg-white border-solid border border-blue-800 hover:bg-gray-200 rounded w-20">送信</button>
            </div>
        </form>
        <a class="rounded-md bg-gray-800 text-white px-4 py-2" href="{{ route('admin.index') }}">戻る</a>
    </div>
</div>
</div>
</div>