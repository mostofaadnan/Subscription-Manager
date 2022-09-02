<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='https://www.w3.org/1999/xhtml'>

<head>
   <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
   <title>{{$createInvoice->clinet_Info->full_name}}-(inv Num:{{$createInvoice->invoice_number}} )</title>
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
                  <strong><b>{{$createInvoice->clinet_Info->company_name}}</b></strong><br />
                  <b>{{$createInvoice->clinet_Info->address}}</b><br />
                     <b>{{$createInvoice->clinet_Info->city}},<b>{{$createInvoice->clinet_Info->post_code}}</b><br /></b><br />
                     Taxnumber: <b>{{$createInvoice->clinet_Info->tax_number}}</b>
                  </td>
                  <td valign='top' width='35%'>
                  </td>
                  <td valign='top' width='30%' style='font-size:12px;'>
                     Invoice Date: <b>{{$createInvoice->invoice_date}}</b><br />

                     Last Date of Pyment: <b>{{$createInvoice->last_date_of_payment}}</b> <br />

                  </td>

               </tr>

            </table>
            <table width='100%' height='100' cellspacing='0' cellpadding='0'>

               <tr>
                  <td>
                     <div align='center' style='font-size: 14px;font-weight: bold;'>Rechnung Nr. {{$createInvoice->invoice_number}} </div>
                  </td>
               </tr>

            </table>

            <!-- THere is the Starting Part of The Invoice Table -->
            <table width='100%' cellspacing='0' cellpadding='2' border='1' bordercolor='#CCCCCC'>
               <tr> 
                 <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;' align="center"><strong>Invoice Months </strong></td>
                  <td width='20%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;' align="center"><strong>Subscrived Package </strong></td>
                  <td width='10%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;' align="center"><strong>Monthly Billing Amount</strong></td>
                  <td width='10%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;' align="center"><strong>Total Unpaid Month / QTY</strong></td>
                  <td width='10%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;' align="center"><strong>Total Paybal </strong></td>
               </tr>
               <tr style="display:none;">
                  <td colspan="*">

               <tr>
          
                  <td valign='top' style='font-size:12px;'>{{$createInvoice->invoice_months}}</td>
                  <td valign='top' style='font-size:12px;'>{{$createInvoice->subscription_plans->name}}</td>
                  <td valign='top' style='font-size:12px;' align="right">{{$createInvoice->monthly_subs_billamount}}</td>
                  <td valign='top' style='font-size:12px;' align="right">{{$createInvoice->total_unpaid_month}}</td>
                  <td valign='top' style='font-size:12px;' align="right">{{$createInvoice->total_billing_amount}}</td>
               </tr>
               @if($createInvoice->membership_amount>0)
                  <tr>
                  <td colspan="4" bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;' align="right"><strong>Registration Fee </strong></td>
                  <td valign='top' style='font-size:12px;' align="right">{{$createInvoice->membership_amount}}</td>
               </tr>
               @endif          
         </td>
      </tr>
   </table>
   <!-- THere is the END Part of The Invoice Table -->

   <table width='100%' cellspacing='0' cellpadding='2' border='0'>

      <tr>
         <td style='font-size:12px;width:50%;'><strong> </strong></td>
         <td>
            <table width='100%' cellspacing='0' cellpadding='2' border='0'>
               <tr>
                  <td align='right' style='font-size:12px;'>Gesamt</td>
                  <td align='right' style='font-size:12px;'>{{$createInvoice->total_billing_main_amount}} euro
                  <td>
               </tr>
               <tr>
                  <td align='right' style='font-size:12px;'>USt.(19%)</td>
                  <td align='right' style='font-size:12px;'>{{$createInvoice->total_billing_vat_amount}} euro</td>
               </tr>
               <tr>

                  <td align='right' style='font-size:12px;'><b>Gesamtpreis</b></td>
                  <td align='right' style='font-size:12px;'><b>{{$createInvoice->nettotal}} euro</b></td>
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

         <td valign='top' width='34%' style='border-top:double medium #CCCCCC;font-size:12px;' align='right'>Bank: Monese<br /> IBAN: GB56PRTC00998500634601 <br />SWIFT/BIC: PRTCGB21 <br />
         </td>
      </tr>
   </table>
   </td>
   </tr>
   </table>
</body>

</html>
