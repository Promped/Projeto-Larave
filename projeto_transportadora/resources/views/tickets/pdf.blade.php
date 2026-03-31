<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; color: #333; }
        .header { border-bottom: 2px solid #0046AD; padding-bottom: 10px; margin-bottom: 20px; }
        .logo { font-size: 24px; font-weight: bold; color: #0046AD; }
        .ticket-title { text-align: right; float: right; color: #666; }
        .content-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .content-table td { padding: 10px; border: 1px solid #eee; }
        .label { font-weight: bold; font-size: 12px; color: #777; text-transform: uppercase; }
        .value { font-size: 14px; font-weight: bold; }
        .footer { margin-top: 50px; text-align: center; font-size: 10px; color: #999; border-top: 1px dashed #ccc; padding-top: 10px; }
        .status-badge { background: #0046AD; color: white; padding: 5px 10px; border-radius: 4px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <span class="ticket-title">COMPROVANTE Nº {{ str_pad($agendamento->id, 6, '0', STR_PAD_LEFT) }}</span>
        <span class="logo">LogisticsPro</span>
    </div>

    <div style="text-align: center; margin-bottom: 20px;">
        <span class="status-badge">SAÍDA AUTORIZADA</span>
    </div>

    <table class="content-table">
        <tr>
            <td colspan="2"><span class="label">Motorista</span><br><span class="value">{{ $agendamento->motorista->nome }}</span></td>
            <td><span class="label">CPF</span><br><span class="value">{{ $agendamento->motorista->cpf }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Placa</span><br><span class="value">{{ $agendamento->veiculo->placa }}</span></td>
            <td><span class="label">Veículo</span><br><span class="value">{{ $agendamento->veiculo->modelo }}</span></td>
            <td><span class="label">Data/Hora Saída</span><br><span class="value">{{ now()->format('d/m/Y H:i') }}</span></td>
        </tr>
        <tr>
            <td colspan="3"><span class="label">Tipo de Carga</span><br><span class="value">{{ $agendamento->carga->tipo }}</span></td>
        </tr>
    </table>

    <div class="footer">
        Documento gerado eletronicamente pelo Sistema de Gestão Pátio LogisticsPro.<br>
        A autenticidade pode ser confirmada via QR Code no portal da empresa.
    </div>
</body>
</html>