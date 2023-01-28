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
                <div class="row">
                    <div class="col-md-4">
                        <h4>My Quotation List</h4>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('/users') }}" class="btn btn-success">Back to Upload Srction</a>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <h3 class="text-muted text-truncate mb-2">Total:
                            </h3>
                            <h5 class="mb-0">
                                @if (!empty($total))
                                {{ $total }}
                            @else
                                0
                            @endif
                            </h5>
                        </div>
                    </div>
                </div>
             
             
            </center>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12"><br><br>
                        <div class="card">

                            <div class="card-body">
                                <div class="scrollme">
                                    <table id="datatable-buttons" class="table table-responsive nowrap w-100">
                                        <thead>
                                            <tr>

                                                <th>Quotation Id</th>
                                                <th>Date</th>
                                                <th>Drugs</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                               

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($preparedQuotation))
                                                @foreach ($preparedQuotation as $item)
                                                    <tr>
                                                        <td>{{ $item->quotationId }}</td>
                                                        <td>{{ $item->date }}</td>
                                                        <td>{{ $item->drug }}</td>
                                                        <td>{{ $item->price }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ $item->amount }}</td>
                                                       
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
