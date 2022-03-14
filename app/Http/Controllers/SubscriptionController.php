<?php

namespace App\Http\Controllers;

use App\Facades\EmailHelperFacade;
use App\Helpers\EmailHelper;
use App\Http\Requests\UnsubscribeRequest;
use App\Interfaces\SubscriptionServiceInterface;
use App\Http\Requests\SubscriptionRequest;
use Illuminate\Http\Request;
use App\Jobs\SendSubscribeNews;

class SubscriptionController extends Controller
{
    private $subscriptionService;

    /* Abstrakcijos dependency infection į construct */
    public function __construct(SubscriptionServiceInterface $subscriptionServiceInterface)
    {
        $this->subscriptionService = $subscriptionServiceInterface;
    }

    /**
     * Show subscription page view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function subscription(Request $request)
    {
        return view('subscribe', ['success' => $request->success]);
    }

    /**
     * Subscribe with email
     * @param SubscriptionRequest $request
     */

    public function subscribe(SubscriptionRequest $request)
    {
        $subscribe = $this->subscriptionService->subscribe($request->email, $request->name);

        return redirect()->route('subscribe_view', ['success' => (boolean)$subscribe]);
    }

    /**
     * Unsubscribe
     * @param UnsubscribeRequest $request
     * @return \Illuminate\Contracts\View\View
     */

    public function unsubscribe(UnsubscribeRequest $request)
    {
        $unsubscribe = $this->subscriptionService->unsubscribe($request->email, $request->hash);

        return view('unsubscribe', ['success' => $unsubscribe]);
    }

    /**
     * Facade demonstration
     * @param EmailHelper $emailHelper
     * @return mixed
     */

    public function facade(EmailHelperFacade $emailHelper)
    {
        //SendSubscribeNews::dispatch(); //galime pažiurėti kaip veikia mėnesinė prenumerata visiems be schedule sulaukimo
        return $emailHelper::success();
    }
}
