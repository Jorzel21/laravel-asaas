<?php

namespace Asaas\Console\Commands;

use Illuminate\Console\Command;

class PublishAsaasCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asaas:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the Asaas package configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Publishing Asaas configuration...');
        
        $this->call('vendor:publish', [
            '--provider' => 'Asaas\\AsaasServiceProvider',
            '--tag' => 'config',
            '--force' => $this->option('force'),
        ]);

        $this->info('Asaas configuration published successfully!');
    }
} 