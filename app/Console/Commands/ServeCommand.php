<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\ServeCommand as BaseServeCommand;
use Symfony\Component\Process\Process;

class ServeCommand extends BaseServeCommand
{
    /**
     * Herd on Windows can fail to boot the child server process when Laravel
     * strips most environment variables for auto-reload support.
     */
    protected function startProcess($hasEnvironment)
    {
        $process = new Process(
            $this->serverCommand(),
            public_path(),
            array_merge($_ENV, ['PHP_CLI_SERVER_WORKERS' => $this->phpServerWorkers])
        );

        $this->trap(fn () => [SIGTERM, SIGINT, SIGHUP, SIGUSR1, SIGUSR2, SIGQUIT], function ($signal) use ($process) {
            if ($process->isRunning()) {
                $process->stop(10, $signal);
            }

            exit;
        });

        $process->start($this->handleProcessOutput());

        return $process;
    }
}
