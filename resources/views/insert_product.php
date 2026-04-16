<!DOCTYPE html>
<html>
<head>
    <title>Create Listing</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4>Add New Listing</h4>
        </div>

        <div class="card-body">

            <form action="{{ url('store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Listing Name</label>
                    <input type="text" name="listing" class="form-control" placeholder="Enter listing" required>
                </div>

                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ url('listing') }}" class="btn btn-secondary">Back</a>

            </form>

        </div>
    </div>

</div>

</body>
</html>