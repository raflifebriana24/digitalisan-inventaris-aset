<?php
$file = __DIR__ . '/resources/views/layout.blade.php';
$content = file_get_contents($file);

// 1. Fix body background
$content = str_replace('<body class="bg-gray-50 text-gray-800" x-data="{ sidebarOpen: false }">', '<body class="text-gray-800" x-data="{ sidebarOpen: false }">', $content);

// 2. Fix main background
$content = str_replace('<main class="flex-1 overflow-y-auto bg-gray-50 p-4 sm:p-6 lg:p-8">', '<main class="flex-1 overflow-y-auto bg-transparent p-4 sm:p-6 lg:p-8">', $content);

// 3. Fix Aside
$oldAside = 'class="fixed z-20 inset-y-0 left-0 w-64 transition duration-300 transform bg-white border-r border-gray-200 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0 flex flex-col"';
$newAside = 'class="fixed z-20 inset-y-0 left-0 w-64 transition duration-300 transform bg-[#1e3a8a] border-r border-[#1e40af] shadow-2xl overflow-y-auto lg:translate-x-0 lg:static lg:inset-0 flex flex-col"';
$content = str_replace($oldAside, $newAside, $content);

// 4. Fix Logo Area
$oldLogoArea = '<div class="flex items-center justify-center mt-6 mb-2">
                <div class="flex items-center">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    <span class="text-gray-800 text-lg font-bold ml-2">Manajemen Aset</span>
                </div>
            </div>';
$newLogoArea = '<div class="flex items-center justify-center py-6 bg-[#1e40af] shadow-md mb-2">
                <div class="flex items-center">
                    <svg class="w-8 h-8 text-[#f97316]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    <span class="text-white text-xl font-bold ml-2 tracking-wide">Manajemen Aset</span>
                </div>
            </div>';
$content = str_replace($oldLogoArea, $newLogoArea, $content);

// 5. Fix link colors globally inside the sidebar nav.
$replacements = [
    "'bg-blue-50 text-blue-700'" => "'bg-[#f97316] text-white shadow-md'",
    "'text-gray-600 hover:bg-gray-50 hover:text-gray-900'" => "'text-blue-100 hover:bg-[#1e40af] hover:text-white transition-colors duration-200'",
    "'text-blue-700'" => "'text-white'",
    "'text-gray-400 group-hover:text-gray-500'" => "'text-blue-300 group-hover:text-white transition-colors duration-200'",
    "'bg-gray-100 text-gray-900'" => "'bg-[#1e40af] text-white'", 
    "border-t border-gray-200" => "border-t border-[#1e40af]",
    "text-gray-600 hover:bg-gray-50 hover:text-gray-900" => "text-blue-100 hover:bg-[#1e40af] hover:text-white transition-colors duration-200",
    "text-gray-400 group-hover:text-gray-500" => "text-blue-300 group-hover:text-white transition-colors duration-200",
    "text-red-600 hover:bg-red-50" => "text-[#f97316] hover:bg-[#1e40af] hover:text-white transition-colors duration-200", 
    "text-red-400 group-hover:text-red-500" => "text-[#f97316] group-hover:text-white transition-colors duration-200", 
];

foreach ($replacements as $old => $new) {
    $content = str_replace($old, $new, $content);
}

file_put_contents($file, $content);
echo "Sidebar styling updated.\n";
?>
