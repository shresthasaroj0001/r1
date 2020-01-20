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
                <h1 style="font-size: 20px;">New Booking</h1>
            </td>
        </tr>
        <tr>
            <td width="100%" cellpadding="0" cellspacing="0">
                <p><b>From:</b> {{ $from_name }} <i>({{ $from_email }})</i></p>
                <p><b>Mobile No:</b> {{ $mobilenos }}</p>
                <p><b>Additional Information:</b></p>
                <p>{{ $additionalinfo }}</p>
                <br>
                <br>
                <hr>
                <h3>TOUR: {{ $title}}</h3>
                <table class="table table-bordered">
                    <thead>
                        <th>
                            <tr>
                                <td>Particular</td>
                                <td>Rate</td>
                                <td></td>
                                <td>Qty</td>
                                <td>Total</td>
                            </tr>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td> Adults </td>
                             <td> $ {{ $rate_adult }} </td>
                             <td> *</td>
                             <td> {{ $adults }} </td>
                            <td> $ {{ $adulttotal }} </td>
                        </tr>
                        <tr>
                            <td> Child </td>
                             <td> $ {{ $rate_children }} </td>
                             <td> *</td>
                             <td> {{ $childs }}</td>
                            <td> $ {{ $childtotal }} </td>
                        </tr>
                        <tr>
                            <td colspan="4"> Total </td>
                            <td> $ {{ $finalTotals }} </td>
                        </tr>
                    </tbody>
                </table>
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