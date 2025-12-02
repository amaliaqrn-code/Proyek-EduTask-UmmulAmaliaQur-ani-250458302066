<?php

namespace App\Filament\Dosen\Resources\CourseResource\Pages;

use App\Filament\Dosen\Resources\Courses\CourseResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentCourseImport;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EditCourse extends EditRecord
{
    protected static string $resource = CourseResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Action::make('importMahasiswa')
                ->label('Import Mahasiswa')
                ->icon('heroicon-o-arrow-up-tray')

                ->modalHeading('Upload Excel Mahasiswa')
                ->modalSubmitActionLabel('Import')

                ->form([
                    FileUpload::make('file')
                        ->label('Upload Excel (.xlsx)')
                        ->required()
                        ->acceptedFileTypes([
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        ]),
                ])
                ->action(function (array $data) {

                    $course = $this->record;

                    // ✅ VALIDASI DOSEN YANG AKSES COURSE
                    if ($course->dosen_id !== Auth::user()->dosen->id) {
                        abort(403, 'Kelas ini bukan milik anda.');
                    }

                    // ✅ PROSES IMPORT
                    $filePath = Storage::disk('local')->path($data['file']);

                    Excel::import(
                        new StudentCourseImport($course),
                        $filePath
                    );
                    // ✅ NOTIFIKASI
                    Notification::make()
                        ->title('Mahasiswa berhasil di-import')
                        ->success()
                        ->send();
                }),

        ];
    }
}
