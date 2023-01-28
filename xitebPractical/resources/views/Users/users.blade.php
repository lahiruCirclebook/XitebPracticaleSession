@php
    $id = session('id');
    $name = session('name');
@endphp
<!doctype html>
<html lang="en">

@include('home.loginLayout')
@include('layout.header')



<body>

    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <h4> Upload the Your Prescriptions</h4>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">

                    {{-- ------------------------------------------------------------------------ --}}
                    @if (session()->has('message'))
                        <div class="col-md-4">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session()->get('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="col-md-4">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session()->get('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @foreach ($errors->all() as $error)
                        <div class="col-md-4">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $error }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endforeach
                    {{-- ---------------------------------------------------------------------- --}}
                    <div class="card overflow-hidden">
                        <div class="card-body pt-0">
                            <div class="p-2">
                                <div class="p-2">
                                    @if ($errors->any())
                                        <div class="container">
                                            <div class="alert alert-danger" name="alert">
                                                {{ $errors->first() }}
                                            </div>
                                        </div>
                                    @endif
                                    <form action="{{ url('prescription') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Upload Prescription Image</label>
                                            <input class="form-control" type="file" id="prescriptionImage"
                                                name="prescriptionImage[]" multiple accept="image/*" value="2048">
                                            <label for="" class="form-label text-danger" id="imgValid"
                                                name="imgValid"></label>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Note</label>
                                            <textarea type="taxt" class="form-control" placeholder="Note..." name="note" id="note" cols="30"
                                                rows="3"></textarea>

                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Delivery Address</label>
                                            <textarea name="deliveryAddress" class="form-control" id="deliveryAddress" cols="30" rows="3"
                                                placeholder="Enter Delivery Address..." required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Delivery Time — 2 Hour Time
                                                Slots</label>
                                            <input type="dateTime" class="form-control" id="deliveryTime"
                                                placeholder="Enter Delivery Time..." name="deliveryTime" required>
                                        </div>

                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light"
                                                type="submit">Upload Prescription
                                            </button>
                                        </div>


                                        <div class="mt-3 d-grid">
                                            <a href="{{ url('/view/Prepared/Quotation') }}"
                                                class="btn btn-danger waves-effect waves-light">View
                                                Prepared Quotation
                                            </a>
                                        </div>



                                    </form>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- end account-pages -->
        <script>
            let uploadField = document.getElementById("prescriptionImage");

            uploadField.onchange = function() {
                if (this.files[0].size > 2097152) {
                    let imgValid = "Image size must be less than 2 MB";
                    document.getElementById('imgValid').innerHTML = imgValid;
                    this.value = "";
                } else {
                    document.getElementById('imgValid').innerHTML = "";
                };
            };

            let uploadFieldEdit = document.getElementById("productImageEdit");

            uploadFieldEdit.onchange = function() {
                if (this.files[0].size > 2097152) {
                    let imgValidEdit = "Image size must be less than 2 MB";
                    document.getElementById('imgValidEdit').innerHTML = imgValidEdit;
                    this.value = "";
                } else {
                    document.getElementById('imgValidEdit').innerHTML = "";
                };
            };
        </script>

</body>


</html>
