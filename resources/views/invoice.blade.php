<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Receipt </title>
  <style>
    /* heading */

    h1 {
      font: bold 100% sans-serif;
      letter-spacing: 0.5em;
      text-align: center;
      text-transform: uppercase;
    }

    /* table */

    table {
      font-size: 75%;
      table-layout: fixed;
      width: 100%;
    }

    table {
      border-collapse: separate;
      border-spacing: 2px;
    }

    th,
    td {
      border-width: 1px;
      padding: 0.5em;
      position: relative;
      text-align: left;
    }

    th,
    td {
      border-radius: 0.25em;
      border-style: solid;
    }

    th {
      background: #EEE;
      border-color: #BBB;
    }

    td {
      border-color: #DDD;
    }

    body {
      box-sizing: border-box;
      height: 11in;
      margin: 0 auto;
      overflow: hidden;
      padding: 0.5in;
      width: 7.5in;
    }

    body {
      background: #FFF;
      border-radius: 1px;
      box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
    }

    /* header */

    header {
      margin: 0 0 3em;
    }

    header:after {
      clear: both;
      content: "";
      display: table;
    }

    header h1 {
      background: #e40101;
      border-radius: 0.25em;
      color: #FFF;
      margin: 0 0 1em;
      padding: 0.5em 0;
    }

    header address {
      float: left;
      font-size: 95%;
      font-style: normal;
      line-height: 1.25;
      margin: 0 1em 1em 0;
    }

    article address.norm h4 {
      font-size: 125%;
      font-weight: bold;
    }

    article address.norm {
      float: left;
      font-size: 95%;
      font-style: normal;
      font-weight: normal;
      line-height: 1.25;
      margin: 0 1em 1em 0;
    }

    header address p {
      margin: 0 0 0.25em;
    }

    header span,
    header img {
      display: block;
      float: right;
    }

    header span {
      margin: 0 0 1em 1em;
      max-height: 25%;
      max-width: 60%;
      position: relative;
    }

    header img {
      max-height: 100%;
      max-width: 100%;
    }

    header input {
      cursor: pointer;
      -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
      height: 100%;
      left: 0;
      opacity: 0;
      position: absolute;
      top: 0;
      width: 100%;
    }

    /* article */

    article,
    article address,
    table.meta,
    table.inventory {
      margin: 0 0 3em;
    }

    article:after {
      clear: both;
      content: "";
      display: table;
    }

    article h1 {
      clip: rect(0 0 0 0);
      position: absolute;
    }

    article address {
      float: left;
      font-size: 125%;
      font-weight: bold;
    }

    /* table meta & balance */

    table.meta,
    table.balance {
      float: right;
      width: 36%;
    }

    table.meta:after,
    table.balance:after {
      clear: both;
      content: "";
      display: table;
    }

    /* table meta */

    table.meta th {
      width: 40%;
    }

    table.meta td {
      width: 60%;
    }

    /* table items */

    table.inventory {
      clear: both;
      width: 100%;
    }

    table.inventory th:first-child {
      /* width: 50px; */
    }

    table.inventory th:nth-child(2) {
      /* width: 300px; */
    }

    table.inventory th {
      font-weight: bold;
      text-align: center;
    }

    table.inventory td:nth-child(1) {
      /* width: 26%; */
    }

    table.inventory td:nth-child(2) {
      /* width: 38%; */
    }

    table.inventory td:nth-child(3) {
      /* text-align: right; */
      /* width: 12%; */
    }

    table.inventory td:nth-child(4) {
      /* text-align: right; */
      width: 30%;
      overflow: hidden;
    }

    table.inventory td:nth-child(5) {
      /* text-align: right; */
      /* width: 12%; */
    }

    /* table balance */

    table.balance th,
    table.balance td {
      width: 50%;
    }

    table.balance td {
      text-align: right;
    }

    /* aside */

    aside h1 {
      border: none;
      border-width: 0 0 1px;
      margin: 0 0 1em;
    }

    aside h1 {
      border-color: #999;
      border-bottom-style: solid;
    }

    table.sign {
      float: left;
      width: 220px;
    }

    table.sign img {
      width: 100%;
    }

    table.sign tr td {
      border-color: transparent;
    }

    @media print {
      * {
        -webkit-print-color-adjust: exact;
      }

      html {
        background: none;
        padding: 0;
      }

      body {
        box-shadow: none;
        margin: 0;
      }

      span:empty {
        display: none;
      }

      .add,
      .cut {
        display: none;
      }
    }

    @page {
      margin: 0;
    }
  </style>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->
</head>

<body>


  <header>
    <h1>Invoice</h1>
    <address>
      <p> Primeoption PRO Verify </p>
      <p> No. 357/18 (the ‘Company’). </p>
      <p> 62 Athalassas Avenue, Strovolos, </p>
      <p> Support@primeoptionpro.live</p>
    </address>
    <span><img alt="Logo" width="200" height="100" src="{{ URL('assets/logo/logo.png') }}"></span>
  </header>
  <article>
    <h1>Recipient</h1>
    <address class="norm">
      <h4></h4>
      <p> {{ $invoice_data->email}} <br>
      <p> Phone: {{ $phone_num->uphone}}</p>
    </address>

    <table class="meta">
      <tr>
        <th><span>Invoice #</span></th>
        <td><span>{{ $invoice_data->id }}</span></td>
      </tr>
      <tr>
        <th><span>Date</span></th>
        <td><span>{{ date('M d,Y',strtotime($invoice_data->created_at))}}</span></td>
      </tr>
      <tr>
        <th><span>Amount </span></th>
        <td><span id="prefix">$</span><span>{{ number_format($invoice_data->withdrawal_amount,2) }}</span></td>
      </tr>
    </table>
    <table class="inventory">
      <thead>
        <tr>
          <th><span>S. No</span></th>
          <th><span>Date</span></th>
          <th><span>Receive Method</span></th>
          <th><span>Wallet Address</span></th>
          <th><span>Amount</span></th>
          <th><span>Status</span></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><span>{{ $invoice_data->id }}</span></td>
          <td><span> {{ date('M d,Y h:i a',strtotime($invoice_data->created_at))}}</span></td>
          <td><span>{{ $invoice_data->currency }}</span></td>
          <td><span>{{ $invoice_data->wallet_address }}</span></td>
          <td><span data-prefix>$</span><span>{{ number_format($invoice_data->withdrawal_amount,2) }}</span></td>
          <td>
            <span>
              @if ($invoice_data->status == 1)
              <button disabled class="btn btn-info "> Pending ...</button>
              @elseif ($invoice_data->status == 2)
              <button disabled class="btn btn-danger "> Canceled</button>
              @elseif ($invoice_data->status == 3)
              <button disabled class="btn btn-success "> Approved </button>
              @endif
            </span>
          </td>
        </tr>
      </tbody>
    </table>
    <table class="sign">
      <tr>
        <!-- <td><img src="signature.png" alt="sdd"></td> -->
      </tr>
    </table>

    <table class="balance">
      <tr>
        <th><span>Total</span></th>
        <td><span data-prefix>$</span><span>{{ number_format($invoice_data->withdrawal_amount,2) }}</span></td>
      </tr>
    </table>
  </article>
  <aside>
    <h1><span>Additional Notes</span></h1>
    <div>
      <p>Thanks For Choosing Us !!! </p>
      <p>PLease Mail the receipt to the admin email if your request Approval delays </p>
    </div>
  </aside>


</body>

</html>