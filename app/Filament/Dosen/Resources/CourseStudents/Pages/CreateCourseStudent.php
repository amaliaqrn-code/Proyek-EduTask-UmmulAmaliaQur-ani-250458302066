<?php

namespace App\Filament\Dosen\Resources\CourseStudents\Pages;

use App\Filament\Dosen\Resources\CourseStudents\CourseStudentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCourseStudent extends CreateRecord
{
    protected static string $resource = CourseStudentResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
