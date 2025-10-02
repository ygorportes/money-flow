<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('description')
                    ->label('Descrição'),

                Select::make('type')
                    ->label('Tipo')
                    ->options([
                        'receita' => 'Receita',
                        'despesa' => 'Despesa'
                    ])
                    ->required(),

                TextInput::make('value')
                    ->label('Valor')
                    ->numeric()
                    ->prefix('R$')
                    ->required(),

                DatePicker::make('date')
                    ->label('Data')
                    ->required()
                    ->default(now()),
            ]);
    }
}
