<x-app-layout>

  <!-- Validation Errors -->
  <
  <section class="text-gray-600 body-font">
    <!-- 商品登録用コンテンツ… -->
    <div class="container px-10 py-24 mx-auto">
      <!-- タイトルロゴ -->
      <div class="flex flex-col text-center w-full mb-20">
        <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">商品登録</h1>
      </div>

      <!-- バリデーションエラーの表示 -->
      @include('common.errors')

      <!-- 商品登録フォーム -->
      <form action="{{ route('store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        <!-- 商品名 -->
        <div>
          <x-label for="name" :value="__('商品名')" />
          <x-input id="name" class="block mt-1 w-full mb-3" type="text" name="name" :value="old('name')" required max:255 autofocus />
        </div>
        <!-- 価格 -->
        <div>
          <x-label for="price" :value="__('価格')" />
          <x-input id="price" class="block mt-1 w-full mb-3" type="text" name="price" required />
        </div>

        <!-- 在庫 -->
        <div>
          <x-label for="quantity" :value="__('在庫')" />
          <x-input id="quantity" class="block mt-1 w-full mb-3" type="number" name="quantity" required />
        </div>

        <!-- 商品説明 -->
        <div>
          <x-label for="info" :value="__('商品説明')" />
          <x-input id="info" class="block mt-1 w-full h-20 mb-3" type="textarea" name="info" required />
        </div>

        <!-- 商品カテゴリー -->
        <div class="form-group-sm clearfix">
          <x-label for="product-category" :value="__('商品カテゴリー')" />
          <div class="product-category width-control mb-3">
            <select class="content-half-width form-control-sm d-inline" id="category_id" name="category_id" onchange="entryChange2();" required>
              <option value="">未選択</option>
              @foreach ($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <!-- 商品画像1 -->
        <div class="form-group mb-3">
          <x-label for="image1" :value="__('商品画像1')" />
          <!-- 画像プレビュー -->
          <img id="preview1" width="200px">
          <input type="file" name="image1" class="form-control" accept="image/*">
        </div>
        <!-- 商品画像2 -->
        <div class="form-group mb-3">
          <x-label for="image2" :value="__('商品画像2')" />
          <!-- 画像プレビュー -->
          <img id="preview2" width="200px">
          <input type="file" name="image2" class="form-control" accept="image/*">
        </div>
        <!-- 商品画像3-->
        <div class="form-group mb-3">
          <x-label for="image3" :value="__('商品画像3')" />
          <!-- 画像プレビュー -->
          <img id="preview3" width="200px">
          <input type="file" name="image3" class="form-control" accept="image/*">
        </div>
        <!-- 商品画像4-->
        <div class="form-group mb-3">
          <x-label for="image4" :value="__('商品画像4')" />
          <!-- 画像プレビュー -->
          <img id="preview4" width="200px">
          <input type="file" name="image4" class="form-control" accept="image/*">
        </div>

        <!-- ラジオボタン -->
        <div clacc="product_status mb-3">
          <label><input type="radio" id="selling_button" name="is_selling" value=1 checked>販売中</label>
          <label><input type="radio" id="stop_selling_button" name="is_selling" value=0 class="ml-3">販売停止</label>
        </div>


        <!-- 商品追加ボタン -->
        <div class="create-product mx-2 my-2">
          <x-button class="">{{ __('登録') }}</x-button>
          <a class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:border-gray-300 mb-4 ml-3" href="{{ route('index') }}">キャンセル</a>
        </div>
      </form>
    </div>
  </section>
</x-app-layout>