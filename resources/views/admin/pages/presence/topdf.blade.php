<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rapport Présence {{ dateToFrench('31.' . $dayly . '.2024', 'j-F-Y') }}</title>

    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('img/cremin.png') }}" type="image/x-icon">
    <style>
        table,
        th,
        td {
            border: 1px solid;
        }

        .title{
            margin-bottom: 5%;
            color: #000;
        }

        .title p{
            font-weight: bold;
            font-size: 14px;
            margin: 0%;
        }
    </style>


</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="title">
                <p>CREDIT MUTUEL D'INVESTISSEMENT</p>
                <p>DU CAMEROUN (CREMIN-CAM)</p>
                <p>DEPARTEMENT ADMINISTRATIF FINANCIER ET COMPTABLE</p>
                <p>SERVICES DES RESSOURCES HUMAINES</p>
            </div>
        </div>
        <h1 style="text-align: center; font-size: 40px; margin-bottom: 2%"><u>Rapport présence Mois de <span style="text-transform: capitalize">{{ dateToFrench('06.' . $dayly . '.2024', 'F') }}</span> {{ date('Y') }}</u></h1>
        <table class="table" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th scope="col" class="text-dark fw-normal">
                        Noms & Prénoms</th>

                    @for ($i = 1; $i <= $days; $i++)
                        <th scope="col" class="text-dark text-center fw-normal" style="width:3%">
                            {{ dateToFrench($i . '.' . $dayly . '.2024', 'j') }}
                    @endfor
                    <th scope="col" style="font-weight: bold; color:black; text-transform: uppercase">
                        Total Retard
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alluserid as $users)
                    <tr>
                        <td class="ps-0" style="font-size: 10px; color:black;">
                            {{ $users->name }}
                        </td>

                        @for ($i = 1; $i <= $days; $i++)
                            <td class="text-center">
                                @foreach ($attendence as $idea)
                                    @if ($users->id_utilisateurs == $idea->id_utilisateurs)
                                        @if (date('d', strtotime($idea->date_check)) == $i)
                                            @if ($idea->time_check < '08:05:00' && $idea->event_check == 'check-in')
                                                <span style="font-size: 8px; color:black;"
                                                    class="badge bg-success-subtle text-success">{{ $idea->time_check }}</span>
                                            @elseif ($idea->time_check > '16:30:00' && $idea->event_check == 'check-out')
                                                <span style="font-size: 8px; color:black;"
                                                    class="badge bg-primary-subtle text-primary">{{ $idea->time_check }}</span>
                                            @elseif ($idea->time_check < '16:30:00' && $idea->event_check == 'check-out')
                                                <span style="font-size: 8px; color:rgb(255, 0, 0);"
                                                    class="badge bg-danger-subtle text-danger">{{ $idea->time_check }}</span>
                                            @elseif ($idea->time_check > '08:05:00' && $idea->event_check == 'check-in')
                                                <span style="font-size: 8px; color:rgb(255, 0, 0);"
                                                    class="badge bg-danger-subtle text-danger">{{ $idea->time_check }}</span>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                        @endfor
                        <td class="text-center">
                            <?php $total = 0; ?>
                            @foreach ($attendence as $idea)
                                @if ($users->id_utilisateurs == $idea->id_utilisateurs)
                                    @if ($idea->time_check > '08:05:00' && $idea->event_check == 'check-in')
                                        <?php
                                        $time_calcul = diff_time($idea->time_check, '08:05:00');

                                        [$heures, $minutes, $secondes] = explode(':', $time_calcul);
                                        $total += $heures * 3600 + $minutes * 60 + $secondes;

                                        ?>
                                    @endif
                                @endif
                            @endforeach
                            <?php echo floor($total / 3600) . ':' . ($total / 60) % 60 . ':' . $total % 60; ?>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>
