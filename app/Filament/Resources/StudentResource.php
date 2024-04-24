<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Student;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\StudentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StudentResource\RelationManagers;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                       TextInput::make('nim')->required()->unique(ignorable:fn($record) => $record), 
                       TextInput::make('nama')->required(),
                       TextInput::make('tgl lahir')->required(),
                       TextInput::make('alamat')->required(),
                       textinput::make('Ekskul')->required(),
                       Select::make('Jurusan')->options([
                            'SIJ'=>'SIJ',
                            'MLG'=>'MLG',
                            'OTP'=>'OTP',
                            'TKJ'=>'TKJ',
                            'FKK'=>'FKK',
                            'TET'=>'TET',
                            'TLM'=>'TLM',
                            'BDP'=>'BDP',
                            'MTM'=>'MTM',
                       ])
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nim')->sortable()->searchable(),
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('tgl lahir')->sortable()->searchable(),
                TextColumn::make('alamat')->sortable()->searchable(),
                textcolumn::make('Ekskul')->sortable()->searchable(),
                TextColumn::make('Jurusan')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }    
}
