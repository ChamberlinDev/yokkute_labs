<?php

namespace App\Http\Controllers;

use App\Mail\NewCandidatureNotification;
use App\Models\Candidature;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class CandidatureController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'portfolio' => $this->normalizeOptionalUrl($request->input('portfolio')),
        ]);

        $validated = $request->validate([
            'prenom' => ['required', 'string', 'max:100'],
            'nom' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'telephone' => ['nullable', 'string', 'max:50'],
            'domaine' => ['required', 'in:dev,data,conseil,projet,formation,commercial,marketing,autre'],
            'experience' => ['required', 'in:junior,confirme,senior,expert'],
            'portfolio' => ['nullable', 'url', 'max:255'],
            'cv' => ['nullable', 'file', 'mimetypes:application/pdf', 'mimes:pdf', 'max:30720'],
            'message' => ['required', 'string', 'min:20', 'max:5000'],
        ]);

        $cvPath = null;
        if ($request->hasFile('cv')) {
            try {
                Log::info('Uploading CV for candidature', [
                    'filename' => $request->file('cv')->getClientOriginalName(),
                    'size' => $request->file('cv')->getSize(),
                    'mime' => $request->file('cv')->getMimeType(),
                ]);
                
                $cvPath = $request->file('cv')->storeAs(
                    'candidatures/cv',
                    (string) Str::uuid().'.pdf',
                    'local'
                );
                
                Log::info('CV uploaded successfully', ['path' => $cvPath]);
            } catch (Throwable $e) {
                Log::error('CV upload failed', [
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]);
                $cvPath = null;
            }
        }

        $candidature = Candidature::create([
            'prenom' => $validated['prenom'],
            'nom' => $validated['nom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'] ?? null,
            'domaine' => $validated['domaine'],
            'experience' => $validated['experience'],
            'portfolio' => $validated['portfolio'] ?? null,
            'message' => $validated['message'],
            'cv_path' => $cvPath,
        ]);

        try {
            $mailEnabled = SiteSetting::valueFor('mail_notifications_enabled', '1') === '1';

            if ($mailEnabled) {
                $recipient = SiteSetting::valueFor('rh_notification_email')
                    ?: SiteSetting::valueFor('rh_email', Config::string('mail.rh_to'));

                Mail::to($recipient)->send(new NewCandidatureNotification($candidature));
                $candidature->forceFill(['rh_notified_at' => now()])->save();
            }
        } catch (Throwable $exception) {
            report($exception);
        }

        return redirect()
            ->route('rejoindre')
            ->with('success', 'Merci, votre candidature a ete envoyee avec succes.');
    }

    private function normalizeOptionalUrl(?string $value): ?string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        if (!preg_match('~^https?://~i', $value)) {
            $value = 'https://' . ltrim($value, '/');
        }

        return $value;
    }
}
