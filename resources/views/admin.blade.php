<x-app-layout>
<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
        <!-- タイトルロゴ -->
        <div class="flex flex-col text-center w-full mb-20">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-10 text-gray-900">管理者画面</h1>
        </div>

        <div class="flex flex-wrap -m-4">
            <div class="p-4 lg:w-1/3">
                <a href="{{ route('order.index') }}" class="hover:no-underline">
                <div class="h-full bg-white bg-opacity-75 px-8 pt-16 pb-16 rounded-lg overflow-hidden text-center relative hover:ring-2 hover:ring-gray-400">
                    <h1 class="title-font sm:text-2xl text-xl font-medium text-gray-900 mb-3">受注リスト</h1>
                    <p class="leading-relaxed mb-3">Order List</p>
                </div>
                </a>
            </div>
            <div class="p-4 lg:w-1/3">
                <a href="{{ route('contact.index') }}" class="hover:no-underline">
                <div class="h-full bg-white bg-opacity-75 px-8 pt-16 pb-16 rounded-lg overflow-hidden text-center relative hover:ring-2 hover:ring-gray-400">
                    <h1 class="title-font sm:text-2xl text-xl font-medium text-gray-900 mb-3">問い合わせ</h1>
                    <p class="leading-relaxed mb-3">Contact</p>
                </div>
                </a>
            </div>
            <div class="p-4 lg:w-1/3">
                <a href="{{ route('index') }}" class="hover:no-underline">
                <div class="h-full bg-white bg-opacity-75 px-8 pt-16 pb-16 rounded-lg overflow-hidden text-center relative hover:ring-2 hover:ring-gray-400">
                    <h1 class="title-font sm:text-2xl text-xl font-medium text-gray-900 mb-3">商品一覧</h1>
                    <p class="leading-relaxed mb-3">Products</p>
                </div>
                </a>
            </div>
        </div>
        
    </div>
</section>

</x-app-layout>
