<?php

namespace App\Filament\Dosen\Resources\Submissions;

use App\Filament\Dosen\Resources\Submissions\Pages\CreateSubmission;
use App\Filament\Dosen\Resources\Submissions\Pages\EditSubmission;
use App\Filament\Dosen\Resources\Submissions\Pages\ListSubmissions;
use App\Filament\Dosen\Resources\Submissions\Schemas\SubmissionForm;
use App\Filament\Dosen\Resources\Submissions\Tables\SubmissionsTable;
use App\Models\Submission;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowUp;

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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereIn('assignment_id', Auth::user()->dosen->assignments()->pluck('id'));
    }
}
