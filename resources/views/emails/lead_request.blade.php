<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Новая заявка с сайта НСК Макстар · Диски</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.45; background-color:#f5f5f5; padding:20px;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:640px;margin:0 auto;background:#ffffff;border-radius:8px;overflow:hidden;">
        <tr>
            <td style="padding:20px 24px 16px 24px;border-bottom:1px solid #e5e7eb;">
                <h2 style="margin:0 0 4px;font-size:18px;color:#111827;">
                    Новая заявка с сайта <span style="color:#d4913a;">НСК Макстар · Диски</span>
                </h2>
                <p style="margin:0;font-size:12px;color:#6b7280;">
                    {{ $lead['created_at'] ?? '' }}
                </p>
            </td>
        </tr>

        <tr>
            <td style="padding:20px 24px 8px 24px;">
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;font-size:14px;color:#111827;">
                    <tr>
                        <td style="padding:4px 0;width:120px;color:#6b7280;">Имя:</td>
                        <td style="padding:4px 0;">
                            {{ $lead['name'] ? e($lead['name']) : '—' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:4px 0;width:120px;color:#6b7280;">Телефон:</td>
                        <td style="padding:4px 0;">
                            {{ e($lead['phone'] ?? '') }}
                        </td>
                    </tr>

                    @if(!empty($lead['message']))
                        <tr>
                            <td style="padding:8px 0 0;width:120px;color:#6b7280;vertical-align:top;">Комментарий:</td>
                            <td style="padding:8px 0 0;">
                                {!! nl2br(e($lead['message'])) !!}
                            </td>
                        </tr>
                    @endif
                    @if(!empty($lead['photo_name']))
                        <tr>
                            <td style="padding:8px 0 0;width:120px;color:#6b7280;vertical-align:top;">Фото:</td>
                            <td style="padding:8px 0 0;">
                                {{ e($lead['photo_name']) }} — приложено к письму
                            </td>
                        </tr>
                    @endif
                </table>
            </td>
        </tr>

        <tr>
            <td style="padding:12px 24px 16px 24px;border-top:1px solid #e5e7eb;">
                <p style="margin:0 0 4px;font-size:13px;color:#6b7280;">
                    <strong>Страница:</strong> {{ $lead['page'] ?? '' }}
                </p>
                <p style="margin:0 0 4px;font-size:13px;color:#6b7280;">
                    <strong>IP:</strong> {{ $lead['ip'] ?? '' }}
                </p>
                <p style="margin:0;font-size:12px;color:#9ca3af;">
                    <strong>User-Agent:</strong> {{ $lead['user_agent'] ?? '' }}
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
