<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Edit Product</h4>
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

            <form method="POST" action="{{ url('/product/update/'.$product->id) }}" enctype="multipart/form-data">
                @csrf

                <!-- Category -->
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" id="category" class="form-control">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Subcategory -->
                <div class="mb-3">
                    <label class="form-label">Subcategory</label>
                    <select name="subcategory_id" id="subcategory" class="form-control">
                        <option value="">Select Subcategory</option>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->id }}"
                                {{ $product->subcategory_id == $sub->id ? 'selected' : '' }}>
                                {{ $sub->subcategory }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Product Name -->
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text"
                           name="product_name"
                           value="{{ $product->product_name }}"
                           class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>

                    @if($product->image)
                        <img src="{{ asset('uploads/products/'.$product->image) }}"
                            width="80"
                            class="rounded shadow">
                    @else
                        <span>No Image</span>
                    @endif
               </div>
               <div class="mb-3">
                    <label class="form-label">Change Image</label>
                    <input type="file" name="image" class="form-control">
              </div>
                <!-- Submit -->
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ url('/product_list') }}" class="btn btn-secondary">Back</a>

            </form>

        </div>
    </div>
</div>

<!-- JS for dynamic subcategory -->
<script>
document.getElementById('category').addEventListener('change', function () {

    let category_id = this.value;

    let url = "{{ url('get-subcategory') }}/" + category_id;

    fetch(url)
        .then(response => response.json())
        .then(data => {

            let sub = document.getElementById('subcategory');
            sub.innerHTML = '<option value="">Select Subcategory</option>';

            data.forEach(function(item) {
                sub.innerHTML += `<option value="${item.id}">${item.subcategory}</option>`;
            });
        });
});
</script>

</body>
</html>