<?php

namespace App\Filament\Dosen\Resources\Forums\Pages;

use App\Filament\Dosen\Resources\Forums\ForumResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListForums extends ListRecords
{
    protected static string $resource = ForumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
