<x-app-layout>
<section class="text-gray-600 body-font flex justify-center flex-col gap-5">
<div class="container px-10 py-24 mx-auto">

        <!-- タイトルロゴ -->
        <div class="flex flex-col text-center w-full mb-20">
            <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">問い合わせリスト</h1>
        </div>

        <!-- ラジオボタン -->
        <label><input type="radio" id="contact_unsupported_button" name="tab_item" value="未対応">未対応</label>
        <label><input type="radio" id="contact_supported_button" name="tab_item" value="対応済" checked>対応済</label>

        <!-- 問い合わせ一覧（対応済） -->
        <table class="table table-striped" id="all" style="display: block;">
        <!-- テーブルヘッダ -->
        <thead>
            <tr>
            <!-- <th>ID</th> //会員情報取得用にidがいる為コメントアウトで非表示-->
            <th>日付</th>
            <th>タイトル</th>
            <th>内容</th>
            </tr>
        </thead>
        @foreach($contacts2 as $contact2)
        @if($contact2->status == 2)
        <!-- テーブル本体 -->
        <tbody>
            <tr>
                <!-- <td class="table-text">{{$contact2->id}}</td> //会員情報取得用にidがいる為コメントアウトで非表示-->
                <td class="table-text w-2/12">{{$contact2->created_at}}</td>
                <td class="table-text w-2/12 break-all">{{$contact2->title}}</td>
                <td class="table-text w-8/12">{{$contact2->content}}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
        </table>

    <!-- paginate -->
    <div>{{ $contacts2->links() }}</div>
</div>
</section>
<script>
    $(function(){
        $("#contact_unsupported_button").click(function(){
            window.location.href = '/contact';
        });
    });
    $(function() {
        $("#contact_supported_button").prop('checked', true);
    });
</script>
</x-app-layout>

