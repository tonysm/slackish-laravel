@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Company</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p>You need a company to use this application. Later you can use this Company to invite your team-mates to the application.</p>

                        <form action="{{ route('companies.store') }}" class="form" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Company name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Company name" />
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-default">
                                    Create
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
