<?php

namespace App\Http\Controllers;

class partController extends Controller
{

    public function showCpu($slug)
    {

// Specification query
        $specs = \DB::table('cpu')->join('manufacturer', 'cpu.manufacturer_id', '=', 'manufacturer.id')->join('cpu_socket', 'cpu.id', '=', 'cpu_socket.cpu_id')->where('slug', $slug)->select(
            'manufacturer.name as brand',
            'cpu.name as name',
            \DB::raw('GROUP_CONCAT( cpu_socket.name SEPARATOR " / ") AS socket'),
            'cpu.part_number as part_number',
            'cpu.core_count as core_count',
            'cpu.thread_count as thread_count',
            'cpu.frequency as frequency',
            'cpu.max_frequency as max_frequency',
            'cpu.l1_cache as l1',
            'cpu.l2_cache as l2',
            'cpu.l3_cache as l3',
            'cpu.manufacturing_tech as tech',
            'cpu.thermal_power as thermal',
            'cpu.integrated_graphics as integrated_graphics',
            'cpu.hyper_threading as hyper',
            'cpu.cooling_device as cooling'
        )->first();

//price query
        $price = \DB::table('cpu')->where('slug', '=', $slug)->join('price', 'cpu.part_number', '=', 'price.part_number')->join('retailer', 'retailer.id', '=', 'price.retailer_id')->select('retailer.name as store', 'retailer.url as alt', 'retailer.delivery_url as delivery', 'price.url as url', 'price.in_stock as stock', 'price.price as price')->orderBy('price.price', 'asc')->get();

// //Parameters
        $specs->frequency = $specs->frequency . 'GHz';
        $specs->thermal = $specs->thermal . 'W';

// //Controls
        if (is_null($specs->thread_count)) {
            unset($specs->thread_count);
        }

        if (is_null($specs->max_frequency)) {
            unset($specs->max_frequency);
        } else {
            $specs->max_frequency = $specs->max_frequency . 'GHz';
        }

        if (is_null($specs->tech)) {
            $specs->tech = '-';
        } else {
            $specs->tech = $specs->tech . 'nm';
        }

        if ($specs->hyper == true) {
            $specs->hyper = 'Ir';
        } else {
            $specs->hyper = 'Nav';
        }

        if ($specs->cooling == true) {
            $specs->cooling = 'Ir';
        } else {
            $specs->cooling = 'Nav';
        }
        if (is_null($specs->l1)) {
            $specs->l1 = '-';
        }
        if (is_null($specs->l2)) {
            $specs->l2 = '-';
        }

        if (is_null($specs->l3)) {
            $specs->l3 = '-';
        }

        if (is_null($specs->integrated_graphics)) {
            $specs->integrated_graphics = 'Nav';
        }

        $data = [
            'title' => $specs->brand . ' ' . $specs->name . ' ' . $specs->frequency . ' ' . $specs->core_count . '-kodolu procesors',
            'specs' => $specs,
            'prices' => $price,
            'slug' => $slug,
            'session_name' => 'cpu',

        ];

        return view('part', $data);

    }

