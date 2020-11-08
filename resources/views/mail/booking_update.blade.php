<p>{{$content->nickname}}様、ご予約内容の変更を承りました。</p>
<br>
<p>変更後の予約内容は以下の通りです。</p>
<p>-------------------------------</p>
<ul>
    <li>予約番号：{{$content->booking_number}}</li>
    <li>日時：{{$content->date}}</li>
    <li>到着予定：{{$content->time}}</li>
    <li>人数：{{$content->people}}</li>
</ul>
<p>-------------------------------</p>

<p>予約内容に変更がある場合は以下URLにアクセスし、予約番号をご入力ください。</p>
<p>{{config('app.url')}}/booking/update</p>
<br>