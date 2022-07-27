<x-app-layout>
<section class="text-gray-600 body-font">
    <!-- 商品登録用コンテンツ… -->
    <div class="container px-10 py-24 mx-auto">
        <!-- タイトルロゴ -->
        <div class="flex flex-col text-center w-full mb-20">
            <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">商品編集</h1>
        </div>

      <!-- バリデーションエラーの表示 -->
      @include('common.errors')

      <!-- 商品登録フォーム -->
      <form action="{{ route('update',['id'=>$product->id]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- 商品名 -->
        <div>
          <x-label for="name" :value="__('商品名')" />
          <x-input id="name" class="block mt-1 w-full mb-3" type="text" name="name" value="{{$product->name}}" required autofocus />
        </div>
        <!-- 価格 -->
        <div>
          <x-label for="price" :value="__('価格')" />
          <x-input id="price" class="block mt-1 w-full mb-3" type="text" name="price" value="{{$product->price}}" required />
        </div>

        <!-- 在庫 -->
        <div>
          <x-label for="quantity" :value="__('在庫')" />
          <x-input id="quantity" class="block mt-1 w-full mb-3" type="number" name="stock" value="{{$stock}}" required/>
        </div>

        <!-- 商品説明 -->
        <div>
          <x-label for="price" :value="__('商品説明')" />
          <textarea type="textarea" name="info" class="form-control" value="{{$product->info}}" required>{{$product->info}}</textarea>
        </div>

        <!-- 商品カテゴリー -->
        <div class="form-group-sm clearfix">
          <x-label for="product-category" :value="__('商品カテゴリー')" />

          <div class="product-info width-control">
            <select class="content-half-width form-control-sm d-inline" id="category_id" name="category_id" onchange="entryChange2();" required>
              <option value="{{ $product->category_id }}">{{ $category_selected_id->name }}</option>
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
            <div>
              @if (isset($product->image1))
              <img id="preview1" src="{{url('storage/upload_img')}}/{{$product->image1}}" alt="image1" style="width: 20%; height: auto; " />
              @else
              <img id="preview1" class="no_image" src="{{url('storage/upload_img/NO IMAGE.png')}}" alt="no_image" style="width: 20%; height: auto; ">
              @endif
            </div>
            <input type="file" name="image1" id="product-img1" class="form-control" accept="image/*" value="{{$product->image1}}">
          </div>
          <!-- 商品画像2 -->
          <div class="form-group mb-3">
          <x-label for="image2" :value="__('商品画像2')" />
            <!-- 画像プレビュー -->
            <div>
              @if (isset($product->image2))
              <img id="preview2" src="{{url('storage/upload_img')}}/{{$product->image2}}" alt="image2" style="width: 20%; height: auto; ">
              @else
              <img id="preview2" class="no_image" src="{{url('storage/upload_img/NO IMAGE.png')}}" alt="no_image" style="width: 20%; height: auto; ">
              @endif
            </div>
            <input type="file" name="image2" id="product-img2" class="form-control" accept="image/*" value="{{$product->image2}}">
          </div>
          <!-- 商品画像3-->
          <div class="form-group mb-3">
          <x-label for="image3" :value="__('商品画像3')" />
            <!-- 画像プレビュー -->
            <div>
              @if (isset($product->image3))
              <img id="preview3" src="{{url('storage/upload_img')}}/{{$product->image3}}" alt="image3" style="width: 20%; height: auto; " />
              @else
              <img id="preview3" class="no_image" src="{{url('storage/upload_img/NO IMAGE.png')}}" alt="no_image" style="width: 20%; height: auto; " />
              @endif
            </div>

            <input type="file" name="image3" id="product-img3" class="form-control" accept="image/*" value="{{$product->image3}}">

          </div>
          <!-- 商品画像4-->
          <div class="form-group mb-3">
          <x-label for="image4" :value="__('商品画像4')" />
            <!-- 画像プレビュー -->
            <div>
              @if (isset($product->image4))
              <img id="preview4" class="no_image" src="{{url('storage/upload_img')}}/{{$product->image4}}" alt="image4" style="width: 20%; height: auto; " />
              @else
              <img id="preview4" src="{{url('storage/upload_img/NO IMAGE.png')}}" alt="no_image" style="width: 20%; height: auto; " />
              @endif
            </div>

            <input type="file" name="image4" id="product-img4" class="form-control" accept="image/*" value="{{$product->image4}}">

          </div>

          <!-- ラジオボタン -->
          <div class="product_status my-4">
            <label><input type="radio" id="selling_button" name="is_selling" value=1 checked>販売中</label>
            <label><input type="radio" id="stop_selling_button" name="is_selling" value=0 class="ml-3">販売停止</label>
          </div>


          <!-- 商品追加ボタン -->
          <div class="create-product mx-2 my-4">
            <x-button class="">{{ __('更新') }}</x-button>
            <a class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:border-gray-300 mb-4 ml-3" href="{{ route('index') }}">
              <x-button class="bg-gray-100">{{ __('キャンセル') }}</x-button>
            </a>
          </div>
      </form>
    </div>
</section>
</x-app-layout>
