<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;


Route::get('/', function () {
    return view('index');
});

Route::get('/Employees',[EmployeeController::class,'index'])->name('Employees');

Route::get('/',[EmployeeController::class,'AllEmployee'])->name('all_employees');

Route::delete('/Employees/{id}', [EmployeeController::class, 'destroy'])->name('Employees.destroy');

Route::post('/Employees/store', [EmployeeController::class, 'store'])->name('Employees.store');

Route::get('/Employees/edit/{id}', [EmployeeController::class, 'edit'])->name('Employees.edit');

Route::put('/Employees/update/{id}', [EmployeeController::class, 'update'])->name('Employees.update');

Route::get('/employees/pdf', [EmployeeController::class, 'generatePDF'])->name('employees.pdf');


