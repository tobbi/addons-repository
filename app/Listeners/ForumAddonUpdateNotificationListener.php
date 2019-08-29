<?php

namespace App\Listeners;

use Acme\Client;

use App\Events\AddonUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForumAddonUpdateNotificationListener
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
            $addon = $event->addon;
            $revision = $event->revision;
            $response = $client->post($discord_webhook, [
                RequestOptions::JSON => ['content' => 'Update: '.$addon->description.": ".$revision->revision_text.". Check it out: ".route('addon_download', $addon->id)]
            ]);
        }
    }
}
