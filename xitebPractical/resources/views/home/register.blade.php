<!doctype html>
<html lang="en">

@include('home.loginLayout')

<body>


    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
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
                                    <form action="{{ url('registered') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Enter Name" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email"
                                                placeholder="Enter Email" name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea name="address" class="form-control" id="address" cols="30" rows="3" placeholder="Enter Address"
                                                required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Contact Number</label>
                                            <input type="number" class="form-control" id="phone"
                                                placeholder="Enter Contact Number" name="phone"
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                maxlength="10" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">DoB</label>
                                            <input type="date" class="form-control" id="dob"
                                                placeholder="Enter DoB" name="dob" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control" placeholder="Enter password"
                                                    aria-label="Password" aria-describedby="password-addon"
                                                    name="password" id="password">
                                                <button class="btn btn-light" onclick="toggle()" type="button"
                                                    id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>



                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light"
                                                type="submit">Register
                                            </button>
                                        </div>

                                        <div class="mt-3 d-grid">
                                            <a href="{{ url('/') }}"
                                                class="btn btn-danger waves-effect waves-light" type="submit">Back To
                                                Login
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


</body>


</html>
