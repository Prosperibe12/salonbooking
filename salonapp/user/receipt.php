<?php 
    // import dompdf library
    require_once 'vendor/autoload.php';

    use Dompdf\Dompdf;

    // start session
    session_start();

    // include class file
    include_once '../models/controller.php';

    $html = '
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        h3{
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }
        table{
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 40%;
        }
        td, th{
            /* border: 1px solid #444; */
            padding: 8px;
            text-align: center;
        }
        .my-table{
            text-align: right;
        }
        #sign{
            padding-top: 50px;
            text-align: right;
        }
    </style>
</head>
<body>
    <section>
        <div>
            <table align="center" width="40">
                <thead>
                    <tr>
                        <td width="30">
                            <img src="css/index1.png" alt="salonapp">
                        </td>
                        <th style="text-align: center;">
                            SALONAPP
                        </th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
    ';

    $html.= '
        <tr>
        <td><strong>Customer Email:</strong>'.$_SESSION["client_em"].'</td>
        <td style="text-align: right;"><strong>Date:</strong>'.date("Y/m/d").'</td>
    </tr>
    </thead>
    <tbody>

    </tbody>
    </table>
    <table align="center" border="1" id="">    
    <h3>Description</h3>
    <thead>
    <tr>
        <th>S/N</th>
        <th>ID</th>
        <th>Service</th>
        <th>Quantity</th>
        <th>Price</th>
    </tr>
    </thead>
    
    ';
    $html.= '
    <tbody>'.date_default_timezone_set("Africa/Lagos");
                    $idate = date('Y-m-d');

                    $i = 1;

                    $gt = 0;

                    $table = new SalonAppDb;

                    $objTable = $table->userReceipt($_SESSION["client_id"], $idate);
        
                foreach ($objTable as $key => $value) {
      $html.='          
                <tr>
                    <td>'. $i++.'</td>
                    <td>'.$value["cart_id"].'</td>
                    <td>'.$value["cat_id"].'</td>
                    <td>'.number_format(1, 1).'</td>
                    <td> $'.number_format($value["product_price"],2).'</td>
                </tr>'.
                $gt = $gt + $value["product_price"];
                $_SESSION["gt"] = $gt;
                 
        } 
    $html.='
    </tbody>
        <tr>
        <td colspan="4" class="my-table"> <strong>Total</strong></td>';
        
        if (isset($_SESSION["gt"])) {
       
     $html.='<td>$'. number_format($_SESSION["gt"],2).'</td>';
        
        }else{
        
      $html.='<td>'.number_format(0,0).'</td>';
       
        }
        
    $html.='</tr>
    <tr>
        <td id="sign" colspan="5">Signature</td>
    </tr>
    </table>
    </div>
    </section>
    </body>
    </html>
    ';    
  $dompdf = new Dompdf;

  $dompdf->loadHtml($html);

  $dompdf->setPaper('A4', 'Portrait');

  $dompdf->render();

  $dompdf->stream('invoice.pdf');
?>