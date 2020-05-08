<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Http\Resources\CountryCollection;
use App\Http\Resources\CountryResource;
use App\Repository\CountryRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    private $country;

    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $countryRepository = new CountryRepository($this->country);

            if($request->has("coditions")) {
                $countryRepository->selectCoditions($request->coditions);
            }

            if($request->has("fields")) {
                $countryRepository->selectFilter($request->fields);
            }

            return new CountryCollection($countryRepository->getResult()->with("city")->paginate(10));

        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        try {
            $this->country->create($request->all());

            $message = new ApiMessages("Country sucessfully created");

            return response()->json($message->getMessage());
        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $country = $this->country
                            ->with("city")
                            ->find($id);

            return new CountryResource($country);
        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, $id)
    {
        try {
            $country = $this->country->findOrFail($id);
            $country->update($request->all());

            $message = new ApiMessages("Country sucessfully updated");
            return response()->json($message->getMessage(), 401);
        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $country = $this->country->findOrFail($id);
            $country->delete();

            $message = new ApiMessages("Country sucessfully removed");
            return response()->json($message->getMessage(), 401);
        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
