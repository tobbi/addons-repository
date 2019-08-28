<?php

namespace App\Listeners;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

use App\Events\AddonUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DiscordAddonUpdateNotificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AddonUpdated  $event
     * @return void
     */
    public function handle(AddonUpdated $event)
    {
        $discord_webhook = env('DISCORD_WEBHOOK', null);
        if($discord_webhook != null)
        {
            $client = new Client();
            $response = $client->post($discord_webhook, [
                RequestOptions::JSON => ['content' => 'Update: '.$event->addon->description.": ".$event->revision->revision_text]
            ]);
        }
    }
}
