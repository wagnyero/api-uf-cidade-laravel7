<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Http\Resources\CityCollection;
use App\Http\Resources\CityResource;
use App\Repository\CityRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CityController extends Controller
{
    private $city;

    public function __construct(City $city)
    {
        $this->city = $city;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $cityRepository = new CityRepository($this->city);

            if($request->has("coditions")) {
                $cityRepository->selectCoditions($request->coditions);
            }

            if($request->has("fields")) {
                $cityRepository->selectFilter($request->fields);
            }

            return new CityCollection($cityRepository->getResult()->with("country")->paginate(10));

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
    public function store(CityRequest $request)
    {
        try {
            $this->city->create($request->all());

            $message = new ApiMessages("City sucessfully created");

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
            $city = $this->city
                            ->with("country")
                            ->findOrFail($id);

            return new CityResource($city);
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
    public function update(Request $request, $id)
    {
        try {

            $cityRepository = new CityRepository($this->city);

            if($cityRepository->validationUpdate($request, $id)) {
                $city = $this->city->findOrFail($id);
                $city->update($request->all());
            }

            $message = new ApiMessages("City sucessfully updated");
            return response()->json($message->getMessage());
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
            $city = $this->city->findOrFail($id);
            $city->delete();

            $message = new ApiMessages("City sucessfully removed");
            return response()->json($message->getMessage());
        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
