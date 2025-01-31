<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Driver's Vehicle Inspection</title>

    @include('backend.layouts.driver.pdfStyle')

    {{-- <style>

        body {

            font-family: Arial, sans-serif;

            margin: 0;

            padding: 0;

            box-sizing: border-box;

            background-color: #f7f7f7;

        }



        .container {

            max-width: 900px;

            margin: 20px auto;

            background: #fff;

            padding: 20px;

            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

            border-radius: 8px;

        }



        h1 {

            text-align: center;

            font-size: 24px;

            margin-bottom: 10px;

        }



        h2 {

            margin-top: 20px;

            font-size: 18px;

            border-bottom: 2px solid #ccc;

            padding-bottom: 5px;

        }



        label {

            display: block;

            margin: 10px 0 5px;

            font-weight: bold;

        }



        input[type="text"],

        input[type="number"],

        input[type="time"] {

            width: 100%;

            padding: 8px;

            margin-bottom: 10px;

            border: 1px solid #ccc;

            border-radius: 4px;

        }



        .inspection-category {

            margin-top: 20px;

        }



        .inspection-category ul {

            list-style: none;

            padding: 0;

            display: grid;

            grid-template-columns: repeat(2, 1fr);

            gap: 10px;

        }



        .inspection-category ul li {

            display: flex;

            align-items: center;

        }



        .inspection-category ul li input {

            margin-right: 10px;

        }



        .row {

            display: flex;

            gap: 20px;

        }



        .row > div {

            flex: 1;

        }



        button {

            margin-top: 20px;

            padding: 10px 15px;

            border: none;

            background-color: #007BFF;

            color: white;

            border-radius: 4px;

            font-size: 16px;

            cursor: pointer;

        }



        button:hover {

            background-color: #0056b3;

        }

    </style> --}}

    

</head>

<body>

    <div class="container">

        <h1>Driver's Vehicle Inspection</h1>

        <p style="text-align: center; font-size: 14px;">As required by the D.O.T Federal motor carrier safety regulations</p>



        <div class="row">

            <div>

                <label for="name">Name:</label>

                <input type="text" id="name" name="name" value="{{ $inspection->user->name ?? 'Unknown' }}">

            </div>



            <div>

                <label for="address">Address:</label>

                <input type="text" id="address" name="address" value="{{$inspection->address}}">

            </div>

        </div>



        <div class="row">

            <div>

                <label for="carrier">Carrier:</label>

                <input type="text" id="carrier" name="carrier" value="{{$inspection->carrier}}">

            </div>



            <div>

                <label for="start-time">Start Time:</label>

                <input type="time" id="start-time" name="start-time" value="{{$inspection->start_time}}">

            </div>



            <div>

                <label for="end-time">End Time:</label>

                <input type="time" id="end-time" name="end-time" value="{{$inspection->end_time}}">

            </div>

        </div>



        <h2>Tractor Category</h2>



        <div class="row">

            <div>

                <label for="tractor-no">Tractor No:</label>

                <input type="text" id="tractor-no" name="tractor-no" value="{{$inspection->truck_no}}">

            </div>



            <div>

                <label for="odometer">Odometer Reading:</label>

                <input type="text" id="odometer" name="odometer" value="{{$inspection->odometer_reading}}">

            </div>

        </div>



        <div class="inspection-category">

            <ul>

                @foreach ($tractorCategory as $tractor)

                    <li><input type="checkbox" checked>{{$tractor}}</li>

                @endforeach

            </ul>

        </div>



        <h2>Trailer Category</h2>



        <div>

            <label for="trailer-no">Trailer No:</label>

            <input type="text" id="trailer-no" name="trailer-no" value="{{$inspection->trailer_no}}">

        </div>



        <div class="inspection-category">

            <ul>

                @foreach ($tailorCategory as $trailer)

                    <li><input type="checkbox" checked>{{$trailer}}</li>

                @endforeach

            </ul>

        </div>

        <div class="row">
            <div>
                <input type="checkbox" {{ $inspection->satisfactory == 1 ? 'checked' : '' }}> Condition of the above vehicle is satisfactory
            </div>
            <div>
                <input type="checkbox" {{$inspection->corrected == 1 ? 'checked' : '' }}> Above defects corrected
            </div>
            <div>
                <input type="checkbox" {{$inspection->not_corrected == 1 ? 'checked' : '' }}> Above defects need not be corrected for safe operation of vehicle
            </div>

        </div>

    </div>

</body>

</html>





