<?php

namespace App\Filament\Dosen\Resources\Materials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

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
                    ->disk('public')
                    ->preserveFilenames()
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/vnd.ms-powerpoint',
                        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    ])
                    ->required(),
                    
                Hidden::make('dosen_id')
                    ->default(function () {
                        return Auth::user()->dosen->id; // ambil ID dosen dari tabel dosens
                    }),
            ]);
    }
}
