@extends('layout')
@section('content')

<!-- Modern Dashboard Layout -->
<div style="display: grid; gap: 1.5rem;">
    
    <!-- Top Bar: Welcome & Quick Stats -->
    <div style="display: grid; grid-template-columns: 1fr auto; gap: 1.5rem; align-items: center;">
        <!-- Welcome Section -->
        <div style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); padding: 1.75rem 2rem; border-radius: var(--radius-lg); color: white; box-shadow: var(--shadow-lg); position: relative; overflow: hidden;">
            <div style="position: absolute; top: 0; right: 0; width: 200px; height: 200px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); border-radius: 50%; transform: translate(50%, -50%);"></div>
            <div style="position: relative; z-index: 1;">
                <div style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 0.25rem; font-weight: 500;">Selamat datang kembali,</div>
                <div style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">{{ Auth::user()->name }}</div>
                <div style="font-size: 0.8125rem; opacity: 0.85;">Dashboard Manajemen Aset - Diskominfo Kota Serang</div>
            </div>
        </div>
        
        <!-- User Info & Logout -->
        <div style="display: flex; gap: 0.75rem; align-items: center;">
            <div style="background: white; padding: 0.875rem 1.25rem; border-radius: var(--radius-md); box-shadow: var(--shadow-md); text-align: right;">
                <div style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 0.125rem;">Logged in as</div>
                <div style="font-size: 0.875rem; font-weight: 600; color: var(--text-primary);">{{ Auth::user()->email }}</div>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn btn-danger" style="padding: 0.875rem 1.25rem; font-size: 0.875rem; white-space: nowrap;">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content Grid: Stats Sidebar + Content Area -->
    <div style="display: grid; grid-template-columns: 280px 1fr; gap: 1.5rem;">
        
        <!-- Left Sidebar: Stats Cards (Vertical Stack) -->
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <!-- Total Assets -->
            <div style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); padding: 1.5rem; border-radius: var(--radius-lg); color: white; box-shadow: var(--shadow-md); position: relative; overflow: hidden;">
                <div style="position: absolute; top: -10px; right: -10px; opacity: 0.15;">
                    <svg width="80" height="80" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div style="position: relative; z-index: 1;">
                    <div style="font-size: 0.75rem; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Total Aset</div>
                    <div style="font-size: 2.5rem; font-weight: 800; line-height: 1; margin-bottom: 0.5rem;">{{ $totalAssets }}</div>
                    <div style="height: 3px; background: rgba(255,255,255,0.3); border-radius: 999px; overflow: hidden; margin-bottom: 0.5rem;">
                        <div style="height: 100%; background: rgba(255,255,255,0.7); width: 100%; border-radius: 999px;"></div>
                    </div>
                    <div style="font-size: 0.75rem; opacity: 0.85;">Terdaftar</div>
                </div>
            </div>

            <!-- Asset Items -->
            <div style="background: linear-gradient(135deg, #14b8a6 0%, #06b6d4 100%); padding: 1.5rem; border-radius: var(--radius-lg); color: white; box-shadow: var(--shadow-md); position: relative; overflow: hidden;">
                <div style="position: absolute; top: -10px; right: -10px; opacity: 0.15;">
                    <svg width="80" height="80" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                    </svg>
                </div>
                <div style="position: relative; z-index: 1;">
                    <div style="font-size: 0.75rem; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Barang</div>
                    <div style="font-size: 2.5rem; font-weight: 800; line-height: 1; margin-bottom: 0.5rem;">{{ $assetItems }}</div>
                    <div style="height: 3px; background: rgba(255,255,255,0.3); border-radius: 999px; overflow: hidden; margin-bottom: 0.5rem;">
                        <div style="height: 100%; background: rgba(255,255,255,0.7); width: {{ $totalAssets > 0 ? ($assetItems / $totalAssets) * 100 : 0 }}%; border-radius: 999px;"></div>
                    </div>
                    <div style="font-size: 0.75rem; opacity: 0.85;">Non-ruangan</div>
                </div>
            </div>



            <!-- Estimated Value -->
            <div style="background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%); padding: 1.5rem; border-radius: var(--radius-lg); color: white; box-shadow: var(--shadow-md); position: relative; overflow: hidden;">
                <div style="position: absolute; top: -10px; right: -10px; opacity: 0.15;">
                    <svg width="80" height="80" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div style="position: relative; z-index: 1;">
                    <div style="font-size: 0.75rem; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Nilai Estimasi</div>
                    <div style="font-size: 1.25rem; font-weight: 800; line-height: 1.2; margin-bottom: 0.5rem;">Rp {{ number_format($totalEstimatedValue, 0, ',', '.') }}</div>
                    <div style="height: 3px; background: rgba(255,255,255,0.3); border-radius: 999px; overflow: hidden; margin-bottom: 0.5rem;">
                        <div style="height: 100%; background: rgba(255,255,255,0.7); width: 85%; border-radius: 999px;"></div>
                    </div>
                    <div style="font-size: 0.75rem; opacity: 0.85;">Total value</div>
                </div>
            </div>

            <!-- Laporan Kerusakan -->
            <a href="{{ route('admin.laporan-kerusakan') }}" style="text-decoration:none; display:block;">
            <div style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); padding: 1.5rem; border-radius: var(--radius-lg); color: white; box-shadow: var(--shadow-md); position: relative; overflow: hidden; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 24px rgba(220,38,38,0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-md)'">
                <div style="position: absolute; top: -10px; right: -10px; opacity: 0.15;">
                    <svg width="80" height="80" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div style="position: relative; z-index: 1;">
                    <div style="font-size: 0.75rem; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Laporan Kerusakan</div>
                    <div style="font-size: 2.5rem; font-weight: 800; line-height: 1; margin-bottom: 0.5rem;">{{ $totalKerusakan }}</div>
                    <div style="height: 3px; background: rgba(255,255,255,0.3); border-radius: 999px; overflow: hidden; margin-bottom: 0.5rem;">
                        <div style="height: 100%; background: rgba(255,255,255,0.7); width: {{ $totalAssets > 0 ? min(($totalKerusakan / $totalAssets) * 100, 100) : 0 }}%; border-radius: 999px;"></div>
                    </div>
                    <div style="font-size: 0.75rem; opacity: 0.85; display:flex; align-items:center; gap:0.3rem;">Dari Operator &rarr; Klik untuk detail</div>
                </div>
            </div>
            </a>

            <!-- Menunggu Persetujuan -->
            <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); padding: 1.5rem; border-radius: var(--radius-lg); color: white; box-shadow: var(--shadow-md); position: relative; overflow: hidden; cursor: default;" title="Laporan kerusakan aset yang masih menunggu verifikasi dan persetujuan Admin.">
                <div style="position: absolute; top: -10px; right: -10px; opacity: 0.15;">
                    <svg width="80" height="80" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div style="position: relative; z-index: 1;">
                    <div style="font-size: 0.75rem; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Menunggu Persetujuan</div>
                    <div style="font-size: 2.5rem; font-weight: 800; line-height: 1; margin-bottom: 0.5rem;">{{ $totalMenungguPersetujuan }}</div>
                    <div style="height: 3px; background: rgba(255,255,255,0.3); border-radius: 999px; overflow: hidden; margin-bottom: 0.5rem;">
                        <div style="height: 100%; background: rgba(255,255,255,0.7); width: {{ $totalSemuaLaporan > 0 ? min(($totalMenungguPersetujuan / $totalSemuaLaporan) * 100, 100) : 0 }}%; border-radius: 999px;"></div>
                    </div>
                    <div style="font-size: 0.75rem; opacity: 0.85;">{{ $totalSemuaLaporan > 0 ? round(($totalMenungguPersetujuan / $totalSemuaLaporan) * 100, 1) : 0 }}% dari total laporan</div>
                </div>
            </div>
        </div>

        <!-- Right Content Area -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            
            <!-- Category Distribution - Horizontal Bars -->
            <div style="background: white; padding: 1.75rem; border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem; margin: 0;">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20" style="color: var(--primary);">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                        </svg>
                        Distribusi Kategori Aset
                    </h3>
                    <div style="font-size: 0.75rem; color: var(--text-muted); background: var(--bg-tertiary); padding: 0.375rem 0.75rem; border-radius: var(--radius-sm);">{{ $assetsByCategory->count() }} Kategori</div>
                </div>
                
                <div style="display: grid; gap: 1rem;">
                    @forelse($assetsByCategory as $index => $category)
                    <div style="animation: slideInRight {{ $index * 0.1 + 0.2 }}s ease-out;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 8px; height: 8px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--secondary));"></div>
                                <span style="font-size: 0.875rem; font-weight: 600; color: var(--text-primary);">{{ $category->kategori }}</span>
                            </div>
                            <div style="display: flex; align-items: baseline; gap: 0.375rem;">
                                <span style="font-size: 1.25rem; font-weight: 700; color: var(--primary);">{{ $category->total }}</span>
                                <span style="font-size: 0.75rem; color: var(--text-muted);">({{ round(($category->total / max(1, $totalAssets)) * 100, 1) }}%)</span>
                            </div>
                        </div>
                        <div style="background: var(--bg-tertiary); height: 8px; border-radius: 999px; overflow: hidden;">
                            <div style="background: linear-gradient(90deg, var(--primary), var(--secondary)); height: 100%; width: {{ ($category->total / max(1, $totalAssets)) * 100 }}%; border-radius: 999px; transition: width 1.2s cubic-bezier(0.4, 0, 0.2, 1);"></div>
                        </div>
                    </div>
                    @empty
                    <div style="text-align: center; padding: 3rem; color: var(--text-muted);">Belum ada kategori</div>
                    @endforelse
                </div>
            </div>


            <!-- Recent Assets - Card Grid -->
            <div style="background: white; padding: 1.75rem; border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem; margin: 0;">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20" style="color: var(--primary);">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        Aset Terbaru
                    </h3>
                    @if($recentAssets->count() > 0)
                    <a href="{{ route('assets.index') }}" style="font-size: 0.8125rem; color: var(--primary); text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.25rem;">
                        Lihat Semua
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                    @endif
                </div>
                
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                    @forelse($recentAssets as $index => $asset)
                    <div style="border: 1.5px solid var(--border-light); border-radius: var(--radius-lg); padding: 1rem; display: flex; gap: 1rem; transition: all 0.3s; animation: fadeInUp {{ $index * 0.1 + 0.2 }}s ease-out;" onmouseover="this.style.borderColor='var(--primary)'; this.style.boxShadow='var(--shadow-md)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='var(--border-light)'; this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                        @if($asset->image_path)
                            <img src="{{ asset('storage/'.$asset->image_path) }}" alt="{{ $asset->nama_aset }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: var(--radius-md); flex-shrink: 0; border: 2px solid var(--border);">
                        @else
                            <div style="width: 60px; height: 60px; background: var(--bg-tertiary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid var(--border);">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20" style="color: var(--text-muted);">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        @endif
                        <div style="flex: 1; min-width: 0;">
                            <div style="font-weight: 600; font-size: 0.875rem; color: var(--text-primary); margin-bottom: 0.25rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $asset->nama_aset }}</div>
                            <div style="font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0.375rem;">
                                <span style="background: var(--bg-tertiary); padding: 0.125rem 0.5rem; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.6875rem;">{{ $asset->kode_aset }}</span>
                            </div>
                            <div style="font-size: 0.6875rem; color: var(--text-muted);">{{ $asset->created_at->diffForHumans() }}</div>
                        </div>
                        <a href="{{ route('assets.show', $asset->id) }}" style="align-self: flex-start; background: var(--primary); color: white; padding: 0.5rem; border-radius: var(--radius-md); display: flex; transition: all 0.3s;">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                    @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: var(--text-muted);">Belum ada aset terbaru</div>
                    @endforelse
                </div>
            </div>

            <!-- Panel: Laporan Kerusakan Terbaru dari Operator -->
            <div style="background: white; padding: 1.75rem; border-radius: var(--radius-lg); box-shadow: var(--shadow-md); border-left: 4px solid #ef4444;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem; margin: 0;">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20" style="color: #ef4444;">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        Laporan Kerusakan Terbaru
                    </h3>
                    <a href="{{ route('admin.laporan-kerusakan') }}" style="font-size: 0.8125rem; color: #ef4444; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.25rem;">
                        Lihat Semua
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                    </a>
                </div>

                @forelse($laporanKerusakan as $check)
                <div style="display: flex; gap: 1rem; padding: 1rem; border-radius: var(--radius-md); border: 1px solid var(--border-light); margin-bottom: 0.75rem; transition: all 0.2s;" onmouseover="this.style.background='var(--bg-primary)'; this.style.borderColor='#fca5a5'" onmouseout="this.style.background='white'; this.style.borderColor='var(--border-light)'">
                    <!-- Kondisi badge -->
                    <div style="flex-shrink:0; display:flex; align-items:flex-start; padding-top:0.15rem;">
                        @if($check->kondisi === 'Rusak Berat')
                            <span style="display:inline-block; width:10px; height:10px; border-radius:50%; background:#ef4444; margin-top:0.25rem; box-shadow: 0 0 0 3px rgba(239,68,68,0.2);"></span>
                        @else
                            <span style="display:inline-block; width:10px; height:10px; border-radius:50%; background:#f59e0b; margin-top:0.25rem; box-shadow: 0 0 0 3px rgba(245,158,11,0.2);"></span>
                        @endif
                    </div>
                    <div style="flex: 1; min-width: 0;">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.25rem; gap:0.5rem; flex-wrap:wrap;">
                            <a href="{{ route('assets.show', $check->asset_id) }}" style="font-weight: 700; color: var(--text-primary); text-decoration: none; font-size: 0.9375rem;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-primary)'">
                                {{ $check->asset->nama_aset ?? '-' }}
                                <span style="font-size:0.75rem; color:var(--text-muted); font-weight:500;">({{ $check->asset->kode_aset ?? '-' }})</span>
                            </a>
                            <span style="font-size: 0.75rem; font-weight: 700; padding: 0.2rem 0.6rem; border-radius: 9999px; flex-shrink:0;
                                {{ $check->kondisi === 'Rusak Berat' ? 'background:#fee2e2; color:#991b1b; border:1px solid #fca5a5;' : 'background:#fef3c7; color:#92400e; border:1px solid #fcd34d;' }}">
                                {{ $check->kondisi }}
                            </span>
                        </div>
                        <div style="font-size: 0.8125rem; color: var(--text-secondary); display:flex; align-items:center; gap:0.5rem; flex-wrap:wrap;">
                            <span style="display:flex; align-items:center; gap:0.25rem;">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                                {{ $check->user->name ?? 'Operator' }}
                            </span>
                            <span style="color:var(--text-muted);">•</span>
                            <span>{{ $check->created_at->diffForHumans() }}</span>
                        </div>
                        @if($check->catatan)
                        <p style="font-size: 0.8125rem; color: var(--text-muted); margin: 0.4rem 0 0; background: var(--bg-tertiary); padding: 0.4rem 0.6rem; border-radius: var(--radius-sm); border-left: 2px solid var(--warning);">
                            "{{ \Illuminate\Support\Str::limit($check->catatan, 100) }}"
                        </p>
                        @endif
                    </div>
                </div>
                @empty
                <div style="text-align: center; padding: 2rem; color: var(--text-muted);">
                    <svg width="40" height="40" fill="currentColor" viewBox="0 0 20 20" style="margin: 0 auto 0.75rem; opacity:0.3; display:block;"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <div style="font-size: 0.9375rem; font-weight: 500;">Tidak ada laporan kerusakan</div>
                </div>
                @endforelse
            </div>

            <!-- Quick Actions - Horizontal Cards -->
            <div style="background: white; padding: 1.75rem; border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-primary); display: flex; align-items: center; gap: 0.5rem; margin: 0 0 1.5rem 0;">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20" style="color: var(--primary);">
                        <path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.476.859h4.002z"/>
                    </svg>
                    Aksi Cepat
                </h3>
                
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                    <a href="{{ route('assets.create') }}" style="text-decoration: none; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; padding: 1.25rem; border-radius: var(--radius-lg); display: flex; align-items: center; gap: 1rem; transition: all 0.3s; box-shadow: var(--shadow-sm);" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='var(--shadow-lg)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-sm)'">
                        <div style="background: rgba(255,255,255,0.2); width: 48px; height: 48px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size: 1rem; font-weight: 700; margin-bottom: 0.125rem;">Tambah Aset</div>
                            <div style="font-size: 0.75rem; opacity: 0.9;">Daftarkan aset baru</div>
                        </div>
                    </a>

                    <a href="{{ route('scan') }}" style="text-decoration: none; background: linear-gradient(135deg, #f97316, #ea580c); color: white; padding: 1.25rem; border-radius: var(--radius-lg); display: flex; align-items: center; gap: 1rem; transition: all 0.3s; box-shadow: var(--shadow-sm);" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='var(--shadow-lg)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-sm)'">
                        <div style="background: rgba(255,255,255,0.2); width: 48px; height: 48px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm2 2V5h1v1H5zM3 13a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1v-3zm2 2v-1h1v1H5zM13 3a1 1 0 00-1 1v3a1 1 0 001 1h3a1 1 0 001-1V4a1 1 0 00-1-1h-3zm1 2v1h1V5h-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size: 1rem; font-weight: 700; margin-bottom: 0.125rem;">Scan QR</div>
                            <div style="font-size: 0.75rem; opacity: 0.9;">Scan kode QR aset</div>
                        </div>
                    </a>

                    <a href="{{ route('assets.index') }}" style="text-decoration: none; background: linear-gradient(135deg, #14b8a6, #0d9488); color: white; padding: 1.25rem; border-radius: var(--radius-lg); display: flex; align-items: center; gap: 1rem; transition: all 0.3s; box-shadow: var(--shadow-sm);" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='var(--shadow-lg)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-sm)'">
                        <div style="background: rgba(255,255,255,0.2); width: 48px; height: 48px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size: 1rem; font-weight: 700; margin-bottom: 0.125rem;">Daftar Aset</div>
                            <div style="font-size: 0.75rem; opacity: 0.9;">Lihat semua aset</div>
                        </div>
                    </a>

                    <a href="{{ route('rooms.index') }}" style="text-decoration: none; background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; padding: 1.25rem; border-radius: var(--radius-lg); display: flex; align-items: center; gap: 1rem; transition: all 0.3s; box-shadow: var(--shadow-sm);" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='var(--shadow-lg)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-sm)'">
                        <div style="background: rgba(255,255,255,0.2); width: 48px; height: 48px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size: 1rem; font-weight: 700; margin-bottom: 0.125rem;">Kelola Ruangan</div>
                            <div style="font-size: 0.75rem; opacity: 0.9;">Manajemen ruangan</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    /* Responsive adjustments */
    @media (max-width: 1200px) {
        div[style*="grid-template-columns: 280px 1fr"] {
            grid-template-columns: 1fr !important;
        }
        
        div[style*="grid-template-columns: repeat(2, 1fr)"] {
            grid-template-columns: 1fr !important;
        }
    }
    
    @media (max-width: 768px) {
        div[style*="grid-template-columns: 1fr auto"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>

@endsection
