<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'Name',
        'Position',
        'Salary',
        'Email',
        'Bonus',
        'Deduction',
        'DOC',
        'Leave',
        'Half_Leave',
    ];
}
