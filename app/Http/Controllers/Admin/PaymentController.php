<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GardenRevolution\Services\PaymentService;

use App\GardenRevolution\Responders\Admin\Payments\UpdateResponder;

class PaymentController extends Controller
{
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UpdateResponder $responder)
    {   
        $input = $request->all();

        $payload = $this->paymentService->update($id,$input);

        $responder->setPayload($payload);

        return $responder->respond();
    }
}
