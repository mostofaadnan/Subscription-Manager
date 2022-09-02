<!DOCTYPE html
    PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='https://www.w3.org/1999/xhtml'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" media="all" />
    <title>{{$clientinfo->full_name}}-(inv Num:{{$clientInvoice->invoice_number}} )</title>
    <style>
    @page {
        margin: 0px;
    }

    .main {
        /*  margin-top: 20px;
        margin-bottom: 20px;
        font-family: calibri;
        font-weight: 500; */
    }

    table td {
        font-family: calibri;
        /*  font-size: 22px; */
    }

    .footer {
        width: 100%;
        text-align: center;
        position: fixed;
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 20px;
    }

    .footer {
        bottom: 0px;
        margin-right: 0px;
        left: 0px;
        /*  padding-top: 10px;
        padding-bottom: 10px; */
        /*  border-top: 2px #00883A solid; */
        /*   padding: 10px; */
    }

    /* .logo{
            align-content: flex-end;
            margin-top: 100px;
            float: right;
        } */
    </style>
</head>

<body>

    <header>
        <img src="https://icon.code2creation.com/header.jpg" width="300px">
        <table style="margin-left:20px;">
            <tr>
                <td style="color:gray;">Notte IT Service – Rudolfsplatz 3 – 50674, Köln</td>
            </tr>
            <tr>
                <td>{{$clientinfo->company_name}}</td>
            </tr>
            <tr>
                <td>{{$clientinfo->address}}</td>
            </tr>
            <!-- <tr>
                    <td style="font-size:22px;">50676 Köln</td>
                </tr> -->
        </table>
    </header>
    <main style="margin-left:20px; margin-right:20px;">
        <div class="main">

            <table align="right">
                <tr>
                    <td><img style="float: right; margin-top:-110px;margin-right:20px;" src="https://icon.code2creation.com/logo.jpg"
                            class="logo" width="80px"></td>
                </tr>
                <tr>
                    <td align="right">Datum:{{$clientInvoice->invoice_date}}</td>
                </tr>
                <tr>
                    <td align="right">Rechnungsnummer:{{ $year }}-{{$clientInvoice->invoice_number}}
                    </td>
                </tr>
                <tr>
                    <td align="right">Rechnungsdatum entspricht Liefer-/Leistungsdatum</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <h3>Rechnung</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        Sehr geehrte Damen und Herren,
                    </td>
                </tr>
                <tr>
                    <td style="padding-bottom: 2rem;">
                        vielen Dank, für Ihr Vertrauen. Vereinbarungsgemäß berechnen wir Ihnen hiermit folgende
                        Leistungen:
                    </td>
                </tr>
                <tr>
                    <table class="table">
                        <thead>
                            <tr style="background-color: #DCDCDC; padding:4px;">
                                <th>Position</th>
                                <th>Anzahl</th>
                                <th>Einheit</th>
                                <th width="40%">Bezeichnung</th>
                                <th style="text-align: right">Einzelpreis</th>
                                <th style="text-align: right;">Gesamtpreis</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{$clientInvoice->driver_qty}}</td>
                                <td>Stück</td>
                                <td>Fahrermonitoring Software</td>
                                <td align="right">{{$clientInvoice->driver_rate}} €</td>
                                <td align="right">{{$clientInvoice->driver_amount}} €</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>{{$clientInvoice->client_qty}}</td>
                                <td>Stück</td>
                                <td>Flottenmanagement Software</td>
                                <td align="right">{{$clientInvoice->client_rate}} €</td>
                                <td align="right">{{$clientInvoice->client_amount}} €</td>
                            </tr>
                            <tr>
                                <td colspan="5">Nettopreis</td>
                                <td style="text-align: right">{{$clientInvoice->total_amount}} €</td>
                            </tr>
                            <tr>
                                <td colspan="5">Zzgl. 19% USt. </td>
                                <td style="text-align: right">{{$clientInvoice->total_vat}} €</td>
                            </tr>

                        </tbody>
                        <tfoot style="background-color: #DCDCDC; padding:4px;">
                            <tr style="font-weight: 600;">

                                <td colspan="5">Rechnungsbetrag </td>
                                <td style="text-align: right">{{$clientInvoice->nettotal}} €</td>


                            </tr>
                        </tfoot>
                    </table>
                </tr>
            </table>
            <table>
                <tr>
                    <td>Bitte überweisen Sie den Rechnungsbetrag innerhalb von 3 Tagen auf unser unten genanntes
                        Konto.
                    </td>
                </tr>
                <tr>
                    <td>Für weitere Fragen stehen wir Ihnen sehr gerne zur Verfügung.</td>
                </tr>
            </table>
            <table style="margin-top:20px; margin-left:20px;">
                <tr>
                    <td>Mit freundlichen Grüßen</td>
                </tr>
                <tr>
                    <td>NotteIT Service GENODED1PAF</td>
                </tr>
            </table>
    </main>
    <footer class="footer">

        <table style="font-family: Arial, Helvetica, sans-serif;
                color: gray; margin-left:10px; padding-bottom:20px">
            <tr>
                <td style="border-right: 3px #009999 solid; padding-right: 10px;">
                    Notte IT Service <br>
                    Rudolfsplatz 3 <br>
                    50674, Köln
                </td>
                <td style="border-right: 3px #009999 solid; padding-right: 10px; padding-left: 10px;">
                    Telefon: 123214235435 <br>
                    Email: info@gmail.com <br>
                    Steuemummer: folgt
                </td>
                <td style="padding-left: 10px;">
                    Bank: Dhaka bank <br>
                    Iban: 1324242142344 <br>
                    BIC: uwfgaf
                </td>
            </tr>
        </table>
        <img style="float:right; margin-top:-78px; margin-right:5px;" src="https://icon.code2creation.com/footer.jpg"
            width="300px">
    </footer>
</body>

</html>