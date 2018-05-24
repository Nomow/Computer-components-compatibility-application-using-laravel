<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class partListController extends Controller
{
    public function showAllCpu(Request $request)
    {
        $header = [
            'processor',
            'core_count',
            'frequency',
            'thermal',
            'price',

        ];
// cpu query
        $parts = \DB::table('cpu')->join('manufacturer', 'cpu.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'cpu.part_number', '=', 'price.part_number')->groupby('cpu.part_number')->select(
            'manufacturer.name as processor',
            'cpu.name as name',
            'cpu.core_count as core_count',
            'cpu.frequency as frequency',
            'cpu.thermal_power as thermal',
            \DB::raw('min(price.price) as price'),

            'cpu.slug as slug');

        if ($request->has('sort')) {
            foreach ($header as $val) {
                if ($val == $request->get('sort')) {
                    switch ($request->get('order')) {
                        case 'asc':
                            $parts = $parts->orderBy($request->get('sort'), 'asc');
                            break;
                        case 'desc':
                            $parts = $parts->orderBy($request->get('sort'), 'desc');
                            break;
                    }
                }
            }
        }

        if ($request->has('search')) {
            $parts->where(\DB::raw('CONCAT(manufacturer.name, " ", cpu.name)'), 'like', '%' . $request->get('search') . '%');

        }

        $parts = $parts->paginate(30);

        foreach ($parts as $part) {

            // dd($part->price);
            $part->frequency = $part->frequency . 'GHz';
            $part->thermal = $part->thermal . 'W';
            $part->processor = $part->processor . ' ' . $part->name;

            if (empty($part->price)) {
                $part->price = '&nbsp;';
            } else {
                $part->price = '&euro;' . $part->price;
            }

            unset($part->name);

        }

        $headerval = [];

        foreach ($header as $desc) {

            if (empty($headerval[$desc])) {
                $headerval[$desc] = 'desc';
            }

            if ($request->has('sort')) {
                if ($request->get('sort') == $desc) {
                    if ($request->get('order') == 'desc') {
                        $headerval[$desc] = 'asc';
                    } else {
                        $headerval[$desc] = 'desc';
                    }
                }

            }
        }

        $data = [
            'title' => 'Izvēlies Procesoru',
            'parts' => $parts->appends(Input::except('page')),
            'slug' => 'procesors-',
            'bgImg' => 'cpubg',
            'headTitle' => 'Intel un AMD Procesori',
            'headParagraph' => 'Izvēlies jaunākos un izcilākos procesorus',
            'session_name' => 'cpu',
            'headerval' => $headerval,
            'url' => 'procesori?',

        ];
        if ($parts->currentPage() <= $parts->lastpage()) {
            return view('partlist', $data);
        } else if ($parts->currentpage() > $parts->lastpage() && !$request->has('search')) {
            abort(404, 'Lapa nēeksistē');
        } else {

            return view('partlist', $data);
        }
    }

    public function showAllMemory(Request $request)
    {

        $header = [
            'memory',
            'type',
            'data_rate',
            'capacity',
            'slots',
            'price',
        ];

// part query
        $parts = \DB::table('memory')->join('manufacturer', 'memory.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'memory.part_number', '=', 'price.part_number')->groupby('memory.part_number')->select(

            'manufacturer.name as memory',
            'memory.part_number as part_number',
            'memory.type as type',
            'memory.data_rate',
            'memory.speed as speed',
            'memory.capacity as capacity',
            'memory.slots as slots',
            'memory.capacity_per_slot as capacity_per_slot',

            \DB::raw('min(price.price) as price'),

            'memory.slug as slug');

        if ($request->has('sort')) {
            foreach ($header as $val) {
                if ($val == $request->get('sort')) {
                    switch ($request->get('order')) {
                        case 'asc':
                            $parts = $parts->orderBy($request->get('sort'), 'asc');
                            break;
                        case 'desc':
                            $parts = $parts->orderBy($request->get('sort'), 'desc');
                            break;
                    }
                }
            }
        }

        if ($request->has('search')) {
            $parts->where(\DB::raw('CONCAT(manufacturer.name, " ", memory.part_number)'), 'like', '%' . $request->get('search') . '%');

        }

        $parts = $parts->paginate(30);

        foreach ($parts as $part) {

            $part->memory = $part->memory . ' ' . $part->part_number;
            if ($part->capacity >= 1000) {
                $part->capacity = $part->capacity / 1000 . 'GB';
            } else {
                $part->capacity = $part->capacity . 'MB';
            }
            if ($part->capacity_per_slot >= 1000) {
                $part->capacity_per_slot = $part->capacity_per_slot / 1000 . 'GB';
            } else {
                $part->capacity_per_slot = $part->capacity_per_slot . 'MB';
            }

            $part->slots = $part->slots . ' x ' . $part->capacity_per_slot;

            unset($part->capacity_per_slot);

            $part->type = $part->type . ' DIMM';

            $part->speed = $part->data_rate . ' - ' . $part->speed;
            unset($part->data_rate);

            if (empty($part->price)) {
                $part->price = '&nbsp;';
            } else {
                $part->price = '&euro;' . $part->price;
            }

            unset($part->part_number);

        }

        $headerval = [];

        foreach ($header as $desc) {

            if (empty($headerval[$desc])) {
                $headerval[$desc] = 'desc';
            }

            if ($request->has('sort')) {
                if ($request->get('sort') == $desc) {
                    if ($request->get('order') == 'desc') {
                        $headerval[$desc] = 'asc';
                    } else {
                        $headerval[$desc] = 'desc';
                    }
                }

            }
        }

        $data = [
            'title' => 'Izvēlies operatīvo atmiņu',
            'parts' => $parts->appends(Input::except('page')),
            'slug' => 'operativa-atmina-',
            'bgImg' => 'memorybg',
            'headTitle' => 'Operatīvā atmiņa',
            'headParagraph' => 'Paātrini sava datora ātrdarbību',
            'session_name' => 'memory',
            'headerval' => $headerval,
            'url' => 'operativa-atmina?',
        ];

        if ($parts->currentPage() <= $parts->lastpage()) {
            return view('partlist', $data);
        } else if ($parts->currentpage() > $parts->lastpage() && !$request->has('search')) {
            abort(404, 'Lapa nēeksistē');
        } else {

            return view('partlist', $data);
        }
    }

    public function showAllCpuCoolers(Request $request)
    {

        $header = [
            'cpu_cooler',
            'rpm_from',
            'air_from',
            'thermal',
            'price',

        ];

        $parts = \DB::table('cpu_cooler')->join('manufacturer', 'cpu_cooler.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'cpu_cooler.part_number', '=', 'price.part_number')->groupby('cpu_cooler.part_number')->select(

            'manufacturer.name as cpu_cooler',
            'cpu_cooler.part_number as part_number',
            'cpu_cooler.rpm_from',
            'cpu_cooler.rpm_to',
            'cpu_cooler.air_from',
            'cpu_cooler.air_to',
            'cpu_cooler.thermal_power as thermal',

            \DB::raw('min(price.price) as price'),

            'cpu_cooler.slug as slug');

        if ($request->has('sort')) {
            foreach ($header as $val) {
                if ($val == $request->get('sort')) {
                    switch ($request->get('order')) {
                        case 'asc':
                            $parts = $parts->orderBy($request->get('sort'), 'asc');
                            break;
                        case 'desc':
                            $parts = $parts->orderBy($request->get('sort'), 'desc');
                            break;
                    }
                }
            }
        }

        if ($request->has('search')) {
            $parts->where(\DB::raw('CONCAT(manufacturer.name, " ", cpu_cooler.part_number)'), 'like', '%' . $request->get('search') . '%');

        }

        $parts = $parts->paginate(30);

        foreach ($parts as $part) {

            $part->cpu_cooler = $part->cpu_cooler . ' ' . $part->part_number;

//RPM
            if (is_null($part->rpm_from) && is_null($part->rpm_to)) {
                $part->rpm_from = '&nbsp;';
                unset($part->rpm_to);
            } else if (!is_null($part->rpm_from) && is_null($part->rpm_to)) {
                unset($part->rpm_to);
                $part->rpm_from = $part->rpm_from . ' RPM';

            } else if (is_null($part->rpm_from) && !is_null($part->rpm_to)) {
                $part->rpm_from = $part->rpm_to;
                unset($part->rpm_to);
                $part->rpm_from = $part->rpm_from . ' RPM';

            } else {
                $part->rpm_from = $part->rpm_from . ' - ' . $part->rpm_to;
                unset($part->rpm_to);
                $part->rpm_from = $part->rpm_from . ' RPM';

            }

//AIR
            if (is_null($part->air_from) && is_null($part->air_to)) {
                $part->air_from = '&nbsp;';
                unset($part->air_to);

            } else if (!is_null($part->air_from) && is_null($part->air_to)) {

                unset($part->air_to);
                $part->air_from = $part->air_from . ' CFM';

            } else if (is_null($part->air_from) && !is_null($part->air_to)) {

                $part->air_from = $part->air_to;
                unset($part->air_to);
                $part->air_from = $part->air_from . ' CFM';

            } else {
                $part->air_from = $part->air_from . ' - ' . $part->air_to;
                unset($part->air_to);
                $part->air_from = $part->air_from . ' CFM';
            }

            $part->thermal = $part->thermal . 'W';

            if (empty($part->price)) {
                $part->price = '&nbsp;';
            } else {
                $part->price = '&euro;' . $part->price;
            }

            unset($part->part_number);

        }

        $headerval = [];

        foreach ($header as $desc) {

            if (empty($headerval[$desc])) {
                $headerval[$desc] = 'desc';
            }

            if ($request->has('sort')) {
                if ($request->get('sort') == $desc) {
                    if ($request->get('order') == 'desc') {
                        $headerval[$desc] = 'asc';
                    } else {
                        $headerval[$desc] = 'desc';
                    }
                }

            }
        }

        $data = [
            'title' => 'Izvēlies procesora dzesētāju',
            'parts' => $parts->appends(Input::except('page')),
            'slug' => 'procesora-dzesetajs-',
            'bgImg' => 'cpucoolerbg',
            'headTitle' => 'Procesora dzesētāji',
            'headParagraph' => 'Izbaudi augstu veiktspēju un zemu temperatūru',
            'session_name' => 'cpu_cooler',
            'headerval' => $headerval,
            'url' => 'procesora-dzesetaji?',

        ];

        if ($parts->currentPage() <= $parts->lastpage()) {
            return view('partlist', $data);
        } else if ($parts->currentpage() > $parts->lastpage() && !$request->has('search')) {
            abort(404, 'Lapa nēeksistē');
        } else {

            return view('partlist', $data);
        }
    }

    public function showAllStorage(Request $request)
    {

        $header = [
            'storage',
            'type',
            'capacity',
            'cache',
            'price',
        ];

// cpu query
        $parts = \DB::table('storage')->join('manufacturer', 'storage.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'storage.part_number', '=', 'price.part_number')->groupby('storage.part_number')->select(
            'manufacturer.name as storage',
            'storage.part_number',
            'storage.type as type',
            'storage.capacity',
            'storage.cache', \DB::raw('min(price.price) as price'),

            'storage.slug as slug');

        if ($request->has('sort')) {
            foreach ($header as $val) {
                if ($val == $request->get('sort')) {
                    switch ($request->get('order')) {
                        case 'asc':
                            $parts = $parts->orderBy($request->get('sort'), 'asc');
                            break;
                        case 'desc':
                            $parts = $parts->orderBy($request->get('sort'), 'desc');
                            break;
                    }
                }
            }
        }

        if ($request->has('search')) {
            $parts->where(\DB::raw('CONCAT(manufacturer.name, " ", storage.part_number)'), 'like', '%' . $request->get('search') . '%');

        }

        $parts = $parts->paginate(30);

        foreach ($parts as $part) {

            $part->storage = $part->storage . ' ' . $part->part_number;

            if (is_null($part->cache)) {
                $part->cache = '&nbsp;';
            } else {
                $part->cache = $part->cache . 'MB';
            }

            if ($part->capacity >= 1000) {
                $part->capacity = $part->capacity / 1000 . 'TB';

            } else {
                $part->capacity = $part->capacity . 'GB';
            }
            if (empty($part->price)) {
                $part->price = '&nbsp;';
            } else {
                $part->price = '&euro;' . $part->price;
            }

            unset($part->part_number);

        }

        $headerval = [];

        foreach ($header as $desc) {

            if (empty($headerval[$desc])) {
                $headerval[$desc] = 'desc';
            }

            if ($request->has('sort')) {
                if ($request->get('sort') == $desc) {
                    if ($request->get('order') == 'desc') {
                        $headerval[$desc] = 'asc';
                    } else {
                        $headerval[$desc] = 'desc';
                    }
                }

            }
        }
        $data = [
            'title' => 'Izvēlies atmiņu',
            'parts' => $parts->appends(Input::except('page')),
            'slug' => 'atmina-',
            'bgImg' => 'storagebg',
            'headTitle' => 'Cietie diski',
            'headParagraph' => 'Glabā savas bildes, filmas, spēles un...',
            'session_name' => 'storage',
            'headerval' => $headerval,
            'url' => 'atminas?',

        ];

        if ($parts->currentPage() <= $parts->lastpage()) {
            return view('partlist', $data);
        } else if ($parts->currentpage() > $parts->lastpage() && !$request->has('search')) {
            abort(404, 'Lapa nēeksistē');
        } else {

            return view('partlist', $data);
        }
    }

    public function showAllSoundCard(Request $request)
    {

        $header = [
            'sound_card',
            'chipset',
            'channel',
            'digital_audio',
            'price',

        ];

        $parts = \DB::table('sound_card')->join('manufacturer', 'sound_card.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'sound_card.part_number', '=', 'price.part_number')->groupby('sound_card.part_number')->select(
            'manufacturer.name as sound_card',
            'sound_card.part_number',
            'sound_card.chipset as chipset',
            'sound_card.channel as channel',
            'sound_card.digital_audio as digital_audio',
            \DB::raw('min(price.price) as price'),

            'sound_card.slug as slug');

        if ($request->has('sort')) {
            foreach ($header as $val) {
                if ($val == $request->get('sort')) {
                    switch ($request->get('order')) {
                        case 'asc':
                            $parts = $parts->orderBy($request->get('sort'), 'asc');
                            break;
                        case 'desc':
                            $parts = $parts->orderBy($request->get('sort'), 'desc');
                            break;
                    }
                }
            }
        }

        if ($request->has('search')) {
            $parts->where(\DB::raw('CONCAT(manufacturer.name, " ", sound_card.part_number)'), 'like', '%' . $request->get('search') . '%');

        }

        $parts = $parts->paginate(30);

        foreach ($parts as $part) {

            $part->sound_card = $part->sound_card . ' ' . $part->part_number;
            unset($part->part_number);

            if (is_null($part->chipset)) {
                $part->chipset = '&nbsp;';
            }

            if (is_null($part->digital_audio)) {
                $part->digital_audio = '&nbsp;';
            }

            if (empty($part->price)) {
                $part->price = '&nbsp;';
            } else {
                $part->price = '&euro;' . $part->price;
            }

        }

        $headerval = [];

        foreach ($header as $desc) {

            if (empty($headerval[$desc])) {
                $headerval[$desc] = 'desc';
            }

            if ($request->has('sort')) {
                if ($request->get('sort') == $desc) {
                    if ($request->get('order') == 'desc') {
                        $headerval[$desc] = 'asc';
                    } else {
                        $headerval[$desc] = 'desc';
                    }
                }

            }
        }

        $data = [
            'title' => 'Izvēlies skaņas karti ',
            'parts' => $parts->appends(Input::except('page')),
            'slug' => 'skanas-karte-',
            'bgImg' => 'soundcardbg',
            'headTitle' => 'Skaņas kartes',
            'headParagraph' => 'Uzlabo sava datora skaņas kvalitāti',
            'session_name' => 'sound_card',
            'headerval' => $headerval,
            'url' => 'skanas-kartes?',
        ];

        if ($parts->currentPage() <= $parts->lastpage()) {
            return view('partlist', $data);
        } else if ($parts->currentpage() > $parts->lastpage() && !$request->has('search')) {
            abort(404, 'Lapa nēeksistē');
        } else {

            return view('partlist', $data);
        }
    }

    public function showAllWirelessCard(Request $request)
    {

        $header = [
            'wireless_card',
            'interface',
            'protocol',
            'price',
        ];

        $parts = \DB::table('wireless_card')->join('manufacturer', 'wireless_card.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'wireless_card.part_number', '=', 'price.part_number')->groupby('wireless_card.part_number')->select(
            'manufacturer.name as wireless_card',
            'wireless_card.part_number as part_number',
            'wireless_card.interface as interface',
            'wireless_card.protocol as protocol',
            \DB::raw('min(price.price) as price'),

            'wireless_card.slug as slug');

        if ($request->has('sort')) {
            foreach ($header as $val) {
                if ($val == $request->get('sort')) {
                    switch ($request->get('order')) {
                        case 'asc':
                            $parts = $parts->orderBy($request->get('sort'), 'asc');
                            break;
                        case 'desc':
                            $parts = $parts->orderBy($request->get('sort'), 'desc');
                            break;
                    }
                }
            }
        }

        if ($request->has('search')) {
            $parts->where(\DB::raw('CONCAT(manufacturer.name, " ", wireless_card.part_number)'), 'like', '%' . $request->get('search') . '%');

        }

        $parts = $parts->paginate(30);
        foreach ($parts as $part) {

            $part->wireless_card = $part->wireless_card . ' ' . $part->part_number;
            unset($part->part_number);

            if (empty($part->price)) {
                $part->price = '&nbsp;';
            } else {
                $part->price = '&euro;' . $part->price;
            }

        }

        $headerval = [];

        foreach ($header as $desc) {

            if (empty($headerval[$desc])) {
                $headerval[$desc] = 'desc';
            }

            if ($request->has('sort')) {
                if ($request->get('sort') == $desc) {
                    if ($request->get('order') == 'desc') {
                        $headerval[$desc] = 'asc';
                    } else {
                        $headerval[$desc] = 'desc';
                    }
                }

            }
        }

        $data = [
            'title' => 'Izvēlies bezvadu tīkla karti ',
            'parts' => $parts->appends(Input::except('page')),
            'slug' => 'bezvadu-tikla-karte-',
            'bgImg' => 'wirelesscardbg',
            'headTitle' => 'Bezvadu tīkla kartes',
            'headParagraph' => 'Ienīsti vadus? Atbrīvojies no tiem un iegūsti bezvada piekļuvi visā mājā',
            'session_name' => 'wireless_card',
            'headerval' => $headerval,
            'url' => 'bezvadu-tikla-kartes?',

        ];

        if ($parts->currentPage() <= $parts->lastpage()) {
            return view('partlist', $data);
        } else if ($parts->currentpage() > $parts->lastpage() && !$request->has('search')) {
            abort(404, 'Lapa nēeksistē');
        } else {

            return view('partlist', $data);
        }
    }

    public function showAllWiredCard(Request $request)
    {

        $header = [
            'wired_card',
            'interface',
            'connector',
            'speed',
            'price',
        ];

        $parts = \DB::table('wired_card')->join('manufacturer', 'wired_card.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'wired_card.part_number', '=', 'price.part_number')->groupby('wired_card.part_number')->select(
            'manufacturer.name as wired_card',
            'wired_card.part_number as part_number',
            'wired_card.interface as interface',
            'wired_card.connector as connector',
            'wired_card.speed as speed',
            \DB::raw('min(price.price) as price'),

            'wired_card.slug as slug');

        if ($request->has('sort')) {
            foreach ($header as $val) {
                if ($val == $request->get('sort')) {
                    switch ($request->get('order')) {
                        case 'asc':
                            $parts = $parts->orderBy($request->get('sort'), 'asc');
                            break;
                        case 'desc':
                            $parts = $parts->orderBy($request->get('sort'), 'desc');
                            break;
                    }
                }
            }
        }

        if ($request->has('search')) {
            $parts->where(\DB::raw('CONCAT(manufacturer.name, " ", wired_card.part_number)'), 'like', '%' . $request->get('search') . '%');

        }

        $parts = $parts->paginate(30);
        foreach ($parts as $part) {

            $part->wired_card = $part->wired_card . ' ' . $part->part_number;
            unset($part->part_number);

            if (empty($part->price)) {
                $part->price = '&nbsp;';
            } else {
                $part->price = '&euro;' . $part->price;
            }

        }

        $headerval = [];

        foreach ($header as $desc) {

            if (empty($headerval[$desc])) {
                $headerval[$desc] = 'desc';
            }

            if ($request->has('sort')) {
                if ($request->get('sort') == $desc) {
                    if ($request->get('order') == 'desc') {
                        $headerval[$desc] = 'asc';
                    } else {
                        $headerval[$desc] = 'desc';
                    }
                }

            }
        }

        $data = [
            'title' => 'Izvēlies Tīkla karti ',
            'parts' => $parts->appends(Input::except('page')),
            'slug' => 'tikla-karte-',
            'bgImg' => 'wiredcardbg',
            'headTitle' => 'Tīkla kartes',
            'headParagraph' => 'Izmanto sava interneta ātrumu pilnā apjomā',
            'session_name' => 'wired_card',
            'headerval' => $headerval,
            'url' => 'tikla-kartes?',

        ];

        if ($parts->currentPage() <= $parts->lastpage()) {
            return view('partlist', $data);
        } else if ($parts->currentpage() > $parts->lastpage() && !$request->has('search')) {
            abort(404, 'Lapa nēeksistē');
        } else {

            return view('partlist', $data);
        }
    }

    public function showAllCase(Request $request)
    {

        $header = [
            'case',
            'type',
            'external_525',
            'external_35',
            'price',
        ];

        $parts = \DB::table('case')->join('manufacturer', 'case.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'case.part_number', '=', 'price.part_number')->groupby('case.part_number')->select(
            'manufacturer.name as case',

            'case.part_number as part_number',
            'case.type as type',
            'case.external_525 as external_525',
            'case.external_35 as external_35',
            \DB::raw('min(price.price) as price'),

            'case.slug as slug');

        if ($request->has('sort')) {
            foreach ($header as $val) {
                if ($val == $request->get('sort')) {
                    switch ($request->get('order')) {
                        case 'asc':
                            $parts = $parts->orderBy($request->get('sort'), 'asc');
                            break;
                        case 'desc':
                            $parts = $parts->orderBy($request->get('sort'), 'desc');
                            break;
                    }
                }
            }
        }

        if ($request->has('search')) {
            $parts->where(\DB::raw('CONCAT(manufacturer.name, " ", case.part_number)'), 'like', '%' . $request->get('search') . '%');

        }

        $parts = $parts->paginate(30);
        foreach ($parts as $part) {
            $part->external_525 = strval($part->external_525);
            $part->external_35 = strval($part->external_35);

            $part->case = $part->case . ' ' . $part->part_number;

            unset($part->part_number);

            if (empty($part->price)) {
                $part->price = '&nbsp;';
            } else {
                $part->price = '&euro;' . $part->price;
            }

        }

        $headerval = [];

        foreach ($header as $desc) {

            if (empty($headerval[$desc])) {
                $headerval[$desc] = 'desc';
            }

            if ($request->has('sort')) {
                if ($request->get('sort') == $desc) {
                    if ($request->get('order') == 'desc') {
                        $headerval[$desc] = 'asc';
                    } else {
                        $headerval[$desc] = 'desc';
                    }
                }

            }
        }

        $data = [
            'title' => 'Izvēlies Korpusu',
            'parts' => $parts->appends(Input::except('page')),
            'slug' => 'korpuss-',
            'bgImg' => 'casebg',
            'headTitle' => 'Korpusi',
            'headParagraph' => 'No maziem līdz lieliem formas dizainiem',
            'session_name' => 'case',
            'headerval' => $headerval,
            'url' => 'korpusi?',

        ];

        if ($parts->currentPage() <= $parts->lastpage()) {
            return view('partlist', $data);
        } else if ($parts->currentpage() > $parts->lastpage() && !$request->has('search')) {
            abort(404, 'Lapa nēeksistē');
        } else {

            return view('partlist', $data);
        }
    }

    public function showAllGpu(Request $request)
    {

        $header = [
            'gpu',
            'series',
            'memory_capacity',
            'frequency',
            'price',
        ];

        $parts = \DB::table('gpu')->join('manufacturer', 'gpu.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'gpu.part_number', '=', 'price.part_number')->groupby('gpu.part_number')->select(
            'manufacturer.name as gpu',
            'gpu.part_number as part_number',
            'gpu.chipset as series',
            'gpu.memory_capacity as memory_capacity',
            'gpu.frequency as frequency',

            \DB::raw('min(price.price) as price'),

            'gpu.slug as slug');

        if ($request->has('sort')) {
            foreach ($header as $val) {
                if ($val == $request->get('sort')) {
                    switch ($request->get('order')) {
                        case 'asc':
                            $parts = $parts->orderBy($request->get('sort'), 'asc');
                            break;
                        case 'desc':
                            $parts = $parts->orderBy($request->get('sort'), 'desc');
                            break;
                    }
                }
            }
        }

        if ($request->has('search')) {
            $parts->where(\DB::raw('CONCAT(manufacturer.name, " ", gpu.part_number)'), 'like', '%' . $request->get('search') . '%');

        }

        $parts = $parts->paginate(30);

        foreach ($parts as $part) {

            $part->gpu = $part->gpu . ' ' . $part->part_number;

            unset($part->part_number);
            if ($part->memory_capacity >= 1000) {
                $part->memory_capacity = $part->memory_capacity / 1000 . 'GB';
            } else {
                $part->memory_capacity = $part->memory_capacity . 'MB';
            }

            if (is_null($part->series)) {
                $part->series = '&nbsp;';
            }

            if (is_null($part->frequency)) {
                $part->frequency = '&nbsp;';
            } else {
                if ($part->frequency >= 1000) {
                    $part->frequency = $part->frequency / 1000 . 'GHz';
                } else {
                    $part->frequency = $part->frequency . 'MHz';
                }
            }

            if (empty($part->price)) {
                $part->price = '&nbsp;';
            } else {
                $part->price = '&euro;' . $part->price;
            }

        }

        $headerval = [];

        foreach ($header as $desc) {

            if (empty($headerval[$desc])) {
                $headerval[$desc] = 'desc';
            }

            if ($request->has('sort')) {
                if ($request->get('sort') == $desc) {
                    if ($request->get('order') == 'desc') {
                        $headerval[$desc] = 'asc';
                    } else {
                        $headerval[$desc] = 'desc';
                    }
                }

            }
        }

        $data = [
            'title' => 'Izvēlies video karti',
            'parts' => $parts->appends(Input::except('page')),
            'slug' => 'video-karte-',
            'bgImg' => 'gpubg',
            'headTitle' => 'Video kartes',
            'headParagraph' => 'Uzlabo sava datora vizualizāciju',
            'session_name' => 'gpu',
            'headerval' => $headerval,
            'url' => 'video-kartes?',

        ];

        if ($parts->currentPage() <= $parts->lastpage()) {
            return view('partlist', $data);
        } else if ($parts->currentpage() > $parts->lastpage() && !$request->has('search')) {
            abort(404, 'Lapa nēeksistē');
        } else {

            return view('partlist', $data);
        }
    }

    public function showAllPsu(Request $request)
    {

        $header = [
            'psu',
            'efficiency',
            'power',
            'modular',
            'type',
            'price',
        ];

        $parts = \DB::table('psu')->join('manufacturer', 'psu.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'psu.part_number', '=', 'price.part_number')->groupby('psu.part_number')->select(
            'manufacturer.name as psu',
            'psu.part_number as part_number',
            'psu.efficiency as efficiency',
            'psu.power as power',
            'psu.modular as modular',
            'psu.main_connector as type',
            \DB::raw('min(price.price) as price'),
            'psu.slug as slug');

        if ($request->has('sort')) {
            foreach ($header as $val) {
                if ($val == $request->get('sort')) {
                    switch ($request->get('order')) {
                        case 'asc':
                            $parts = $parts->orderBy($request->get('sort'), 'asc');
                            break;
                        case 'desc':
                            $parts = $parts->orderBy($request->get('sort'), 'desc');
                            break;
                    }
                }
            }
        }

        if ($request->has('search')) {
            $parts->where(\DB::raw('CONCAT(manufacturer.name, " ", psu.part_number)'), 'like', '%' . $request->get('search') . '%');

        }

        $parts = $parts->paginate(30);

        foreach ($parts as $part) {

            if ($part->modular == true) {
                $part->modular = 'Ir';
            } else {
                $part->modular = 'Nav';
            }

            $part->psu = $part->psu . ' ' . $part->part_number;
            unset($part->part_number);

            if (empty($part->price)) {
                $part->price = '&nbsp;';
            } else {
                $part->price = '&euro;' . $part->price;
            }

        }

        $headerval = [];

        foreach ($header as $desc) {

            if (empty($headerval[$desc])) {
                $headerval[$desc] = 'desc';
            }

            if ($request->has('sort')) {
                if ($request->get('sort') == $desc) {
                    if ($request->get('order') == 'desc') {
                        $headerval[$desc] = 'asc';
                    } else {
                        $headerval[$desc] = 'desc';
                    }
                }

            }
        }

        $data = [
            'title' => 'Izvēlies barošanas bloku',
            'parts' => $parts->appends(Input::except('page')),
            'slug' => 'barosanas-bloks-',
            'bgImg' => 'psubg',
            'headTitle' => 'Barošanas bloki',
            'headParagraph' => 'Stabili, uzticami, un efektīva jaudas pārveidošana tavam datoram',
            'session_name' => 'psu',
            'headerval' => $headerval,
            'url' => 'barosanas-bloki?',

        ];

        if ($parts->currentPage() <= $parts->lastpage()) {
            return view('partlist', $data);
        } else if ($parts->currentpage() > $parts->lastpage() && !$request->has('search')) {
            abort(404, 'Lapa nēeksistē');
        } else {

            return view('partlist', $data);
        }
    }

    public function showAllMobo(Request $request)
    {

        $header = [
            'motherboard',
            'form_factor',
            'socket',
            'memory_slots',
            'max_capacity',
            'price',

        ];

        $parts = \DB::table('motherboard')->join('manufacturer', 'motherboard.manufacturer_id', '=', 'manufacturer.id')->leftjoin('motherboard_socket', 'motherboard.id', '=', 'motherboard_socket.motherboard_id')->leftjoin('price', 'motherboard.part_number', '=', 'price.part_number')->groupby('motherboard.part_number')->select(
            'manufacturer.name as motherboard',
            'motherboard.part_number as part_number',
            'motherboard.form_factor as form_factor',
            \DB::raw('GROUP_CONCAT( motherboard_socket.name SEPARATOR " / ") AS socket'),
            'motherboard.memory_slots as memory_slots',
            'motherboard.max_capacity as max_capacity',
            \DB::raw('min(price.price) as price'),

            'motherboard.slug as slug');

        if ($request->has('sort')) {
            foreach ($header as $val) {
                if ($val == $request->get('sort')) {
                    switch ($request->get('order')) {
                        case 'asc':
                            $parts = $parts->orderBy($request->get('sort'), 'asc');
                            break;
                        case 'desc':
                            $parts = $parts->orderBy($request->get('sort'), 'desc');
                            break;
                    }
                }
            }
        }

        if ($request->has('search')) {
            $parts->where(\DB::raw('CONCAT(manufacturer.name, " ", motherboard.part_number)'), 'like', '%' . $request->get('search') . '%');

        }

        $parts = $parts->paginate(30);

        foreach ($parts as $part) {

            $part->motherboard = $part->motherboard . ' ' . $part->part_number;
            unset($part->part_number);

            if ($part->max_capacity >= 1000) {
                $part->max_capacity = $part->max_capacity / 1000 . 'GB';
            } else {
                $part->max_capacity = $part->max_capacity . 'MB';
            }
            if (empty($part->price)) {
                $part->price = '&nbsp;';
            } else {
                $part->price = '&euro;' . $part->price;
            }

        }

        $headerval = [];

        foreach ($header as $desc) {

            if (empty($headerval[$desc])) {
                $headerval[$desc] = 'desc';
            }

            if ($request->has('sort')) {
                if ($request->get('sort') == $desc) {
                    if ($request->get('order') == 'desc') {
                        $headerval[$desc] = 'asc';
                    } else {
                        $headerval[$desc] = 'desc';
                    }
                }

            }
        }

        $data = [
            'title' => 'Izvēlies mātesplati',
            'parts' => $parts->appends(Input::except('page')),
            'slug' => 'matesplate-',
            'bgImg' => 'motherboardbg',
            'headTitle' => 'Mātesplates',
            'headParagraph' => 'Atrodi Mikroshēmojumu un nepieciešamos interfeisus ',
            'session_name' => 'motherboard',
            'headerval' => $headerval,
            'url' => 'matesplates?',
        ];

        if ($parts->currentPage() <= $parts->lastpage()) {
            return view('partlist', $data);
        } else if ($parts->currentpage() > $parts->lastpage() && !$request->has('search')) {
            abort(404, 'Lapa nēeksistē');
        } else {

            return view('partlist', $data);
        }
    }

    public function showAllOpticalDrive(Request $request)
    {

        $header = [
            'optical_drive',
            'bd',
            'dvd',
            'cd',
            'cd_write',
            'dvd_write',
            'bd_write',
            'price',
        ];

        $parts = \DB::table('optical_drive')->join('manufacturer', 'optical_drive.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'optical_drive.part_number', '=', 'price.part_number')->groupby('optical_drive.part_number')->select(
            'manufacturer.name as optical_drive',
            'optical_drive.part_number as part_number',
            'optical_drive.bd_rom as bd',
            'optical_drive.dvd_rom as dvd',
            'optical_drive.cd_rom as cd',
            'optical_drive.cd_r as cd_write',
            'optical_drive.cd_rw as cd_rw',
            'optical_drive.dvd_r as dvd_write',
            'optical_drive.dvd_plus_r as dvd_plus_r',
            'optical_drive.dvd_plus_r_dual as dvd_plus_r_dual',
            'optical_drive.dvd_plus_rw as dvd_plus_rw',
            'optical_drive.dvd_r_dual as dvd_r_dual',
            'optical_drive.dvd_ram as dvd_ram',
            'optical_drive.dvd_r as dvd_r',
            'optical_drive.dvd_rw as dvd_rw',
            'optical_drive.bd_r as bd_write',
            'optical_drive.bd_re as bd_re',

            \DB::raw('min(price.price) as price'),

            'optical_drive.slug as slug');

        if ($request->has('sort')) {
            foreach ($header as $val) {
                if ($val == $request->get('sort')) {
                    switch ($request->get('order')) {
                        case 'asc':
                            $parts = $parts->orderBy($request->get('sort'), 'asc');
                            break;
                        case 'desc':
                            $parts = $parts->orderBy($request->get('sort'), 'desc');
                            break;
                    }
                }
            }
        }

        if ($request->has('search')) {
            $parts->where(\DB::raw('CONCAT(manufacturer.name, " ", optical_drive.part_number)'), 'like', '%' . $request->get('search') . '%');

        }

        $parts = $parts->paginate(30);

        foreach ($parts as $part) {

            $part->optical_drive = $part->optical_drive . ' ' . $part->part_number;
            unset($part->part_number);

// bd , cd/ dvd
            if (is_null($part->bd)) {
                $part->bd = '-';
            }
            if (is_null($part->cd)) {
                $part->cd = '-';
            }
            if (is_null($part->dvd)) {
                $part->dvd = '-';
            }

//cd
            if (is_null($part->cd_write)) {
                $part->cd_write = '-';
            }

            if (is_null($part->cd_rw)) {
                $part->cd_rw = '-';
            }

// dvd

            if (is_null($part->dvd_write)) {
                $part->dvd_write = '-';
            }

            if (is_null($part->dvd_plus_r)) {
                $part->dvd_plus_r = '-';
            }

            if (is_null($part->dvd_plus_r_dual)) {
                $part->dvd_plus_r_dual = '-';
            }

            if (is_null($part->dvd_plus_rw)) {
                $part->dvd_plus_rw = '-';
            }

            if (is_null($part->dvd_r_dual)) {
                $part->dvd_r_dual = '-';
            }

            if (is_null($part->dvd_ram)) {
                $part->dvd_ram = '-';
            }

            if (is_null($part->dvd_r)) {
                $part->dvd_r = '-';
            }

            if (is_null($part->dvd_rw)) {
                $part->dvd_rw = '-';
            }

//bd
            if (is_null($part->bd_write)) {
                $part->bd_write = '-';
            }

            if (is_null($part->bd_re)) {
                $part->bd_re = '-';
            }

            $part->cd_write = $part->cd_write
            . '/' . $part->cd_rw;

            unset($part->cd_rw);
            $part->dvd_write =
            $part->dvd_write
            . '/' . $part->dvd_plus_r
            . '/' . $part->dvd_plus_r_dual
            . '/' . $part->dvd_plus_rw
            . '/' . $part->dvd_r_dual
            . '/' . $part->dvd_ram
            . '/' . $part->dvd_r
            . '/' . $part->dvd_rw;

            unset($part->dvd_plus_r);
            unset($part->dvd_plus_r_dual);
            unset($part->dvd_plus_rw);
            unset($part->dvd_r_dual);
            unset($part->dvd_ram);
            unset($part->dvd_r);
            unset($part->dvd_rw);

            $part->bd_write =
            $part->bd_write
            . '/' . $part->bd_re;

            unset($part->bd_re);

            if (empty($part->price)) {
                $part->price = '&nbsp;';
            } else {
                $part->price = '&euro;' . $part->price;
            }

        }

        $headerval = [];

        foreach ($header as $desc) {

            if (empty($headerval[$desc])) {
                $headerval[$desc] = 'desc';
            }

            if ($request->has('sort')) {
                if ($request->get('sort') == $desc) {
                    if ($request->get('order') == 'desc') {
                        $headerval[$desc] = 'asc';
                    } else {
                        $headerval[$desc] = 'desc';
                    }
                }

            }
        }
        $data = [
            'title' => 'Izvēlies diskdzini',
            'parts' => $parts->appends(Input::except('page')),
            'slug' => 'diskdzinis-',
            'bgImg' => 'opticaldrivebg',
            'headTitle' => 'Diskdziņi',
            'headParagraph' => 'Raksti un lasi visu veida diskus.',
            'session_name' => 'optical_drive',
            'headerval' => $headerval,
            'url' => 'diskdzini?',

        ];

        if ($parts->currentPage() <= $parts->lastpage()) {
            return view('partlist', $data);
        } else if ($parts->currentpage() > $parts->lastpage() && !$request->has('search')) {
            abort(404, 'Lapa nēeksistē');
        } else {

            return view('partlist', $data);
        }
    }

    public function showAllCaseFan(Request $request)
    {

        $header = [
            'case_fan',
            'rpm_from',
            'air_from',
            'size',
            'price',
        ];

        $parts = \DB::table('case_fan')->join('manufacturer', 'case_fan.manufacturer_id', '=', 'manufacturer.id')->leftjoin('price', 'case_fan.part_number', '=', 'price.part_number')->groupby('case_fan.part_number')->select(

            'manufacturer.name as case_fan',
            'case_fan.part_number as part_number',
            'case_fan.rpm_from',
            'case_fan.rpm_to',
            'case_fan.air_from',
            'case_fan.air_to',
            'case_fan.size',

            \DB::raw('min(price.price) as price'),

            'case_fan.slug as slug');

        if ($request->has('sort')) {
            foreach ($header as $val) {
                if ($val == $request->get('sort')) {
                    switch ($request->get('order')) {
                        case 'asc':
                            $parts = $parts->orderBy($request->get('sort'), 'asc');
                            break;
                        case 'desc':
                            $parts = $parts->orderBy($request->get('sort'), 'desc');
                            break;
                    }
                }
            }
        }

        if ($request->has('search')) {
            $parts->where(\DB::raw('CONCAT(manufacturer.name, " ", case_fan.part_number)'), 'like', '%' . $request->get('search') . '%');

        }

        $parts = $parts->paginate(30);

        foreach ($parts as $part) {

            $part->case_fan = $part->case_fan . ' ' . $part->part_number;

//RPM
            if (is_null($part->rpm_from) && is_null($part->rpm_to)) {
                $part->rpm_from = '&nbsp;';
                unset($part->rpm_to);

            } else if (!is_null($part->rpm_from) && is_null($part->rpm_to)) {
                unset($part->rpm_to);
                $part->rpm_from = $part->rpm_from . ' RPM';

            } else if (is_null($part->rpm_from) && !is_null($part->rpm_to)) {
                $part->rpm_from = $part->rpm_to;
                unset($part->rpm_to);
                $part->rpm_from = $part->rpm_from . ' RPM';

            } else {
                $part->rpm_from = $part->rpm_from . ' - ' . $part->rpm_to;
                unset($part->rpm_to);
                $part->rpm_from = $part->rpm_from . ' RPM';

            }

//AIR
            if (is_null($part->air_from) && is_null($part->air_to)) {
                $part->air_from = '&nbsp;';
                unset($part->air_to);

            } else if (!is_null($part->air_from) && is_null($part->air_to)) {

                unset($part->air_to);
                $part->air_from = $part->air_from . ' CFM';

            } else if (is_null($part->air_from) && !is_null($part->air_to)) {

                $part->air_from = $part->air_to;
                unset($part->air_to);
                $part->air_from = $part->air_from . ' CFM';

            } else {
                $part->air_from = $part->air_from . ' - ' . $part->air_to;
                unset($part->air_to);
                $part->air_from = $part->air_from . ' CFM';
            }

            $part->size = $part->size . 'mm';

            if (empty($part->price)) {
                $part->price = '&nbsp;';
            } else {
                $part->price = '&euro;' . $part->price;
            }

            unset($part->part_number);

        }

        $headerval = [];

        foreach ($header as $desc) {

            if (empty($headerval[$desc])) {
                $headerval[$desc] = 'desc';
            }

            if ($request->has('sort')) {
                if ($request->get('sort') == $desc) {
                    if ($request->get('order') == 'desc') {
                        $headerval[$desc] = 'asc';
                    } else {
                        $headerval[$desc] = 'desc';
                    }
                }

            }
        }

        $data = [
            'title' => 'Izvēlies korpusa dzesētāji ',
            'parts' => $parts->appends(Input::except('page')),
            'slug' => 'korpusa-ventilators-',
            'bgImg' => 'casefanbg',
            'headTitle' => 'Korpusa dzesētāji',
            'headParagraph' => 'Samazini sava datora kopējo temperatūru',
            'session_name' => 'case_fan',
            'headerval' => $headerval,
            'url' => 'korpusa-ventilatori?',

        ];

        if ($parts->currentPage() <= $parts->lastpage()) {
            return view('partlist', $data);
        } else if ($parts->currentpage() > $parts->lastpage() && !$request->has('search')) {
            abort(404, 'Lapa nēeksistē');
        } else {

            return view('partlist', $data);
        }
    }

}
