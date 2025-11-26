<?php

namespace App\Filament\Resources\Submissions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SubmissionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('assignment_id')
                    ->numeric(),
                TextEntry::make('mahasiswa_id')
                    ->numeric(),
                TextEntry::make('file_url'),
                TextEntry::make('status'),
                TextEntry::make('submitted_at')
                    ->dateTime(),
                TextEntry::make('points_awarded')
                    ->numeric(),
                TextEntry::make('points_reason'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
