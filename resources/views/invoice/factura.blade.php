<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura</title>
</head>
<style>
    body {
        margin: -70px
    }
   
    .img{
        float: left;
        margin: 0;
    }
    .factura{
        border: 1px solid black;
        width: 300px;
        height: 150px;
        margin: 70px 60px;
        float: right;
        border-radius: 5px
       
    }
    .tipo{
        text-align: center
    }
    .tipo_center{
        background: rgb(160, 224, 240);
        padding: 7px 0;
    }
    .datos_pac{
        margin: 300px 60px 0px 60px;
        border: 1px solid black;
        border-radius: 5px; 
        padding-left: 8px;
    }
    .dates{
        text-transform: uppercase;
    }
    .contenido{
        border: 1px solid black;
        margin: 1rem 60px 0 60px ;
        border-radius: 5px; 
        height: 500px;
        
    }
    .descrption{
        border-collapse: collapse;
        height: 400px;

    }
    .descrption th, {
            text-align: center;
        }
       
    th {
            background: rgb(160, 224, 240);
        }
    td{
        padding: 8px;
    }

    .des{
        width: 400px;
    }
    .other{
        padding: 0 25px;
        text-align: center;
    }
  
</style>
<body>
    <div class="fotter">
        <div class="img">
            <img class="" src="data:image/jpg;base64, {{base64_encode(file_get_contents(base_path('public/assets/img/fotos/logo.png')))}}">
        </div>
        <div class="factura">
            <h3 class="tipo"> Factura Electronica</h3>
            <h3 class="tipo tipo_center"> Factura de Venta Electronica</h3>
            <h3 class="tipo">N° : {{$invoice->codigo}}</h3>
        </div>
    </div>
    <div class="datos_pac">
        <p>Cliente:  <strong class="dates">{{$invoice->patients->name}} {{$invoice->patients->lastname}}</strong></p>
        <p>Dni: {{$invoice->patients->dni}}</p>
        <p>Fecha de Emisión:  {{ \Carbon\Carbon::parse($invoice->date_issue)->format('d/m/Y') }}</p>
    </div>
    <div class="contenido">
        <table class="descrption">
            <thead style="border-radius: 20px">
                    <tr>
                        <th>Cant</th>
                        <th class="des">Description</th>
                        <th class="other">Valor Unitario</th>
                        <th class="other">Valor Total</th>
                    </tr>
            </thead>
            <tbody>
                    @foreach ($invoiceDets as $detalle)
                    <tr>
                        <td class="other" >{{$detalle->pivot->amount}}.00</td>
                        <td class="des">{{$detalle->product}}</td>
                        <td class="other">{{$detalle->price}}</td>
                        <td class="other">{{ number_format($detalle->pivot->amount * $detalle->price, 2, '.', '') }}</td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
        <div class="info">
            <div style="width:360px; height: 65px; float: left;
            border-right:1px black solid;
            border-bottom:1px black solid;border-top:1px black solid;">
                <p style="text-align: center;">Informacion adicional</p>
            </div>
            <div style="width:360px; height: auto;; float: right;
            border-right:1px black solid;
            border-bottom:1px black solid;border-top:1px black solid;">
                <p style="padding: none 5px ;margin: 2px">Venta Gravada :<strong style="float: right"> S/ {{number_format($grav,2, '.','')}}</strong></p>
                <p style="padding: none 5px;margin: 2px">Total I.G.V :<strong style="float: right"> S/ {{number_format($igv,2, '.','')}}</strong> </p>
                <p style="padding: none 5px;margin: 2px">Precio Total de Venta :<strong style="float: right"> S/ {{number_format($grav,2, '.','')}}</strong> </p>
            </div>
        </div>
    </div>
</body>
</html>