<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Folder;
use Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientsRequest;
use App\Http\Requests\Admin\UpdateClientsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request as NRequest;

class ClientsController extends Controller
{   
    /**
     * Display a listing of Clients.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (!Gate::allows('client_access')){
            return abort (401);
        }

        if ($filterBy = Request::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Client.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Client.filter', 'my');
            }
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('client_delete')) {
                return abort(401);
            }
            $clients = Client::onlyTrashed()->get();
        } else {
            $clients = Client::all();
        }

        return view ('admin.clients.index', compact('clients'));

    }
    public function create(){
        if (! Gate::allows('client_create')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.clients.create', compact('created_bies'));

    }

    public function edit($id)
    {
        if (! Gate::allows('client_edit')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $client = Client::findOrFail($id);

        return view('admin.clients.edit', compact('client', 'created_bies'));
    }

    public function store(StoreClientsRequest $request)
    {
        if (! Gate::allows('client_create')) {
            return abort(401);
        }
        $client = Client::create($request->all());



        return redirect()->route('admin.clients.index');
    }
    public function show($id)
    {
        if (! Gate::allows('client_view')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');$clients = \App\File::where('client_id', $id)->get();

        $client = Client::findOrFail($id);
        $userClientsCount = File::where('created_by_id', Auth::getUser()->id)->count();

        return view('admin.clients.show', compact('client', 'client', 'userClientsCount'));
    }
    public function update(UpdateClientsRequest $request, $id)
    {
        if (! Gate::allows('client_edit')) {
            return abort(401);
        }
        $client = Client::findOrFail($id);
        $client->update($request->all());



        return redirect()->route('admin.clients.index');
    }
}
