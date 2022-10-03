<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\PhoneType;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    private $COUNT_EMAILS = 3,
            $COUNT_PHONES = 3;

    public function __construct()
    {
        parent::__construct();
        
        $count_phone_types = PhoneType::count();
        $this->COUNT_PHONES = ($count_phone_types > $this->COUNT_PHONES ? $count_phone_types : $this->COUNT_PHONES);
       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.list', [
            'name' => 'Клиенты',
            'url_add' => route('clients.create'),
            'clients' => Client::with(['emails', 'phones.type'])->paginate(2)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.form', [
            'name' => 'Добавить клиента',
            'phone_types' => PhoneType::all(),
            'count_emails' => $this->COUNT_EMAILS,
            'count_phones' => $this->COUNT_PHONES,
            'action' => action([self::class, 'store']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        $client = new Client();
        return $this->saveOrUpdate($client, $request, 'Клиент добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);

        return view('client.show', [
            'client' => $client,
            'name' => 'Просмотр клиента: ' . $client->fio,
            'phone_types' => PhoneType::all(),
            'count_emails' => $this->COUNT_EMAILS,
            'count_phones' => $this->COUNT_PHONES,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return view('client.form', [
            'client' => $client,
            'name' => 'Изменить клиента',
            'phone_types' => PhoneType::all(),
            'count_emails' => $this->COUNT_EMAILS,
            'count_phones' => $this->COUNT_PHONES,
            'action' => action([self::class, 'update'], $client->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, $id)
    {
        $client = Client::findOrFail($id);
        return $this->saveOrUpdate($client, $request, 'Клиент обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return $this->redirectToList('Клиент удален!');
    }


    protected function redirectToList($message)
    {
        return redirect()->route('clients.index')->with('message', $message);
    }


    protected function saveOrUpdate(Client $client, Request $request, $message)
    {
        $client->fio = $request->fio;

        DB::transaction(function () use ($client, $request) {
            $client->save();
            $client->saveEmails($request->emails);
            $client->savePhones($request->phones);
        });

        return $this->redirectToList($message);
    }
}
