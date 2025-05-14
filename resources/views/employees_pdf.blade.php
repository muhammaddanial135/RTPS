<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees List</title>
    <style>
        @page { size: A4 landscape; margin: 20px; } /* Landscape Mode */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .header { text-align: center; font-size: 20px; font-weight: bold; margin-bottom: 10px; }
        .table-container { width: 100%; border-collapse: collapse; font-size: 12px; table-layout: fixed; }
        .table-container th, .table-container td {
            border: 1px solid black; padding: 6px; text-align: center;
            word-wrap: break-word; overflow: hidden;
        }
        .table-container th { background-color: #f3f4f6; }
        .id { width: 5%; }
        .name { width: 12%; }
        .position { width: 12%; }
        .salary, .bonus, .deduction, .doc, .leave, .half-leave { width: 10%; }
        .email { width: 15%; word-break: break-word; }

             tr:nth-child(18n) {
            page-break-after: always;
        }

        .footer { text-align: center; margin-top: 20px; font-size: 10px; color: gray; }
    </style>
</head>
<body>
<div class="header">Employees Report</div>

<table class="table-container">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Position</th>
        <th>Salary</th>
        <th>Bonus</th>
        <th>Deductions</th>
        <th>Email</th>
        <th>DOC</th>
        <th>Leave</th>
        <th>Half Leave</th>
        <th>Total</th>

    </tr>
    </thead>
    <tbody>
    @foreach($employees as $employee)
        <tr>
            <td>{{ $employee->id }}</td>
            <td>{{ $employee->Name }}</td>
            <td>{{ $employee->Position }}</td>
            <td>Rs {{ number_format($employee->Salary, 2) }}</td>
            <td>Rs {{ number_format($employee->Bonus ?? 0, 2) }}</td>
            <td>Rs {{ number_format($employee->Deduction ?? 0, 2) }}</td>
            <td>{{ $employee->Email }}</td>
            <td>{{ $employee->DOC }}</td>
            <td>{{ $employee->Leave }}</td>
            <td>{{ $employee->Half_Leave }}</td>
            <td>Rs {{ number_format($employee->totalPayroll, 2) }}</td>


        </tr>
    @endforeach
    </tbody>
</table>

<div class="footer">Generated on {{ \Carbon\Carbon::now()->format('d F, Y') }}</div>
</body>
</html>
