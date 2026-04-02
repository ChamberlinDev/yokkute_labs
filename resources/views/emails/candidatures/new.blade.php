<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvelle candidature</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.6;">
    <h2 style="margin-bottom: 8px;">Nouvelle candidature reçue</h2>
    <p style="margin-top: 0;">Une nouvelle candidature a été soumise depuis la page "Nous rejoindre".</p>

    <ul style="padding-left: 18px;">
        <li><strong>Nom :</strong> {{ $candidature->prenom }} {{ $candidature->nom }}</li>
        <li><strong>Email :</strong> {{ $candidature->email }}</li>
        <li><strong>Téléphone :</strong> {{ $candidature->telephone ?: 'Non renseigné' }}</li>
        <li><strong>Domaine :</strong> {{ $candidature->domaine }}</li>
        <li><strong>Expérience :</strong> {{ $candidature->experience }}</li>
        <li><strong>Portfolio :</strong> {{ $candidature->portfolio ?: 'Non renseigné' }}</li>
        <li><strong>CV :</strong> {{ $candidature->cv_path ? 'CV joint' : 'Aucun CV fourni' }}</li>
    </ul>

    <p><strong>Message :</strong></p>
    <p style="white-space: pre-line;">{{ $candidature->message }}</p>

    <p style="margin-top: 20px; color: #6b7280;">Date : {{ $candidature->created_at?->format('d/m/Y H:i') }}</p>
</body>
</html>
