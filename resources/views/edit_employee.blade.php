<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>
        RING TECH PAYROLL SYSTEM
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<style>
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield; /* Firefox */
    }

    .error-message{
        color: red;
        font-size: 14px;
        margin-top: 4px;
        /*display: none;*/
    }
</style>

<body class="bg-gray-100">
<div class="min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold">
                RING TECH PAYROLL SYSTEM
            </div>
            <div>
                <a class="px-4" href="{{url('/')}}">
                    Dashboard
                </a>
                <a class="px-4" href="{{route('Employees')}}">
                    Employees
                </a>
                <a class="px-4" href="#">
                    Payroll
                </a>
                <a class="px-4" href="#">
                    Settings
                </a>
                <a class="px-4" href="#">
                    Logout
                </a>
            </div>
        </div>
    </nav>
    <!-- Main Content -->
    <div class="container mx-auto flex flex-1">
        <!-- Sidebar -->
        <aside class="w-64 bg-white p-4 shadow-lg">
            <div class="mb-4">
                <img alt="Profile picture of the admin" class="rounded-full mx-auto" height="150" src="{{asset('images/admin_img.jpg')}}" width="150"/>
                <h2 class="text-center text-xl font-semibold mt-2">
                 Talha Maqbool
                </h2>
            </div>
            <ul>
                <li class="mb-2">
                    <a class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded" href="{{url('/')}}">
                        <i class="fas fa-tachometer-alt mr-2">
                        </i>
                        Dashboard
                    </a>
                </li>
                <li class="mb-2">
                    <a class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded" href="{{route('Employees')}}">
                        <i class="fas fa-users mr-2">
                        </i>
                        Employees
                    </a>
                </li>
                <li class="mb-2">
                    <a class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded" href="#">
                        <i class="fas fa-money-check-alt mr-2">
                        </i>
                        Payroll
                    </a>
                </li>
                <li class="mb-2">
                    <a class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded" href="#">
                        <i class="fas fa-cogs mr-2">
                        </i>
                        Settings
                    </a>
                </li>
            </ul>
        </aside>
        <!-- Dashboard Content -->
        <main class="flex-1 p-2 flex justify-center items-center ">
            <!-- Employee List -->


            <div class="bg-white p-4 rounded-lg shadow-md w-full max-w-2xl">
                <h2 class="text-2xl font-bold mb-6 text-center">Edit Employee</h2>
                <form action="{{ route('Employees.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium">Name</label>
                            <input type="text" name="name" class="w-full p-2 border  border-gray-300 rounded" value="{{ $employee->Name}}"  required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium">Position</label>
                            <input type="text" name="position" class="w-full p-2 border  border-gray-300 rounded" value="{{ $employee->Position }}" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium">Salary</label>
                            <input type="number" name="salary" class="w-full p-2 border  border-gray-300 rounded" value="{{ $employee->Salary }}"  required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium">Email</label>
                            <input type="email" name="email" class="w-full p-2 border  border-gray-300 rounded" value="{{ $employee->Email }}" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium">Bonus</label>
                            <input type="number" name="bonus" class="w-full p-2 border border-gray-300 rounded" value="{{ $employee->Bonus }}"  >
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium">Deduction</label>
                            <input type="number" name="deduction" class="w-full p-2 border  border-gray-300 rounded" value="{{ $employee->Deduction }}" >
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium">Doc ( Fine ) </label>
                            <input type="number" name="doc" class="w-full p-2 border  border-gray-300 rounded" value="{{ $employee->DOC }}" >
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium">Leave ( Day )</label>
                            <input type="number" name="leave" class="w-full p-2 border  border-gray-300 rounded" value="{{ $employee->Leave }}" >
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium">Half Leave ( Day )</label>
                            <input type="number" name="half_leave" class="w-full p-2 border  border-gray-300 rounded" value="{{ $employee->Half_Leave }}" >
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 mt-6">
                        Update Employee
                    </button>
                    @if(session('success'))
                        <div class="bg-green-500 text-white p-3 rounded mb-4 mt-2" id="success-message">
                            {{ session('success') }}
                        </div>
                    @endif
                </form>
            </div>
        </main>

    </div>
    <!-- Footer -->
    <footer class="bg-blue-600 text-white p-4 text-center">
        <p>
            Designed by Talha Maqbool
        </p>
    </footer>
</div>

</body>
</html>
