<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ticket de Saída Logística</title>
    <style>
        /* Configurações de página e reset para PDF */
        @page { 
            margin: 0; /* Controle total das margens pelo container interno */
        }
        body { 
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
            color: #334155; 
            background-color: #f8fafc;
            margin: 0; 
            padding: 40px;
            font-size: 13px;
            line-height: 1.5;
        }
        
        /* Cartão Principal Emulado */
        .ticket-container {
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            padding: 32px;
            position: relative;
        }

        /* Detalhe estético superior (Linha de Identidade) */
        .top-bar {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #0046AD, #0066FF);
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }

        /* Cabeçalho */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }
        .brand-logo {
            font-size: 24px;
            font-weight: 800;
            color: #0046AD;
            letter-spacing: -1px;
        }
        .brand-sub {
            font-size: 10px;
            color: #94a3b8;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 2px;
        }
        .ticket-meta {
            text-align: right;
            vertical-align: middle;
        }
        .ticket-number {
            font-family: monospace;
            font-size: 16px;
            font-weight: bold;
            color: #0f172a;
            background-color: #f1f5f9;
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            display: inline-block;
        }

        /* Barra de Status */
        .status-section {
            border-top: 1px solid #f1f5f9;
            border-bottom: 1px solid #f1f5f9;
            padding: 12px 0;
            margin-bottom: 28px;
        }
        .status-badge {
            background-color: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .timestamp {
            float: right;
            font-size: 11px;
            color: #64748b;
            font-weight: 600;
            margin-top: 6px;
        }

        /* Grid Estrutural de Dados */
        .grid-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .grid-table td {
            padding: 0;
            vertical-align: top;
        }

        /* Bloco de Informação Isolado */
        .info-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 16px;
        }
        .info-card-inner {
            margin-right: 14px; /* Espaçamento entre colunas simuladas */
        }
        
        /* Placa Destacada Estilo Mercosul/Antiga */
        .plate-box {
            background-color: #ffffff;
            border: 3px solid #0f172a;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            box-shadow: inset 0 0 4px rgba(0,0,0,0.05);
        }
        .plate-header {
            font-size: 8px;
            font-weight: 800;
            color: #ffffff;
            background-color: #0046AD;
            margin: -10px -10px 6px -10px;
            padding: 3px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
        }
        .plate-text {
            font-family: 'Courier New', Courier, monospace;
            font-size: 22px;
            font-weight: 900;
            color: #0f172a;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Labels e Typography */
        .label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }
        .value {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
        }
        .uppercase {
            text-transform: uppercase;
        }

        /* Rodapé de Segurança */
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #94a3b8;
            border-top: 2px dashed #e2e8f0;
            padding-top: 20px;
        }
        .footer-bold {
            font-weight: 700;
            color: #64748b;
            margin-bottom: 4px;
        }
    </style>
</head>
<body>

<div class="ticket-container">
    <div class="top-bar"></div>

    <table class="header-table">
        <tr>
            <td>
                <div class="brand-logo">LogisticsPro</div>
                <div class="brand-sub">Sistema de Gestão de Pátio e Portaria</div>
            </td>
            <td class="ticket-meta">
                <div class="ticket-number">Nº {{ str_pad($agendamento->id, 6, '0', STR_PAD_LEFT) }}</div>
            </td>
        </tr>
    </table>

    <div class="status-section">
        <span class="status-badge">✓ Saída Autorizada</span>
        <span class="timestamp">Gerado em: {{ now()->format('d/m/Y H:i:s') }}</span>
    </div>

    <div class="info-card">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 65%; vertical-align: top;">
                    <span class="label">Motorista / Condutor</span>
                    <span class="value uppercase">{{ $agendamento->motorista->nome }}</span>
                </td>
                <td style="width: 35%; vertical-align: top;">
                    <span class="label">Documento CPF</span>
                    <span class="value" style="font-family: monospace; font-size: 14px;">{{ $agendamento->motorista->cpf }}</span>
                </td>
            </tr>
        </table>
    </div>

    <table class="grid-table">
        <tr>
            <td style="width: 50%;">
                <div class="info-card-inner">
                    <div class="info-card" style="min-height: 110px;">
                        <span class="label">Modelo do Veículo</span>
                        <span class="value uppercase" style="display: block; margin-bottom: 12px;">{{ $agendamento->veiculo->modelo }}</span>
                        
                        <div class="plate-box">
                            <div class="plate-header">Brasil</div>
                            <div class="plate-text">{{ $agendamento->veiculo->placa }}</div>
                        </div>
                    </div>
                </div>
            </td>
            
            <td style="width: 50%;">
                <div class="info-card" style="min-height: 110px;">
                    <span class="label">Classificação do Material / Carga</span>
                    <span class="value uppercase" style="color: #0046AD; display: block; margin-bottom: 8px;">{{ $agendamento->carga->tipo }}</span>
                    
                    <span class="label" style="margin-top: 12px;">Fluxo Operacional</span>
                    <span class="value" style="font-size: 12px; color: #475569;">Expedição / Evasão de Doca</span>
                </div>
            </td>
        </tr>
    </table>

    <div class="footer">
        <div class="footer-bold">TIQUETE DE CONTROLE DE PORTARIA PRINCIPAL</div>
        <div>Este documento comprova que o veículo citado realizou a checagem documental e física obrigatória.</div>
        <div style="margin-top: 4px; color: #cbd5e1;">LogisticsPro Yard Management Systems • Direitos Reservados</div>
    </div>
</div>

</body>
</html>