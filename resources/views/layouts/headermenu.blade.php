                                    <a class="dropdown-item" href="{{ route('home') }}">ホーム</a>
                                    <a class="dropdown-item" href="{{ route('userManagement') }}">入退店管理</a>
                                    <a class="dropdown-item" href="{{ route('realtime') }}">リアルタイム状況確認</a>
                                    <a class="dropdown-item" href="{{ route('feeSystem') }}">料金システム編集</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>