<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Bus;
use App\Models\Siege;
use Illuminate\Support\Facades\DB;

class GenerateSieges extends Command
{
    protected $signature = 'sieges:generate
                            {--all : Générer pour tous les buses}
                            {--bus= : ID spécifique d\'un bus}
                            {--force : Regénérer les sièges existants}';

    protected $description = 'Génère automatiquement les sièges selon nombre_place de chaque bus';

    public function handle()
    {
        if ($this->option('all')) {
            $buses = Bus::all();
            $this->info("Début de génération pour {$buses->count()} buses...");
        } elseif ($busId = $this->option('bus')) {
            $buses = Bus::where('id', $busId)->get();
        } else {
            $this->error("Spécifiez --all ou --bus=ID");
            return 1;
        }

        foreach ($buses as $bus) {
            $this->processBus($bus);
        }

        $this->info("✅ Génération terminée !");
        return 0;
    }

    protected function processBus(Bus $bus)
    {
        $places = $bus->nombre_place;

        if ($places < 2) {
            $this->error("Bus #{$bus->id} : Nombre de places invalide (min 2)");
            return;
        }

        if ($bus->sieges()->count() === ($places - 1) && !$this->option('force')) {
            $this->line("Bus #{$bus->id} : Déjà {$places} sièges - skip");
            return;
        }

        DB::transaction(function () use ($bus, $places) {
            Siege::where('bus_id', $bus->id)->delete();

            $sieges = array_map(function ($num) use ($bus) {
                return [
                    'bus_id' => $bus->id,
                    'numero' => $num,
                    'disponible' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }, range(2, $places)); // Sièges de 2 à nombre_place

            Siege::insert($sieges);
        });

        $this->info("Bus #{$bus->id} ({$bus->immatriculation}) : {$places} places → " . ($places-1) . " sièges générés");
    }
}