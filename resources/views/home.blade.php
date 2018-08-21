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
                        <div class="panel-body table-responsive">
                        </div>
                        <div id="app">
                            <h2>Proxy list</h2>
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
