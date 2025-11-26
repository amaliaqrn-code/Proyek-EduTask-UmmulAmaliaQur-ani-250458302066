<?php

namespace App\Filament\Resources\Assignments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AssignmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('course_id')
                ->options(function () {
                        return \App\Models\Course::pluck('name', 'id');
                    })
                    ->required(),
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                DateTimePicker::make('deadline'),
                Select::make('dosen_id')
                ->label('Dosen')
                ->options(function () {
                    return \App\Models\Dosen::with('user')
                        ->get()
                        ->pluck('user.name', 'id');
                })
                ->default(null),
            ]);
    }
}
