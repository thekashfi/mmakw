<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
</head>
<body>
@php
$settingInfo = App\Http\Controllers\webController::getSettings();
@endphp
<div style="margin-left:10%; margin-right:10%;">        
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td height="100" align="center" bgcolor="#002C51">@if($settingInfo->emaillogo)<img src="{{url('uploads/logo/'.$settingInfo->emaillogo)}}" width="140" height="64" alt="{{$settingInfo->name_en}}"/>@endif</td>
    </tr>
    <tr>
      <td style="padding:20px; font-family: arial, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', 'serif'; color: #000; text-align: justify; font-size: 14px; line-height:23px;">
            <p>{!! $dear !!}</p>
		  	<p>{!! $email_body !!}</p>
            <p>{!! $email_footer !!}</p>
		</td>
    </tr>
    <tr>
      <td height="50" align="center" bgcolor="#262B3E" style="font-family: arial, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', 'serif'; color:#fff; font-size: 14px;">{!!__('webMessage.copyrights')!!}</td>
    </tr>
  </tbody>
</table>
</div>
</body>
</html>