
<!DOCTYPE html>
<html>
<head>
    <title>Ebos Reputation Mentions Report</title>

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


    <div align="left">

      <table>
          <tr>
              <td>Mentions Export:</td>
              <td><b>{{ $kw }},</b></td>
              <td> {{ $startDate }} - {{ $endDate }}</td>
          </tr>
      </table>

    </div>
    <div align="right">

    <b>{{ $today }}</b>

    </div>

   </div>

	<table autosize="1" style="overflow: wrap">

      <tr><td style="border-top:1px solid black;" colspan="8"></td></tr>
        <tr>
            <th>Domain</th>
            <th>URL</th>
            <th>Text</th>
            <th>Date</th>
            <th>Author</th>
            <th>Followers</th>
            <th>Friends</th>
            <th>City, Country</th>

        </tr>

        <tr><td style="border-top:1px solid black;" colspan="8"></td></tr>

        @if(isset($data['twitter']))
            @foreach ($data['twitter'] as $k)
            <tr>
                <td><?php echo $domain[$k->id]; ?></td>
                <td><a target="_blank" href="<?php echo $k->url; ?>"><?php echo $k->url; ?></a></td>
                <td><?php echo $k->t_text; ?></td>
                <td><?php echo $createDate[$k->id]; ?></td>
                <td><?php echo $k->screen_name; ?></td>
                <td><?php echo $k->followers_count; ?></td>
                <td><?php echo $k->friends_count; ?></td>
                <td><?php echo $k->location; ?></td>
            </tr>
            @endforeach
        @endif


    </table>

    <div class="page_break"></div>

</body>
</html>
