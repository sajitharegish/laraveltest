<!DOCTYPE html>
<html>
<head>
    <title>Listing</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Listing Table Data</h4>
        </div>

        <div class="card-body">

            {{-- ✅ SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- ✅ FILTER FORM --}}
            <form method="GET" action="{{ url('/product_list') }}" class="row mb-3">

                <div class="col-md-4">
                    <select name="category_id" id="category" class="form-control">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <select name="subcategory_id"  id="subcategory" class="form-control">
                        <option value="">-- Select Subcategory --</option>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->id }}"
                                {{ request('subcategory_id') == $sub->id ? 'selected' : '' }}>
                                {{ $sub->subcategory }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 d-flex">
                    <button type="submit" class="btn btn-primary me-2">Search</button>
                    <a href="{{ url('/product_list') }}" class="btn btn-secondary">Reset</a>
                </div>

            </form>

            {{-- ✅ TABLE --}}
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Listing</th>
                            <th>category name</th>
                            <th>subcategory name</thh>
                            <th>Created At</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($data as $key => $row)
                        <tr>
                            {{-- ✅ Correct numbering --}}
                            <td>{{ $data->firstItem() + $key }}</td>

                            <td>{{ $row->product_name }}</td>
                            <td>{{ $row->category_name }}</td>
                            <td>{{ $row->subcategory_name }}</td>
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
                        @empty
                        <tr>
                            <td colspan="4">No data found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- ✅ PAGINATION --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $data->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<<script>
document.getElementById('category').addEventListener('change', function () {

    let category_id = this.value;
    console.log(category_id);


    if(category_id !== '') {
        let url = "{{ url('get-subcategory') }}/" + category_id;
        console.log("URL:", url);
        fetch(url)
            .then(response => response.json())
            .then(data => {
                let sub = document.getElementById('subcategory');
                sub.innerHTML = '<option value="">Select Subcategory</option>';

                data.forEach(function(item) {
                    sub.innerHTML += `<option value="${item.id}">${item.subcategory}</option>`;
                });
            });
    }
});
</script>

</body>
</html>