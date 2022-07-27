<x-app-layout>
  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
              <div class="flex flex-col text-center w-full mb-4 mt-10"><h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">カート</h1></div>
                  @if (count($products) > 0)
                    @foreach ($products as $product)
                      <div class="md:flex md:items-start w-3/4 mx-auto mb-3">
                        <div class="md:w-2/12">
                          @if ($product->image1 !== null)
                            <img class="w-full h-auto overflow-y-hidden" src="{{url('storage/upload_img')}}/{{$product->image1}}">
                          @else
                            <img src="">
                          @endif
                        </div>
                        <div class="md:w-6/12 md:ml-10 mt-3">{{ $product->name }}</div>
                        <div class="md:w-3/12 flex mt-3 justify-around">
                          <div>{{ $product->pivot->quantity }}個</div>
                          <div>{{ number_format($product->pivot->quantity * $product->price) }}<span class="text-sm text-gray-700">円(税込)</span></div>
                        </div>
                        <div class="md:w-1/12 mt-3 ">
                          <form method="post" action="{{ route('cart.delete', ['id' => $product->id]) }}">
                            @csrf
                            <button>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            </button>
                          </form>
                        </div>
                      </div>
                    @endforeach
                    <form action="{{ route('cart.checkout') }}" method="post">
                      @csrf
                      <div class="flex flex-col text-center w-full mb-4 mt-10"><h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">決済方法</h1></div>
                    <div class="p-2 w-3/4 mx-auto">
                      <div class="relative flex justify-around mb-4 items-center">
                        <div><input type="radio" name="payment" value="1" class="mr-2" checked>銀行振込</div>
                        <div><input type="radio" name="payment" value="2" class="mr-2">カード決済</div>
                        <div><input type="radio" name="payment" value="3" class="mr-2">代引き</div>
                        <x-button class="ml-8 py-2 px-4">
                    {{ __('購入確定') }}
                </x-button>
                    </div>
                    </form>
                  @else
                    <p class="text-center">カートに商品が入っていません。</p>
                  @endif
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
