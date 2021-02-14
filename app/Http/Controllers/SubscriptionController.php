<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
        $this->middleware(['subscribed'])->only('update');
    }

    public function store(Request $request)
    {
        request()->validate([
            'plan' => 'nullable|exists:plans,slug|required',
            'token' => 'required'
        ]);

        $plan = Plan::whereSlug($request->get('plan','medium'))->first();

        $request->user()->newSubscription('default', $plan->stripe_id)
        ->create($request->token);
    }

    public function update(Request $request)
    {
        request()->validate([
            'plan' => 'nullable|exists:plans,slug|required'
        ]);

        $plan = Plan::whereSlug($request->plan)->first();
        if (!$request->user()->canDowngradeToPlan($plan)) {
            throw new Exception();
        }
        if (!$plan->buyable) {
            $request->user()->subscription('default')->cancel();
            return;
        }
        $request->user()->subscription('default')->swap($plan->stripe_id);
    }
}
