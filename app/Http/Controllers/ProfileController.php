<?php

namespace App\Http\Controllers;

use App\Models\Item;
use League\Csv\Reader;
use App\Events\ExampleEvent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Jobs\ProcessCsvUpload;
use App\Http\Requests\StoreProfileRequest;
use App\Repository\Interface\ProfileInterface;

class ProfileController extends Controller
{
    private $ProfileRepository;

    public function __construct(ProfileInterface $ProfileRepository)
    {
        $this->ProfileRepository = $ProfileRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return response()->json([
            'data' => $this->ProfileRepository->getAllProfile(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request)
    {
        return response()->json(
            [
                'data' => $this->ProfileRepository->createProfile($request->validated()),
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());




        return response()->json([
            'data' => $this->ProfileRepository->updateProfile($id, $request->all()),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        // dd("on");
        session()->forget('CsvUploadCompletionMessage');
        return view('csv');

    }
    public function upload_csv(Request $req)
    {





        // dd();


        $tempFilePath = $req->file('image')->store('temp-uploads');
        ProcessCsvUpload::dispatch($tempFilePath);
        echo("done");

        return redirect('csv')->with('message','Data added Successfully');

    }

    }



