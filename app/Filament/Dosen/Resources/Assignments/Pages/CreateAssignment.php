<?php

namespace App\Filament\Dosen\Resources\Assignments\Pages;

use App\Filament\Dosen\Resources\Assignments\AssignmentResource;
use App\Models\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateAssignment extends CreateRecord
{
    protected static string $resource = AssignmentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        // Ambil course dari assignment yang baru dibuat
        $course = $this->record->course;

        // Ambil semua MAHASISWA yang mengambil course tersebut
        $mahasiswas = $course->mahasiswas;

        foreach ($mahasiswas as $mhs) {
            Notification::create([
                'user_id' => $mhs->user_id, // FK ke users table
                'type' => 'new_assignment',
                'message' => "Tugas baru untuk mata kuliah {$course->name}: {$this->record->title}",
                'is_read' => false,
            ]);
        }
    }
}
