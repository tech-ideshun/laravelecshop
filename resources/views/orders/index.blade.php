<x-app-layout>
<section class="text-gray-600 body-font flex justify-center flex-col gap-5">
<div class="container px-10 py-24 mx-auto">

    <!-- タイトルロゴ -->
    <div class="flex flex-col text-center w-full mb-10">
        <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">受注リスト</h1>
    </div>

    <!-- ラジオボタン -->
    <label><input type="radio" id="order_unsupported_button" name="tab_item" value="未対応" checked>未対応</label>
    <label><input type="radio" id="order_supported_button" name="tab_item" value="対応済">対応済</label>

    <!-- 受注一覧（未対応） -->
    <table class="table table-striped min-w-full" id="all" style="display: block;">
    <!-- テーブルヘッダ -->
    <thead>
        <tr>
        <!-- <th>ID</th> -->
        <th>日付</th>
        <th>番号</th>
        <th>商品名</th>
        <th>数量</th>
        <th>顧客</th>
        <th>郵便番号</th>
        <th>住所</th>
        </tr>
    </thead>
    @foreach($orders as $order)
    @if($order->status == 1)

    <tr>
        <!-- <td>{{$order->id}}</td> // 会員情報取得用にidがいる為コメントアウトで非表示 -->
        <td class="w-2/12">{{$order->purchase_date}}</td>
        <td class="w-1/12 break-all">{{$order->order_number}}</td>
        <td class="w-1/12">{{$order->product->name}}</td>
        <td class="w-1/12">{{$order->quantity}}</td>
        <td class="w-1/12">{{$order->user->name}}</td>
        <td class="w-1/12">{{$order->user->post_number}}</td>
        <td class="w-4/12">{{$order->user->address}}</td>
        <td class="w-1/12 px-0">
            <form action="{{ route('order.update') }}" method="post">
                @csrf
                <input type="hidden" name="order_id" value="{{$order->id}}">
                <x-button class="py-1 px-1">
                    {{ __('完了') }}
                </x-button>
            </form>
        </td>
    </tr>
    @endif
    @endforeach
    </tbody>
    </table>

    <!-- paginate -->
    <div>{{ $orders->links() }}</div>

</div>
</section>
<script>
    $(function(){
        $("#order_supported_button").click(function(){
            window.location.href = '/order2';
            $("#order_unsupported_button").prop('checked', true);
        });
    });
</script>
</x-app-layout>