    public function showMemory($slug)
    {

// memory query
        $specs = \DB::table('memory')->join('manufacturer', 'memory.manufacturer_id', '=', 'manufacturer.id')->where('slug', $slug)->select(
            'manufacturer.name as brand',
            'memory.part_number as part_number',
            'memory.type as type',
            'memory.data_rate',
            'memory.speed as speed',
            'memory.capacity as capacity',
            'memory.slots as slots',
            'memory.capacity_per_slot as capacity_per_slot',
            'memory.timing as timing',
            'memory.latency as latency',
            'memory.voltage as voltage',
            'memory.ecc as ecc',
            'memory.buffered as buffer',
            'memory.spreader as spreader'
        )->first();

//price query
        $price = \DB::table('memory')->where('slug', '=', $slug)->join('price', 'memory.part_number', '=', 'price.part_number')->join('retailer', 'retailer.id', '=', 'price.retailer_id')->select('retailer.name as store', 'retailer.url as alt', 'retailer.delivery_url as delivery', 'price.url as url', 'price.in_stock as stock', 'price.price as price')->orderBy('price.price', 'asc')->get();

//output styling
        if ($specs->capacity >= 1000) {
            $specs->capacity = $specs->capacity / 1000 . 'GB';
        } else {
            $specs->capacity = $specs->capacity . 'MB';
        }
        if ($specs->capacity_per_slot >= 1000) {
            $specs->capacity_per_slot = $specs->capacity_per_slot / 1000 . 'GB';
        } else {
            $specs->capacity_per_slot = $specs->capacity_per_slot . 'MB';
        }

        $specs->capacity = $specs->capacity . ' (' . $specs->slots . ' x ' . $specs->capacity_per_slot .
            ')';

        unset($specs->capacity_per_slot);
        unset($specs->slots);

        $specs->type = $specs->type . ' DIMM';
        $specs->voltage = $specs->voltage . 'V';

        $specs->speed = $specs->data_rate . ' - ' . $specs->speed;
        unset($specs->data_rate);

//controls
        if (is_null($specs->timing)) {
            unset($specs->timing);
        }

        if ($specs->ecc == true) {
            $specs->ecc = 'Ir';
        } else {
            $specs->ecc = 'Nav';
        }
        if ($specs->buffer == true) {
            $specs->buffer = 'Ir';
        } else {
            $specs->buffer = 'Nav';
        }
        if ($specs->spreader == true) {
            $specs->spreader = 'Ir';
        } else {
            $specs->spreader = 'Nav';
        }

        $data = [
            'title' => $specs->brand . ' ' . $specs->part_number . ' ' . $specs->capacity . ' ' . $specs->speed . ' - operatīvā atmiņa',
            'specs' => $specs,
            'prices' => $price,
            'slug' => $slug,
            'session_name' => 'memory',

        ];

        return view('part', $data);

    }

    public function showCpuCooler($slug)
    {

        $specs = \DB::table('cpu_cooler')->join('manufacturer', 'cpu_cooler.manufacturer_id', '=', 'manufacturer.id')->join('cpu_cooler_socket', 'cpu_cooler.id', '=', 'cpu_cooler_socket.cpu_cooler_id')->where('slug', $slug)->select(
            'manufacturer.name as brand',
            'cpu_cooler.part_number as part_number',
            \DB::raw('GROUP_CONCAT( cpu_cooler_socket.name SEPARATOR " / ") AS socket'),
            'cpu_cooler.bearing',
            'cpu_cooler.rpm_from',
            'cpu_cooler.rpm_to',
            'cpu_cooler.air_from',
            'cpu_cooler.air_to',
            'cpu_cooler.noise_from',
            'cpu_cooler.noise_to',
            'cpu_cooler.height',
            'cpu_cooler.thermal_power as thermal'
        )->first();

//RPM
        if (is_null($specs->rpm_from) && is_null($specs->rpm_to)) {
            unset($specs->rpm_from);
            unset($specs->rpm_to);
        } else if (!is_null($specs->rpm_from) && is_null($specs->rpm_to)) {
            unset($specs->rpm_to);
            $specs->rpm_from = $specs->rpm_from . ' RPM';

        } else if (is_null($specs->rpm_from) && !is_null($specs->rpm_to)) {
            $specs->rpm_from = $specs->rpm_to;
            unset($specs->rpm_to);
            $specs->rpm_from = $specs->rpm_from . ' RPM';

        } else {
            $specs->rpm_from = $specs->rpm_from . ' - ' . $specs->rpm_to;
            unset($specs->rpm_to);
            $specs->rpm_from = $specs->rpm_from . ' RPM';

        }

//AIR
        if (is_null($specs->air_from) && is_null($specs->air_to)) {
            unset($specs->air_from);
            unset($specs->air_to);

        } else if (!is_null($specs->air_from) && is_null($specs->air_to)) {

            unset($specs->air_to);
            $specs->air_from = $specs->air_from . ' CFM';

        } else if (is_null($specs->air_from) && !is_null($specs->air_to)) {

            $specs->air_from = $specs->air_to;
            unset($specs->air_to);
            $specs->air_from = $specs->air_from . ' CFM';

        } else {
            $specs->air_from = $specs->air_from . ' - ' . $specs->air_to;
            unset($specs->air_to);
            $specs->air_from = $specs->air_from . ' CFM';
        }

//NOISE
        if (is_null($specs->noise_from) && is_null($specs->noise_to)) {
            unset($specs->noise_from);
            unset($specs->noise_to);

        } else if (!is_null($specs->noise_from) && is_null($specs->noise_to)) {
            unset($specs->noise_to);
            $specs->noise_from = $specs->noise_from . ' dbA';

        } else if (is_null($specs->noise_from) && !is_null($specs->noise_to)) {
            $specs->noise_from = $specs->noise_to;
            unset($specs->noise_to);
            $specs->noise_from = $specs->noise_from . ' dbA';
        } else {
            $specs->noise_from = $specs->noise_from . ' - ' . $specs->noise_to;
            unset($specs->noise_to);
            $specs->noise_from = $specs->noise_from . ' dbA';
        }

        $specs->thermal = $specs->thermal . 'W';
        $specs->height = $specs->height . 'mm';

//price query
        $price = \DB::table('cpu_cooler')->where('slug', '=', $slug)->join('price', 'cpu_cooler.part_number', '=', 'price.part_number')->join('retailer', 'retailer.id', '=', 'price.retailer_id')->select('retailer.name as store', 'retailer.url as alt', 'retailer.delivery_url as delivery', 'price.url as url', 'price.in_stock as stock', 'price.price as price')->orderBy('price.price', 'asc')->get();

        $data = [
            'title' => $specs->brand . ' ' . $specs->part_number . ' ' . $specs->height . ' ' . ' - procesora dzesētājs',
            'specs' => $specs,
            'prices' => $price,
            'slug' => $slug,
            'session_name' => 'cpu_cooler',

        ];

        return view('part', $data);

    }

