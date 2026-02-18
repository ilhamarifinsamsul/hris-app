<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji</title>

    <style>
        body { font-family: Arial, sans-serif; padding: 30px; }
        .box { border: 1px solid #ddd; padding: 20px; border-radius: 10px; }
        .row { display: flex; justify-content: space-between; margin: 10px 0; }
        .title { font-size: 20px; font-weight: bold; margin-bottom: 20px; }
    </style>
</head>
<body onload="window.print()">

    <div class="box">
        <div class="title">Slip Gaji</div>

        <div class="row">
            <div>Tanggal</div>
            <div>{{ \Carbon\Carbon::parse($payroll->pay_date)->format('d M Y') }}</div>
        </div>
        <hr>

        <div class="row">
            <div>Nama</div>
            <div><b>{{ $payroll->employee->fullname }}</b></div>
        </div>

        <div class="row">
            <div>Salary</div>
            <div>Rp {{ number_format($payroll->salary, 0, ',', '.') }}</div>
        </div>

        <div class="row">
            <div>Bonus</div>
            <div>Rp {{ number_format($payroll->bonuses, 0, ',', '.') }}</div>
        </div>

        <div class="row">
            <div>Potongan</div>
            <div>Rp {{ number_format($payroll->deductions, 0, ',', '.') }}</div>
        </div>

        <hr>

        <div class="row">
            <div><b>Net Salary</b></div>
            <div><b>Rp {{ number_format($payroll->net_salary, 0, ',', '.') }}</b></div>
        </div>
    </div>

</body>
</html>
