@extends('layouts.app')

@section('content')
    <div class="bg-grey-lightest h-screen">
        <div class="container mx-auto flex justify-content">
            <div class="w-2/3 mx-auto my-4">
                <div class="bg-orange-lightest border-l-4 border-orange text-orange-dark p-4" role="alert">
                    <p class="font-bold">Unauthorized!</p>
                    <p>In order to proceed, you need to authenticate.</p>
                </div>

                <div class="w-full my-8">
                    <div class="flex flex-wrap text-center -mx-3 mb-6">
                        <div class="w-full px-3">
                            <a href="{{ route('auth', ['provider' => 'google']) }}" class="no-underline py-4 px-6 border border-purple-lightest bg-white rounded text-purple-light">Login with Google</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