    public function showStorage($slug)
    {

        $specs = \DB::table('storage')->join('manufacturer', 'storage.manufacturer_id', '=', 'manufacturer.id')->where('slug', $slug)->select(
            'manufacturer.name as brand',
            'storage.part_number',
            'storage.type as type',
            'storage.capacity',
            'storage.interface',
            'storage.cache',
            'storage.form_factor'
        )->first();

        $price = \DB::table('storage')->where('slug', '=', $slug)->join('price', 'storage.part_number', '=', 'price.part_number')->join('retailer', 'retailer.id', '=', 'price.retailer_id')->select('retailer.name as store', 'retailer.url as alt', 'retailer.delivery_url as delivery', 'price.url as url', 'price.in_stock as stock', 'price.price as price')->orderBy('price.price', 'asc')->get();

        if (is_null($specs->cache)) {
            unset($specs->cache);
        } else {
            $specs->cache = $specs->cache . 'MB';
        }

        if ($specs->capacity >= 1000) {
            $specs->capacity = $specs->capacity / 1000 . 'TB';

        } else {
            $specs->capacity = $specs->capacity . 'GB';
        }
        $data = [
            'title' => $specs->brand . ' ' . $specs->part_number . ' ' . $specs->capacity . ' ' . $specs->type . ' - cietais disks',
            'specs' => $specs,
            'prices' => $price,
            'slug' => $slug,
            'session_name' => 'storage',

        ];

        return view('part', $data);

    }

    public function showSoundCard($slug)
    {

        $specs = \DB::table('sound_card')->join('manufacturer', 'sound_card.manufacturer_id', '=', 'manufacturer.id')->select(
            'manufacturer.name as brand',
            'sound_card.part_number as part_number',
            'sound_card.series as series',
            'sound_card.channel as channel',
            'sound_card.chipset as chipset',
            'sound_card.interface as interface',
            'sound_card.digital_audio as digital_audio',
            'sound_card.snr as snr',
            'sound_card.sample_rate as sample_rate'
        )->where('sound_card.slug', '=', $slug)->first();

        if (is_null($specs->chipset)) {
            unset($specs->chipset);
        }
        if (is_null($specs->series)) {
            unset($specs->series);
        }

        if (is_null($specs->snr)) {
            unset($specs->snr);
        } else {
            $specs->snr = 'Līdz ' . $specs->snr . ' dB';
        }

        if (is_null($specs->digital_audio)) {
            unset($specs->digital_audio);
        } else {
            $specs->digital_audio = $specs->digital_audio . '-bit';
        }

        if (is_null($specs->sample_rate)) {
            unset($specs->sample_rate);
        } else {
            $specs->sample_rate = $specs->sample_rate . 'KHz';
        }
//price query
        $price = \DB::table('sound_card')->where('slug', '=', $slug)->join('price', 'sound_card.part_number', '=', 'price.part_number')->join('retailer', 'retailer.id', '=', 'price.retailer_id')->select('retailer.name as store',
            'retailer.url as alt',
            'retailer.delivery_url as delivery',
            'price.url as url',
            'price.in_stock as stock', 'price.price as price')->orderBy('price.price', 'asc')->get();

        $data = [
            'title' => $specs->brand . ' ' . $specs->part_number . ' - skaņas karte',
            'specs' => $specs,
            'prices' => $price,
            'slug' => $slug,
            'session_name' => 'sound_card',

        ];

        return view('part', $data);

    }

