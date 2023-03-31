<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class ApiTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute Api Test';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $process = new Process(['php', 'artisan', 'test', '--testsuite=api']);
        $process->setTty(Process::isTtySupported());
        $process->run(function ($type, $buffer) {
            $this->output->write($buffer);
        });

        return $process->getExitCode();
    }
}
