<!DOCTYPE html>
<html>
<head>
   <title>User Log Chart</title>
</head>
<body>
    <div class="row">
        <div class="col">
            <h3>Grafik Pemakaian Calculator</h3>
            <canvas id="myChart" height="100px"></canvas>
        </div>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">


    const data = {
        labels: [
            @foreach ($labels as $r)
                '{{ $r }}',
            @endforeach
        ],
        datasets: [
        @foreach ($users as $r )
        {
            label: '{{ $r }}',
            data: [
                @for ($i=0;$i<count($totaltimedata);$i++)
                    @if ($totaltimedata[$i]['email']==$r)
                        {{$totaltimedata[$i]['total']}},
                    @endif

                @endfor

            ],
        },
        @endforeach
        ],

    };
    const config = {
      type: 'line',
      data: data,
      options: {}
    };
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );



</script>
</html>
