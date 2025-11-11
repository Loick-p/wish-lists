<?php

namespace App\Observers;

use App\Models\Gift;
use App\Services\FileService;

class GiftObserver
{
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Handle the Gift "deleted" event.
     */
    public function deleted(Gift $gift): void
    {
        // Suppression de l'image du cadeau
        if ($gift->image && $gift->image !== Gift::DEFAULT_GIFT_IMAGE) {
            $this->fileService->delete($gift->image, 'gifts');
        }
    }
}
