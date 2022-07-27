<x-app-layout>
<section class="text-gray-600 body-font flex justify-center flex-col gap-5">
<div class="container px-10 py-24 mx-auto">

        <!-- タイトルロゴ -->
        <div class="flex flex-col text-center w-full mb-20">
            <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">問い合わせリスト</h1>
        </div>

        <!-- ラジオボタン -->
            <label><input type="radio" id="contact_unsupported_button" name="tab_item" value="未対応" checked>未対応</label>
            <label><input type="radio" id="contact_supported_button" name="tab_item" value="対応済">対応済</label>

        <!-- 問い合わせ一覧（未対応） -->
        <table class="table table-striped" id="all" style="display: block;">
        <!-- テーブルヘッダ -->
        <thead>
            <tr>
            <!-- <th>ID</th> -->
            <th>日付</th>
            <th>タイトル</th>
            <th>内容</th>
            </tr>
        </thead>
        @foreach($contacts as $contact)
        @if($contact->status == 1)
        <!-- テーブル本体 -->
        <tbody>
            <tr>
                <!-- <td class="table-text">{{$contact->id}}</td> -->
                <td class="table-text w-2/12">{{$contact->created_at}}</td>
                <td class="table-text w-2/12 break-all">{{$contact->title}}</td>
                <td class="table-text w-6/12">{{$contact->content}}</td>
                <td class="table-text w-1/12"><a href="mailto:info@example.com">対応</a></td>
                <td class="table-text w-1/12 px-0">
                        <form action="{{ route('contact.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="contact_id" value="{{$contact->id}}">
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
    <div>{{ $contacts->links() }}</div>
</div>
</section>
<script>
    $(function(){
        $("#contact_supported_button").click(function(){
            window.location.href = '/contact2';
            $("#contact_unsupported_button").prop('checked', true);
        });
    });
</script>
</x-app-layout>