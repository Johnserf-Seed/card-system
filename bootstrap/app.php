<?php
$sp6d2550 = new Illuminate\Foundation\Application(realpath(__DIR__ . '/../')); $sp6d2550->singleton(Illuminate\Contracts\Http\Kernel::class, App\Http\Kernel::class); $sp6d2550->singleton(Illuminate\Contracts\Console\Kernel::class, App\Console\Kernel::class); $sp6d2550->singleton(Illuminate\Contracts\Debug\ExceptionHandler::class, App\Exceptions\Handler::class); return $sp6d2550;