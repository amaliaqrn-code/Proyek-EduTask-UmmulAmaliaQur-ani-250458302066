<?php

namespace App\Filament\Resources\Materials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MaterialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('course_id')
                    ->label('Mata Kuliah')
                    ->relationship('course', 'name')
                    ->required(),
                TextInput::make('title')
                    ->label('Judul Materi')
                    ->required(),
                FileUpload::make('file_url')
                    ->label('Upload File Materi')
                    ->directory('materials')
                    ->preserveFilenames()
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/vnd.ms-powerpoint',
                        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    ])
                    ->required(),
                Select::make('dosen_id')
                    ->relationship('dosen', 'nidn')
                    ->getOptionLabelFromRecordUsing(
                            fn (\App\Models\Dosen $record) => $record->user->name . ' - ' . $record->department
                        )
                    ->label('Dosen')
                    ->nullable(),
            ]);
    }
}
