<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h4 class="mb-0">Product List</h4>
            <a href="{{ url('/create_product') }}" class="btn btn-light btn-sm">+ Add Product</a>
        </div>

        <div class="card-body">

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success justify-content-between d-flex">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($products as $key => $row)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $row->category_name }}</td>
                            <td>{{ $row->subcategory_name }}</td>
                            <td>{{ $row->product_name }}</td>
                            <td>
                                @if($row->image)
                                    <img src="{{ asset('uploads/products/'.$row->image) }}" width="60" height="60" style="object-fit:cover;">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('/product/edit/'.$row->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="{{ url('/product/delete/'.$row->id) }}"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Are you sure you want to delete?')">
                                   Delete
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">No data found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>