    public function showWiredCard($slug)
    {

        $specs = \DB::table('wired_card')->join('manufacturer', 'wired_card.manufacturer_id', '=', 'manufacturer.id')->select(
            'manufacturer.name as brand',
            'wired_card.part_number as part_number',
            'wired_card.interface as interface',
            'wired_card.connector as connector',
            'wired_card.speed as speed'

        )->where('wired_card.slug', '=', $slug)->first();

//price query
        $price = \DB::table('wired_card')->where('slug', '=', $slug)->join('price', 'wired_card.part_number', '=', 'price.part_number')->join('retailer', 'retailer.id', '=', 'price.retailer_id')->select('retailer.name as store',
            'retailer.url as alt',
            'retailer.delivery_url as delivery',
            'price.url as url',
            'price.in_stock as stock', 'price.price as price')->orderBy('price.price', 'asc')->get();

        $data = [
            'title' => $specs->brand . ' ' . $specs->part_number . ' ' . $specs->speed . ' - Tīkla karte',

            'specs' => $specs,
            'prices' => $price,
            'slug' => $slug,
            'session_name' => 'wired_card',

        ];

        return view('part', $data);

    }

    public function showWirelessCard($slug)
    {

        $specs = \DB::table('wireless_card')->join('manufacturer', 'wireless_card.manufacturer_id', '=', 'manufacturer.id')->select(
            'manufacturer.name as brand',
            'wireless_card.part_number as part_number',
            'wireless_card.interface as interface',
            'wireless_card.protocol as protocol',
            'wireless_card.security as security'

        )->where('wireless_card.slug', '=', $slug)->first();

//price query
        $price = \DB::table('wireless_card')->where('slug', '=', $slug)->join('price', 'wireless_card.part_number', '=', 'price.part_number')->join('retailer', 'retailer.id', '=', 'price.retailer_id')->select('retailer.name as store',
            'retailer.url as alt',
            'retailer.delivery_url as delivery',
            'price.url as url',
            'price.in_stock as stock', 'price.price as price')->orderBy('price.price', 'asc')->get();

        if (is_null($specs->security)) {
            unset($specs->security);
        }

        $data = [
            'title' => $specs->brand . ' ' . $specs->part_number . ' - Bezvadu tīkla karte',

            'specs' => $specs,
            'prices' => $price,
            'slug' => $slug,
            'session_name' => 'wireless_card',

        ];

        return view('part', $data);

    }

    public function showCase($slug)
    {

        $specs = \DB::table('case')->join('manufacturer', 'case.manufacturer_id', '=', 'manufacturer.id')->join('case_form_factor', 'case.id', '=', 'case_form_factor.case_id')
            ->select(
                'manufacturer.name as brand',
                'case.part_number as part_number',

                'case.type as type',

                \DB::raw('GROUP_CONCAT( case_form_factor.name SEPARATOR " / ") AS mobo_form_factor'),
                'case.side_panel_window as side_panel_window',
                'case.front_usb_panel as front_usb_panel',
                'case.external_525 as external_525',
                'case.external_35 as external_35',
                'case.internal_35 as internal_35',
                'case.internal_25 as internal_25',
                'case.expansion_slots as expansion_slots',
                'case.gpu_lenght as gpu_lenght'
            )->where('case.slug', '=', $slug)->first();

//price query
        $price = \DB::table('case')->where('slug', '=', $slug)->join('price', 'case.part_number', '=', 'price.part_number')->join('retailer', 'retailer.id', '=', 'price.retailer_id')->select('retailer.name as store',
            'retailer.url as alt',
            'retailer.delivery_url as delivery',
            'price.url as url',
            'price.in_stock as stock', 'price.price as price')->orderBy('price.price', 'asc')->get();

        $specs->gpu_lenght = $specs->gpu_lenght . 'mm';

        if ($specs->front_usb_panel == true) {
            $specs->front_usb_panel = 'Ir';
        } else {
            $specs->front_usb_panel = 'Nav';
        }

        if ($specs->side_panel_window == true) {
            $specs->side_panel_window = 'Ir';
        } else {
            $specs->side_panel_window = 'Nav';
        }

        if ($specs->external_525 == 0) {
            unset($specs->external_525);
        }
        if ($specs->external_35 == 0) {
            unset($specs->external_35);
        }
        if ($specs->internal_35 == 0) {
            unset($specs->internal_35);
        }
        if ($specs->internal_25 == 0) {
            unset($specs->internal_25);
        }

        $data = [
            'title' => $specs->brand . ' ' . $specs->part_number . ' ' . $specs->type . ' - Korpuss',

            'specs' => $specs,
            'prices' => $price,
            'slug' => $slug,
            'session_name' => 'case',

        ];

        return view('part', $data);

    }

