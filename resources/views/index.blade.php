<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   RINGTECH PAYROLL SYSTEM
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
 <body class="bg-gray-100">
  <div class="min-h-screen flex flex-col">
   <!-- Navbar -->
   <nav class="bg-blue-600 p-4 text-white">
    <div class="container mx-auto flex justify-between items-center">
     <div class="text-2xl font-bold">
      RINGTECH PAYROLL SYSTEM
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
      <img alt="Profile picture of the admin" class="rounded-full mx-auto" height="150" src="{{asset('images/logo.jpg')}}" width="150"/>
      <h2 class="text-center text-xl font-semibold mt-2">
       Admin
      </h2>
     </div>
     <ul>
      <li class="mb-2">
       <a class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded"  href="{{url('/')}}">
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
    <main class="flex-1 p-6">
     <h1 class="text-3xl font-bold mb-6">
      Dashboard
     </h1>
     <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
      <!-- Card 1 -->
      <div class="bg-white p-4 rounded-lg shadow-lg">
       <div class="flex items-center">
        <div class="p-3 bg-blue-500 text-white rounded-full">
         <i class="fas fa-users">
         </i>
        </div>
        <div class="ml-4">
         <h2 class="text-xl font-semibold">
          Total Employees
         </h2>
         <p class="text-gray-600">
            @if(isset($employeeCount))
                 <strong>   <h3> {{ $employeeCount }}</h3> </strong>
            @else
                <p>No employee data available.</p>
                @endif

                </p>
        </div>
       </div>
      </div>
      <!-- Card 2 -->
      <div class="bg-white p-4 rounded-lg shadow-lg">
       <div class="flex items-center">
        <div class="p-3 bg-green-500 text-white rounded-full">
         <i class="fas fa-money-bill-wave">
         </i>
        </div>
        <div class="ml-4">
         <h2 class="text-xl font-semibold">
          Total Payroll
         </h2>
         <p class="text-gray-600">
             <strong> <h2> Rs {{$totalPayroll_dash}}</h2></strong>
         </p>
        </div>
       </div>
      </div>
      <!-- Card 3 -->
      <div class="bg-white p-4 rounded-lg shadow-lg">
       <div class="flex items-center">
        <div class="p-3 bg-yellow-500 text-white rounded-full">
         <i class="fas fa-calendar-alt">
         </i>
        </div>
        <div class="ml-4">
         <h2 class="text-xl font-semibold">
          Next Payroll
         </h2>
         <p class="text-gray-600">
             {{ $newDate ? $newDate->format('d - F - Y') : 'No data' }}
         </p>
        </div>
       </div>
      </div>
     </div>
     <!-- Employee List -->
     <h2 class="text-2xl font-bold mb-4">
      Employee List
     </h2>
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                 {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                 {{ session('error') }}
            </div>
        @endif

        <div class="bg-white p-4 rounded-lg shadow-lg">
      <table class="min-w-full bg-white">
       <thead>
        <tr>
         <th class="py-2 px-4 border-b">
          ID
         </th>
         <th class="py-2 px-4 border-b">
          Name
         </th>
         <th class="py-2 px-4 border-b">
          Position
         </th>
         <th class="py-2 px-4 border-b">
          Salary
         </th>
         <th class="py-2 px-4 border-b">
          Email
         </th>
            <th class="py-2 px-4 border-b">
                Bonus
            </th>
            <th class="py-2 px-4 border-b">
                Deduction
            </th>
            <th class="py-2 px-4 border-b">
                DOC
            </th>
            <th class="py-2 px-4 border-b">
                Leave
            </th>
            <th class="py-2 px-4 border-b">
                Half Leave
            </th>
            <th class="py-2 px-4 border-b">
            Total
            </th>
         <th class="py-2 px-4 border-b">
          Actions
         </th>
        </tr>
       </thead>
       <tbody>
       @foreach($employee as $obj)
        <tr class="py-2">
         <td class="text-center border-b px-4 py-2">
          {{$obj->id}}
         </td>
         <td class="text-center border-b px-4 py-2">
          {{$obj->Name}}
         </td>
         <td class="text-center border-b px-4 py-2">
             {{$obj->Position}}
         </td>
         <td class="text-center border-b px-4 py-2">
          {{$obj->Salary}}
         </td>
         <td class="text-center border-b px-4 py-2">
          {{$obj->Email}}
         </td>
            <td class="text-center border-b px-4 py-2">
                {{$obj->Bonus}}
            </td>
            <td class="text-center border-b px-4 py-2">
                {{$obj->Deduction}}
            </td>
            <td class="text-center border-b px-4 py-2">
                {{$obj->DOC}}
            </td>
            <td class="text-center border-b px-4 py-2">
                {{$obj->Leave}}
            </td>
            <td class="text-center border-b px-4 py-2">
                {{$obj->Half_Leave}}
            </td>
            <td class="text-center border-b px-4 py-2">
                Rs {{ number_format($obj->totalPayroll, 2) }}
            </td>
         <td class="text-center border-b px-4 py-2">
          <a class="text-blue-500 hover:underline" href="{{ route('Employees.edit', $obj->id) }}">
           Edit
          </a>
             <form action="{{ route('Employees.destroy', $obj->id) }}" method="POST" style="display:inline;">
                 @csrf
                 @method('DELETE')
                 <button type="submit" class="text-red-500 hover:underline ml-2"
                         onclick="return confirm('Are you sure you want to delete this employee?');">
                     Delete
                 </button>
             </form>
         </td>
        </tr>
       @endforeach

       </tbody>
      </table>
        </div>

        <div class="flex justify-end mt-4">
            <a href="{{ route('employees.pdf') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Download PDF
            </a>
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
