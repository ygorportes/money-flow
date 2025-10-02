<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) {
            return [];
        }

        $transactionsQuery = $user->transactions();

        $totalIncome = (clone $transactionsQuery)->where('type', 'receita')->sum('value');
        $totalExpense = (clone $transactionsQuery)->where('type', 'despesa')->sum('value');
        $balance = $totalIncome - $totalExpense;

        $incomeThisMonth = (clone $transactionsQuery)
            ->where('type', 'receita')
            ->whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('value');

        $expenseThisMonth = (clone $transactionsQuery)
            ->where('type', 'despesa')
            ->whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('value');

        return [
            Stat::make('Saldo Acumulado', Number::currency($balance, 'BRL'))
                ->description('Total de receitas menos despesas')
                ->color($balance >= 0 ? 'success' : 'danger'),

            Stat::make('Receitas (Mês Atual)', Number::currency($incomeThisMonth, 'BRL'))
                ->description('Total de receitas este mês')
                ->color('success'),

            Stat::make('Despesas (Mês Atual)', Number::currency($expenseThisMonth, 'BRL'))
                ->description('Total de despesas este mês')
                ->color('danger'),
        ];
    }
}
