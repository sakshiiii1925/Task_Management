<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class AllEmployeesReportExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $report;
    protected $month;

    public function __construct($report, $month)
    {
        $this->report = $report;
        $this->month = $month;
    }

    public function collection()
    {
        return $this->report;
    }

    public function headings(): array
    {
        return [
            'Employee Name',
            'Total Assigned',
            'Completed',
            'Pending',
            'In Progress',
            'Overdue',
            'Completion Percentage',
        ];
    }

    public function map($item): array
    {
        return [
            $item['employee']->name,
            $item['totalTasks'],
            $item['completedTasks'],
            $item['pendingTasks'],
            $item['inProgressTasks'],
            $item['overdueTasks'],
            $item['completionPercentage'] . '%',
        ];
    }

    public function title(): string
    {
        return 'Employee Report';
    }
}
