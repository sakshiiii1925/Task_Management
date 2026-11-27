<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;
use App\Exports\AllEmployeesReportExport;
use Maatwebsite\Excel\Facades\Excel;

class AllEmployeeReportController extends Controller
{
    public function index(Request $request)
    {
        // Default month is the current month
        $month = $request->input('month', now()->format('Y-m'));

        // Validate selected month
        $request->validate([
            'month' => 'required|date_format:Y-m',
        ]);

        $startDate = Carbon::createFromFormat('Y-m', $month)
            ->startOfMonth();

        $endDate = $startDate->copy()->endOfMonth();

        // Get all employees
        $employees = User::where('role', 'employee')
            ->orderBy('name')
            ->get();

        // Get all tasks assigned during the selected month
        $employeeTasks = Task::whereIn('assigned_to', $employees->pluck('id'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->groupBy('assigned_to');

        // Calculate each employee's performance
        $report = $employees->map(function ($employee) use ($employeeTasks) {

            $tasks = $employeeTasks->get($employee->id, collect());

            $totalTasks = $tasks->count();

            $completedTasks = $tasks->where('status', 'Completed')->count();

            $pendingTasks = $tasks->where('status', 'Pending')->count();

            $inProgressTasks = $tasks->where('status', 'In Progress')->count();

            $overdueTasks = $tasks->filter(function ($task) {
                return $task->status !== 'Completed'
                    && $task->due_date
                    && Carbon::parse($task->due_date)->startOfDay()->lt(today());
            })->count();

            $completionPercentage = $totalTasks > 0
    ? round(($completedTasks / $totalTasks) * 100, 2)
    : 0;

return [
    'employee' => $employee,
    'totalTasks' => $totalTasks,
    'completedTasks' => $completedTasks,
    'pendingTasks' => $pendingTasks,
    'inProgressTasks' => $inProgressTasks,
    'overdueTasks' => $overdueTasks,
    'completionPercentage' => $completionPercentage,
];
        });

        return view('manager.reports.all-employees', compact(
            'employees',
            'month',
            'report'
        ));
    }
    public function downloadExcel(Request $request)
{
    $month = $request->input('month', now()->format('Y-m'));

    $request->validate([
        'month' => 'required|date_format:Y-m',
    ]);

    $startDate = Carbon::createFromFormat('Y-m', $month)
        ->startOfMonth();

    $endDate = $startDate->copy()->endOfMonth();

    $employees = User::where('role', 'employee')
        ->orderBy('name')
        ->get();

    $employeeTasks = Task::whereIn('assigned_to', $employees->pluck('id'))
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get()
        ->groupBy('assigned_to');

    $report = $employees->map(function ($employee) use ($employeeTasks) {

        $tasks = $employeeTasks->get($employee->id, collect());

        $totalTasks = $tasks->count();

$completedTasks = $tasks->where('status', 'Completed')->count();

$completionPercentage = $totalTasks > 0
    ? round(($completedTasks / $totalTasks) * 100, 2)
    : 0;

return [
    'employee' => $employee,
    'totalTasks' => $totalTasks,
    'completedTasks' => $completedTasks,
    'pendingTasks' => $tasks->where('status', 'Pending')->count(),
    'inProgressTasks' => $tasks->where('status', 'In Progress')->count(),
    'overdueTasks' => $tasks->filter(function ($task) {
        return $task->status !== 'Completed'
            && $task->due_date
            && Carbon::parse($task->due_date)->startOfDay()->lt(today());
    })->count(),
    'completionPercentage' => $completionPercentage,
];
    });

    return Excel::download(
        new AllEmployeesReportExport($report, $month),
        'All_Employees_Report_' . $month . '.xlsx'
    );
}
}
