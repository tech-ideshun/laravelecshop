<x-app-layout>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
              <div class="flex flex-col text-center w-full mb-4 mt-10"><h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">購入履歴</h1></div>

                  @if (count($orders) > 0)
                    @foreach ($orders as $order)
                      <div class="md:flex md:items-start w-3/4 mx-auto mb-3">
                        <div class="md:w-2/12">
                          <div>{{ $order->purchase_date }}</div>
                        </div>
                        <div class="md:w-2/12">
                          @if ($order->product->image1 !== null)
                            <img class="w-full h-auto" src="{{ asset('storage/upload_img/' . $order->product->image1) }}">
                          @else
                            <img src="">
                          @endif
                        </div>
                        <div class="md:w-5/12 ml-2">{{ $order->product->name }}</div>
                        <div class="md:w-1/12 flex justify-around">
                          <div>{{ $order->quantity }}個</div>
                        </div>
                        <div class="md:w-2/12">
                          <div>{{ number_format($order->product->price) }}<span class="text-sm text-gray-700">円(税込)</span></div>
                        </div>
                      </div>
                    @endforeach
                    
                  @else
                  <p class="text-center">まだ購入されていません。</p>
                  @endif
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
