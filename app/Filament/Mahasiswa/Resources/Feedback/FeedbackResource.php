<?php

namespace App\Filament\Mahasiswa\Resources\Feedback;

use App\Filament\Mahasiswa\Resources\Feedback\Pages\CreateFeedback;
use App\Filament\Mahasiswa\Resources\Feedback\Pages\EditFeedback;
use App\Filament\Mahasiswa\Resources\Feedback\Pages\ListFeedback;
use App\Filament\Mahasiswa\Resources\Feedback\Schemas\FeedbackForm;
use App\Filament\Mahasiswa\Resources\Feedback\Tables\FeedbackTable;
use App\Models\Feedback;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static ?string $recordTitleAttribute = 'feedback';

    public static function form(Schema $schema): Schema
    {
        return FeedbackForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FeedbackTable::configure($table);
    }

    // hanya bisa lihat feedback milik da sendiri

        public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('mahasiswa_id', Filament::auth()->user()->mahasiswa->id);
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
            'index' => ListFeedback::route('/'),
            'create' => CreateFeedback::route('/create'),
            'edit' => EditFeedback::route('/{record}/edit'),
        ];
    }
}
