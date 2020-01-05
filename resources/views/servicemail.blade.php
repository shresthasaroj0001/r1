<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body style="background-color: #eee; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #333333;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td width="100%" cellpadding="0" cellspacing="0">
                <h1 style="font-size: 20px;">A new Enquiry!</h1>
            </td>
        </tr>
        <tr>
            <td width="100%" cellpadding="0" cellspacing="0">
                <p><b>From:</b> {{ $from_name }} <i>({{ $from_email }})</i></p>
                <p><b>Mobile No:</b> {{ $mobilenos }}</p>
                <p><b>Cruise Terminal:</b> {{ $cruiseterminal }}</p>
                <p><b>Airport:</b> {{ $airport }}</p>
                <p><b>other:</b> {{ $other }}</p>
                <p><b>Trip Type:</b> {{ $triptype }}</p>
                <p><b>Travel Date:</b> {{ $traveldate }}</p>
                <p><b>Pickup Address:</b> {{ $pickupaddress }}</p>
                <p><b>No ofpassenger:</b> {{ $noofpassenger }}</p>
                <p><b>flightinfo:</b> {{ $flightinfo }}</p>
                <p><b>privatecharter:</b> {{ $privatecharter }}</p>
                <p><b>Child Seats:</b>
                {{$childseats}}
                </p>
                <p><b>Message:</b></p>
                <p>{{ $additionalinfo }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="color: #777777;"><i>That's it! Cheers!</i></p>
            </td>
        </tr>
    </table>
</body>
</html>