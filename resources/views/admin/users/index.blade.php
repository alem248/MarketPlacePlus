@extends('layouts.admin')
@section('title', 'Gestionar Usuarios')
@section('page_title', 'Gestionar Usuarios y Perfiles')

@section('content')
<div class="mb-8">
    <h1 class="font-headline-lg text-headline-lg text-on-surface">Usuarios Registrados</h1>
    <p class="text-on-surface-variant text-body-lg">Gestione los perfiles y roles de los usuarios de la plataforma</p>
</div>

<div class="bg-surface-container-lowest rounded-xl border border-outline-variant overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-surface-container border-b border-outline-variant">
                <tr>
                    <th class="px-6 py-4 text-left font-label-caps text-label-caps text-on-surface-variant">USUARIO</th>
                    <th class="px-6 py-4 text-left font-label-caps text-label-caps text-on-surface-variant">CORREO</th>
                    <th class="px-6 py-4 text-left font-label-caps text-label-caps text-on-surface-variant">TELÉFONO</th>
                    <th class="px-6 py-4 text-left font-label-caps text-label-caps text-on-surface-variant">ROL ACTUAL</th>
                    <th class="px-6 py-4 text-center font-label-caps text-label-caps text-on-surface-variant">CAMBIAR ROL</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant">
                @forelse($users as $user)
                <tr class="hover:bg-surface-container-low/50 transition-colors {{ $user->id === auth()->id() ? 'bg-primary-fixed/10' : '' }}">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-primary flex items-center justify-center text-on-primary font-bold text-sm shrink-0">
                                {{ strtoupper(substr($user->first_name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-body-sm">{{ $user->full_name }}</p>
                                @if($user->id === auth()->id())
                                    <span class="text-[10px] text-primary font-bold">TÚ</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-body-sm text-on-surface-variant">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-body-sm text-on-surface-variant">{{ $user->phone ?? '—' }}</td>
                    <td class="px-6 py-4">
                        @if($user->role === 'admin')
                            <span class="bg-primary text-on-primary px-3 py-1 rounded-full text-label-caps font-bold">ADMIN</span>
                        @else
                            <span class="bg-surface-container-high text-on-surface-variant px-3 py-1 rounded-full text-label-caps font-bold">USUARIO</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.updateRole', $user) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="role" value="{{ $user->role === 'admin' ? 'user' : 'admin' }}">
                                    <button type="submit"
                                        class="{{ $user->role === 'admin' ? 'bg-error/10 text-error hover:bg-error/20' : 'bg-primary/10 text-primary hover:bg-primary/20' }} px-4 py-1.5 rounded-lg font-bold text-body-sm transition-colors"
                                        onclick="return confirm('¿Cambiar el rol de {{ $user->first_name }} a {{ $user->role === 'admin' ? 'usuario' : 'administrador' }}?')">
                                        {{ $user->role === 'admin' ? '→ Usuario' : '→ Admin' }}
                                    </button>
                                </form>
                            @else
                                <span class="text-on-surface-variant text-body-sm italic">Tu cuenta</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-5xl">group</span>
                        <p class="mt-3 font-body-lg">No hay usuarios registrados.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-6 border-t border-outline-variant">
        {{ $users->links() }}
    </div>
</div>
@endsection
