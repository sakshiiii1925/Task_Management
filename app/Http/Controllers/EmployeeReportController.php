<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
class EmployeeReportController extends Controller
{
    public function index(Request $request)
    {
        // Get all employees for dropdown
        $employees = User::where('role', 'employee')
            ->orderBy('name')
            ->get();

        $report = null;
        $tasks = collect();

        if ($request->filled('employee_id') && $request->filled('month')) {

            $request->validate([
                'employee_id' => 'required|exists:users,id',
                'month' => 'required|date_format:Y-m',
            ]);

            $employee = User::where('role', 'employee')
                ->findOrFail($request->employee_id);

            $startDate = Carbon::createFromFormat('Y-m', $request->month)
                ->startOfMonth();

            $endDate = $startDate->copy()->endOfMonth();

            // Tasks assigned to this employee during selected month
            $tasks = Task::where('assigned_to', $employee->id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->orderBy('due_date')
                ->get();

            $totalTasks = $tasks->count();

            $completedTasks = $tasks->where('status', 'Completed')->count();

            $inProgressTasks = $tasks->where('status', 'In Progress')->count();

            $overdueTasks = $tasks->filter(function ($task) {
                return $task->status !== 'Completed'
                    && $task->due_date
                    && Carbon::parse($task->due_date)->startOfDay()->lt(today());
            })->count();

            $report = [
                'employee' => $employee,
                'month' => $request->month,
                'totalTasks' => $totalTasks,
                'completedTasks' => $completedTasks,
                'inProgressTasks' => $inProgressTasks,
                'overdueTasks' => $overdueTasks,
                'pendingTasks' => $tasks->where('status', 'Pending')->count(),
            ];
        }

        return view('manager.reports.employee', compact(
            'employees',
            'report',
            'tasks'
        ));
    }

public function downloadPdf(Request $request)
{
    $request->validate([
        'employee_id' => 'required|exists:users,id',
        'month' => 'required|date_format:Y-m',
    ]);

    $employee = User::where('role', 'employee')
        ->findOrFail($request->employee_id);

    $startDate = Carbon::createFromFormat('Y-m', $request->month)
        ->startOfMonth();

    $endDate = $startDate->copy()->endOfMonth();

    $tasks = Task::where('assigned_to', $employee->id)
        ->whereBetween('created_at', [$startDate, $endDate])
        ->orderBy('due_date')
        ->get();

    $totalTasks = $tasks->count();

    $completedTasks = $tasks->where('status', 'Completed')->count();

    $inProgressTasks = $tasks->where('status', 'In Progress')->count();

    $pendingTasks = $tasks->where('status', 'Pending')->count();

    $overdueTasks = $tasks->filter(function ($task) {
        return $task->status !== 'Completed'
            && $task->due_date
            && Carbon::parse($task->due_date)->startOfDay()->lt(today());
    })->count();

    $monthName = Carbon::createFromFormat('Y-m', $request->month)
        ->format('F_Y');

    $pdf = Pdf::loadView('manager.reports.employee-pdf', compact(
        'employee',
        'tasks',
        'totalTasks',
        'completedTasks',
        'inProgressTasks',
        'pendingTasks',
        'overdueTasks',
        'monthName'
    ));

    return $pdf->download(
        'Employee_Report_' . $employee->name . '_' . $monthName . '.pdf'
    );
}

}
