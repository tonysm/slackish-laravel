@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>

                    <div class="panel-body">
                        <div class="form-group">
                            <p class="text-center">
                                To proceed, you need to login.
                            </p>
                            <div class="col-md-6 col-md-offset-3 text-center">
                                <a href="{{ route('auth', ['provider' => 'google']) }}" class="btn btn-primary btn-lg">Login with Google</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
