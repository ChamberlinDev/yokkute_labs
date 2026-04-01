<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau message de contact</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.6;">
    <h2 style="margin-bottom: 8px;">Nouveau message de contact</h2>
    <p style="margin-top: 0;">Un nouveau message a été soumis depuis la page Contact.</p>

    <ul style="padding-left: 18px;">
        <li><strong>Nom :</strong> {{ $contactMessage->prenom }} {{ $contactMessage->nom }}</li>
        <li><strong>Email :</strong> {{ $contactMessage->email }}</li>
        <li><strong>WhatsApp :</strong> {{ $contactMessage->whatsapp ?: 'Non renseigné' }}</li>
        <li><strong>Entreprise :</strong> {{ $contactMessage->entreprise ?: 'Non renseignée' }}</li>
        <li><strong>Besoin :</strong> {{ $contactMessage->besoin }}</li>
    </ul>

    <p><strong>Message :</strong></p>
    <p style="white-space: pre-line;">{{ $contactMessage->message }}</p>

    <p style="margin-top: 20px; color: #6b7280;">Date : {{ $contactMessage->created_at?->format('d/m/Y H:i') }}</p>
</body>
</html>
