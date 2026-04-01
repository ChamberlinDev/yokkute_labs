<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use App\Support\PublicUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamMemberController extends Controller
{
    public function index(): View
    {
        return view('admin.team.index', [
            'members' => TeamMember::query()->orderBy('order_column')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.team.create', ['member' => new TeamMember()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $member = new TeamMember();
        $this->fillAndSave($request, $member);

        return redirect()->route('admin.team.index')->with('success', 'Membre ajoute avec succes.');
    }

    public function edit(TeamMember $team): View
    {
        return view('admin.team.edit', ['member' => $team]);
    }

    public function update(Request $request, TeamMember $team): RedirectResponse
    {
        $this->fillAndSave($request, $team);

        return redirect()->route('admin.team.index')->with('success', 'Membre mis a jour avec succes.');
    }

    public function destroy(TeamMember $team): RedirectResponse
    {
        PublicUploads::delete($team->image_path);
        $team->delete();

        return redirect()->route('admin.team.index')->with('success', 'Membre supprime.');
    }

    private function fillAndSave(Request $request, TeamMember $member): void
    {
        $request->merge([
            'linkedin_url' => $this->normalizeOptionalUrl($request->input('linkedin_url')),
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'role_en' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'bio_en' => ['nullable', 'string'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'order_column' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
        ]);

        if ($request->hasFile('image')) {
            PublicUploads::delete($member->image_path);
            $member->image_path = PublicUploads::store($request->file('image'), 'team');
        }

        $member->fill([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'role_en' => $validated['role_en'] ?? null,
            'bio' => $validated['bio'] ?? null,
            'bio_en' => $validated['bio_en'] ?? null,
            'linkedin_url' => $validated['linkedin_url'] ?? null,
            'order_column' => $validated['order_column'],
            'is_active' => $request->boolean('is_active'),
        ]);

        $member->save();
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
