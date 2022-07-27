<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

          <!-- タイトルロゴ -->
          <div class="flex flex-col text-center w-full mb-4 mt-10">
            <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">会員情報編集</h1>
          </div>

      <!-- バリデーションエラーの表示 -->
      @include('common.errors')

      <!-- 会員編集フォーム -->
      <form action="{{ route('user.update',['id'=>$user->id]) }}" method="POST" class="form-horizontal w-2/3 mx-auto mb-10" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- ユーザー名 -->
        <div>
          <x-label for="user-name" :value="__('名前')" />
          <x-input id="name" class="block mt-1 w-full mb-3" type="text" name="name" value="{{$user->name}}" required autofocus />
        </div>

        <!-- メール-->
        <div>
          <x-label for="email" :value="__('メールアドレス')" />
          <x-input id="email" class="block mt-1 w-full mb-3" type="email" name="email" value="{{$user->email}}" required />
        </div>

        <!-- パスワード -->
        <div>
          <x-label for="password" :value="__('パスワード')" />
          <x-input id="password" class="block mt-1 w-full mb-3" type="password" name="password" value="{{ $user->password }}" required />
        </div>

        <!-- 郵便番号 -->
        <div>
          <x-label for="post_number" :value="__('郵便番号')" />
          <x-input id="post_number" class="block mt-1 w-full mb-3" type="number" name="post_number" value="{{$user->post_number}}" required />
        </div>

        <!-- 住所 -->
        <div>
          <x-label for="address" :value="__('住所')" />
          <textarea type="text" name="address" class="form-control mb-4" value="{{$user->address}}" required>{{$user->address}}</textarea>
        </div>

        <!-- 会員情報編集ボタン -->
        <x-button class="mb-3">{{ __('更新') }}</x-button>

        <!-- 削除(問い合わせに推移->管理者側がDBから会員削除) -->
        
        <a class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:border-gray-300 mb-4 ml-3" href="{{ route('contact.add') }}">
        <x-button type="button" class="mb-3">{{ __('削除') }}</x-button>
        
          <!--
        <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mb-3">
        
    削除
</button>
//-->
      </a>
  
        <!-- キャンセル(商品一覧に推移) -->
        <a class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:border-gray-300 mb-4 ml-3" href="{{ route('products') }}"><x-button class="mb-3">{{ __('キャンセル') }}</x-button></a>
      </form>

</div>
</div>
    </div>
</div>
</x-app-layout>