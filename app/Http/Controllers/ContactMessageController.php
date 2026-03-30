<?php

namespace App\Http\Controllers;

use App\Mail\NewContactMessageNotification;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactMessageController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'prenom' => ['required', 'string', 'max:100'],
            'nom' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:50'],
            'entreprise' => ['nullable', 'string', 'max:255'],
            'besoin' => ['required', 'in:audit,conseil,referencement,integration,ia,formation,bigdata,orientation'],
            'message' => ['required', 'string', 'min:20', 'max:5000'],
        ]);

        $message = ContactMessage::query()->create([
            'prenom' => $validated['prenom'],
            'nom' => $validated['nom'],
            'email' => $validated['email'],
            'whatsapp' => $validated['whatsapp'] ?? null,
            'entreprise' => $validated['entreprise'] ?? null,
            'besoin' => $validated['besoin'],
            'orientation_requested' => $validated['besoin'] === 'orientation',
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        try {
            $mailEnabled = SiteSetting::valueFor('mail_notifications_enabled', '1') === '1';

            if ($mailEnabled) {
                $recipient = SiteSetting::valueFor('contact_notification_email')
                    ?: SiteSetting::valueFor('contact_email', 'solution@yokkutelabs.com');

                Mail::to($recipient)->send(new NewContactMessageNotification($message));
            }
        } catch (Throwable $exception) {
            report($exception);
        }

        return redirect()
            ->route('contact')
            ->with('success', 'Merci, votre message a ete envoye avec succes.');
    }
}