    public function showMobo($slug)
    {

        $specs = \DB::table('motherboard')->join('manufacturer', 'motherboard.manufacturer_id', '=', 'manufacturer.id')->join('motherboard_socket', 'motherboard.id', '=', 'motherboard_socket.motherboard_id')
            ->select(
                'manufacturer.name as brand',
                'motherboard.part_number as part_number',
                'motherboard.form_factor as form_factor',
                'motherboard.chipset as chipset',
                'motherboard.memory_slots as memory_slots',
                'motherboard.pin_type as pin_type',
                'motherboard.max_capacity as max_capacity',
                'motherboard.data_rate as data_rate',
                'motherboard.onboard_usb as onboard_usb',
                'motherboard.sli as sli',
                'motherboard.crossfire as crossfire',
                'motherboard.pci as pci',

                \DB::raw('GROUP_CONCAT( motherboard_socket.name SEPARATOR " / ") AS socket'),
                'motherboard.pcix1 as pcix1',
                'motherboard.pcix4 as pcix4',
                'motherboard.pcix8 as pcix8',
                'motherboard.pcix16 as pcix16',
                'motherboard.sata3 as sata3',
                'motherboard.sata2 as sata2',
                'motherboard.sata as sata',
                'motherboard.esata as esata',
                'motherboard.sata_express as sata_express',
                'motherboard.m2 as m2',
                'motherboard.msata as msata',
                'motherboard.sata_raid as raid',
                'motherboard.max_lan as lan'
            )->where('slug', $slug)->first();

        if ($specs->m2 == 0) {
            unset($specs->m2);
        }

        if ($specs->msata == 0) {
            unset($specs->msata);
        }

        if ($specs->raid == true) {
            $specs->raid = 'Ir';
        } else {
            $specs->raid = 'Nav';
        }

        if ($specs->sata_express == 0) {
            unset($specs->sata_express);
        }

        if ($specs->esata == 0) {
            unset($specs->esata);
        }

        if ($specs->sata == 0) {
            unset($specs->sata);
        }

        if ($specs->sata2 == 0) {
            unset($specs->sata2);
        }

        if ($specs->sata3 == 0) {
            unset($specs->sata3);
        }

        if ($specs->pcix16 == 0) {
            unset($specs->pcix16);
        }

        if ($specs->pcix8 == 0) {
            unset($specs->pcix8);
        }

        if ($specs->pcix4 == 0) {
            unset($specs->pcix4);
        }

        if ($specs->pcix1 == 0) {
            unset($specs->pcix1);
        }

        if ($specs->pci == 0) {
            unset($specs->pci);
        }

        if ($specs->crossfire < 2) {
            $specs->crossfire = 'Nav';
        } else {
            $specs->crossfire = $specs->crossfire . '-Way Crossfire';
        }

        if ($specs->sli < 2) {
            $specs->sli = 'Nav';
        } else {
            $specs->sli = $specs->sli . '-Way SLI';
        }

        if ($specs->onboard_usb == true) {
            $specs->onboard_usb = 'Ir';
        } else {
            $specs->onboard_usb = 'Nav';
        }

        if ($specs->max_capacity >= 1000) {
            $specs->max_capacity = $specs->max_capacity / 1000 . 'GB';
        } else {
            $specs->max_capacity = $specs->max_capacity . 'MB';
        }

//price query
        $price = \DB::table('motherboard')->where('slug', '=', $slug)->join('price', 'motherboard.part_number', '=', 'price.part_number')->join('retailer', 'retailer.id', '=', 'price.retailer_id')->select('retailer.name as store',
            'retailer.url as alt',
            'retailer.delivery_url as delivery',
            'price.url as url',
            'price.in_stock as stock', 'price.price as price')->orderBy('price.price', 'asc')->get();

        $data = [
            'title' => $specs->brand . ' ' . $specs->part_number . ' ' . $specs->form_factor . ' ' . ' - mātesplate',

            'specs' => $specs,
            'prices' => $price,
            'slug' => $slug,
            'session_name' => 'motherboard',

        ];

        return view('part', $data);

    }

