<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='https://www.w3.org/1999/xhtml'>

<head>
   <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
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
            @foreach ($clientReport as $client)
               <tr>
                  <td valign='top' width='35%' style='font-size:12px;'>
                   <strong>{{$client->bill_address}}</strong><br />
                     $firstline adress<br />
                     $secondline address <br />
                     $taxnumber<br />
                     $if available second tax number<br />

                  </td>
                  <td valign='top' width='35%'>
                  </td>
                  <td valign='top' width='30%' style='font-size:12px;'>
                  {{ Carbon\Carbon::now()->format('d-m-Y') }}<br />
                  Lieferdatum: $when invoice was due<br />
                     Fälligkeitsdatum: $when its needs to be paid (one week after creation) <br />


                  </td>

               </tr>
               @endforeach
            </table>
            <table width='100%' height='100' cellspacing='0' cellpadding='0'>
               <tr>
                  <td>
                     <div align='center' style='font-size: 14px;font-weight: bold;'>Rechnung Nr. $invoice number </div>
                  </td>
               </tr>
            </table>
            <table width='100%' cellspacing='0' cellpadding='2' border='1' bordercolor='#CCCCCC'>
               <tr>

                  <td width='35%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>Clinet Name </strong></td>
                  <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>Client Email</strong></td>
                  <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>Subscription Plan</strong></td>
                  <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>Subscription Amount</strong></td>

               </tr>
               @foreach ($clientReport as $client)
               <tr style="display:none;">
                  <td colspan="*">
                 
               <tr>

                  <td valign='top' style='font-size:12px;'>{{$client->name}}</td>
                  <td valign='top' style='font-size:12px;'>{{$client->email}} </td>
                  <td valign='top' style='font-size:12px;'>{{$client->subscription_plans->name}}</td>
                  <td valign='top' style='font-size:12px;'>
                  {{$client->subscription_plans->amount}}
                  <b>Euro</b>
               </td>

               </tr>
               
               <tr>


               </tr>
               
         </td>
      </tr>
      @endforeach
   </table>
   <table width='100%' cellspacing='0' cellpadding='2' border='0'>
      <tr>
         <td style='font-size:12px;width:50%;'><strong> </strong></td>
         <td>
            <table width='100%' cellspacing='0' cellpadding='2' border='0'>
               <tr>
                  <td align='right' style='font-size:12px;'>Gesamt $total priuce</td>
                  <td align='right' style='font-size:12px;'>330,00 €
                  <td>
               </tr>
               <tr>
                  <td align='right' style='font-size:12px;'>USt.(19%) $this is the tax will be added to the toal</td>
                  <td align='right' style='font-size:12px;'>463,03 €</td>
               </tr>
               <tr>

                  <td align='right' style='font-size:12px;'><b>Gesamtpreis $total price with tax</b></td>
                  <td align='right' style='font-size:12px;'><b>392,70 €</b></td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
   <!-- This all here stays the same -->
   <table width='100%' height='50'>
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