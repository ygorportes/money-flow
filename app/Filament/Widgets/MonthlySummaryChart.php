<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class MonthlySummaryChart extends ChartWidget
{
    protected ?string $heading = 'Resumo do Mês Atual';
    protected ?string $maxHeight = '300px';
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $transactionsQuery = $user->transactions();

        $income = (clone $transactionsQuery)
            ->where('type', 'receita')
            ->whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('value');

        $expense = (clone $transactionsQuery)
            ->where('type', 'despesa')
            ->whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('value');

        return [
            'datasets' => [
                [
                    'label' => 'Receitas vs. Despesas',
                    'data' => [$income, $expense],
                    'backgroundColor' => ['#22c55e', '#ef4444'],
                ],
            ],
            'labels' => ['Receitas', 'Despesas'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
