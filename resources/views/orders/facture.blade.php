<!DOCTYPE html>
<html lang="en">




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
    </title>

    <style>
        body {
            font-family: sans-serif;
        }

        .box-container {
            width: 80%;
            padding: 2rem;
            border: 1px solid #f2f2f2;
            border-radius: 5px;
            background-color: #ffffff;
            margin-left: 10%;
            margin-right: 10%;
        }

        .box-container .title {
            font-weight: bold;
            padding: 1rem;
            border-bottom: 1px solid #f2f2f2;
            background-color: #f2f2f2;
        }

        .transaction-box {
            margin-top: 1rem;
        }

        .transaction-box .item {
            display: table;
            width: 100%;
            margin-bottom: 1rem;
        }

        .transaction-box .item>* {
            display: table-cell;
            vertical-align: middle;
        }

        .transaction-box .item> :first-child {
            text-align-last: left;
        }

        .transaction-box .item> :last-child {
            text-align-last: right;
            font-weight: bold;
        }

        .transaction_details_box {
            margin-top: 3rem;
            border-radius: 5px;
            display: table;
            width: 100%;
            margin-bottom: 3rem;
        }

        .transaction_details_box .left {
            display: table;
            margin-bottom: 1rem;
            width: 100%;
        }

        .transaction_details_box .left>* {
            display: table-cell;
            vertical-align: middle;
        }



        .transaction_details_box .left .item {
            display: table;
            width: 100%;
            float: left;
            margin-bottom: 1rem;
        }

        .transaction_details_box .left .item>* {
            display: table-cell;
            vertical-align: middle;

            width: 100%;
            margin-bottom: 1rem;
        }

        .transaction_details_box .left .item> :first-child {
            text-align: left;
        }

        .transaction_details_box .left .item> :last-child {
            text-align: right;
        }

        .transaction_details_box .right {
            display: table;
            width: 100%;
        }

        .transaction_details_box .right table {
            width: 100%;
        }

        .transaction_details_box .right .payment_tile {
            margin-top: 2rem;
            margin-bottom: 2rem;
            text-transform: uppercase;
            font-weight: bold;
        }

        th {
            background: #8a97a0;
            color: #fff;
        }

        tr {
            background: #f4f7f8;
        }

        tr:nth-child(even) {
            background: #e8eeef;
        }

        th,
        td {
            padding: 0.5rem;
        }

        .single_item .value {
            font-weight: bold;
        }

        /** */
        .position-absolute {
            position: absolute;
        }

        .top-50 {
            top: 50%;
        }

        .start-50 {
            left: 50%;
        }

        .translate-middle {
            transform: translate(-30%, -50%);
        }

    </style>



</head>

<body>
    <div class="box-container">
        <div>
            <div class="title">
                <b>Facture de paiement</b>
            </div>

            <div class="transaction-box">

                <div class="item">
                    <div class="label">Identifiant employer:</div>
                    <div class="value">FC{{ date('dmY', strtotime($fullOderInfo->created_at))."_". $fullOderInfo->id }}</div>
                </div>
                <div class="item">
                    <div class="label">Nom & prénom:</div>
                    <div class="value">{{ $fullOderInfo->clientName }}</div>
                </div>
                <div class="item">
                    <div class="label">Adresse Facturation:</div>
                    <div class="value">{{ $fullOderInfo->billing_address }}</div>
                </div>
                <div class="item">
                    <div class="label">Adresse Livraison:</div>
                    <div class="value">{{ $fullOderInfo->shipping_address }}</div>
                </div>
                <div class="item">
                    <div class="label">Date Commande :</div>
                    <div class="value">{{ date('d-m-Y', strtotime($fullOderInfo->created_at)) }} </div>
                </div>



            </div>
        </div>
        <div>
            <div class="title">
                <b>Expédition</b>
            </div>

            <div class="transaction-box">

                <div class="item">
                    <div class="label">Expéditeur :</div>
                    <div class="value">{{ $fullOderInfo->carrier_name }}</div>
                </div>
                <div class="item">
                    <div class="label">Frais Expédition :</div>
                    <div class="value">{{ $format_price($fullOderInfo->carrier_price) }}</div>
                </div>
            </div>
        </div>      
        <div class="last_item single_item">

            <div class="title"> Resumé de la transaction
            </div>
            <div class="transaction_details_box">
                <div class="left">

                    <div class="item">
                        <div class="label">Moyen Paiement :</div>
                        <span class="value">{{ $fullOderInfo->paymeny_method }}</span>
                    </div>
            
                </div>
                <div class="left">
                    <div class="item">
                        <div class="label">Taxe : </div>
                        <div class="value">{{ $format_price($fullOderInfo->taxe) }}</div>
                    </div>
                </div>
                <div class="left">
                    <div class="item">
                        <div class="label">Quantité : </div>
                        <div class="value">{{ $fullOderInfo->quantity }} élement(s)</div>
                    </div>
                </div>
                <div class="right">
                    <div class="payment_tile">Détails du paiement</div>
                    <table>
                        <thead>
                            <th>
                                Date
                            </th>
                            <th>Montant</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($fullOderInfo->created_at)) }} </td>
                                <td>{{ $format_price($fullOderInfo->order_cost) }} </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="single_item"> <span>Total TTC : </span>
                                        <span class="value item">{{ $format_price($fullOderInfo->order_cost_ttc) }} </span>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <div class="single_item">
                                        <span>Total frais</span>
                                        <span class="value">{{ $format_price($fullOderInfo->taxe + $fullOderInfo->carrier_price) }} </span>
                                    </div>
                                    <div class="single_item">
                                        <span>Total payé : </span>
                                        <span class="value">{{ $format_price( $fullOderInfo->order_cost_ttc) }}</span>
                                    </div>
                                    <div class="single_item">
                                        <span>Reste a payer : </span>
                                        <span class="value">0</span>
                                    </div>                              
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <div  style="text-align: center">
                                <div class="">
                                    Merci pour votre commande !
                                </div>
                            </div>
                        </tfoot>
                    </table>
                    @if ($fullOderInfo->isPaid =='true')
                        <span style="">
                            <img class="position-absolute top-50 start-50 translate-middle" src="{{ asset($imgLogo1) }}">
                            <img class="position-absolute top-50 start-50 translate-middle" src="{{ asset($imgLogo2) }}">
                        </span> 
                    @endif
                                       
                </div>
            </div>
        </div>

    </div>
</body>

</html>
