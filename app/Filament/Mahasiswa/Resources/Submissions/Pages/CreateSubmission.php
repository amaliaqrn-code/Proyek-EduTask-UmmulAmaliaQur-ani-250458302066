<?php

namespace App\Filament\Mahasiswa\Resources\Submissions\Pages;

use App\Filament\Mahasiswa\Resources\Submissions\SubmissionResource;
use App\Models\Assignment;
use App\Models\ActivityPoint;
use Filament\Resources\Pages\CreateRecord;
use Filament\Facades\Filament;

class CreateSubmission extends CreateRecord
{
    protected static string $resource = SubmissionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ambil dari hidden field, bukan query (FIX)
        $assignmentId = $data['assignment_id'] ?? null;

        if (!$assignmentId) {
            throw new \Exception("Assignment ID tidak dikirim ke form.");
        }

        $assignment = Assignment::find($assignmentId);

        if (!$assignment) {
            throw new \Exception("Assignment dengan ID {$assignmentId} tidak ditemukan.");
        }

        // mahasiswa login
        $data['mahasiswa_id'] = Filament::auth()->user()->mahasiswa->id;

        // status auto
        if ($assignment->deadline) {
            $data['status'] = now()->greaterThan($assignment->deadline)
                ? 'late'
                : 'submitted';
        } else {
            $data['status'] = 'submitted';
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        $submission = $this->record;
        $assignment = $submission->assignment;

        $mahasiswaId = $submission->mahasiswa_id;

        // Hitung poin
        if ($assignment && $assignment->deadline && $submission->created_at <= $assignment->deadline) {
            $points = 10;
            $badge = "On Time";
        } else {
            $points = 5;
            $badge = null;
        }

        // untuk masukin poin ke activity_point
        ActivityPoint::create([
            'mahasiswa_id'  => $mahasiswaId,
            'submission_id' => $submission->id,
            'points'        => $points,
            'badge'         => $badge,
        ]);

        // Memunculkan poin otomatis di table submission ketika mahasiswa ngirim tugas
         $submission->update([
        'points_awarded' => $points,
        'points_reason'  => $badge,
    ]);
    }
}
