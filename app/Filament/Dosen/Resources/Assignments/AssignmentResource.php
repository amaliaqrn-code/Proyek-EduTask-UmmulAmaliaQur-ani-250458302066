<?php

namespace App\Filament\Dosen\Resources\Assignments;

use App\Filament\Dosen\Resources\Assignments\Pages\CreateAssignment;
use App\Filament\Dosen\Resources\Assignments\Pages\EditAssignment;
use App\Filament\Dosen\Resources\Assignments\Pages\ListAssignments;
use App\Filament\Dosen\Resources\Assignments\Schemas\AssignmentForm;
use App\Filament\Dosen\Resources\Assignments\Tables\AssignmentsTable;
use App\Models\Assignment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AssignmentResource extends Resource
{
    protected static ?string $model = Assignment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocument;

    protected static ?string $recordTitleAttribute = 'assignment';

    public static function form(Schema $schema): Schema
    {
        return AssignmentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AssignmentsTable::configure($table);
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
            'index' => ListAssignments::route('/'),
            'create' => CreateAssignment::route('/create'),
            'edit' => EditAssignment::route('/{record}/edit'),
        ];
    }

        public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('dosen_id', Auth::user()->dosen->id);
    }
}
