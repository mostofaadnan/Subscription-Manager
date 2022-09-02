<!DOCTYPE html
    PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='https://www.w3.org/1999/xhtml'>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <title>{{$clientinfo->full_name}}-(inv Num:{{$clientInvoice->invoice_number}} )</title>
</head>

<body style='font-family:Tahoma;font-size:12px;color: #333333;background-color:#FFFFFF;'>
    <table align='center' border='0' cellpadding='0' cellspacing='0' style='height:842px; width:595px;font-size:12px;'>
        <tr>
            <td valign='top'>
                <table width='100%' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td valign='bottom' width='50%' height='50'>
                            <div align='left'><img src='https://fahrly.de/assets/images/footer-logo.png' /></div><br />
                        </td>

                        <td width='50%'>&nbsp;</td>
                    </tr>
                </table>Empfänger: <br /><br />
                <table width='100%' cellspacing='0' cellpadding='0'>

                    <tr>
                        <td valign='top' width='35%' style='font-size:12px;'>
                            <strong><b>{{$clientinfo->company_name}}</b></strong><br />
                            <b>{{$clientinfo->address}}</b><br />
                            <b>{{$clientinfo->city}},<b>{{$clientinfo->post_code}}</b><br /></b><br />
                            Taxnumber: <b>{{$clientinfo->tax_number}}</b>
                        </td>
                        <td valign='top' width='35%'>
                        </td>
                        <td valign='top' width='30%' style='font-size:12px;'>
                            Invoice Date: <b>{{$clientInvoice->invoice_date}}</b><br />

                            Last Date of Pyment: <b></b> <br />

                        </td>

                    </tr>

                </table>
                <table width='100%' height='100' cellspacing='0' cellpadding='0'>

                    <tr>
                        <td>
                            <div align='center' style='font-size: 14px;font-weight: bold;'>Rechnung Nr.
                                {{$clientInvoice->invoice_number}} </div>
                        </td>
                    </tr>

                </table>

                <!-- THere is the Starting Part of The Invoice Table -->
                <table width='100%' cellspacing='0' cellpadding='2' border='1' bordercolor='#CCCCCC'>
                    <tr>
                        <td width='20%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;' align="center">
                            <strong>SL.No
                            </strong></td>
                        <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;' align="center">
                            <strong>Description</strong>
                        </td>
                        <td width='10%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;' align="center">
                            <strong>Rate</strong>
                        </td>
                        <td width='10%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;' align="center">
                            <strong>QTY</strong>
                        </td>
                        <td width='10%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;' align="center">
                            <strong>Amount</strong>
                        </td>
                    </tr>
                    <tr style="display:none;">
                        <td colspan="*">

                    <tr>

                        <td valign='top' style='font-size:12px;' align="center">1</td>
                        <td valign='top' style='font-size:12px;'>Fleet</td>
                        <td valign='top' style='font-size:12px;' align="right">{{$clientInvoice->client_rate}}</td>
                        <td valign='top' style='font-size:12px;'  align="right">{{$clientInvoice->client_qty}}</td>
                        <td valign='top' style='font-size:12px;' align="right">{{$clientInvoice->client_amount}}</td>
                    </tr>
                    <tr>
                        <td valign='top' style='font-size:12px;' align="center">2</td>
                        <td valign='top' style='font-size:12px;'>Driver</td>
                        <td valign='top' style='font-size:12px;'  align="right">{{$clientInvoice->driver_rate}}</td>
                        <td valign='top' style='font-size:12px;'  align="right">{{$clientInvoice->driver_qty}}</td>
                        <td valign='top' style='font-size:12px;' align="right">{{$clientInvoice->driver_amount}}</td>
                    </tr>


            </td>
        </tr>
    </table>
    <!-- THere is the END Part of The Invoice Table -->

    <table width='100%' cellspacing='0' cellpadding='2' border='0'>

        <tr>
            <td style='font-size:12px;width:70%;'><strong> </strong></td>
            <td>
                <table width='100%' cellspacing='0' cellpadding='2' border='0'>
                    <tr>
                        <td align='right' style='font-size:12px;'>Gesamt</td>
                        <td align='right' style='font-size:12px;'>{{$clientInvoice->total_amount}} euro
                        <td>
                    </tr>
                    <tr>
                        <td align='right' style='font-size:12px;'>USt.(19%)</td>
                        <td align='right' style='font-size:12px;'>{{$clientInvoice->total_vat}} euro</td>
                    </tr>
                    <tr>

                        <td align='right' style='font-size:12px;'><b>Gesamtpreis</b></td>
                        <td align='right' style='font-size:12px;'><b>{{$clientInvoice->nettotal}} euro</b></td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>
    <!-- This all here stays the same -->
    <table width='100%' height='50' style="margin-top:100px;">
        <tr>
            <td style='font-size:12px;text-align:justify;'></td>
        </tr>
    </table>
    <table width='100%' cellspacing='0' cellpadding='2'>
        <tr>
            <td width='33%' style='border-top:double medium #CCCCCC;font-size:12px;' valign='top'><b>Fahrly</b><br />
                StNr.: 216/5013/3020 <br />
                USt-IdNr.: 216/5013/3020<br />
            </td>
            <td width='33%' style='border-top:double medium #CCCCCC; font-size:12px;' align='center' valign='top'>
                Richmodstr. 6<br />
                50667 Köln <br />
                Telefon: +447564843498<br />
            </td>

            <td valign='top' width='34%' style='border-top:double medium #CCCCCC;font-size:12px;' align='right'>Bank:
                Monese<br /> IBAN: GB56PRTC00998500634601 <br />SWIFT/BIC: PRTCGB21 <br />
            </td>
        </tr>
    </table>
    </td>
    </tr>
    </table>
</body>

</html>