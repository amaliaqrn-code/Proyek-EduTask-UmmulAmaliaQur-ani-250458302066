<?php

namespace App\Filament\Mahasiswa\Resources\Assignments;

use App\Filament\Mahasiswa\Resources\Assignments\Pages\CreateAssignment;
use App\Filament\Mahasiswa\Resources\Assignments\Pages\EditAssignment;
use App\Filament\Mahasiswa\Resources\Assignments\Pages\ListAssignments;
use App\Filament\Mahasiswa\Resources\Assignments\Schemas\AssignmentForm;
use App\Filament\Mahasiswa\Resources\Assignments\Tables\AssignmentsTable;
use App\Models\Assignment;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AssignmentResource extends Resource
{
    protected static ?string $model = Assignment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocument;

    protected static ?string $recordTitleAttribute = 'assignment';

    public static function form(Schema $schema): Schema
    {
        return AssignmentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AssignmentsTable::configure($table);
    }

       // khusus apa yang dia ambil (course)
       

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
}
