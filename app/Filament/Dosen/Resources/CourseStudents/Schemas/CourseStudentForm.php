<?php

namespace App\Filament\Dosen\Resources\CourseStudents\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CourseStudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('course_id')
                    ->required()
                    ->numeric(),
                TextInput::make('mahasiswa_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
