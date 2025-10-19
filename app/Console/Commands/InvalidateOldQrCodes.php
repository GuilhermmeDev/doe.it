<?php

namespace App\Console\Commands;

use App\Models\Donation;
use Carbon\Carbon;
use Illuminate\Console\Command;

class InvalidateOldQrCodes extends Command
{
    protected $signature = 'donations:invalidate';

    protected $description = 'Atualiza o status das doações não confirmadas para "invalid" após 2 horas';

    public function handle()
    {
        Donation::where('created_at', '<=', Carbon::now()->subHours(2))
            ->where('Status', '!=', 'invalid')
            ->update(['Status' => 'invalid']);

        $this->info('Doações atualizadas para "invalid" com sucesso.');
    }
}
