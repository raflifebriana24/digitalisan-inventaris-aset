<?php
$file = __DIR__ . '/resources/views/layout.blade.php';
$content = file_get_contents($file);

$start = strpos($content, '<!-- Sidebar -->');
$end = strpos($content, '</aside>') + 8;
$oldSidebar = substr($content, $start, $end - $start);

$newSidebar = <<<HTML
<!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed z-50 inset-y-0 left-0 w-[280px] transition-all duration-300 transform bg-[#0B1120] shadow-2xl lg:translate-x-0 lg:static lg:inset-0 flex flex-col lg:m-5 lg:rounded-2xl lg:h-[calc(100vh-2.5rem)] border border-gray-800/60 overflow-hidden">
            <!-- Logo Section -->
            <div class="flex items-center justify-center pt-8 pb-6 border-b border-gray-800/60 relative">
                <!-- Decorative Glow -->
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-48 h-48 bg-blue-500 rounded-full opacity-10 blur-3xl pointer-events-none"></div>
                <div class="flex items-center gap-3 relative z-10">
                    <div class="bg-gradient-to-tr from-blue-600 to-blue-400 p-2.5 rounded-xl shadow-lg shadow-blue-500/20 ring-1 ring-white/10">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <span class="text-white text-xl font-bold tracking-tight">Manajemen<span class="text-blue-400">Aset</span></span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 mt-6 space-y-1.5 overflow-y-auto overflow-x-hidden custom-scrollbar pb-6">
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <!-- ADMIN SIDEBAR -->
                    <div class="px-3 mb-3 text-[0.7rem] font-bold text-gray-500 uppercase tracking-wider">Main Menu</div>
                    
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20 ring-1 ring-blue-500/50' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }} group flex items-center px-3 py-3 text-[0.95rem] font-medium rounded-xl transition-all duration-200">
                        <svg class="mr-3.5 flex-shrink-0 h-5 w-5 transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-500 group-hover:text-blue-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('assets.index') }}" class="{{ request()->routeIs('assets.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20 ring-1 ring-blue-500/50' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }} group flex items-center px-3 py-3 text-[0.95rem] font-medium rounded-xl transition-all duration-200">
                        <svg class="mr-3.5 flex-shrink-0 h-5 w-5 transition-colors duration-200 {{ request()->routeIs('assets.*') ? 'text-white' : 'text-gray-500 group-hover:text-blue-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Data Aset
                    </a>

                    <a href="#" class="text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 group flex items-center px-3 py-3 text-[0.95rem] font-medium rounded-xl transition-all duration-200">
                        <svg class="mr-3.5 flex-shrink-0 h-5 w-5 transition-colors duration-200 text-gray-500 group-hover:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        Kategori Aset
                    </a>

                    <a href="{{ route('rooms.index') }}" class="{{ request()->routeIs('rooms.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20 ring-1 ring-blue-500/50' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }} group flex items-center px-3 py-3 text-[0.95rem] font-medium rounded-xl transition-all duration-200">
                        <svg class="mr-3.5 flex-shrink-0 h-5 w-5 transition-colors duration-200 {{ request()->routeIs('rooms.*') ? 'text-white' : 'text-gray-500 group-hover:text-blue-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Lokasi Aset
                    </a>

                    <a href="#" class="text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 group flex items-center px-3 py-3 text-[0.95rem] font-medium rounded-xl transition-all duration-200">
                        <svg class="mr-3.5 flex-shrink-0 h-5 w-5 transition-colors duration-200 text-gray-500 group-hover:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Data Pengguna
                    </a>

                    <div class="px-3 mt-6 mb-3 text-[0.7rem] font-bold text-gray-500 uppercase tracking-wider">Laporan & Monitoring</div>

                    <div x-data="{ open: {{ request()->routeIs('admin.laporan-kerusakan*') ? 'true' : 'false' }} }" class="space-y-1 pt-1">
                        <button @click="open = !open" class="{{ request()->routeIs('admin.laporan-kerusakan*') ? 'bg-gray-800/80 text-white ring-1 ring-gray-700' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }} group w-full flex items-center px-3 py-3 text-[0.95rem] font-medium rounded-xl focus:outline-none transition-all duration-200">
                            <svg class="mr-3.5 flex-shrink-0 h-5 w-5 transition-colors duration-200 {{ request()->routeIs('admin.laporan-kerusakan*') ? 'text-blue-400' : 'text-gray-500 group-hover:text-blue-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span class="flex-1 text-left">Laporan Kerusakan</span>
                            <svg :class="{'rotate-90': open}" class="ml-auto h-4 w-4 transform transition-transform duration-200 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" class="space-y-1 px-2 pb-1" style="display: none;">
                            <a href="{{ route('admin.laporan-kerusakan') }}" class="{{ request()->routeIs('admin.laporan-kerusakan') ? 'text-white bg-white/5' : 'text-gray-400 hover:text-gray-200' }} group w-full flex items-center pl-10 pr-3 py-2.5 text-[0.9rem] font-medium rounded-lg transition-all duration-200 relative">
                                <div class="absolute left-5 top-1/2 -translate-y-1/2 w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.laporan-kerusakan') ? 'bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.8)]' : 'bg-gray-600 group-hover:bg-blue-400' }}"></div>
                                Verifikasi Laporan
                                @if(isset($pendingReportsCount) && $pendingReportsCount > 0)
                                    <span class="ml-auto inline-flex items-center justify-center px-2 py-0.5 font-bold bg-red-500 text-white rounded-full text-[0.7rem] shadow-sm">{{ $pendingReportsCount }}</span>
                                @endif
                            </a>
                            <a href="#" class="text-gray-400 hover:text-gray-200 group w-full flex items-center pl-10 pr-3 py-2.5 text-[0.9rem] font-medium rounded-lg transition-all duration-200 relative">
                                <div class="absolute left-5 top-1/2 -translate-y-1/2 w-1.5 h-1.5 rounded-full bg-gray-600 group-hover:bg-blue-400"></div>
                                Riwayat Laporan
                            </a>
                        </div>
                    </div>

                    <a href="#" class="text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 group flex items-center px-3 py-3 text-[0.95rem] font-medium rounded-xl transition-all duration-200">
                        <svg class="mr-3.5 flex-shrink-0 h-5 w-5 transition-colors duration-200 text-gray-500 group-hover:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Monitoring Aset
                    </a>

                    <a href="#" class="text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 group flex items-center px-3 py-3 text-[0.95rem] font-medium rounded-xl transition-all duration-200">
                        <svg class="mr-3.5 flex-shrink-0 h-5 w-5 transition-colors duration-200 text-gray-500 group-hover:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Laporan
                    </a>

                    <a href="#" class="text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 group flex items-center px-3 py-3 text-[0.95rem] font-medium rounded-xl transition-all duration-200">
                        <svg class="mr-3.5 flex-shrink-0 h-5 w-5 transition-colors duration-200 text-gray-500 group-hover:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065zM15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Pengaturan
                    </a>

                @elseif(auth()->check() && auth()->user()->role === 'operator')
                    <!-- OPERATOR SIDEBAR -->
                    <div class="px-3 mb-3 text-[0.7rem] font-bold text-gray-500 uppercase tracking-wider">Main Menu</div>

                    <a href="{{ route('operator.index') }}" class="{{ request()->routeIs('operator.index') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20 ring-1 ring-blue-500/50' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }} group flex items-center px-3 py-3 text-[0.95rem] font-medium rounded-xl transition-all duration-200">
                        <svg class="mr-3.5 flex-shrink-0 h-5 w-5 transition-colors duration-200 {{ request()->routeIs('operator.index') ? 'text-white' : 'text-gray-500 group-hover:text-blue-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('assets.index') }}" class="{{ request()->routeIs('assets.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20 ring-1 ring-blue-500/50' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }} group flex items-center px-3 py-3 text-[0.95rem] font-medium rounded-xl transition-all duration-200">
                        <svg class="mr-3.5 flex-shrink-0 h-5 w-5 transition-colors duration-200 {{ request()->routeIs('assets.*') ? 'text-white' : 'text-gray-500 group-hover:text-blue-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Data Aset
                    </a>

                    <a href="{{ route('scan') }}" class="{{ request()->routeIs('scan') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20 ring-1 ring-blue-500/50' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }} group flex items-center px-3 py-3 text-[0.95rem] font-medium rounded-xl transition-all duration-200">
                        <svg class="mr-3.5 flex-shrink-0 h-5 w-5 transition-colors duration-200 {{ request()->routeIs('scan') ? 'text-white' : 'text-gray-500 group-hover:text-blue-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                        </svg>
                        Scan QR Code
                    </a>

                    <div class="px-3 mt-6 mb-3 text-[0.7rem] font-bold text-gray-500 uppercase tracking-wider">Laporan</div>

                    <a href="{{ route('operator.laporan-kerusakan.buat') }}" class="{{ request()->routeIs('operator.laporan-kerusakan.buat') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20 ring-1 ring-blue-500/50' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }} group flex items-center px-3 py-3 text-[0.95rem] font-medium rounded-xl transition-all duration-200">
                        <svg class="mr-3.5 flex-shrink-0 h-5 w-5 transition-colors duration-200 {{ request()->routeIs('operator.laporan-kerusakan.buat') ? 'text-white' : 'text-gray-500 group-hover:text-blue-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        Buat Laporan Kerusakan
                    </a>

                    <a href="{{ route('operator.laporan-kerusakan') }}" class="{{ request()->routeIs('operator.laporan-kerusakan') && !request()->routeIs('operator.laporan-kerusakan.buat') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20 ring-1 ring-blue-500/50' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }} group flex items-center px-3 py-3 text-[0.95rem] font-medium rounded-xl transition-all duration-200">
                        <svg class="mr-3.5 flex-shrink-0 h-5 w-5 transition-colors duration-200 {{ request()->routeIs('operator.laporan-kerusakan') && !request()->routeIs('operator.laporan-kerusakan.buat') ? 'text-white' : 'text-gray-500 group-hover:text-blue-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Status Laporan Saya
                    </a>

                    <a href="#" class="text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 group flex items-center px-3 py-3 text-[0.95rem] font-medium rounded-xl transition-all duration-200">
                        <svg class="mr-3.5 flex-shrink-0 h-5 w-5 transition-colors duration-200 text-gray-500 group-hover:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Riwayat Laporan
                    </a>
                @endif
            </nav>

            @if(auth()->check())
            <div class="flex-shrink-0 p-4 border-t border-gray-800/60 bg-gray-900/50">
                <div class="space-y-2">
                    <a href="{{ route('profile.index') }}" class="group flex w-full items-center px-3 py-2.5 text-[0.95rem] font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition-all duration-200 rounded-lg">
                        <div class="mr-3 flex items-center justify-center h-8 w-8 rounded-full bg-blue-600 text-white font-bold ring-2 ring-gray-700 group-hover:ring-blue-500 transition-all duration-200">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-semibold truncate max-w-[150px]">{{ auth()->user()->name }}</span>
                            <span class="text-[0.7rem] text-gray-500 capitalize">{{ auth()->user()->role }}</span>
                        </div>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="group flex w-full items-center px-3 py-2.5 text-[0.95rem] font-medium text-gray-400 hover:text-red-400 hover:bg-red-500/10 transition-all duration-200 rounded-lg">
                            <svg class="mr-3 h-5 w-5 text-gray-500 group-hover:text-red-400 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </aside>
HTML;

$content = str_replace($oldSidebar, $newSidebar, $content);

$oldScrollbar = '.custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
        }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb {
            background-color: #94a3b8;
        }';
        
$newScrollbar = '.custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #334155;
            border-radius: 20px;
        }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb {
            background-color: #475569;
        }';
$content = str_replace($oldScrollbar, $newScrollbar, $content);

file_put_contents($file, $content);
echo "Sidebar replaced.\n";
?>
