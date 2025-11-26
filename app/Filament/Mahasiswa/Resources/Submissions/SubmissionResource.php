<?php

namespace App\Filament\Mahasiswa\Resources\Submissions;

use App\Filament\Mahasiswa\Resources\Submissions\Pages\CreateSubmission;
use App\Filament\Mahasiswa\Resources\Submissions\Pages\EditSubmission;
use App\Filament\Mahasiswa\Resources\Submissions\Pages\ListSubmissions;
use App\Filament\Mahasiswa\Resources\Submissions\Schemas\SubmissionForm;
use App\Filament\Mahasiswa\Resources\Submissions\Tables\SubmissionsTable;
use App\Models\Submission;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowUpTray;

    protected static ?string $recordTitleAttribute = 'submission';

    public static function form(Schema $schema): Schema
    {
        return SubmissionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubmissionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSubmissions::route('/'),
            'create' => CreateSubmission::route('/create'),
            'edit' => EditSubmission::route('/{record}/edit'),
        ];
    }
}
