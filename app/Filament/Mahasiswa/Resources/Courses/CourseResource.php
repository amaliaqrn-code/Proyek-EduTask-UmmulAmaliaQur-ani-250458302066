<?php

namespace App\Filament\Mahasiswa\Resources\Courses;

use App\Filament\Mahasiswa\Resources\Courses\Pages\CreateCourse;
use App\Filament\Mahasiswa\Resources\Courses\Pages\EditCourse;
use App\Filament\Mahasiswa\Resources\Courses\Pages\ListCourses;
use App\Filament\Mahasiswa\Resources\Courses\Schemas\CourseForm;
use App\Filament\Mahasiswa\Resources\Courses\Tables\CoursesTable;
use App\Models\Course;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    // Icon untuk panel mahasiswa
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return CourseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CoursesTable::configure($table);
    }

    /**
     *  Filter course hanya yang sedang diambil mahasiswa
     */

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCourses::route('/'),
            'create' => CreateCourse::route('/create'),
            'edit' => EditCourse::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $mahasiswaId = Auth::user()->mahasiswa->id ?? null;

        return parent::getEloquentQuery()
            ->when($mahasiswaId, fn ($q) => $q->where('mahasiswa_id', $mahasiswaId));
    }
}
