<?php

namespace App\Filament\Dosen\Resources\Submissions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('assignment_id')
                    ->label('Assignment')
                    ->relationship('assignment', 'title')
                    ->getOptionLabelFromRecordUsing(
                        fn (\App\Models\Assignment $record) =>
                            $record->title . ' - ' . $record->course->name
                    )
                    ->required(),
                TextInput::make('mahasiswa_id')
                    ->required()
                    ->numeric(),
                TextInput::make('file_url')
                    ->default(null),
                Select::make('status')
                    ->options(['submitted' => 'Submitted', 'late' => 'Late', 'not_submitted' => 'Not submitted'])
                    ->default('not_submitted')
                    ->required(),
                DateTimePicker::make('submitted_at'),
                TextInput::make('points_awarded')
                    ->numeric()
                    ->default(null),
                TextInput::make('points_reason')
                    ->default(null),
            ]);
    }
}
