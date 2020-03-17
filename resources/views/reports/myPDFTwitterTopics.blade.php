
<!DOCTYPE html>
<html>
<head>
    <title>Ebos Reputation Twitter Topics Report</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">

        @page {
            size: A4 landscape;
        }

        div.page_break + div.page_break{
            page-break-before: always;
        }

        tr.th{
            border-bottom: 10px solid black;
        }

        tr.heading {  /* new style */
            border-bottom: 1px solid black;
        }

    </style>

</head>
<body>
   <div class="row">


    <div align="right">

    <b>{{ $today }}</b>

    </div>

   </div>

	<table autosize="1" style="overflow: wrap">

      <tr><td style="border-top:1px solid black;" colspan="8"></td></tr>
        <tr>
            <th>Started</th>
            <th>Topic</th>
            <th>Volume</th>

        </tr>

        <tr><td style="border-top:1px solid black;" colspan="8"></td></tr>

        @if(isset($data))
            @foreach ($data as $k)
            <tr>
                <td><?php echo $k['created']; ?></td>
                <td><?php echo $k['text']; ?></td>
                <td><?php echo $k['volume']; ?></td>

            </tr>
            @endforeach
        @endif


    </table>

    <div class="page_break"></div>

</body>
</html>
