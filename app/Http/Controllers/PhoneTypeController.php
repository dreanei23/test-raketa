<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePhoneTypeRequest;
use App\Http\Requests\StorePhoneTypeRequest;
use Illuminate\Http\Request;
use App\Models\PhoneType;
use Illuminate\Support\Facades\DB;

class PhoneTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('phone_type.list', [
            'name' => 'Типы телефонов',
            'phone_types' => PhoneType::all(),
            'url_add' => route('phone-types.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('phone_type.form', [
            'name' => 'Добавить тип телефона',
            'phone_types' => PhoneType::all(),
            'action' => action([self::class, 'store']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhoneTypeRequest $request)
    {
        $phone_type = new PhoneType();
        return $this->saveOrUpdate($phone_type, $request, 'Тип телефона добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $phone_type = PhoneType::findOrFail($id);

        return view('phone_type.form', [
            'phone_type' => $phone_type,
            'name' => 'Изменить тип телефона',
            'action' => action([self::class, 'update'], $phone_type->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhoneTypeRequest $request, $id)
    {
        $phone_type = PhoneType::findOrFail($id);
        return $this->saveOrUpdate($phone_type, $request, 'Тип телефона обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function saveOrUpdate(PhoneType $phone_type, Request $request, $message)
    {
        $phone_type->name = $request->name;

        DB::transaction(function () use ($phone_type) {
            $phone_type->save();
        });

        return $this->redirectToList($message);
    }

    protected function redirectToList($message)
    {
        return redirect()->route('phone-types.index')->with('message', $message);
    }
}
