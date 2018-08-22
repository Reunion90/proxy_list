@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div id="app">
                            <h2>Proxy list</h2>
                            {{-- FILTER --}}
                            <form class="card mb-2" action="{{action('ProxyListController@index')}}" method="GET">
                                <div class="form-inline mt-2 mb-2">
                                    <div class="form-group col-auto">
                                        <label for="country" class="control-label">Страна: </label>
                                        <select type="text"  class="form-control" name="country" id="country">
                                            <option value="" {{ $country=== null? 'selected' : '' }}>Все</option>
                                            @foreach($countries as $key => $countryItem)
                                                <option value="{{$countryItem}}" {{ $country=== $countryItem? 'selected' : '' }}>
                                                    {{$countryItem}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-auto">
                                        <label for="anonymity" class="control-label">Анонимность: </label>
                                        <select type="text"  class="form-control" name="anonymity" id="anonymity">
                                            <option value="" {{ $anonymity=== null? 'selected' : '' }}>Все</option>
                                            @foreach($anonymities as $key => $anonymityItem)
                                                <option value="{{$anonymityItem}}" {{ $anonymity=== $anonymityItem? 'selected' : '' }}>
                                                    {{$anonymityItem}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-auto">
                                        <label for="access" class="control-label">Доступность: </label>
                                        <select class="form-control custom-select" name="access" id="access">
                                            <option value="" {{$access ===''? 'selected':''}}>Все</option>
                                            <option value="0" {{$access ==='0'? 'selected':''}}>Не доступен</option>
                                            <option value="1" {{$access ==='1'? 'selected':''}}>Доступен</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-auto">
                                        <button type="submit" class="btn btn-primary">Приенить</button>
                                    </div>
                                </div>
                            </form>

                            {{-- TABLE --}}
                            <table class="table table-striped table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>IP</th>
                                        <th>порт</th>
                                        <th>Страна</th>
                                        <th>Анонимность</th>
                                        <th>Доступность</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list as $key => $item)
                                        <tr>
                                            <td scope="row">{{++$key}}</td>
                                            <td>{{$item->ip}}</td>
                                            <td>{{$item->port}}</td>
                                            <td>{{$item->country}}</td>
                                            <td>{{$item->anonymity}}</td>
                                            <td>{{$item->access? 'Доступен' : 'Недоступен'}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent;
    <script>
      {{--window.user = @json($user);--}}
      {{--window.APP_URL = '{{$app_url}}';--}}
    </script>
@endsection
