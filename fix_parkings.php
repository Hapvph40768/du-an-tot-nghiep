<?php
$vehicles = \App\Models\Vehicle::all();
$parkings = \App\Models\Parking::all();

\Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
\App\Models\ParkingHistory::truncate();
\App\Models\ParkingSlot::truncate();
\Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

$vIndex = 0;
$statuses = ['available', 'occupied', 'reserved'];

foreach($parkings as $parking) {
    for($r=1; $r<=3; $r++) {
        for($c=1; $c<=5; $c++) {
            $vehicleId = null;
            $status = $statuses[array_rand($statuses)];
            
            if ($r == 2 && $c == 3 && isset($vehicles[$vIndex])) {
                $vehicleId = $vehicles[$vIndex]->id;
                $status = 'occupied';
                $vIndex++;
            }
            
            $slot = \App\Models\ParkingSlot::create([
                'parking_id' => $parking->id,
                'vehicle_id' => $vehicleId,
                'slot_code' => 'P' . $parking->id . '-A' . $r . '0' . $c,
                'row' => $r,
                'column' => $c,
                'zone' => 'A',
                'slot_type' => 'bus',
                'status' => $status
            ]);
            
            if ($vehicleId) {
                \App\Models\ParkingHistory::create([
                    'slot_id' => $slot->id,
                    'vehicle_id' => $vehicleId,
                    'check_in_time' => now()->subHours(rand(1, 10)),
                ]);
            }
        }
    }
}
echo "Done fixing parkings.\n";
exit();
