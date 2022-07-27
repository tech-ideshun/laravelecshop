<x-app-layout>
<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
        <!-- タイトルロゴ -->
        <div class="flex flex-col text-center w-full mb-20">
            <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">商品一覧</h1>
        </div>
        
        <!-- 検索欄 -->
        <div class="text-gray-600 mb-20 items-center mr-0">
            <form action="{{ route('products') }}" method="GET">
            <input type="text" name="keyword" placeholder="Search" class="bg-white h-10 px-5 pr-10 rounded-full text-sm focus:outline-none" value="{{$keyword}}">
            <div class="items-center inline-flex ml-2">
            <button type="submit" class="">
            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
            </svg>
            </button>
</div>
            </form>
        </div>
        <!-- 商品サムネ -->
        <div class="flex flex-wrap -m-4 mb-20">
        @foreach ($products as $product)
            <div class="lg:w-1/3 sm:w-1/2 p-4">
            <div class="flex relative">
                <img alt="{{ $product->name }}の画像" class="absolute inset-0 w-full h-full object-cover object-center" src="{{url('storage/upload_img')}}/{{$product->image1}}">
                <a href="{{ route('products.show', ['id' => $product->id]) }}" class="block hover:no-underline text-gray-400">

                <div class="px-8 py-10 relative z-10 w-full border-4 border-gray-200 bg-white opacity-0 hover:opacity-80 overflow-hidden h-80 no-underline">
                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $product->name }}</h1>
                    <h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">¥{{ number_format($product->price) }}</h2>
                    <p class="leading-relaxed text-gray-400">{{ $product->info }}</p>
                </div>
</a>
            </div>
            </div>
        @endforeach
        </div>

        
        <!-- 店舗住所 -->
        <div class="block mx-auto text-center my-10">
            <div class="text-left inline-block">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-3 text-gray-900">SHOP A</h1>
                <p>〒123-4567</p>
                <p>東京都千代田区1-1-1</p>
                <iframe class="my-15" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6481.476250875061!2d139.7511786260994!3d35.683449620775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188c0d02d8064d%3A0xd11a5f0b379e6db7!2z55qH5bGF!5e0!3m2!1sja!2sjp!4v1650707787071!5m2!1sja!2sjp" width="300" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" ></iframe>
            </div>
        </div>
    </div>
</section>
</x-app-layout>
