@props([
    'sidebar' => false,
])

<div {{ $attributes->merge(['class' => 'flex items-center gap-1']) }}>
    <div class="shrink-0">
        <img src="/images/logo.png" alt="Logo Koperasi" class="w-10 h-10 rounded-lg object-contain">
    </div>

    <div class="flex flex-col justify-center border-l border-gray-200 dark:border-gray-700 pl-3">
        <span class="text-[17px] font-extrabold text-[#0f2a27] dark:text-white leading-[1.1] tracking-tight">
            KOPERASI
        </span>
        <span class="text-[10px] font-bold text-[#994c2e] uppercase tracking-[0.15em] leading-tight mt-0.5">
            SEHAT MULIA
        </span>
    </div>
</div>
