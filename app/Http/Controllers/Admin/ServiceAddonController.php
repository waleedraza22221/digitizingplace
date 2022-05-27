<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service_Addon;
use App\Http\Requests\StoreService_AddonRequest;
use App\Http\Requests\UpdateService_AddonRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use DataTables;

class ServiceAddonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Service_Addon::find(1);
        // dd($data->service->name);
        if ($request->ajax()) {
            $data = Service_Addon::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('edit', function ($row) {
                    $btn = '<button class="edit btn btn-primary btn-sm" data-toggle="modal" data-target="#editmodel" data-id="' . $row->id . '"  data-name="' . $row->name . '" >Edit / Delete </button>';

                    return $btn;
                })->addColumn('service', function ($row) {
                    return $row->service->name;
                })
                ->rawColumns(['edit'])
                ->make(true);
        }

        return view('admin.services_addon.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();

        return view('admin.services_addon.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreService_AddonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreService_AddonRequest $request)
    {
        Service_Addon::create($request->validated());
        return redirect()->route('servicesaddon.index')->with('message', 'Service Addon registered Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service_Addon  $service_Addon
     * @return \Illuminate\Http\Response
     */
    public function show(Service_Addon $service_Addon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service_Addon  $service_Addon
     * @return \Illuminate\Http\Response
     */
    public function edit(Service_Addon $service_Addon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateService_AddonRequest  $request
     * @param  \App\Models\Service_Addon  $service_Addon
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateService_AddonRequest $request, Service_Addon $service_Addon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service_Addon  $service_Addon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service_Addon $service_Addon)
    {
        //
    }
}
