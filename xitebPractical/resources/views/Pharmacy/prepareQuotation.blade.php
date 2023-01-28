@php
    $id = session('id');
    $name = session('name');
@endphp
<!doctype html>
<html lang="en">

@include('home.loginLayout')
@include('layout.header')

<head>


    <style>
        .container .imageContainer {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            padding: 10px;
        }

        #whatsapp-button {
            background-color: #43A645;
            color: white;
            margin-left: 25px;
        }
    </style>

</head>

<body>

    <div>
        <div class="page-content">
            <div class="container-fluid">
                <h4>Prepare Quotation</h4>
                <div class="row justify-content-center">
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="container">
                                    <div class="imageContainer">
                                        @php
                                            $prescriptionImage = DB::table('user_prescriptions')
                                                ->where('isActive', '=', 1)
                                                ->select('prescriptionImage')
                                                ->get();
                                            $prescriptionImages = explode('|', $prescriptionImage);
                                        @endphp
                                        @foreach ($prescriptionImages as $items)
                                            <img src="{{ URL::to($items) }}" style="width: 100px; height:100px;"
                                                class="image" alt="">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="hidden-print " style="margin-bottom:-60px ">
                            <table>
                                <td><a id="whatsapp-button" href="{{ $urlString }}" target="_blank" class="btn"><i
                                            class="fa fa-arrow-left"></i> WhatsApp</a> </td>


                                <a href="{{ url('/prescriptions') }}" style="margin-left: 40%"
                                    class="btn btn-danger">Back To
                                    Prescription List</a>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="card"
                        style="border-radius: 10px;padding: 10px;display: block;width: 100%;height: 500px;overflow-y: auto;text-align: left">
                        <form action="{{ url('/addQuotation') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row expansesRow">
                                    <div class="col-md-2">
                                        <label class="form-label">Date</label>
                                        <input type="date" class="form-control" name="date[]" id="date"
                                            required>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Drug</label>
                                        <input type="text" class="form-control" name="drug[]" id="drug"
                                            required>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Price</label>
                                        <input type="number" class="form-control exAmount" step="0.01"
                                            name="price[]" id="price" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Quantity</label>
                                        <input type="number" class="form-control" name="quantity[]" id="quantity"
                                            required>
                                    </div>

                                    <div class="col-md-2">
                                        <label>Amount</label>
                                        <input type="number" class="form-control" step="0.01" name="amount[]"
                                            id="amount" required>
                                    </div>



                                </div><br>
                                <button id='add' type="button"
                                    class="btn btn-outline-primary btn-sm">Add</button>
                                <button id='remove' type="button"
                                    class="btn btn-outline-danger btn-sm">Remove</button>
                                <div style="float: right">
                                    <button class="btn btn-outline-success btn-sm">Submit</button>
                                </div>


                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>



    </div>

    <script>
        function checkRemove() {
            if ($('div.expansesRow').length == 1) {
                $('#remove').hide();
            } else {
                $('#remove').show();
            }
        };
        $(document).ready(function() {
            checkRemove()
            $('#add').click(function() {
                $('div.expansesRow:last').after($('div.expansesRow:first').clone());
                $('div.expansesRow:last').find("input[type=text],input[type=number]").val("");
                checkRemove();

            });
            $('#remove').click(function() {
                $('div.expansesRow:last').remove();
                checkRemove();
            });
        });
    </script>
</body>


</html>
