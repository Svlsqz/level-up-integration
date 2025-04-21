<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RewardResource\Pages;
use App\Models\Reward;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class RewardResource extends Resource
{
    protected static ?string $model = Reward::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationGroup = 'Gamification';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255),

            Textarea::make('description')
                ->maxLength(500)
                ->nullable(),

            TextInput::make('required_level')
                ->numeric()
                ->minValue(1)
                ->required(),

            Select::make('type')
                ->required()
                ->options([
                    'badge' => 'Badge',
                    'voucher' => 'Voucher',
                    'mentorship' => 'Mentorship',
                    'custom' => 'Custom',
                ]),

            Select::make('entity_id')
                ->label('Entity')
                ->relationship('entity', 'name')
                ->searchable()
                ->preload()
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('required_level')->label('Level Required')->sortable(),
            BadgeColumn::make('type')->sortable()->colors([
                'primary' => 'badge',
                'success' => 'mentorship',
                'warning' => 'voucher',
                'gray' => 'custom',
            ]),
            TextColumn::make('entity.name')->label('Entity')->toggleable(),
            TextColumn::make('created_at')->dateTime()->sortable()->toggleable(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRewards::route('/'),
            'create' => Pages\CreateReward::route('/create'),
            'edit' => Pages\EditReward::route('/{record}/edit'),
        ];
    }
}
