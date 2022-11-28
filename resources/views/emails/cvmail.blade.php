<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="icon" href="../../assets/img/icons/foundation-favicon.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/foundation-emails/2.2.1/foundation-emails.min.css" rel="stylesheet">
  <title>Cv {{ $data['name'] }}</title>
</head>
<body>
  <span class="preheader"></span>

  <style type="text/css">
    .header {
      background: #8a8a8a;
    }
    .header .columns {
      padding-bottom: 0;
    }
    .header p {
      color: #fff;
      margin-bottom: 0;
    }
    .header .wrapper-inner {
      padding: 20px; /*controls the height of the header*/
    }
    .header .container {
      background: #8a8a8a;
    }
    .wrapper.secondary {
      background: #f3f3f3;
    }
  </style>

  <table align="center" class="container float-center">
    <tbody>
      <tr>
        <td>
          <table class="spacer">
            <tbody>
              <tr>
                <td height="16px" style="font-size:16px;line-height:16px;">&#xA0;</td>
              </tr>
            </tbody>
          </table>
          <table class="row">
            <tbody>
              <tr>
                <th class="small-12 large-12 columns first last">
                  <table>
                    <tr>
                      <th>
                        <h1>New Cv Received from @if($data['name']){{ $name }}@else --- @endif for {{ $data['career']->title_en }}</h1>
                        <p class="lead">Name: @if($data['name']){{ $name }}@else --- @endif</p>

                        <p class="lead">Email: @if($data['email'])<a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a>@else --- @endif</p>

                        <p class="lead">Mobile: @if($data['mobile']){{ $data['mobile'] }}@else --- @endif</p>

                        <p class="lead">Attachment: @if($data['file'])<a href="{{ url('uploads/resumes/'. $data['file']) }}">{{ $data['file'] }}</a>@else --- @endif</p>

                        <p class="lead">Message:</p>
                        @if($data['message'])<p>{!! nl2br(strip_tags($data['message'])) !!}</p>@else --- @endif

                      </th>
                      <th class="expander"></th>
                    </tr>
                  </table>
                </th>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>

  <!-- prevent Gmail on iOS font size manipulation -->
  <div style="display:none; white-space:nowrap; font:15px courier; line-height:0;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </div>
</body>
</html>
