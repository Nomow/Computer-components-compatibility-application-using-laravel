<?php

namespace App\Http\Controllers;

class sessionController extends Controller
{

    public function storeSessionData($name, $value)
    {

        // adding values to session

        switch ($name) {
            case 'cpu':
                \Session::put($name, $value);
                break;
            case 'cpu_cooler':
                \Session::put($name, $value);
                break;

            case 'case':
                \Session::put($name, $value);
                break;

            case 'motherboard':
                \Session::put($name, $value);
                break;
            case 'gpu':
                \Session::put($name, $value);
                break;

            case 'psu':
                \Session::put($name, $value);
                break;

            case 'memory':
                \Session::push($name, $value);
                break;

            case 'sound_card':
                \Session::push($name, $value);
                break;

            case 'wireless_card':
                \Session::push($name, $value);
                break;

            case 'wired_card':
                \Session::push($name, $value);
                break;

            case 'storage':
                \Session::push($name, $value);
                break;

            case 'optical_drive':
                \Session::push($name, $value);
                break;

            case 'case_fan':
                \Session::push($name, $value);
                break;

        }

        return ['name' => $name, 'value' => $value];

    }
//delete all sessions
    public function deleteSessionData()
    {

        \Session::flush();

        return redirect()->route('compatibilityCheck');

    }
//delete session value
    public function deleteSessionValue($name, $value)
    {
        if (\Session::has($name)) {

            if (count(\Session::get($name)) == 1) {
                \Session::forget($name);

            } else {
                $temp = \Session::get($name);
                unset($temp[$value]);

                $newsession = [];
                foreach ($temp as $key => $value) {
                    $newsession[] = $value;
                }
                session([$name => $newsession]);
            }

        }
        return redirect()->route('compatibilityCheck');
    }
}