    public function showGpu($slug)
    {

        $specs = \DB::table('gpu')->join('manufacturer', 'gpu.manufacturer_id', '=', 'manufacturer.id')
            ->select(
                'manufacturer.name as brand',
                'gpu.part_number as part_number',
                'gpu.lenght as lenght',
                'gpu.expansion_slot as expansion_slots',
                'gpu.chipset as chipset',
                'gpu.memory_capacity as memory_capacity',
                'gpu.data_rate as data_rate',
                'gpu.frequency as frequency',
                'gpu.interface as interface',
                'gpu.6pin as pin8',
                'gpu.6pin as pin6',
                'gpu.dvi_port as dvi',
                'gpu.hdmi as hdmi',
                'gpu.displayport as display',
                'gpu.sli_cross as sli_cross'
            )->where('gpu.slug', '=', $slug)->first();

//price query
        $price = \DB::table('gpu')->where('slug', '=', $slug)->join('price', 'gpu.part_number', '=', 'price.part_number')->join('retailer', 'retailer.id', '=', 'price.retailer_id')->select('retailer.name as store',
            'retailer.url as alt',
            'retailer.delivery_url as delivery',
            'price.url as url',
            'price.in_stock as stock', 'price.price as price')->orderBy('price.price', 'asc')->get();

        if ($specs->memory_capacity >= 1000) {
            $specs->memory_capacity = $specs->memory_capacity / 1000 . 'GB';
        } else {
            $specs->memory_capacity = $specs->memory_capacity . 'MB';
        }

        if ($specs->display == 0) {
            unset($specs->display);
        }
        if ($specs->hdmi == 0) {
            unset($specs->hdmi);
        }
        if ($specs->dvi == 0) {
            unset($specs->dvi);
        }
        if ($specs->pin6 == 0) {
            unset($specs->pin6);
        }
        if ($specs->pin8 == 0) {
            unset($specs->pin8);
        }

        if (is_null($specs->sli_cross)) {
            $specs->sli_cross = 'Nav';
        } else if ($specs->sli_cross == true) {
            $specs->sli_cross = 'Crossfire';
        } else if ($specs->sli_cross == false) {
            $specs->sli_cross = 'SLI';
        }

        if (is_null($specs->frequency)) {
            unset($specs->frequency);
        } else {
            if ($specs->frequency >= 1000) {
                $specs->frequency = $specs->frequency / 1000 . 'GHz';
            } else {
                $specs->frequency = $specs->frequency . 'MHz';
            }
        }

        $data = [
            'title' => $specs->brand . ' ' . $specs->part_number . ' ' . $specs->memory_capacity . ' - video karte',

            'specs' => $specs,
            'prices' => $price,
            'slug' => $slug,
            'session_name' => 'gpu',

        ];

        return view('part', $data);

    }

    public function showPsu($slug)
    {

        $specs = \DB::table('psu')->join('manufacturer', 'psu.manufacturer_id', '=', 'manufacturer.id')->join('psu_type', 'psu_type.psu_id', '=', 'psu.id')
            ->select(
                'manufacturer.name as brand',
                'psu.part_number as part_number',
                \DB::raw('GROUP_CONCAT( psu_type.name SEPARATOR " / ") AS type'),
                'psu.power as power',
                'psu.energy_efficiency as energy',
                'psu.modular as modular',
                'psu.6pin as pin6',
                'psu.8pin as pin8',
                'psu.6_plus_2 as pin62',

                'psu.output as output',
                'psu.efficiency as efficiency'

            )->where('psu.slug', '=', $slug)->first();

//price query
        $price = \DB::table('psu')->where('slug', '=', $slug)->join('price', 'psu.part_number', '=', 'price.part_number')->join('retailer', 'retailer.id', '=', 'price.retailer_id')->select('retailer.name as store',
            'retailer.url as alt',
            'retailer.delivery_url as delivery',
            'price.url as url',
            'price.in_stock as stock', 'price.price as price')->orderBy('price.price', 'asc')->get();

        if ($specs->pin6 == 0) {
            unset($specs->pin6);
        }

        if ($specs->pin8 == 0) {
            unset($specs->pin8);
        }
        if ($specs->pin62 == 0) {
            unset($specs->pin62);
        }

        if (is_null($specs->energy)) {
            unset($specs->energy);
        }
        if (is_null($specs->efficiency)) {
            unset($specs->efficiency);
        } else {
            $specs->efficiency = '< ' . $specs->efficiency . '%';
        }
        if ($specs->modular == true) {
            $specs->modular = 'Ir';
        } else {
            $specs->modular = 'Nav';
        }

        $specs->power = $specs->power . 'W';
        $data = [
            'title' => $specs->brand . ' ' . $specs->part_number . ' ' . $specs->power . ' - barošanas bloks',

            'specs' => $specs,
            'prices' => $price,
            'slug' => $slug,
            'session_name' => 'psu',

        ];

        return view('part', $data);

    }

