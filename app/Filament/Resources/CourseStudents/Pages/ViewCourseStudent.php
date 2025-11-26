<?php

namespace App\Filament\Resources\CourseStudents\Pages;

use App\Filament\Resources\CourseStudents\CourseStudentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCourseStudent extends ViewRecord
{
    protected static string $resource = CourseStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
