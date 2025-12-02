<?php

namespace App\Filament\Dosen\Resources\CourseStudents\Pages;

use App\Filament\Dosen\Resources\CourseStudents\CourseStudentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCourseStudent extends EditRecord
{
    protected static string $resource = CourseStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
