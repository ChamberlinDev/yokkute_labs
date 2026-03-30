<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Permitted-Cross-Domain-Policies', 'none');
        $response->headers->set('Permissions-Policy', 'accelerometer=(), camera=(), geolocation=(), gyroscope=(), magnetometer=(), microphone=(), payment=(), usb=()');
        $response->headers->set('Cross-Origin-Opener-Policy', 'same-origin');
        $response->headers->set('Content-Security-Policy', $this->contentSecurityPolicy($request));

        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        return $response;
    }

    private function contentSecurityPolicy(Request $request): string
    {
        $scriptSrc = [
            "'self'",
            "'unsafe-inline'",
            'https://cdn.jsdelivr.net',
        ];

        $styleSrc = [
            "'self'",
            "'unsafe-inline'",
            'https://cdn.jsdelivr.net',
            'https://fonts.bunny.net',
            'https://fonts.googleapis.com',
        ];

        $fontSrc = [
            "'self'",
            'data:',
            'https://cdn.jsdelivr.net',
            'https://fonts.bunny.net',
            'https://fonts.googleapis.com',
            'https://fonts.gstatic.com',
        ];

        $imgSrc = [
            "'self'",
            'data:',
            'blob:',
            'https:',
        ];

        $connectSrc = [
            "'self'",
        ];

        if ($request->isSecure()) {
            $connectSrc[] = 'https:';
        } else {
            $connectSrc[] = 'http:';
        }

        return implode('; ', [
            "default-src 'self'",
            'base-uri \'self\'',
            'form-action \'self\'',
            'frame-ancestors \'none\'',
            'object-src \'none\'',
            'script-src '.implode(' ', $scriptSrc),
            'style-src '.implode(' ', $styleSrc),
            'img-src '.implode(' ', $imgSrc),
            'font-src '.implode(' ', $fontSrc),
            'connect-src '.implode(' ', $connectSrc),
            'media-src \'self\'',
            'worker-src \'self\' blob:',
            'upgrade-insecure-requests',
        ]);
    }
}