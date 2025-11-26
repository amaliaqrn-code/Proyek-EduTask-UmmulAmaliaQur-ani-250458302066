<?php

namespace App\Filament\Mahasiswa\Resources\Feedback\Pages;

use App\Filament\Mahasiswa\Resources\Feedback\FeedbackResource;
use App\Models\Submission;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

class CreateFeedback extends CreateRecord
{
    protected static string $resource = FeedbackResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
{
    $submission = Submission::find($data['submission_id']);

    $data['mahasiswa_id'] = $submission->mahasiswa_id;
    $data['dosen_id'] = Filament::auth()->user()->dosen->id;

    return $data;
}

}
