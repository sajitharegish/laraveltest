<!DOCTYPE html>
<html>
<head>
    <title>Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 <div class="card shadow">
    <div class="card-header bg-success text-white">
        <h2>Edit Listing</h2>
    </div>
    <div class="card-body">
    <form action="{{ url('update/'.$data->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="text" name="listing" value="{{ $data->listing }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
    </div>
</div>

</body>
</html>