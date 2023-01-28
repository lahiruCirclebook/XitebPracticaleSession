@php
    $id = session('id');
    $name = session('name');
@endphp
<!doctype html>
<html lang="en">

<body>
    @include('home.loginLayout')
    @include('layout.header')


    <div>
        <div class="page-content">
            <center>
                <h4>Prescriptions List</h4>
            </center>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="scrollme">
                                    <table id="datatable-buttons" class="table table-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>User Name</th>
                                                <th>Prescription Images</th>
                                                <th>Note</th>
                                                <th>Delivery Address</th>
                                                <th>Delivery Time</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($prescriptions))
                                                @foreach ($prescriptions as $item)
                                                    <tr>
                                                        <td hidden>{{ $item->userId }}</td>
                                                        <td>{{ now()->format('Y-m-d') }} </td>
                                                        <td>{{ $item->name }}</td>

                                                        <td>
                                                            @php
                                                                $prescriptionImage = DB::table('user_prescriptions')
                                                                    ->where('isActive', '=', 1)
                                                                    ->select('prescriptionImage')
                                                                    ->get();
                                                                $prescriptionImages = explode('|', $prescriptionImage);
                                                            @endphp
                                                            @foreach ($prescriptionImages as $items)
                                                                <img src="{{ URL::to($items) }}"
                                                                    style="width: 50px; height:50px" alt="">
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $item->note }}</td>
                                                        <td>{{ $item->deliveryAddress }}</td>
                                                        <td>{{ $item->deliveryTime }}</td>

                                                        <td>

                                                            <a href="{{ url('/prepare/quotation') }}"
                                                                class="btn btn-outline-danger btn-sm waves-effect waves-light">Prepare
                                                                Quotation</a>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div>
        </div>
    </div>

</body>


</html>
