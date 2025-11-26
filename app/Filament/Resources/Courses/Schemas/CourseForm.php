<?php

namespace App\Filament\Resources\Courses\Schemas;

use App\Models\Dosen;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->label('Nama Mata Kuliah')
                ->required(),

            TextInput::make('code')
                ->label('Kode')
                ->required(),

            Textarea::make('description')
                ->label('Deskripsi')
                ->nullable(),

            Select::make('dosen_id')
            ->label('Dosen')
            ->relationship('dosen', 'nidn')
            ->getOptionLabelFromRecordUsing(
                fn (\App\Models\Dosen $record) => $record->user->name . ' - ' . $record->department
            )
            ->required(),
        ]);
    }
}
