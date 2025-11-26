<?php

namespace App\Filament\Mahasiswa\Resources\Materials;

use App\Filament\Mahasiswa\Resources\Materials\Pages\CreateMaterial;
use App\Filament\Mahasiswa\Resources\Materials\Pages\EditMaterial;
use App\Filament\Mahasiswa\Resources\Materials\Pages\ListMaterials;
use App\Filament\Mahasiswa\Resources\Materials\Schemas\MaterialForm;
use App\Filament\Mahasiswa\Resources\Materials\Tables\MaterialsTable;
use App\Models\Material;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $recordTitleAttribute = 'material';

    public static function form(Schema $schema): Schema
    {
        return MaterialForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MaterialsTable::configure($table);
    }

    // khusus buat materi kuliah yang dia ambil

    //     public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()
    //         ->whereHas('course.mahasiswas', function (Builder $q) {
    //             $q->where('mahasiswa_id', Filament::auth()->user()->mahasiswa->id);
    //         });
    // }

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
}
