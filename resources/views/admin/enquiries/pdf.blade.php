<!DOCTYPE html>
<html>

<head>
    <title>Enquiry Report</title>
    <style>
        body {
            font-family: DejaVu Sans;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
    </style>
</head>

<body>

    <h2>Enquiry Report</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Product</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Qty</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($enquiries as $key => $e)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $e->date }}</td>
                <td>{{ $e->product->name ?? '-' }}</td>
                <td>{{ $e->name }}</td>
                <td>{{ $e->mobile }}</td>
                <td>{{ $e->quantity }}</td>
                <td>{{ $e->contacted ? 'Contacted' : 'Pending' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>