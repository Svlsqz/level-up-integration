<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChallengeResource\Pages;
use App\Models\Challenge;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class ChallengeResource extends Resource
{
    protected static ?string $model = Challenge::class;
    protected static ?string $navigationIcon = 'heroicon-o-fire';
    protected static ?string $navigationGroup = 'Gamification';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')->required()->maxLength(255),
            Textarea::make('description')->required(),
            Select::make('entity_id')->relationship('entity', 'name')->required(),
            TextInput::make('xp_reward')->numeric()->required(),
            Select::make('status')
                ->required()
                ->options([
                    'open' => 'Open',
                    'in_progress' => 'In Progress',
                    'closed' => 'Closed',
                ]),
            DatePicker::make('deadline')->label('Deadline'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable()->sortable(),
            TextColumn::make('entity.name')->label('Entity'),
            BadgeColumn::make('status')->colors([
                'primary' => 'open',
                'warning' => 'in_progress',
                'danger' => 'closed',
            ]),
            TextColumn::make('xp_reward')->label('XP'),
            TextColumn::make('deadline')->date(),
            TextColumn::make('created_at')->dateTime(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChallenges::route('/'),
            'create' => Pages\CreateChallenge::route('/create'),
            'edit' => Pages\EditChallenge::route('/{record}/edit'),
        ];
    }
}
