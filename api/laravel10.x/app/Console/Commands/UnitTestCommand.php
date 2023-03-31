<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class UnitTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unit-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute unit test';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $process = new Process(['php', 'artisan', 'test', '--testsuite=unit']);
        $process->setTty(Process::isTtySupported());
        $process->run(function ($type, $buffer) {
            $this->output->write($buffer);
        });

        return $process->getExitCode();
    }
}
