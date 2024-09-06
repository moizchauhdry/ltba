=
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Voucher - 00{{$member->id}}</title>

    <style>
        * {
            box-sizing: border-box;
        }

        .column {
            float: left;
            width: 25%;
            padding: 0px;
            height: 300px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .text-lg {
            font-size: 10px;
            font: bold;
            padding-left: 1px;
            padding-right: 1px;
        }

        table,
        th,
        td {
            border: 1px solid rgb(46, 45, 45);
            padding: 3px;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="row">
        <?php for ($i=1; $i <= 4; $i++) { ?>
        <div class="column">
            <div style="text-align: center;">
                <img src="{{asset('public/images/mcb.jpeg')}}" alt="" style="width: 70px; padding-right:10px">
                <img src="{{asset('public/images/logo.png')}}" alt="" style="width: 70px">
            </div>
            <div style="text-align: center;">
                <span style="font-size: 12px; font:bold">LAHORE TAX BAR ASSOCIATION</span> <br>
                <span style="font-size: 12px; font:bold;">MCB BANK</span> <br>
                <span style="font-size: 10px">Challan-Cash & Local Instruments Only</span> <br> <br>
                <span>
                    @php
                    if ($i == 1) {
                    echo "Bank's Copy";
                    }
                    if ($i == 2) {
                    echo "LTBA Copy";
                    }
                    if ($i == 3) {
                    echo "Depositor's Copy 01";
                    }
                    if ($i == 4) {
                    echo "Depositor's Copy 02";
                    }
                    @endphp
                </span>
            </div>

            <table class="table">
                <tr>
                    <td style="padding: 15px; font-size:12px;">
                        <span>Voucher #</span> <br>
                    </td>
                    <th style=" padding: 15px">
                        <span style="font-size:14px;">{{$member->id}}</span> <br>
                    </th>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center; padding:14px;font-size:12px">MCB BANK
                        <br> <b>MEMBERSHIP FEE.</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center">Payable at any branch in Pakistan</td>
                </tr>
                <tr>
                    {{-- <td colspan="2" style="text-align: center"><b>Transactions to be processed via HBL App</b></td> --}}
                </tr>
                <tr>
                    <td>Name of Depositor:</td>
                    <td>{{ $member->name ?? '- -' }}</td>
                </tr>
                <tr>
                    <td>Father/Husband Name:</td>
                    <td>{{$member->father_name}}</td>
                </tr>
                <tr>
                    <td>CNIC No:</td>
                    <td>{{$member->cnic_no}}</td>
                </tr>
                <tr>
                    <td>Contact No:</td>
                    <td>+92{{$member->contact_no}}</td>
                </tr>
            </table>

            <table>
                <tr style="text-align: center">
                    <td>Nature of fee</td>
                    <td>Amount</td>
                </tr>

                <tr style="text-align: center">
                    <td style="padding-bottom:2px">
                        <b>MEMBERSHIP FEE</b>
                    </td>
                    <td style="padding-bottom:2px"> <b>5000/-</b> </td>
                </tr>
               
               

            </table>

            <table>
                <tr style="text-align: center">
                    <td style="padding-bottom:32px">Total Amount (Words)</td>
                    <td style="padding-bottom:32px; text-transform: uppercase;">
                        @php
                        $digit = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                        echo $digit->format(5000);
                        @endphp RUPEES ONLY.
                    </td>
                    <td style="padding-bottom:32px">Total Amount (Digits)</td>
                    <td style="padding-bottom:32px"> 5000/- </td>
                </tr>
            </table>

            <span style="font-size: 12px">Printed On: {{Carbon\Carbon::now()->format('d-m-Y h:i A')}} </span>
        </div>
        <?php } ?>
    </div>
</body>

</html>