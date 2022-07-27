<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

          <!-- タイトルロゴ -->
          <div class="flex flex-col text-center w-full mb-4 mt-10">
            <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">問い合わせ</h1>
          </div>

          <!-- 問い合わせフォーム -->
          <!-- バリデーション -->
          @include('common.errors')
          <form method="POST" action="{{ route('contact.add') }}" class="w-2/3 mx-auto mb-10">
              @csrf
              <x-label for="user-name" :value="__('タイトル')" />
              <x-input id="title" class="block mt-1 w-full mb-3" type="text" name="title" autofocus />
              <x-label for="user-name" :value="__('本文')" />
              <textarea type="text" name="content" class="rounded-md shadow-sm w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mb-4 h-80 resize-none"></textarea>
              <x-button class="">{{ __('送信') }}</x-button>
          </form>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>