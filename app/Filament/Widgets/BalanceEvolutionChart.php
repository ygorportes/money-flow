<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class BalanceEvolutionChart extends ChartWidget
{
    protected ?string $heading = 'Evolução do Saldo (Últimos 12 meses)';
    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) {
            return [];
        }

        $transactions = $user->transactions()
            ->where('date', '>=', now()->subMonths(11)->startOfMonth())
            ->orderBy('date')
            ->get();

        $monthlyData = $transactions->groupBy(function ($transaction){
            return Carbon::parse($transaction->date)->format('Y-m');
        });

        $labels = [];
        $data = [];
        $runningBalance = 0;

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthKey = $date->format('Y-m');
            $monthLabel = $date->format('M/y');

            $labels[] = $monthLabel;

            if (isset($monthlyData[$monthKey])) {
                $income = $monthlyData[$monthKey]->where('type', 'receita')->sum('value');
                $expense = $monthlyData[$monthKey]->where('type', 'despesa')->sum('value');
                $monthlyNet = $income - $expense;
                $runningBalance += $monthlyNet;
            }

            $data[] = $runningBalance;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Saldo Acumulado',
                    'data' => $data,
                    'borderColor' => '#3b82f6',
                    'tension' => 0.2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
