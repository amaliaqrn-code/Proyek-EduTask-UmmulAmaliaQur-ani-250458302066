<?php

namespace App\Filament\Dosen\Resources\Materials;

use App\Filament\Dosen\Resources\Materials\Pages\CreateMaterial;
use App\Filament\Dosen\Resources\Materials\Pages\EditMaterial;
use App\Filament\Dosen\Resources\Materials\Pages\ListMaterials;
use App\Filament\Dosen\Resources\Materials\Schemas\MaterialForm;
use App\Filament\Dosen\Resources\Materials\Tables\MaterialsTable;
use App\Models\Material;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocument;

    protected static ?string $recordTitleAttribute = 'Material';

    public static function form(Schema $schema): Schema
    {
        return MaterialForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MaterialsTable::configure($table);
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
            'index' => ListMaterials::route('/'),
            'create' => CreateMaterial::route('/create'),
            'edit' => EditMaterial::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $dosenId = Auth::user()->dosen->id ?? null;

        return parent::getEloquentQuery()
            ->when($dosenId, fn ($q) => $q->where('dosen_id', $dosenId));
    }
}
