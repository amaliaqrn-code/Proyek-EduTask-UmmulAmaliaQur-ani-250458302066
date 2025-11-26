<?php

namespace App\Filament\Dosen\Resources\Assignments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class AssignmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('course_id')
                    ->label('Mata Kuliah')
                    ->options(function () {
                            return \App\Models\Course::pluck('name', 'id');
                        })
                    ->required(),
                TextInput::make('title')
                    ->label('Judul Tugas')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->required()
                    ->columnSpanFull(),
                DateTimePicker::make('deadline'),
                Hidden::make('dosen_id')
                    ->label('Nama Dosen')
                    ->required()
                    ->default(function () {
                        return Auth::user()->dosen->id; // ambil ID dosen dari tabel dosens
                    })
            ]);
    }
}
