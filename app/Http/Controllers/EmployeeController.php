<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class EmployeeController extends Controller
{
    public function index(){
        return view('employees');
    }

    public function AllEmployee(){

        $employee = EmployeeModel::all();
        $employeeCount = EmployeeModel::count();
        $payroll = EmployeeModel::sum(DB::raw('Salary + Bonus'));
        $firstEmployee = EmployeeModel::select('created_at')->first();
        $newDate = $firstEmployee ? Carbon::parse($firstEmployee->created_at)->addMonth() : null;

        foreach ($employee as $employe) {

            $dailySalary = ($employe->Salary / 24);

            $leaveDeduction = ($employe->Leave * $dailySalary);
            $halfLeaveDeduction = (($employe->Half_Leave * $dailySalary) / 2);


            $totalDeduction = $leaveDeduction + $halfLeaveDeduction + $employe->Deduction + $employe->DOC;

            $employe->totalPayroll = ($employe->Salary + $employe->Bonus -( $totalDeduction));
        }

        $totalPayroll_dash = $employee->sum(function ($employe) {
            return ($employe->Salary + $employe->Bonus - (
                    ($employe->Leave * ($employe->Salary / 24)) +
                    (($employe->Half_Leave * ($employe->Salary / 24)) / 2) +
                    $employe->Deduction +
                    $employe->DOC
                ));
        });

        $totalPayroll = $employee->sum('totalPayroll');

        $totalPayroll_dash=round($totalPayroll,2);

        return view('index', compact('employee', 'employeeCount','payroll','newDate','totalPayroll','totalPayroll_dash'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'email' => 'required|email|unique:employees,email',
            'bonus' => 'nullable|numeric',
            'deduction' => 'nullable|numeric',
            'leave' => 'nullable|numeric',
            'half_leave' => 'nullable|numeric',
        ], [
        'name.required' => 'The employee name is required.',
        'name.string' => 'The employee name must be a valid string.',
        'name.max' => 'The employee name cannot exceed 255 characters.',

        'position.required' => 'The position field is required.',
        'position.string' => 'The position must be a valid string.',
        'position.max' => 'The position cannot exceed 255 characters.',

        'salary.required' => 'The salary field is required.',
        'salary.numeric' => 'The salary must be a valid number.',

        'email.required' => 'The email field is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already taken.',

        'bonus.numeric' => 'The bonus must be a valid number.',
        'deduction.numeric' => 'The deduction must be a valid number.',
        'leave.numeric' => 'The leave must be a valid number.',
        'half_leave.numeric' => 'The half-leave must be a valid number.',
    ]);


        EmployeeModel::create([
            'Name' => $request->name,
            'Position' => $request->position,
            'Salary' => $request->salary,
            'Email' => $request->email,
            'Bonus' => $request->bonus ?? 0,
            'Deduction' => $request->deduction ?? 0,
            'DOC' => $request->doc ?? 0,
            'Leave' => $request->leave ?? 0,
            'Half_Leave' => $request->half_leave ?? 0,
        ]);

        return redirect()->route('Employees')->with('success', 'Employee added successfully!');
    }

    public function destroy($id)
    {

        $employee = EmployeeModel::find($id);

        if (!$employee) {
            return redirect()->route('all_employees')->with('error', 'Employee not found!');
        }

        $employee->delete();

        return redirect()->route('all_employees')->with('success', 'Employee deleted successfully!');
    }

    public function edit($id)
    {
        $employee = EmployeeModel::find($id);
        if (!$employee) {
            return redirect()->route('all_employees')->with('error', 'Employee not found.');
        }

        return view('edit_employee', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = EmployeeModel::find($id);

        if (!$employee) {
            return redirect()->route('all_employees')->with('error', 'Employee not found.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'email' => 'required|email|unique:employees,email,'.$id,
            'bonus' => 'nullable|numeric',
            'deduction' => 'nullable|numeric',
            'leave' => 'nullable|numeric',
            'half_leave' => 'nullable|numeric',
        ]);

        $employee->update([
            'Name' => $request->name,
            'Position' => $request->position,
            'Salary' => $request->salary,
            'Email' => $request->email,
            'Bonus' => $request->bonus ?? 0,
            'Deduction' => $request->deduction ?? 0,
            'DOC' => $request->doc ?? 0,
            'Leave' => $request->leave ?? 0,
            'Half_Leave' => $request->half_leave ?? 0,
        ]);

        return redirect()->route('all_employees')->with('success', 'Employee updated successfully.');
    }

    public function generatePDF()
    {
        $employees = EmployeeModel::all();

        foreach ($employees as $employee) {
            $employee->totalPayroll = $employee->Salary + $employee->Bonus - $employee->Deduction - $employee->DOC;
        }
        $total = $employees->sum('totalPayroll');
        $pdf = Pdf::loadView('employees_pdf', compact('employees','total'));

        return $pdf->download('employees.pdf');
    }



}
