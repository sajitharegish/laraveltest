<!DOCTYPE html>
<html>
<head>
    <title>Listing</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Listing Table Data</h4>
        </div>

        <div class="card-body">

            {{-- ✅ Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            {{-- ✅ FILTER FORM --}}
            <form method="GET" action="{{ url('/product_list') }}" class="row mb-3">

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" id="category" class="form-control">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Subcategory -->
                <div class="mb-3">
                    <label class="form-label">Subcategory</label>
                    <select name="subcategory_id" id="subcategory" class="form-control">
                        <option value="">Select Subcategory</option>
                    </select>
                </div>

                <div class="col-md-4 d-flex">
                    <button class="btn btn-primary me-2">Search</button>
                    <a href="{{ url('/product_list') }}" class="btn btn-secondary">Reset</a>
                </div>

            </form>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Listing</th>
                            <th>Created At</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->listing }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>
                                <a href="{{ url('edit/'.$row->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <a href="{{ url('delete/'.$row->id) }}"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">
                                Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>