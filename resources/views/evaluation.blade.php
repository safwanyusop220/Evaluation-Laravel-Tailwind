<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation App</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-3xl font-bold mb-6 text-center">Evaluation Data</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Age</th>
                        <th class="py-2 px-4 border-b">Address</th>
                        <th class="py-2 px-4 border-b">Working Status</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['data'] as $row)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                            <td class="py-2 px-4 border-b">{{ $row['name'] }}</td>
                            <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($row['date_of_birth'])->age }}</td>
                            <td class="py-2 px-4 border-b">{{ $row['address'] }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $row['working_status'] ? 'No' : 'Yes' }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="{{ route('exportExcel', ['id' => $row['id']]) }}" class="text-blue-500 hover:underline">Export</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>