    public function showOpticalDrive($slug)
    {

        $specs = \DB::table('optical_drive')->join('manufacturer', 'optical_drive.manufacturer_id', '=', 'manufacturer.id')
            ->select(
                'manufacturer.name as brand',
                'optical_drive.part_number as part_number',
                'optical_drive.type as type',
                'optical_drive.reader_writer as reader_writer',
                'optical_drive.form_factor as form_factor',
                'optical_drive.interface as interface',
                'optical_drive.bd_rom as bd_rom',
                'optical_drive.dvd_rom as dvd_rom',
                'optical_drive.cd_rom as cd_rom',
                'optical_drive.cd_r as cd_r',
                'optical_drive.cd_rw as cd_rw',
                'optical_drive.dvd_r as dvd_r',
                'optical_drive.dvd_plus_r as dvd_plus_r',
                'optical_drive.dvd_plus_r_dual as dvd_plus_r_dual',
                'optical_drive.dvd_plus_rw as dvd_plus_rw',
                'optical_drive.dvd_r_dual as dvd_r_dual',
                'optical_drive.dvd_ram as dvd_ram',
                'optical_drive.dvd_r as dvd_r',
                'optical_drive.dvd_rw as dvd_rw',
                'optical_drive.bd_r as bd_r',
                'optical_drive.bd_re as bd_re'

            )->where('optical_drive.slug', '=', $slug)->first();

        if ($specs->reader_writer == true) {
            $specs->reader_writer = 'Rakstītājs';
        } else {
            $specs->reader_writer = 'Lasītājs';
        }
        if (is_null($specs->bd_re)) {
            unset($specs->bd_re);
        } else {
            $specs->bd_re = $specs->bd_re . 'X';
        }

        if (is_null($specs->bd_r)) {
            unset($specs->bd_r);
        } else {
            $specs->bd_r = $specs->bd_r . 'X';
        }

        if (is_null($specs->dvd_rw)) {
            unset($specs->dvd_rw);
        } else {
            $specs->dvd_rw = $specs->dvd_rw . 'X';
        }

        if (is_null($specs->dvd_r)) {
            unset($specs->dvd_r);
        } else {
            $specs->dvd_r = $specs->dvd_r . 'X';
        }

        if (is_null($specs->dvd_ram)) {
            unset($specs->dvd_ram);
        } else {
            $specs->dvd_ram = $specs->dvd_ram . 'X';
        }

        if (is_null($specs->dvd_r_dual)) {
            unset($specs->dvd_r_dual);
        } else {
            $specs->dvd_r_dual = $specs->dvd_r_dual . 'X';
        }

        if (is_null($specs->dvd_plus_rw)) {
            unset($specs->dvd_plus_rw);
        } else {
            $specs->dvd_plus_rw = $specs->dvd_plus_rw . 'X';
        }

        if (is_null($specs->dvd_plus_r_dual)) {
            unset($specs->dvd_plus_r_dual);
        } else {
            $specs->dvd_plus_r_dual = $specs->dvd_plus_r_dual . 'X';
        }

        if (is_null($specs->dvd_plus_r)) {
            unset($specs->dvd_plus_r);
        } else {
            $specs->dvd_plus_r = $specs->dvd_plus_r . 'X';
        }

        if (is_null($specs->cd_rw)) {
            unset($specs->cd_rw);
        } else {
            $specs->cd_rw = $specs->cd_rw . 'X';
        }

        if (is_null($specs->cd_r)) {
            unset($specs->cd_r);
        } else {
            $specs->cd_r = $specs->cd_r . 'X';
        }

        if (is_null($specs->cd_rom)) {
            unset($specs->cd_rom);
        } else {
            $specs->cd_rom = $specs->cd_rom . 'X';
        }

        if (is_null($specs->dvd_rom)) {
            unset($specs->dvd_rom);
        } else {
            $specs->dvd_rom = $specs->dvd_rom . 'X';
        }

        if (is_null($specs->bd_rom)) {
            unset($specs->bd_rom);
        } else {
            $specs->bd_rom = $specs->bd_rom . 'X';
        }
//price query
        $price = \DB::table('optical_drive')->where('slug', '=', $slug)->join('price', 'optical_drive.part_number', '=', 'price.part_number')->join('retailer', 'retailer.id', '=', 'price.retailer_id')->select('retailer.name as store',
            'retailer.url as alt',
            'retailer.delivery_url as delivery',
            'price.url as url',
            'price.in_stock as stock', 'price.price as price')->orderBy('price.price', 'asc')->get();

        $data = [
            'title' => $specs->brand . ' ' . $specs->part_number . ' ' . $specs->type . ' ' . $specs->reader_writer . ' - diskdzinis',

            'specs' => $specs,
            'prices' => $price,
            'slug' => $slug,
            'session_name' => 'optical_drive',

        ];

        return view('part', $data);

    }

