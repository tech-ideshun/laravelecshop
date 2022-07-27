<x-app-layout>
<section class="text-gray-600 body-font flex justify-center flex-col gap-5">
<div class="container px-10 py-24 mx-auto">

    <!-- タイトルロゴ -->
    <div class="flex flex-col text-center w-full mb-10">
        <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">受注リスト</h1>
    </div>

    <!-- ラジオボタン -->
    <label><input type="radio" id="order_unsupported_button" name="tab_item" value="未対応">未対応</label>
    <label><input type="radio" id="order_supported_button" name="tab_item" value="対応済" checked>対応済</label>

    <!-- 受注一覧（対応済） -->
    <table class="table table-striped min-w-full" id="all" style="display: block;">
    <!-- テーブルヘッダ -->
    <thead>
        <tr>
        <th class="hidden">ID</th>
        <th>日付</th>
        <th>番号</th>
        <th>商品名</th>
        <th>数量</th>
        <th>顧客</th>
        <th>郵便番号</th>
        <th>住所</th>
        </tr>
    </thead>
    @foreach($orders2 as $order2)
    @if($order2->status == 2)
    <tr>
        <td class="hidden">{{$order2->id}}</td> 
        <td class="w-2/12">{{$order2->purchase_date}}</td>
        <td class="w-1/12 break-all">{{$order2->order_number}}</td>
        <td class="w-1/12">{{$order2->product->name}}</td>
        <td class="w-1/12">{{$order2->quantity}}</td>
        <td class="w-1/12">{{$order2->user->name}}</td>
        <td class="w-1/12">{{$order2->user->post_number}}</td>
        <td class="w-4/12">{{$order2->user->address}}</td>
    </tr>
    @endif
    @endforeach
    </tbody>
    </table>

    <!-- paginate -->
    <div>{{ $orders2->links() }}</div>

</div>
</section>
<script>
    $(function(){
        $("#order_unsupported_button").click(function(){
            window.location.href = '/order';
        });
    });
    $(function() {
        $("#order_supported_button").prop('checked', true);
    });
</script>
</x-app-layout>

