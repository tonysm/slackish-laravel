@extends('layouts.app')

@section('content')
    <div class="bg-grey-lightest h-screen">
        <div class="container mx-auto flex justify-content">
            <div class="w-2/3 mx-auto my-4">
                <div class="bg-blue-lightest border-l-4 border-blue text-blue-dark p-4" role="alert">
                    <p class="font-bold">Almost there!</p>
                    <p>In order to proceed, you need to create a company.</p>
                </div>

                <form class="w-full my-8" action="{{ route('companies.store') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="company-name">
                                Company Name
                            </label>
                            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-4 px-4 mb-3" id="company-name" name="name" type="text" placeholder="ie: madewithlove">
                            <p class="text-grey-dark text-xs italic">{{ $errors->first('name') }}</p>
                        </div>

                        <div class="w-full px-3">
                            <button type="submit" class="py-4 px-6 border border-purple-lightest bg-white rounded text-purple-light">
                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