    public function showCaseFan($slug)
    {

        $specs = \DB::table('case_fan')->join('manufacturer', 'case_fan.manufacturer_id', '=', 'manufacturer.id')
            ->select(
                'manufacturer.name as brand',
                'case_fan.part_number as part_number',
                'case_fan.rpm_from',
                'case_fan.rpm_to',
                'case_fan.air_from',
                'case_fan.air_to',
                'case_fan.size'
            )->where('case_fan.slug', '=', $slug)->first();

//price query
        $price = \DB::table('case_fan')->where('slug', '=', $slug)->join('price', 'case_fan.part_number', '=', 'price.part_number')->join('retailer', 'retailer.id', '=', 'price.retailer_id')->select('retailer.name as store',
            'retailer.url as alt',
            'retailer.delivery_url as delivery',
            'price.url as url',
            'price.in_stock as stock', 'price.price as price')->orderBy('price.price', 'asc')->get();

//RPM
        if (is_null($specs->rpm_from) && is_null($specs->rpm_to)) {
            unset($specs->rpm_from);
            unset($specs->rpm_to);

        } else if (!is_null($specs->rpm_from) && is_null($specs->rpm_to)) {
            unset($specs->rpm_to);
            $specs->rpm_from = $specs->rpm_from . ' RPM';

        } else if (is_null($specs->rpm_from) && !is_null($specs->rpm_to)) {
            $specs->rpm_from = $specs->rpm_to;
            unset($specs->rpm_to);
            $specs->rpm_from = $specs->rpm_from . ' RPM';

        } else {
            $specs->rpm_from = $specs->rpm_from . ' - ' . $specs->rpm_to;
            unset($specs->rpm_to);
            $specs->rpm_from = $specs->rpm_from . ' RPM';

        }

//AIR
        if (is_null($specs->air_from) && is_null($specs->air_to)) {
            unset($specs->air_from);
            unset($specs->air_to);

        } else if (!is_null($specs->air_from) && is_null($specs->air_to)) {

            unset($specs->air_to);
            $specs->air_from = $specs->air_from . ' CFM';

        } else if (is_null($specs->air_from) && !is_null($specs->air_to)) {

            $specs->air_from = $specs->air_to;
            unset($specs->air_to);
            $specs->air_from = $specs->air_from . ' CFM';

        } else {
            $specs->air_from = $specs->air_from . ' - ' . $specs->air_to;
            unset($specs->air_to);
            $specs->air_from = $specs->air_from . ' CFM';
        }

        $specs->size = $specs->size . 'mm';

        $data = [
            'title' => $specs->brand . ' ' . $specs->part_number . ' - korpusa ventilators',

            'specs' => $specs,
            'prices' => $price,
            'slug' => $slug,
            'session_name' => 'case_fan',

        ];

        return view('part', $data);

    }

}
