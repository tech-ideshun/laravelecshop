<x-app-layout>
<section class="text-gray-600 body-font">
  <!-- 商品一覧表示 -->
  

  <!-- 商品一覧コンテンツ… -->
  <div class="center-block flex justify-center items-center flex-col gap-5">
    <div class="container px-5 pt-24 mx-auto">
      
        <!-- タイトルロゴ -->
        <div class="flex flex-col text-center w-full mb-20">
            <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">商品一覧</h1>
        </div>

        <!-- 商品登録画面へ遷移 -->
        <div class="my-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
          <a class="text-white hover:no-underline" href="{{ route('create') }}">商品登録</a>
        </div>

        <!-- ラジオボタン -->
        <div class="selling_status my-2">
          <label><input type="radio" id="all_button" name="tab_item" value="全て" checked class="mr-2">全て</label>
          <label><input type="radio" id="selling_button" name="tab_item" value="販売中" class="mr-2">販売中</label>
          <label><input type="radio" id="stop_selling_button" name="tab_item" value="販売停止" class="mr-2">販売停止</label>
        </div>

        <!-- 検索機能 -->
        <div class="text-gray-600 items-center mr-0 mb-10">
          <form action="{{ route('search') }}" method="POST">
            @csrf
            <input type="search" name="search" placeholder="商品名or商品番号" class="bg-white h-10 px-3 rounded-full text-sm focus:outline-none" aria-label="Search" aria-describedby="search-addon" value="@if (isset($search)) {{ $search }} @endif">
            <div class="items-center inline-flex ml-2">
            <button type="submit" class="" id="search-addon">
              <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
              </svg>
            </button>
            </div>
          </form>
        </div>
      
      
    <div>
      <!-- 商品一覧（全て） -->
      <table class="table table-striped w-full" id="all" style="display: block;">
        <!-- テーブルヘッダ -->
        <thead>
          <tr>
            <th>番号</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫</th>
            <th>販売</th>
            <th>備考</th>
          </tr>
        </thead>
        @if (count($products) > 0)
        @foreach ($products as $i => $product)
        <!-- テーブル本体 -->
        <tbody>
          <tr>
            <!-- 商品名 -->
            <td class="table-text w-1/12">{{ $product->id }}</td>
            <td class="table-text w-1/12">{{ $product->name }}</td>
            <td class="table-text w-1/12">{{ $product->price }}</td>
            <!-- stockテーブルからproduct_idが同じ在庫数を抽出する -->
            <!-- <td class="table-text w-1/12">{{ $stocks[$products[$i]->id]  }}</td> -->
            <td class="table-text w-1/12">{{ $stocks[$product->id]  }}</td>
            <!-- ordersテーブルからproduct_idが同じ販売数を抽出する -->
            <td class="table-text w-1/12">{{ $orders[$product->id]  }}</td>
            <td class="table-text w-6/12">{{ $product->info }}</td>
            <!-- 編集ボタン -->
            <td class="w-1/12"><a href="{{ route('edit', ['id'=>$product->id]) }}">編集</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>

      @if (count($products_selling) > 0)
      <!-- 商品一覧（販売中） -->
      <table class="table table-striped w-full" id="selling" style="display: none;">
        <!-- テーブルヘッダ -->
        <thead>
          <th>番号</th>
          <th>商品名</th>
          <th>価格</th>
          <th>在庫</th>
          <th>販売</th>
          <th>備考</th>
        </thead>

        @foreach ($products_selling as $i => $product)
        @if($product->is_selling == 1)
        <!-- テーブル本体 -->
        <tbody>
          <tr>
            <!-- 商品名 -->
            <td class="table-text w-1/12">{{ $product->id }}</td>
            <td class="table-text w-1/12">{{ $product->name }}</td>
            <td class="table-text w-1/12">{{ $product->price }}</td>
            <!-- stockテーブルからproduct_idが同じ在庫数を抽出する -->
            <td class="table-text w-1/12">{{ $stocks[$product->id]  }}</td>
            <!-- ordersテーブルからproduct_idが同じ販売数を抽出する -->
            <td class="table-text w-1/12">{{ $orders[$product->id]  }}</td>
            <td class="table-text w-6/12">{{ $product->info }}</td>
            <!-- 編集ボタン -->
            <td class="w-1/12"><a href="{{ route('edit', ['id'=>$product->id]) }}">編集</a></td>
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
      @endif

      @if (count($products_no_selling) > 0)
      <!-- 商品一覧（販売停止） -->
      <table class="table table-striped w-full" id="stop_selling" style="display: none;">
        <!-- テーブルヘッダ -->
        <thead>
          <th>番号</th>
          <th>商品名</th>
          <th>価格</th>
          <th>在庫</th>
          <th>販売</th>
          <th>備考</th>
        </thead>
        @foreach ($products_no_selling as $i => $product)
        @if($product->is_selling == 0)

        <!-- テーブル本体 -->
        <!-- 商品一覧（販売中） -->
        <tbody>
          <tr>
            <!-- 商品名 -->
            <td class="table-text w-1/12">{{ $product->id }}</td>
            <td class="table-text w-1/12">{{ $product->name }}</td>
            <td class="table-text w-1/12">{{ $product->price }}</td>
            <!-- stockテーブルからproduct_idが同じ在庫数を抽出する -->
            <td class="table-text w-1/12">{{ $stocks[$product->id] }}</td>
            <!-- ordersテーブルからproduct_idが同じ販売数を抽出する -->
            <td class="table-text w-1/12">{{ $orders[$product->id]  }}</td>
            <td class="table-text w-6/12">{{ $product->info }}</td>
            <!-- 編集ボタン-->
            <td class="w-1/12"><a href="{{ route('edit', ['id'=>$product->id]) }}">編集</a></td>
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
      @endif
    </div>
    @endif
</div>
  </div>
</section>
</x-app-layout>