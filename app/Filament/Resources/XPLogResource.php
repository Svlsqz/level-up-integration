<?php

namespace App\Filament\Resources;

use App\Filament\Resources\XPLogResource\Pages;
use App\Models\XPLog;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\CreateRecord;
use Filament\Tables\Columns\TextColumn;

class XPLogResource extends Resource
{
    protected static ?string $model = XPLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Gamification';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('user_id')
                ->label('User')
                ->relationship('user', 'name')
                ->searchable()
                ->required(),

            TextInput::make('points')
                ->numeric()
                ->required()
                ->label('XP Points'),

            Textarea::make('reason')
                ->rows(3)
                ->maxLength(255)
                ->label('Reason')
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('user.name')->label('User'),
            TextColumn::make('points')->label('XP'),
            TextColumn::make('reason')->label('Reason')->limit(30),
            TextColumn::make('created_at')->label('Date')->dateTime(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListXPLogs::route('/'),
            'create' => Pages\CreateXPLog::route('/create'),
            'edit' => Pages\EditXPLog::route('/{record}/edit'),
        ];
    }
}
