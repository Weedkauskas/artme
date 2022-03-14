<?php

namespace App\Jobs;

use App\Facades\EmailHelperFacade;
use App\Helpers\EmailHelper;
use App\Interfaces\MagicRepositoryInterface;
use App\Interfaces\SubscriptionRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSubscribeNews implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     * @param SubscriptionRepositoryInterface $subscriptionRepository
     * @param MagicRepositoryInterface $magicRepository
     * @param EmailHelper $emailHelper FACADE!!1
     */

    public function handle(SubscriptionRepositoryInterface $subscriptionRepository, MagicRepositoryInterface $magicRepository, EmailHelperFacade $emailHelper)
    {
        $subscriptions = $subscriptionRepository->all();
        $phrases = $magicRepository->allNotNotifiedPhrases();

        if(!$phrases->isEmpty() && !$subscriptions->isEmpty()) {
            //Group phrase by magics
            $magics = $this->groupByMagic($phrases);

            //Let's try some custom facades from emailHelper class
            $emailHelper::send($subscriptions, $magics);

            // Update notified status
            foreach($phrases as $phrase) {
                $magicRepository->notified($phrase->id);
            }
        }
    }

    private function groupByMagic($phrases)
    {
        $magics = [];
        foreach($phrases as $phrase) {
            $magics[$phrase->magic->title][] = $phrase->title;
        }

        return $magics;
    }
}
