<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Log;

class CompanyController extends Controller
{
    public function getCompany(Request $request)
    {
        try {
            return $request->user()->company;
        } catch (\Throwable $th) {
            Log::error('Company fetch failed!', ['error' => $th->getMessage()]);
            return response()->json(['error' => 'Company fetch failed!'], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $company = $request->user()->company;
            $company->update($request->all());
            if($request->has('address')) {
                $company->address()->update($request->get('address'));
            }
            return $company;
        } catch (\Throwable $th) {
            Log::error('Company update failed!', ['error' => $th->getMessage()]);
            return response()->json(['error' => 'Company update failed!'], 500);
        }
    }
}
