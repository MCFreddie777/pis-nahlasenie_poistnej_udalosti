<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Driver;
use App\DrivingLicence;
use App\DrivingLicenceGroup;
use App\InsuranceEvent as Event;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class InsuranceEventController extends Controller
{
    public function index()
    {
        $events = Gate::allows('admin') ?
            Event::all() :
            Event::whereIn(
                'contract_id',
                Contract::where('user_id', Auth::id())->pluck('id')
            )->get();

        return view('events.index')
            ->with('events', $events);
    }

    public function create(Request $request)
    {
        $contract = Contract::findOrFail($request->get('id'));

        $this->checkPermissions($contract);

        return view('events.create')
            ->with('contract', $contract);
    }

    public function store(Request $request)
    {
        $contract = Contract::findOrFail($request->get('contract_id'));

        $this->checkPermissions($contract);

        // Validate request
        $request->validate($this->rules(), $this->messages());

        $data = $request->all();

        $drivers = [];
        $driver_fields = ['v0', 'v1'];
        $licence_fields = ['licence_id', 'group', 'valid_from', 'valid_to', 'issued_by'];

        foreach ($driver_fields as $key) {

            $result = arrayExclude($data[$key], $licence_fields, true);

            // Find or create new driving licence
            $licence = DrivingLicence::where('licence_id', $data[$key]['licence_id'])->first();

            if (!$licence) {
                $licence = new DrivingLicence(arrayExclude($result['excluded'], ['group']));
                $licence->save();
            }

            // Sync driving license groups to driving license
            foreach ($result['excluded']['group'] as $groupName) {
                $group = DrivingLicenceGroup::whereName($groupName)->first();
                if (!$licence->groups->contains('name', $groupName))
                    $licence->groups()->attach($group);
            }

            // Create new driver
            $driver = new Driver(array_filter($result['items'], function ($item) {
                // filter null items from array
                return !is_null($item);
            }));

            // Attach license to the driver
            $driver->licence()->associate($licence)->save();

            array_push($drivers, $driver);
        }

        // Well, basically what this does is removes 'contract_id' from arguments
        // so we get ['v0','v1','contract_id'];
        // and we can exclude it from data, and pass it to newly created event
        // Yes I know it's awful
        $event = new Event(arrayExclude($data, call_user_func(function () use ($driver_fields) {
            array_push($driver_fields, 'contract_id', '_token');
            return $driver_fields;
        })));

        // Save drivers
        $event->driverA_id = $drivers[0]->id;
        $event->driverB_id = $drivers[1]->id;
        $event->status = 'čakajúca';

        //Save
        $res = $contract->events()->save($event);

        if ($res) {
            session()->put(['success' => ['Poistná udalosť bola vytvorená.']]);
            return redirect('/');
        }

        return redirect()->back()
            ->withInput()
            ->withErrors(['Nepodarilo sa vytvoriť poistnú udalosť']);
    }

    public function show(Request $request)
    {
        $event = Event::findOrFail($request['id']);

        $this->checkPermissions($event->contract);

        return view('events.detail')
            ->with('event', $event);
    }

    private function checkPermissions($item)
    {
        if (!Gate::allows('admin') && $item->user->id != Auth::id())
            abort(404);
    }

    /*
     * Rules for validator
     */
    private function rules()
    {
        return [
            'place' => 'required|string',
            'cost' => 'required|numeric',
            'date' => 'required|date_format:Y-m-d',
            'description' => 'required|string',

            'v0' => 'required|array',
            'v0.first_name' => 'required|alpha',
            'v0.last_name' => 'required|alpha_dash',
            'v0.national_identity_number' => array(
                'required',
                'regex:/([0-9]{6})\/([0-9]{4})/u',
            ),
            'v0.phone' => 'nullable|phone',
            'v0.address' => 'required|string',
            'v0.licence_id' => array(
                'required',
                'regex:/([A-Z]{2})([0-9]{6})/u'
            ),
            'v0.valid_from' => 'required|date_format:Y-m-d',
            'v0.valid_to' => 'required|date_format:Y-m-d',
            'v0.issued_by' => 'required|string',
            'v0.group' => 'required|array',
            'v0.group.*' => 'required|alpha_num|max:2',

            'v1' => 'required|array',
            'v1.first_name' => 'required|alpha',
            'v1.last_name' => 'required|alpha_dash',
            'v1.national_identity_number' => array(
                'required',
                'regex:/([0-9]{6})\/([0-9]{4})/u'
            ),
            'v1.phone' => 'nullable|phone',
            'v1.address' => 'required|string',
            'v1.licence_id' => array(
                'required',
                'regex:/([A-Z]{2})([0-9]{6})/u'
            ),
            'v1.valid_from' => 'required|date_format:Y-m-d',
            'v1.valid_to' => 'required|date_format:Y-m-d',
            'v1.issued_by' => 'required|string',
            'v1.group' => 'required|array',
            'v1.group.*' => 'required|alpha_num|max:2',
        ];
    }

    /*
     * Error messages
     */
    private function messages()
    {
        return [
            'place.required' => 'Nebolo zadané miesto poistnej udalosti',
            'cost.required' => 'Nebola uvedená škoda',
            'date.required' => 'Nebol uvedený dátum udalosti',
            'date.date_format' => 'Dátum má zlý formát',
            'description.required' => 'Nebol uvedený opis udalosti',
            '*.first_name.required' => 'Nebolo uvedené meno niektorého z vodičov',
            '*.last_name.required' => 'Nebolo uvedené prizvisko niektorého z vodičov',
            '*.national_identity_number.required' => 'Rodné číslo niektorého z vodičov nebolo uvedené',
            '*.national_identity_number.regex' => 'Rodné číslo bolo uvedené v zlom formáte. Použite formát YYYY-m-d',
            '*.phone.required' => 'Nebolo uvedené telefónne číslo niektorého z vodičov',
            '*.address.required' => 'Adresa niektorého z vodičov nebola uvedená',
            '*.licence_id.required' => 'Nebolo uvedené číslo vodičského preukazu niektorého z vodičov',
            '*.licence_id.regex' => 'Číslo vodičského preukazu niektorého z vodičov je v zlom formáte',
            '*.valid_from.required' => 'Dátum platnosti vodičského oprávnenia niektorého z vodičov nebol uvedený',
            '*.valid_from.date_format' => 'Dátum platnosti vodičského oprávnenia niektorého z vodičov má zlý formát',
            '*.valid_to.required' => 'Dátum platnosti vodičského oprávnenia niektorého z vodičov nebol uvedený',
            '*.valid_to.date_format' => 'Dátum platnosti vodičského oprávnenia niektorého z vodičov má zlý formát',
            '*.issued_by.required' => 'Vystaviteľ vodičského oprávnenia niektorého z vodičov nebol uvedený',
            '*.group.required' => 'Skupina vodičského preukazu niektorého z vodičov musí byť uvedená',
            '*.group.*.alpha_num' => 'Skupina vodičského preukazu niektorého z vodičov je v zlom formáte',
            '*.group.*.max' => 'Skupina vodičského preukazu niektorého z vodičov je v zlom formáte',
        ];
    }
}
