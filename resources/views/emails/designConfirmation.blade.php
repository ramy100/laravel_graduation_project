<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body>

	@if($mailInfo['status'] == 'rejected' )
    <div>
        <p>{{ $mailInfo['message'] }}</p>
       <p> please Update the design <a href="{{route('design.show', ['design' => $mailInfo['design']->id])}}">{{ $mailInfo['design']->title  }}</a></p>
        
    </div>
    @elseif($mailInfo['status'] == 'accepted' )
    	<div>
	        <p>Your design <a href="{{route('design.show', ['design' => $mailInfo['design']->id])}}">{{ $mailInfo['design']->title  }}</a> has been accepted.</p>
	        
	    </div>
    @endif

</body>
</html>