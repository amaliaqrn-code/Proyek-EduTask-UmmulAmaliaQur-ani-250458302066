<?php

namespace App\Filament\Mahasiswa\Resources\Submissions\Schemas;

use App\Models\Assignment;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class SubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            //Ngambil Assignment_id bedasarkan apa yang di klik
            Hidden::make('assignment_id')
                ->default(fn () => request()->query('assignment_id'))
                ->required(),

            // submited_by otomatis sesuai dengan mahasiswa yang login
            Hidden::make('mahasiswa_id')
                ->default(fn () => Filament::auth()->user()->mahasiswa->id)
                ->required(),

            // Upload File
            FileUpload::make('file_url')
                ->directory('tugas')
                ->disk('public')
                ->preserveFilenames()
                ->enableOpen()
                ->enableDownload(),
        ]);
    }
}
