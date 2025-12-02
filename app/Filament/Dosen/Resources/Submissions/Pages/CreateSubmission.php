<?php

namespace App\Filament\Dosen\Resources\Submissions\Pages;

use App\Filament\Dosen\Resources\Submissions\SubmissionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSubmission extends CreateRecord
{
    protected static string $resource = SubmissionResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
