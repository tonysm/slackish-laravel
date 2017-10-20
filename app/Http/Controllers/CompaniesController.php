<?php

namespace App\Http\Controllers;

use App\Http\Requests\Companies\CreateCompanyRequest;

class CompaniesController extends Controller
{
    /**
     * Protects this resource from users that already have companies.
     */
    public function __construct()
    {
        $this->middleware('has-company');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * @param \App\Http\Requests\Companies\CreateCompanyRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCompanyRequest $request)
    {
        $request->user()->createCompany($request->name);

        return redirect()
            ->route('home');
    }
}
