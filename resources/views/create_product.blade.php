<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add Product</h4>
        </div>

        <div class="card-body">

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('/product/store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Category -->
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

                <!-- Product Name -->
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="product_name" class="form-control" placeholder="Enter product name">
                </div>
                  <!-- image -->
                <div class="mb-3">
                    <label class="form-label">Product Image</label>
                    <input type="file" name="image" class="form-control">
                </div>



                <!-- Submit -->
                <button type="submit" class="btn btn-success">Save Product</button>
                <a href="{{ url('/product_list') }}" class="btn btn-secondary">Back</a>

            </form>

        </div>
    </div>
</div>

<!-- JS -->
<script>
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