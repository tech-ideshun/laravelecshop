<x-app-layout>
  {{-- <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          商品の詳細
      </h2>
  </x-slot> --}}

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
              <div class="md:flex md:justify-around">
                <div class="md:w-1/2">
                  <!-- Slider main container -->
                  <div class="swiper-container">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                      <!-- Slides -->
                      <div class="swiper-slide">
                        @if ($product->image1 !== null)
                          <img class="m-auto" src="{{ asset('storage/upload_img/' . $product->image1) }}">
                        @else
                          <img src="">
                        @endif
                      </div>
                      <div class="swiper-slide">
                        @if ($product->image2 !== null)
                          <img class="m-auto" src="{{ asset('storage/upload_img/' . $product->image2) }}">
                        @else
                          <img src="">
                        @endif
                      </div>
                      <div class="swiper-slide">
                        @if ($product->image3 !== null)
                          <img class="m-auto" src="{{ asset('storage/upload_img/' . $product->image3) }}">
                        @else
                          <img src="">
                        @endif
                      </div>
                      <div class="swiper-slide">
                        @if ($product->image4 !== null)
                          <img class="m-auto" src="{{ asset('storage/upload_img/' . $product->image4) }}">
                        @else
                          <img src="">
                        @endif
                      </div>
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                    <!-- If we need scrollbar -->
                    <div class="swiper-scrollbar"></div>
                  </div>
                </div>
                <div class="md:w-1/2 ml-4 mt-4 mb-4">
                  <h2 class="mb-4 text-sm title-font text-gray-500 tracking-widest">{{ $product->category->name }}</h2>
                  <h1 class="mb-4 text-gray-900 text-3xl title-font font-medium ">{{ $product->name }}</h1>
                  <p class="mb-4 leading-relaxed">{{ $product->info }}</p>
                  <div class="flex justify-around items-center mt-8">
                    <div>
                      <span class="title-font font-medium text-2xl text-gray-900">{{ number_format($product->price) }}</span><span class="text-sm text-gray-700">円(税込)</span>
                    </div>
                    <form method="post" action="{{ route('cart.add') }}" class="flex">
                      @csrf
                    <div class="flex items-center">
                      <span class="mr-3">数量</span>
                      <div class="relative">
                        <select name="quantity" class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base pl-3 pr-10 mr-4">
                          @for($i = 1; $i <= $quantity; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                    <button class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">カート</button>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    </form>
                  </div>
                </div>
              </div>

            <div class="container py-4 mx-auto">
              <h1 class="mt-8 text-gray-900 text-3xl title-font font-medium">関連商品</h1>
              <div class="flex flex-wrap -m-4">
                @foreach ($recommend_items as $item)
                <div class="lg:w-1/3 md:w-1/2 p-4 w-full">
                  <a class="block relative h-8 rounded overflow-hidden">
                    <a href="{{ route('products.show', ['id' => $item->id]) }}">
                      <img class="object-cover object-center w-full h-1/2 block" src="{{url('storage/upload_img')}}/{{$item->image1}}">
                    </a>
                  </a>
                  <div class="mt-4">
                    <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">{{ $item->category->name }}</h3>
                    <h2 class="text-gray-900 title-font text-lg font-medium">{{ $item->name }}</h2>
                    <p class="mt-1">¥{{ number_format($item->price) }}</p>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
              
            </div>
        </div>
    </div>
  </div>


  <script src="{{ mix('js/swiper.js') }}"></script>
</x-app-layout>