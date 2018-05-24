<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class compatibilityController extends Controller
{

    public function compatibilityCheck(Request $request)
    {

# cpu query #
        $cpu = '';
        if (\Session::has('cpu')) {
            $cpu = \DB::table('cpu')->join('manufacturer', 'cpu.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'cpu.part_number', '=', 'price.part_number')->leftjoin('retailer', 'price.retailer_id', '=', 'retailer.id')->groupby('cpu.part_number')->select(
                'manufacturer.name as processor',
                'cpu.part_number as part_number',
                'cpu.name as name',
                \DB::raw('min(price.price) as price'),
                'price.url as url',
                'retailer.url as retailer',
                'retailer.delivery_url as delivery',
                'cpu.slug as slug',
                'cpu.max_capacity as capacity',
                'cpu.core_count as core_count',
                'cpu.frequency as frequency',
                'cpu.thermal_power as tdp',
                'cpu.ecc as ecc',
                'cpu.cooling_device as cooler'

            )->where('cpu.slug', '=', \Session::get('cpu'))
                ->first();

//cpu socket query
            $cpu_socket = \DB::table('cpu')->join('cpu_socket', 'cpu.id', '=', 'cpu_socket.cpu_id')->select(
                'cpu_socket.name as socket'
            )->where('cpu.slug', '=', \Session::get('cpu'))
                ->get();

// from object to array

            $cpu_socket = json_decode(json_encode($cpu_socket), true);

//flatten array
            $cpu_socket = array_flatten($cpu_socket);

//add backward compatible sockets

            foreach ($cpu_socket as $key) {

                switch ($key) {

                    case 'AM2+':
                        if (!in_array("AM2", $cpu_socket)) {
                            $cpu_socket[] = "AM2";
                        }
                        break;

                    case 'AM3+':
                        if (!in_array("AM3", $cpu_socket)) {
                            $cpu_socket[] = "AM3";
                        }
                        break;

                    case 'FM2+':
                        if (!in_array("FM2", $cpu_socket)) {
                            $cpu_socket[] = "FM2";
                        }
                        break;
                }
            }
        }

# end of cpu query #

#cpu cooler query #

        $cpu_cooler = '';
        if (\Session::has('cpu_cooler')) {

// finds  cpu coolers
            $cpu_cooler = \DB::table('cpu_cooler')->join('manufacturer', 'cpu_cooler.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'cpu_cooler.part_number', '=', 'price.part_number')->leftjoin('retailer', 'price.retailer_id', '=', 'retailer.id')->select(
                'manufacturer.name as cpu_cooler',
                'cpu_cooler.part_number as part_number',
                'cpu_cooler.bearing',
                \DB::raw('min(price.price) as price'),
                'cpu_cooler.height',
                'price.url as url',
                'retailer.url as retailer',
                'retailer.delivery_url as delivery',
                'cpu_cooler.slug as slug',
                'cpu_cooler.thermal_power as tdp'
            )->where('cpu_cooler.slug', '=', \Session::get('cpu_cooler'))
                ->first();

// find all cpu sockets
            $cpu_cooler_socket = \DB::table('cpu_cooler')->join('cpu_cooler_socket', 'cpu_cooler.id', '=', 'cpu_cooler_socket.cpu_cooler_id')->select(
                'cpu_cooler_socket.name as socket'
            )->where('cpu_cooler.slug', '=', \Session::get('cpu_cooler'))
                ->get();

//convert cpu cooler socket object to array
            $cpu_cooler_socket = json_decode(json_encode($cpu_cooler_socket), true);

            //flatten array
            $cpu_cooler_socket = array_flatten($cpu_cooler_socket);

// add backward compatible sockets
            foreach ($cpu_cooler_socket as $key) {

                switch ($key) {
                    case 'AM2+':
                        if (!in_array("AM2", $cpu_cooler_socket)) {
                            $cpu_cooler_socket[] = "AM2";
                        }
                        break;

                    case 'AM3+':
                        if (!in_array("AM3", $cpu_cooler_socket)) {
                            $cpu_cooler_socket[] = "AM3";
                        }
                        break;

                    case 'FM2+':
                        if (!in_array("FM2", $cpu_cooler_socket)) {
                            $cpu_cooler_socket[] = "FM2";
                        }
                        break;
                }
            }

        }

# end of cpu cooler query #

# motherboard query #

        $motherboard = '';
        if (\Session::has('motherboard')) {

// finds  cpu coolers
            $motherboard = \DB::table('motherboard')->join('manufacturer', 'motherboard.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'motherboard.part_number', '=', 'price.part_number')->leftjoin('retailer', 'price.retailer_id', '=', 'retailer.id')->select(
                'manufacturer.name as motherboard',
                'motherboard.part_number as part_number',
                'motherboard.form_factor as form_factor',
                'motherboard.memory_slots as memory_slots',
                'motherboard.max_capacity as max_capacity',
                'motherboard.pin_type as pin_type',
                'motherboard.chipset as chipset',
                'motherboard.data_rate as data_rate',
                'motherboard.ecc as ecc',
                'motherboard.buffered as buffered',
                'motherboard.pci as pci',
                'motherboard.pcix1 as pcix1',
                'motherboard.pcix4 as pcix4',
                'motherboard.pcix8 as pcix8',
                'motherboard.pcix16 as pcix16',
                'motherboard.sata as sata',
                'motherboard.sata2 as sata2',
                'motherboard.sata3 as sata3',
                'motherboard.msata as msata',
                'motherboard.sata_express as sata_express',
                'motherboard.m2 as m2',
                'motherboard.main_connector as main_connector',
                'motherboard.onboard_usb',

                \DB::raw('min(price.price) as price'),
                'price.url as url',
                'retailer.url as retailer',
                'retailer.delivery_url as delivery',
                'motherboard.slug as slug'
            )->where('motherboard.slug', '=', \Session::get('motherboard'))
                ->first();

// find all cpu sockets
            $motherboard_socket = \DB::table('motherboard')->join('motherboard_socket', 'motherboard.id', '=', 'motherboard_socket.motherboard_id')->select(
                'motherboard_socket.name as socket'
            )->where('motherboard.slug', '=', \Session::get('motherboard'))
                ->get();

//convert cpu cooler socket object to array
            $motherboard_socket = json_decode(json_encode($motherboard_socket), true);

            //flatten array
            $motherboard_socket = array_flatten($motherboard_socket);

// add backward compatible sockets
            foreach ($motherboard_socket as $key) {

                switch ($key) {
                    case 'AM2+':
                        if (!in_array("AM2", $motherboard_socket)) {
                            $cpu_cooler_socket[] = "AM2";
                        }
                        break;

                    case 'AM3+':
                        if (!in_array("AM3", $motherboard_socket)) {
                            $cpu_cooler_socket[] = "AM3";
                        }
                        break;

                    case 'FM2+':
                        if (!in_array("FM2", $motherboard_socket)) {
                            $cpu_cooler_socket[] = "FM2";
                        }
                        break;
                }
            }

        }

        $motherboard_cpu = \DB::table('motherboard')->join('motherboard_cpu_comp', 'motherboard.id', '=', 'motherboard_cpu_comp.motherboard_id')->select(
            'motherboard_cpu_comp.cpu_name as name'
        )->where('motherboard.slug', '=', \Session::get('motherboard'))
            ->get();

//convert cpu cooler socket object to array
        $motherboard_cpu = json_decode(json_encode($motherboard_cpu), true);

        //flatten array
        $motherboard_cpu = array_flatten($motherboard_cpu);

        $motherboard_frequency = \DB::table('motherboard')->join('motherboard_frequency', 'motherboard.id', '=', 'motherboard_frequency.motherboard_id')->select(
            'motherboard_frequency.frequency as frequency'
        )->where('motherboard.slug', '=', \Session::get('motherboard'))
            ->get();

//convert cpu cooler socket object to array
        $motherboard_frequency = json_decode(json_encode($motherboard_frequency), true);

        //flatten array
        $motherboard_frequency = array_flatten($motherboard_frequency);

# end of motherboard query #

# memory query #

// finds all memory
        $newmemory = '';
        if (\Session::has('memory')) {
            $memory = \DB::table('memory')->join('manufacturer', 'memory.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'memory.part_number', '=', 'price.part_number')->leftjoin('retailer', 'price.retailer_id', '=', 'retailer.id')->groupby('memory.part_number')->select(
                'manufacturer.name as memory',
                'memory.part_number as part_number',
                'memory.type as type',
                'memory.data_rate',
                'memory.speed as speed',
                'memory.capacity as capacity',
                'memory.slots as slots',
                'memory.ecc as ecc',
                'memory.buffered',
                'memory.capacity_per_slot as capacity_per_slot',
                \DB::raw('min(price.price) as price'),
                'price.url as url',
                'retailer.url as retailer',
                'retailer.delivery_url as delivery',
                'memory.slug as slug')->wherein('memory.slug', \Session::get('memory'));

            $memory = $memory->get();

//add duplicate and non-duplicate results to a new array.
            $count = 0;

            $newmemory = [];
            foreach (\Session::get('memory') as $k => $v) {
                foreach ($memory as $mem => $value) {

                    if ($v == $value->slug) {
                        foreach ($value as $key => $val) {

                            $newmemory[$count][$key] = $val;
                        }
                    }
                }
                $count++;
            }
        }

//make the new array as object
        $newmemory = json_decode(json_encode($newmemory));

# end of memory query #

# gpu query #

        $gpu = '';
        if (\Session::has('gpu')) {

// finds  cpu coolers
            $gpu = \DB::table('gpu')->join('manufacturer', 'gpu.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'gpu.part_number', '=', 'price.part_number')->leftjoin('retailer', 'price.retailer_id', '=', 'retailer.id')->select(
                'manufacturer.name as gpu',
                'gpu.part_number as part_number',
                'gpu.lenght as lenght',
                'gpu.expansion_slot as expansion_slot',
                'gpu.interface as interface',
                'gpu.8pin as pin6',
                'gpu.6pin as pin8',
                'gpu.memory_capacity',

                \DB::raw('min(price.price) as price'),
                'price.url as url',
                'retailer.url as retailer',
                'retailer.delivery_url as delivery',
                'gpu.slug as slug'
            )->where('gpu.slug', '=', \Session::get('gpu'))
                ->first();

        }

# end of gpu query #

# end of storage query #

// finds all storage
        $newstorage = '';
        if (\Session::has('storage')) {
            $storage = \DB::table('storage')->join('manufacturer', 'storage.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'storage.part_number', '=', 'price.part_number')->leftjoin('retailer', 'price.retailer_id', '=', 'retailer.id')->groupby('storage.part_number')->select(
                'manufacturer.name as storage',
                'storage.capacity as capacity',
                'storage.type as type',
                'storage.part_number as part_number',
                'storage.form_factor as form_factor',
                'storage.interface as interface',
                \DB::raw('min(price.price) as price'),
                'price.url as url',
                'retailer.url as retailer',
                'retailer.delivery_url as delivery',
                'storage.slug as slug')->wherein('storage.slug', \Session::get('storage'));

            $storage = $storage->get();

//add duplicate and non-duplicate results to a new array.
            $count = 0;

            $newstorage = [];
            foreach (\Session::get('storage') as $k => $v) {
                foreach ($storage as $stor => $value) {

                    if ($v == $value->slug) {
                        foreach ($value as $key => $val) {

                            $newstorage[$count][$key] = $val;
                        }
                    }
                }
                $count++;
            }
        }

//make the new array as object
        $newstorage = json_decode(json_encode($newstorage));

# end of storage query #

# case query #

        $case = '';
        if (\Session::has('case')) {

// finds  cpu coolers
            $case = \DB::table('case')->join('manufacturer', 'case.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'case.part_number', '=', 'price.part_number')->leftjoin('retailer', 'price.retailer_id', '=', 'retailer.id')->select(
                'manufacturer.name as case',
                'case.part_number as part_number',
                'case.type as type',
                'case.gpu_lenght as gpu_lenght',
                'case.cpu_cooler_height as cpu_cooler_height',
                'case.psu_lenght as psu_lenght',
                'case.external_525 as external_525',
                'case.external_35 as external_35',
                'case.internal_35 as internal_35',
                'case.internal_25 as internal_25',
                'case.front_usb_panel as front_usb_panel',
                'case.expansion_slots as expansion_slots',
                \DB::raw('min(price.price) as price'),
                'price.url as url',
                'retailer.url as retailer',
                'retailer.delivery_url as delivery',
                'case.slug as slug'
            )->where('case.slug', '=', \Session::get('case'))
                ->first();

            $case->internal_35 = $case->external_35 + $case->internal_35;
            unset($case->external_35);

            $case_form_factor = \DB::table('case')->join('case_form_factor', 'case.id', '=', 'case_form_factor.case_id')->select(
                'case_form_factor.name as form_factor'
            )->where('case.slug', '=', \Session::get('case'))
                ->get();
            $case_form_factor = json_decode(json_encode($case_form_factor), true);
            $case_form_factor = array_flatten($case_form_factor);

        }

# end of case query #

# end of psu query #

        $psu = '';
        if (\Session::has('psu')) {

// finds  cpu coolers
            $psu = \DB::table('psu')->join('manufacturer', 'psu.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'psu.part_number', '=', 'price.part_number')->leftjoin('retailer', 'price.retailer_id', '=', 'retailer.id')->select(
                'manufacturer.name as psu',
                'psu.part_number as part_number',
                'psu.lenght as lenght',
                'psu.6pin as pin6',
                'psu.8pin as pin8',
                'psu.power as power',
                'psu.6_plus_2 as pin62',
                'psu.sata as sata',
                'psu.main_connector',
                \DB::raw('min(price.price) as price'),
                'price.url as url',
                'retailer.url as retailer',
                'retailer.delivery_url as delivery',
                'psu.slug as slug'
            )->where('psu.slug', '=', \Session::get('psu'))
                ->first();

        }

# end of psu query #

# optical drive query #

// finds all optical_drive
        $newoptical_drive = '';
        if (\Session::has('optical_drive')) {
            $optical_drive = \DB::table('optical_drive')->join('manufacturer', 'optical_drive.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'optical_drive.part_number', '=', 'price.part_number')->leftjoin('retailer', 'price.retailer_id', '=', 'retailer.id')->groupby('optical_drive.part_number')->select(
                'manufacturer.name as optical_drive',
                'optical_drive.part_number as part_number',
                'optical_drive.reader_writer',
                'optical_drive.type',
                'optical_drive.form_factor as form_factor',
                'optical_drive.interface as interface',
                \DB::raw('min(price.price) as price'),
                'price.url as url',
                'retailer.url as retailer',
                'retailer.delivery_url as delivery',
                'optical_drive.slug as slug')->wherein('optical_drive.slug', \Session::get('optical_drive'));

            $optical_drive = $optical_drive->get();

//add duplicate and non-duplicate results to a new array.
            $count = 0;

            $newoptical_drive = [];
            foreach (\Session::get('optical_drive') as $k => $v) {
                foreach ($optical_drive as $stor => $value) {

                    if ($v == $value->slug) {
                        foreach ($value as $key => $val) {

                            $newoptical_drive[$count][$key] = $val;
                        }
                    }
                }
                $count++;
            }
        }

//make the new array as object
        $newoptical_drive = json_decode(json_encode($newoptical_drive));

# sound card query #

        $newsoundcard = '';
        // finds all sound cards
        if (\Session::has('sound_card')) {
            $sound_card = \DB::table('sound_card')->join('manufacturer', 'sound_card.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'sound_card.part_number', '=', 'price.part_number')->leftjoin('retailer', 'price.retailer_id', '=', 'retailer.id')->groupby('sound_card.part_number')->select(
                'manufacturer.name as sound_card',
                'sound_card.part_number as part_number',
                'sound_card.interface as interface',
                'sound_card.expansion_slot as expansion_slot',
                \DB::raw('min(price.price) as price'),
                'price.url as url',
                'retailer.url as retailer',
                'retailer.delivery_url as delivery',
                'sound_card.slug as slug')->wherein('sound_card.slug', \Session::get('sound_card'));

            $sound_card = $sound_card->get();

//add duplicate and non-duplicate results to a new array.
            $count = 0;

            $newsoundcard = [];
            foreach (\Session::get('sound_card') as $k => $v) {
                foreach ($sound_card as $card => $value) {

                    if ($v == $value->slug) {
                        foreach ($value as $key => $val) {

                            $newsoundcard[$count][$key] = $val;
                        }
                    }
                }
                $count++;
            }
        }
//make the new array as object
        $newsoundcard = json_decode(json_encode($newsoundcard));

# end of sound card query #

# wireless  card query #

        $newwirelesscard = '';
        // finds all sound cards
        if (\Session::has('wireless_card')) {
            $wireless_card = \DB::table('wireless_card')->join('manufacturer', 'wireless_card.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'wireless_card.part_number', '=', 'price.part_number')->leftjoin('retailer', 'price.retailer_id', '=', 'retailer.id')->groupby('wireless_card.part_number')->select(
                'manufacturer.name as wireless_card',
                'wireless_card.part_number as part_number',
                'wireless_card.interface as interface',
                'wireless_card.expansion_slot as expansion_slot',
                \DB::raw('min(price.price) as price'),
                'price.url as url',
                'retailer.url as retailer',
                'retailer.delivery_url as delivery',
                'wireless_card.slug as slug')->wherein('wireless_card.slug', \Session::get('wireless_card'));

            $wireless_card = $wireless_card->get();

//add duplicate and non-duplicate results to a new array.
            $count = 0;

            $newwirelesscard = [];
            foreach (\Session::get('wireless_card') as $k => $v) {
                foreach ($wireless_card as $card => $value) {

                    if ($v == $value->slug) {
                        foreach ($value as $key => $val) {

                            $newwirelesscard[$count][$key] = $val;
                        }
                    }
                }
                $count++;
            }
        }
//make the new array as object
        $newwirelesscard = json_decode(json_encode($newwirelesscard));

# end of wireless card query #

# wireless  card query #

        $newwiredcard = '';
        // finds all sound cards
        if (\Session::has('wired_card')) {
            $wired_card = \DB::table('wired_card')->join('manufacturer', 'wired_card.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'wired_card.part_number', '=', 'price.part_number')->leftjoin('retailer', 'price.retailer_id', '=', 'retailer.id')->groupby('wired_card.part_number')->select(
                'manufacturer.name as wired_card',
                'wired_card.part_number as part_number',
                'wired_card.interface as interface',
                'wired_card.expansion_slot as expansion_slot',
                \DB::raw('min(price.price) as price'),
                'wired_card.speed as speed',
                'price.url as url',
                'retailer.url as retailer',
                'retailer.delivery_url as delivery',
                'wired_card.slug as slug')->wherein('wired_card.slug', \Session::get('wired_card'));

            $wired_card = $wired_card->get();

//add duplicate and non-duplicate results to a new array.
            $count = 0;

            $newwiredcard = [];
            foreach (\Session::get('wired_card') as $k => $v) {
                foreach ($wired_card as $card => $value) {

                    if ($v == $value->slug) {
                        foreach ($value as $key => $val) {

                            $newwiredcard[$count][$key] = $val;
                        }
                    }
                }
                $count++;
            }
        }
//make the new array as object
        $newwiredcard = json_decode(json_encode($newwiredcard));

# end of wired card query #

# case_fan query #

// finds all case_fan
        $newcase_fan = '';
        if (\Session::has('case_fan')) {
            $case_fan = \DB::table('case_fan')->join('manufacturer', 'case_fan.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'case_fan.part_number', '=', 'price.part_number')->leftjoin('retailer', 'price.retailer_id', '=', 'retailer.id')->groupby('case_fan.part_number')->select(
                'manufacturer.name as case_fan',
                'case_fan.part_number as part_number',
                \DB::raw('min(price.price) as price'),
                'price.url as url',
                'retailer.url as retailer',
                'retailer.delivery_url as delivery',
                'case_fan.slug as slug')->wherein('case_fan.slug', \Session::get('case_fan'));

            $case_fan = $case_fan->get();

//add duplicate and non-duplicate results to a new array.
            $count = 0;

            $newcase_fan = [];
            foreach (\Session::get('case_fan') as $k => $v) {
                foreach ($case_fan as $mem => $value) {

                    if ($v == $value->slug) {
                        foreach ($value as $key => $val) {

                            $newcase_fan[$count][$key] = $val;
                        }
                    }
                }
                $count++;
            }
        }

//make the new array as object
        $newcase_fan = json_decode(json_encode($newcase_fan));

#end of case fan query #

// error
        $error = false;

// error description
        $error_desc = [];

//external slots
        $external_525 = 0;

//internal slots
        $internal_35 = 0;
        $internal_25 = 0;

//expansion slots
        $expansion_slots = 0;

//pci slots
        $pci = 0;
        $pcix1 = 0;
        $pcix4 = 0;
        $pcix8 = 0;
        $pcix16 = 0;
//memory
        $capacity = 0;
        $slots = 0;

//sata ports
        $sata = 0;
        $sata2 = 0;
        $sata3 = 0;
        $sata_express = 0;
        $m2 = 0;
        $msata = 0;

//motherboard comparison
        if (\Session::has('motherboard')) {

            if (\Session::has('memory')) {

                // ecc support comparison
                foreach ($newmemory as $mem) {

                    if ($motherboard->ecc == false && $mem->ecc == true) {
                        $error = true;
                        $error_desc[] = $motherboard->motherboard . ' ' . $motherboard->part_number . ' - mātesplate un ' . $mem->memory . ' ' . $mem->part_number . ' - operatīvā atmiņa nav saderīga';
                    } else if ($motherboard->buffered != $mem->buffered) {
                        $error = true;
                        $error_desc[] = $motherboard->motherboard . ' ' . $motherboard->part_number . ' - mātesplate un ' . $mem->memory . ' ' . $mem->part_number . ' - operatīvā atmiņa nav saderīga';
                    }

                    if ($motherboard->pin_type != $mem->type) {
                        $error = true;
                        $error_desc[] = $motherboard->motherboard . ' ' . $motherboard->part_number . ' - mātesplate neatbalsta ' . $mem->memory . ' ' . $mem->part_number . ' - ' . $mem->type . ' - operatīvas atmiņas DIMM slotus';
                    } else if (min($motherboard_frequency) > $mem->speed) {
                        $error = true;
                        $error_desc[] = $motherboard->motherboard . ' ' . $motherboard->part_number . ' - mātesplate un ' . $mem->memory . ' ' . $mem->part_number . ' -operatīvā atmiņa nav saderīgi';
                    }

                    $slots = $slots + $mem->slots;
                    $capacity = $capacity + $mem->capacity;

                }

            }

//cpu and motherboard - socket
            if (\Session::has('cpu')) {

                // cpu and cpu cooler socket comparison
                $mobo_cpu_cooler_result = array_intersect($cpu_socket, $motherboard_socket);

                if (empty($mobo_cpu_cooler_result) && !in_array($cpu->name, $motherboard_cpu)) {
                    $error = true;
                    $error_desc[] = $motherboard->motherboard . ' ' . $motherboard->part_number . ' - mātesplate un ' . $cpu->processor . ' ' . $cpu->name . ' - procesors nav saderīgi';
                }
            }

            if (\Session::has('cpu_cooler')) {

                // cpu and cpu cooler socket comparison
                $mobo_cpu_cooler_result = array_intersect($cpu_cooler_socket, $motherboard_socket);
                if (empty($mobo_cpu_cooler_result)) {
                    $error = true;
                    $error_desc[] = $motherboard->motherboard . ' ' . $motherboard->part_number . ' -mātesplate un ' . $cpu_cooler->cpu_cooler . ' ' . $cpu_cooler->part_number . ' - procesora dzesētājs nav saderīgi';
                }
            }

            if (\Session::has('storage')) {

                foreach ($newstorage as $card) {
                    switch ($card->interface) {
                        case 'SATA 6 Gb/s':

                            if ($sata3 < $motherboard->sata3) {
                                $sata3 = $sata3 + 1;
                            } else if ($sata_express < $motherboard->sata_express) {
                                $sata_express = $sata_express + 1;
                                $sata3 = $sata3 - 1;
                            } else {
                                $sata3 = $sata3 + 1;
                            }
                            break;

                        case 'SATA 3 Gb/s':
                            if ($sata2 < $motherboard->sata2) {
                                $sata2 = $sata2 + 1;
                            } else if ($sata3 < $motherboard->sata3) {
                                $sata3 = $sata3 + 1;
                            } else if ($sata_express < $motherboard->sata_express) {
                                $sata_express = $sata_express + 1;
                                $sata3 = $sata3 - 1;
                            } else {
                                $sata2 = $sata2 + 1;
                            }
                            break;

                        case 'mSATA':

                            $msata = $msata + 1;

                            break;
                    }
                }
            }

            if (\Session::has('optical_drive')) {

                foreach ($newoptical_drive as $card) {
                    switch ($card->interface) {
                        case 'SATA 6 Gb/s':

                            if ($sata3 < $motherboard->sata3) {
                                $sata3 = $sata3 + 1;
                            } else if ($sata_express < $motherboard->sata_express) {
                                $sata_express = $sata_express + 1;
                                $sata3 = $sata3 - 1;
                            } else {
                                $sata3 = $sata3 + 1;
                            }
                            break;

                        case 'SATA 3 Gb/s':
                            if ($sata2 < $motherboard->sata2) {
                                $sata2 = $sata2 + 1;
                            } else if ($sata3 < $motherboard->sata3) {
                                $sata3 = $sata3 + 1;
                            } else if ($sata_express < $motherboard->sata_express) {
                                $sata_express = $sata_express + 1;
                                $sata3 = $sata3 - 1;
                            } else {
                                $sata2 = $sata2 + 1;
                            }
                            break;

                        case 'mSATA':

                            $msata = $msata + 1;

                            break;
                    }
                }
            }

// gpu interface
            if (\Session::has('gpu')) {
                switch ($gpu->interface) {
                    case 'PCI Express x16':
                        $pcix16 = $pcix16 + 1;
                        break;
                    case 'PCI Express x8':
                        if ($pcix8 < $motherboard->pcix8) {
                            $pcix8 = $pcix8 + 1;
                        } elseif ($pcix16 < $motherboard->pcix16) {
                            $pcix16 = $pcix16 + 1;
                        } else {
                            $pcix8 = $pcix8 + 8;
                        }
                        break;
                    case 'PCI Express x4':
                        if ($pcix4 < $motherboard->pcix4) {
                            $pcix4 = $pcix4 + 1;
                        } else if ($pcix8 < $motherboard->pcix8) {
                            $pcix8 = $pcix8 + 1;
                        } elseif ($pcix16 < $motherboard->pcix16) {
                            $pcix16 = $pcix16 + 1;
                        } else {
                            $pcix4 = $pcix4 + 1;
                        }
                        break;
                }

            }

//wireless card and motherboard - interface
            if (\Session::has('wireless_card')) {

                foreach ($newwirelesscard as $card) {
                    switch ($card->interface) {
                        case 'PCI Express x1':

                            if ($pcix1 < $motherboard->pcix1) {
                                $pcix1 = $pcix1 + 1;
                            } else if ($pcix4 < $motherboard->pcix4) {
                                $pcix4 = $pcix4 + 1;
                            } else if ($pcix8 < $motherboard->pcix8) {
                                $pcix8 = $pcix8 + 1;
                            } elseif ($pcix16 < $motherboard->pcix16) {
                                $pcix16 = $pcix16 + 1;
                            } else {
                                $pcix1 = $pcix1 + 1;
                            }
                            break;
                        case 'PCI':
                            $pci = $pci + 1;
                            break;

                    }
                }
            }

//wired card and motherboard - interface
            if (\Session::has('wired_card')) {

                foreach ($newwiredcard as $card) {
                    switch ($card->interface) {
                        case 'PCI Express x1':
                            if ($pcix1 < $motherboard->pcix1) {
                                $pcix1 = $pcix1 + 1;
                            } else if ($pcix4 < $motherboard->pcix4) {
                                $pcix4 = $pcix4 + 1;
                            } else if ($pcix8 < $motherboard->pcix8) {
                                $pcix8 = $pcix8 + 1;
                            } elseif ($pcix16 < $motherboard->pcix16) {
                                $pcix16 = $pcix16 + 1;
                            } else {
                                $pcix1 = $pcix1 + 1;
                            }
                            break;
                        case 'PCI':
                            $pci = $pci + 1;
                            break;
                        case 'PCI Express x4':
                            if ($pcix4 < $motherboard->pcix4) {
                                $pcix4 = $pcix4 + 1;
                            } else if ($pcix8 < $motherboard->pcix8) {
                                $pcix8 = $pcix8 + 1;
                            } elseif ($pcix16 < $motherboard->pcix16) {
                                $pcix16 = $pcix16 + 1;
                            } else {
                                $pcix4 = $pcix4 + 1;
                            }
                            break;
                        case 'PCI Express x8':
                            if ($pcix8 < $motherboard->pcix8) {
                                $pcix8 = $pcix8 + 1;
                            } elseif ($pcix16 < $motherboard->pcix16) {
                                $pcix16 = $pcix16 + 1;
                            } else {
                                $pcix8 = $pcix8 + 1;
                            }
                            break;

                    }
                }
            }

//sound card and motherboard - interface
            if (\Session::has('sound_card')) {

                foreach ($newsoundcard as $card) {
                    switch ($card->interface) {
                        case 'PCI Express x1':

                            if ($pcix1 < $motherboard->pcix1) {
                                $pcix1 = $pcix1 + 1;
                            } else if ($pcix4 < $motherboard->pcix4) {
                                $pcix4 = $pcix4 + 1;
                            } else if ($pcix8 < $motherboard->pcix8) {
                                $pcix8 = $pcix8 + 1;
                            } elseif ($pcix16 < $motherboard->pcix16) {
                                $pcix16 = $pcix16 + 1;
                            } else {
                                $pcix1 = $pcix1 + 1;
                            }
                            break;

                        case 'PCI':
                            $pci = $pci + 1;
                            break;

                    }
                }
            }

// check if motherboard has enought sata ports
            if ($motherboard->sata < $sata) {
                $error = true;
                $error_desc[] = $motherboard->motherboard . ' ' . $motherboard->part_number . ' - mātesplates Sata 1.5Gb/s slotu skaits: ' . $motherboard->sata . ', tagadējais: ' . $sata;
            }
// check if motherboard has enought sata2 ports
            if ($motherboard->sata2 < $sata2) {
                $error = true;
                $error_desc[] = $motherboard->motherboard . ' ' . $motherboard->part_number . ' - mātesplates Sata 3Gb/s slotu skaits: ' . $motherboard->sata2 . ', tagadējais: ' . $sata2;
            }
// check if motherboard has enought sata3 ports
            if ($motherboard->sata3 < $sata3) {
                $error = true;
                $error_desc[] = $motherboard->motherboard . ' ' . $motherboard->part_number . ' - mātesplates Sata 6Gb/s slotu skaits: ' . $motherboard->sata3 . ', tagadējais: ' . $sata3;
            }
// check if motherboard has enought msata ports
            if ($motherboard->msata < $msata) {
                $error = true;
                $error_desc[] = $motherboard->motherboard . ' ' . $motherboard->part_number . ' - mātesplates Msata slotu skaits: ' . $motherboard->msata . ', tagadējais: ' . $msata;
            }

//check if mothers max capicity is in rams total capacity
            if ($motherboard->max_capacity < $capacity) {
                $error = true;
                $error_desc[] = $motherboard->motherboard . ' ' . $motherboard->part_number . ' - mātesplates maksimālā operatīvas atmiņas kapacītāte ir: ' . $motherboard->max_capacity / 1000 . ' GB, tagadējais apjoms: ' . $capacity / 1000 . 'GB';
            }
            // check if motherboard has enought slots
            if ($motherboard->memory_slots < $slots) {
                $error = true;
                $error_desc[] = $motherboard->motherboard . ' ' . $motherboard->part_number . ' - mātesplates operatīvas atmiņas slotu skaits: ' . $motherboard->memory_slots . ', tagadējais: ' . $slots;

            }

// check if motherboard has enought pci slots
            if ($motherboard->pci < $pci) {
                $error = true;
                $error_desc[] = $motherboard->motherboard . ' ' . $motherboard->part_number . ' - mātesplates PCI slotu skaits: ' . $motherboard->pci . ', tagadējais: ' . $pci;
            }

// check if motherboard has enought pcix1 slots
            if ($motherboard->pcix1 < $pcix1) {
                $error = true;

                $error_desc[] = $motherboard->motherboard . ' ' . $motherboard->part_number . ' - mātesplates PCI express x1 slotu skaits: ' . $motherboard->pcix1 . ', tagadējais: ' . $pcix1;

            }

// check if motherboard has enought pcix4 slots
            if ($motherboard->pcix4 < $pcix4) {
                $error = true;
                $error_desc[] = $motherboard->motherboard . ' ' . $motherboard->part_number . ' - mātesplates PCI express x4 slotu skaits: ' . $motherboard->pcix4 . ', tagadējais: ' . $pcix4;

            }
// check if motherboard has enought pcix8 slots
            if ($motherboard->pcix8 < $pcix8) {
                $error = true;
                $error_desc[] = $motherboard->motherboard . ' ' . $motherboard->part_number . ' - mātesplates PCI express x8 slotu skaits: ' . $motherboard->pcix8 . ', tagadējais: ' . $pcix8;

            }
// check if motherboard has enought pcix16 slots
            if ($motherboard->pcix16 < $pcix16) {
                $error = true;
                $error_desc[] = $motherboard->motherboard . ' ' . $motherboard->part_number . ' - mātesplates PCI express x16 slotu skaits: ' . $motherboard->pcix16 . ', tagadējais: ' . $pcix16;
            }
        }

// case compatibility
        if (\Session::has('case')) {

// cpu cooler  with case - height
            if (\Session::has('cpu_cooler')) {
                if ($cpu_cooler->height > $case->cpu_cooler_height) {
                    $error = true;

                    $error_desc[] = $case->case . ' ' . $case->part_number . ' ' . $case->type . ' - korpusa atļautais procesora dzesētāja augstums neatbilst ' . $cpu_cooler->cpu_cooler . ' ' . $cpu_cooler->part_number . ' augstumam';

                }
            }

// motherboard with case - form factor
            if (\Session::has('motherboard')) {

                if (!in_array($motherboard->form_factor, $case_form_factor)) {
                    $error = true;
                    $error_desc[] = $case->case . ' ' . $case->part_number . ' ' . $case->type . ' - korpuss neatbalsta '
                    . $motherboard->motherboard . ' ' . $motherboard->part_number . ' - mātesplates formas standartu: ' . $motherboard->form_factor;
                }

                if ($motherboard->onboard_usb == false && $case->front_usb_panel == true) {
                    $error = true;
                    $error_desc[] = $motherboard->motherboard . ' ' . $motherboard->part_number . ' - mātesplatei nav priekšējā paneļa porti';
                } else if ($motherboard->onboard_usb == true && $case->front_usb_panel == false) {
                    $error = true;
                    $error_desc[] = $case->case . ' ' . $case->part_number . ' ' . $case->type . ' - korpusam nav priekšējā paneļa porti';
                }
            }

//psu with case compatibility - lenght
            if (\Session::has('psu')) {
                if ($case->psu_lenght < $psu->lenght) {
                    $error = true;
                    $error_desc[] = $case->case . ' ' . $case->part_number . ' ' . $case->type . ' - korpusa atļautais barošanas bloka garums neatbilst  ' . $psu->psu . ' ' . $psu->part_number . ' ' . $psu->power . 'W  garumam';
                }
            }

// optical driver with case slots - form factor
            if (\Session::has('optical_drive')) {

                foreach ($newoptical_drive as $drive) {

                    switch ($drive->form_factor) {
                        case '5.25':
                            $external_525 = $external_525 + 1;
                            break;
                    }
                }
            }

//wireless card and case - expansion slots
            if (\Session::has('wireless_card')) {

                foreach ($newwirelesscard as $card) {
                    $expansion_slots = $expansion_slots + $card->expansion_slot;

                }
            }

//wired card and case - expansion slots
            if (\Session::has('wired_card')) {

                foreach ($newwiredcard as $card) {
                    $expansion_slots = $expansion_slots + $card->expansion_slot;

                }
            }

//wired card and case - expansion slots
            if (\Session::has('sound_card')) {

                foreach ($newsoundcard as $card) {
                    $expansion_slots = $expansion_slots + $card->expansion_slot;

                }
            }

//storage and case - form factor
            if (\Session::has('storage')) {

                foreach ($newstorage as $storage) {

                    switch ($storage->form_factor) {
                        case '3.5':
                            $internal_35 = $internal_35 + 1;
                            break;

                        case '2.5':
                            $internal_25 = $internal_25 + 1;
                            break;
                    }
                }
            }

//video card and case - lenght , expansion slots
            if (\Session::has('gpu')) {
                //lenght
                if ($case->gpu_lenght < $gpu->lenght) {
                    $error = true;

                    $error_desc[] = $case->case . ' ' . $case->part_number . ' ' . $case->type . ' - korpusa atļautais video kartes garums neatbilst  ' . $gpu->gpu . ' ' . $gpu->part_number . ' garumam';

                }
                // expansion slots
                $expansion_slots = $expansion_slots + $gpu->expansion_slot;
            }

// form factor output
            // check if case has enought 5.25 slots
            if ($external_525 > $case->external_525) {
                $error = true;

                $error_desc[] = $case->case . ' ' . $case->part_number . ' ' . $case->type . ' - korpusa ārējo 5.25 slotu skaits: ' . $case->external_525 . ', tagadējais: ' . $external_525;
            }

//check if case has enought interanl 3.5 slots
            if ($internal_35 > $case->internal_35) {
                $error = true;
                $error_desc[] = $case->case . ' ' . $case->part_number . ' ' . $case->type . ' - korpusa iekšējo 3.5 slotu skaits: ' . $case->internal_35 . ', tagadējais: ' . $internal_35;
            }

//check if case has enought internal 2.5slots
            if ($internal_25 > $case->internal_25) {
                $error = true;
                $error_desc[] = $case->case . ' ' . $case->part_number . ' ' . $case->type . ' - korpusa iekšējo 2.5 slotu skaits: ' . $case->internal_25 . ', tagadējais: ' . $internal_25;
            }

//check if case has enought exapnsion slots
            if ($expansion_slots > $case->expansion_slots) {
                $error = true;
                $error_desc[] = $case->case . ' ' . $case->part_number . ' ' . $case->type . ' - korpusa palašīnājuma slotu slotu skaits: ' . $case->expansion_slots . ', tagadējais: ' . $expansion_slots;

            }
        }

//cpu and cpu cooler - tdp, socket
        if (\Session::has('cpu')) {
            if (\Session::has('cpu_cooler')) {

                // cpu and cpu cooler socket comparison
                $result_socket = array_intersect($cpu_cooler_socket, $cpu_socket);
                if (empty($result_socket)) {
                    $error = true;
                    $error_desc[] = $cpu->processor . ' ' . $cpu->name . ' - procesors un ' . $cpu_cooler->cpu_cooler . ' ' . $cpu_cooler->part_number . ' - procesora dzesētājs nav saderīgi';
                    //cpu and cpu cooler - tdp
                } else if ($cpu->tdp > $cpu_cooler->tdp) {
                    $error = true;
                    $error_desc[] = $cpu->processor . ' ' . $cpu->name . ' - procesors un ' . $cpu_cooler->cpu_cooler . ' ' . $cpu_cooler->part_number . ' - procesora dzesētājs nav saderīgi. Procesora siltuma jauda ir pārāk augsta';
                }
            } else {
                if ($cpu->cooler == false) {
                    $error = true;
                    $error_desc[] = $cpu->processor . ' ' . $cpu->name . ' procesoram nenāk līdzi dzesētājs';
                }
            }

// cpu and memory - ecc, max ram
            if (\Session::has('memory')) {
                $capacity = 0;
                // ecc support comparison
                foreach ($newmemory as $mem) {
                    if ($cpu->ecc == false && $mem->ecc == true) {
                        $error = true;
                        $error_desc[] = $cpu->processor . ' ' . $cpu->name . ' - procesors un ' . $mem->memory . ' ' . $mem->part_number . ' - operatīvā atmiņa nav saderīgi';
                    }

                    $capacity = $capacity + $mem->capacity;

                }
                //cpu max memory and total memory comparison
                if (!empty($cpu->capacity)) {
                    if ($cpu->capacity < $capacity) {
                        $error = true;
                        $error_desc[] = $cpu->processor . ' ' . $cpu->name . ' - procesora maksimālā operatīvas atmiņas kapacītāte ir: ' . $cpu->capacity / 1000 . ', tagadējais apjoms: ' . $capacity / 1000 . 'GB';
                    }
                }
            }
        }

        $pin8 = 0;
        $pin6 = 0;
        $sata_connectors = 0;
//psu comparison
        if (\Session::has('psu')) {

//psu and gpu - pin types
            if (\Session::has('gpu')) {

                $gpu6pin = $gpu->pin6;
                $gpu8pin = $gpu->pin8;
                $psu8pin = $psu->pin8;
                $psu6pin = $psu->pin6;
                $psu62pin = $psu->pin62;

                $psu6pintotal = $psu6pin + $psu62pin;
                if ($psu6pintotal < $gpu6pin) {
                    $error = true;
                    $error_desc[] = 'Pietrūkst: ' . abs($psu6pintotal = $psu6pintotal - $gpu6pin) . ' - 6-pin strāvas savienotāji - barošanas blokam';

                } else {

                    $psu6pin = $psu6pin - $gpu6pin;

                    if ($psu6pin < 0) {
                        $psu62pin = $psu62pin + $psu6pin;
                    }
                }

                $psu8pintotal = $psu8pin + $psu62pin;
                if ($psu8pintotal < $gpu8pin) {
                    $error = true;
                    $error_desc[] = 'Pietrūkst: ' . abs($psu8pintotal = $psu8pintotal - $gpu8pin) . ' - 8-pin strāvas savienotāji - barošanas blokam';
                }
            }

// psu storage -sata cables
            if (\Session::has('storage')) {

                foreach ($newstorage as $key) {
                    $sata_connectors = $sata_connectors + 1;
                }
            }

            if (\Session::has('motherboard')) {
                switch ($motherboard->main_connector) {
                    case '0':
                        if ($psu->main_connector != '20+4Pin' && $psu->main_connector != '20Pin') {
                            $error = true;
                            $error_desc[] = $psu->psu . ' ' . $psu->part_number . ' ' . $psu->power . 'W' . ' - barošanas blokam nav 20-pin strāvas savienotājs';
                        }
                        break;
                    case '1':
                        if ($psu->main_connector != '20+4Pin' && $psu->main_connector != '24Pin') {
                            $error = true;
                            $error_desc[] = $psu->psu . ' ' . $psu->part_number . ' ' . $psu->power . 'W' . ' - barošanas blokam nav 24-pin strāvas savienotājs';
                        }
                        break;
                }
            }

// psu optical drive -sata cables
            if (\Session::has('optical_drive')) {

                foreach ($newoptical_drive as $key) {
                    $sata_connectors = $sata_connectors + 1;
                }
            }

//check if case has enought sata connectors
            if ($sata_connectors > $psu->sata) {
                $error = true;
                $error_desc[] = $psu->psu . ' ' . $psu->part_number . ' ' . $psu->power . 'W - barošanas blokam Sata savienotāju skaits: ' . $psu->sata . ', tagadējais: ' . $sata_connectors;
            }

        }

//output
        if (\Session::has('cpu')) {

            $cpu->processor = $cpu->processor . ' ' . $cpu->name . ' ' . $cpu->core_count . '- kodolu ' . $cpu->frequency . 'GHz - procesors';

        }
        if (\Session::has('cpu_cooler')) {

            $cpu_cooler->cpu_cooler = $cpu_cooler->cpu_cooler . ' ' . $cpu_cooler->part_number . ' ' . $cpu_cooler->height . 'mm - procesora dzesētājs';

        }
        if (\Session::has('motherboard')) {

            $motherboard->motherboard = $motherboard->motherboard . ' ' . $motherboard->part_number . ' ' . $motherboard->form_factor . ' ' . $motherboard->chipset . ' - mātesplate';

        }

        if (\Session::has('memory')) {
            foreach ($newmemory as $mem) {
                if ($mem->capacity_per_slot >= 1000) {
                    $mem->capacity_per_slot = $mem->capacity_per_slot / 1000 . 'GB';
                } else {
                    $mem->capacity_per_slot = $mem->capacity_per_slot . 'MB';
                }

                $mem->memory = $mem->memory . ' ' . $mem->part_number . ' ' . $mem->slots . 'x' . $mem->capacity_per_slot . ' ' . $mem->data_rate . '-' . $mem->speed . ' - operatīvā atmiņa';
            }
        }

        if (\Session::has('storage')) {

            foreach ($newstorage as $storage) {
                if ($storage->capacity >= 1000) {
                    $storage->capacity = $storage->capacity / 1000 . 'TB';
                } else {
                    $storage->capacity = $storage->capacity . 'GB';
                }

                $storage->storage = $storage->storage . $storage->part_number . ' ' . $storage->capacity . ' ' . $storage->type . ' - cietais disks';
            }
        }

        if (\Session::has('case')) {

            $case->case = $case->case . ' ' . $case->part_number . ' ' . $case->type . ' - Korpuss';

        }

        if (\Session::has('gpu')) {

            if ($gpu->memory_capacity >= 1000) {
                $gpu->memory_capacity = $gpu->memory_capacity / 1000 . 'GB';
            } else {
                $gpu->memory_capacity = $gpu->memory_capacity . 'MB';
            }

            $gpu->gpu = $gpu->gpu . ' ' . $gpu->part_number . ' ' . $gpu->memory_capacity . ' - video karte';

        }

        if (\Session::has('psu')) {
            $psu->psu = $psu->psu . ' ' . $psu->part_number . ' ' . $psu->power . 'W' . ' - barošanas bloks';

        }

        if (\Session::has('optical_drive')) {

            foreach ($newoptical_drive as $drive) {

                if ($drive->reader_writer == true) {
                    $drive->reader_writer = 'rakstītājs';
                } else {
                    $drive->reader_writer = 'lasītājs';
                }
                $drive->optical_drive = $drive->optical_drive . $drive->part_number . ' ' . $drive->type . ' ' . $drive->reader_writer . ' - diskdzinis';
            }
        }

        if (\Session::has('sound_card')) {

            foreach ($newsoundcard as $drive) {

                $drive->sound_card = $drive->sound_card . ' ' . $drive->part_number . ' - skaņas karte';
            }
        }

        if (\Session::has('wireless_card')) {

            foreach ($newwirelesscard as $drive) {

                $drive->wireless_card = $drive->wireless_card . ' ' . $drive->part_number . ' - bezvadu tīkla karte';
            }
        }

        if (\Session::has('wired_card')) {

            foreach ($newwiredcard as $drive) {

                $drive->wired_card = $drive->wired_card . ' ' . $drive->part_number . ' ' . $drive->speed . ' - tīkla karte';
            }
        }

        if (\Session::has('case_fan')) {

            foreach ($newcase_fan as $drive) {

                $drive->case_fan = $drive->case_fan . ' ' . $drive->part_number . ' - korpusa dzesētājs';
            }
        }

        $data = ['title' => 'SaliecKompi.lv - compatibility',
            'error' => $error,
            'error_desc' => $error_desc,
            'cpu' => $cpu,
            'memory' => $newmemory,
            'cpu_cooler' => $cpu_cooler,
            'sound_card' => $newsoundcard,
            'wireless_card' => $newwirelesscard,
            'wired_card' => $newwiredcard,
            'motherboard' => $motherboard,
            'storage' => $newstorage,
            'case' => $case,
            'psu' => $psu,
            'optical_drive' => $newoptical_drive,
            'gpu' => $gpu,
            'case_fan' => $newcase_fan,
        ];

        return view('compatibility', $data);

    }
}
