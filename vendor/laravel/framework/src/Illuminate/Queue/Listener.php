<?php
 namespace Illuminate\Queue; use Closure; use Illuminate\Support\ProcessUtils; use Symfony\Component\Process\Process; use Symfony\Component\Process\PhpExecutableFinder; class Listener { protected $commandPath; protected $environment; protected $sleep = 3; protected $maxTries = 0; protected $workerCommand; protected $outputHandler; public function __construct($commandPath) { $this->commandPath = $commandPath; $this->workerCommand = $this->buildCommandTemplate(); } protected function buildCommandTemplate() { $command = 'queue:work %s --once --queue=%s --delay=%s --memory=%s --sleep=%s --tries=%s'; return "{$this->phpBinary()} {$this->artisanBinary()} {$command}"; } protected function phpBinary() { return ProcessUtils::escapeArgument( (new PhpExecutableFinder)->find(false) ); } protected function artisanBinary() { return defined('ARTISAN_BINARY') ? ProcessUtils::escapeArgument(ARTISAN_BINARY) : 'artisan'; } public function listen($connection, $queue, ListenerOptions $options) { $process = $this->makeProcess($connection, $queue, $options); while (true) { $this->runProcess($process, $options->memory); } } public function makeProcess($connection, $queue, ListenerOptions $options) { $command = $this->workerCommand; if (isset($options->environment)) { $command = $this->addEnvironment($command, $options); } $command = $this->formatCommand( $command, $connection, $queue, $options ); return new Process( $command, $this->commandPath, null, null, $options->timeout ); } protected function addEnvironment($command, ListenerOptions $options) { return $command.' --env='.ProcessUtils::escapeArgument($options->environment); } protected function formatCommand($command, $connection, $queue, ListenerOptions $options) { return sprintf( $command, ProcessUtils::escapeArgument($connection), ProcessUtils::escapeArgument($queue), $options->delay, $options->memory, $options->sleep, $options->maxTries ); } public function runProcess(Process $process, $memory) { $process->run(function ($type, $line) { $this->handleWorkerOutput($type, $line); }); if ($this->memoryExceeded($memory)) { $this->stop(); } } protected function handleWorkerOutput($type, $line) { if (isset($this->outputHandler)) { call_user_func($this->outputHandler, $type, $line); } } public function memoryExceeded($memoryLimit) { return (memory_get_usage(true) / 1024 / 1024) >= $memoryLimit; } public function stop() { die; } public function setOutputHandler(Closure $outputHandler) { $this->outputHandler = $outputHandler; } } 