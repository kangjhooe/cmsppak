<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Agenda;
use Carbon\Carbon;

class UpdateAgendaStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agenda:update-status {--dry-run : Tampilkan perubahan tanpa menyimpan}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status agenda secara otomatis berdasarkan waktu saat ini';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $isDryRun = $this->option('dry-run');
        
        $this->info('Memulai update status agenda...');
        
        // Ambil semua agenda yang bukan cancelled
        $agendas = Agenda::where('status', '!=', 'cancelled')->get();
        
        $updatedCount = 0;
        $upcomingCount = 0;
        $ongoingCount = 0;
        $completedCount = 0;
        
        foreach ($agendas as $agenda) {
            $oldStatus = $agenda->status;
            $newStatus = $agenda->calculateAutoStatus();
            
            if ($oldStatus !== $newStatus) {
                $updatedCount++;
                
                if ($isDryRun) {
                    $this->line("ID {$agenda->id}: '{$agenda->judul}' - {$oldStatus} → {$newStatus}");
                } else {
                    $agenda->update(['status' => $newStatus]);
                    $this->line("✓ Updated ID {$agenda->id}: '{$agenda->judul}' - {$oldStatus} → {$newStatus}");
                }
            }
            
            // Hitung status final
            switch ($newStatus) {
                case 'upcoming':
                    $upcomingCount++;
                    break;
                case 'ongoing':
                    $ongoingCount++;
                    break;
                case 'completed':
                    $completedCount++;
                    break;
            }
        }
        
        $this->newLine();
        $this->info("=== RINGKASAN UPDATE STATUS AGENDA ===");
        $this->info("Total agenda diproses: " . $agendas->count());
        $this->info("Agenda yang diupdate: " . $updatedCount);
        $this->newLine();
        $this->info("=== DISTRIBUSI STATUS SAAT INI ===");
        $this->info("Upcoming: " . $upcomingCount);
        $this->info("Ongoing: " . $ongoingCount);
        $this->info("Completed: " . $completedCount);
        
        if ($isDryRun) {
            $this->newLine();
            $this->warn("Mode DRY RUN - Tidak ada perubahan yang disimpan");
            $this->info("Jalankan tanpa --dry-run untuk menyimpan perubahan");
        } else {
            $this->newLine();
            $this->info("✓ Update status agenda selesai!");
        }
        
        return Command::SUCCESS;
    }
}
