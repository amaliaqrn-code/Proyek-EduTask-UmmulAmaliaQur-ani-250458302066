<?php

namespace App\Filament\Dosen\Resources\Forums;

use App\Filament\Dosen\Resources\Forums\Pages\CreateForum;
use App\Filament\Dosen\Resources\Forums\Pages\EditForum;
use App\Filament\Dosen\Resources\Forums\Pages\ListForums;
use App\Filament\Dosen\Resources\Forums\Schemas\ForumForm;
use App\Filament\Dosen\Resources\Forums\Tables\ForumsTable;
use App\Models\Forum;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ForumResource extends Resource
{
    protected static ?string $model = Forum::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleBottomCenterText;

    public static function form(Schema $schema): Schema
    {
        return ForumForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ForumsTable::configure($table);
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
            'index' => ListForums::route('/'),
            'create' => CreateForum::route('/create'),
            'edit' => EditForum::route('/{record}/edit'),
        ];
    }
}
