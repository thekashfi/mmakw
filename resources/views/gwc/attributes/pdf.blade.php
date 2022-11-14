<!-- pdf.blade.php -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  @if(count($services))
    <table class="table table-bordered" width="100%">
    @foreach($services as $service)
      <tr>
        <td width="20%" valign="top">{{__('adminMessage.title_en')}}</td>
        <td valign="top">{{$service->title_en}}</td>
      </tr>
      <tr>
        <td width="20%" valign="top">{{__('adminMessage.details_en')}}</td>
        <td valign="top">{!!$service->details_en!!}</td>
      </tr>
      <tr>
        <td width="20%" valign="top">{{__('adminMessage.title_ar')}}</td>
        <td valign="top">{{$service->title_en}}</td>
      </tr>
      <tr>
        <td width="20%" valign="top">{{__('adminMessage.details_ar')}}</td>
        <td valign="top">{!!$service->details_ar!!}</td>
      </tr>
      <tr><td colspan="2"><hr></td></tr>
     @endforeach
    </table>
    @else
    {{__('adminMessage.recordnotfound')}}
    @endif 
  </body>
</html>