<?php
declare(strict_types = 1);

namespace BulletinBoard\UserModule\Application\AddAdvert\Listeners;


use BulletinBoard\UserModule\Application\AddAdvert\Events\SaveImage as Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SaveImage
{
    /**
     * @param Event $image
     */
    public function handle(Event $image): void
    {
        try {
            if (!empty($image->getImage())) {
                Storage::disk('public')
                    ->put( 'advert_photos/', $image->getImage());
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage() . $e->getTraceAsString());
        }
    }
}
