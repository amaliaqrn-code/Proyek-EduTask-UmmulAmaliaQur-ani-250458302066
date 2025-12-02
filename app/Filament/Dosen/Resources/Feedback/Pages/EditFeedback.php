<?php

namespace App\Filament\Dosen\Resources\Feedback\Pages;

use App\Filament\Dosen\Resources\Feedback\FeedbackResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFeedback extends EditRecord
{
    protected static string $resource = FeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

      protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
