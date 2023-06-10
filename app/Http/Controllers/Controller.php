<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Vendor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        //its just a dummy data object.
        $customers = Customer::all();

        $vendors = Vendor::all();

        // Sharing is caring
        View::share(['customers' => $customers, 'vendors' => $vendors]);
    }

    public function backToForm(string $message, string $alertType = 'success')
    {
        if(request()->expectsJson()){
            return compact('message', 'type');
        }
        return redirect()->back()->with('form-alert', $message)->with('form-alert-type', $alertType);
    }

    public function redirectToForm(string $route, array $params, string $message, string $alertType = 'success')
    {
        return redirect()->route($route, $params)->with('form-alert', $message)->with('form-alert-type', $alertType);
    }
}
