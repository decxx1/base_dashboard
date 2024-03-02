<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use GuzzleHttp\Client as GuzzleClient;

class ClientController extends Controller
{
    public function index()
    {
        return Inertia::render('Clients/Index', [
            'clients' => Client::all(),
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'street' => 'required',
            'number' => 'required',
            'zip_code' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        $client = Client::create($request->all());

        $this->updateCoordinates($client);

        return Redirect::route('clients');
    }

    // public function show(Client $client)
    // {
    //     return view('clients.show', compact('client'));
    // }

    // public function edit(Client $client)
    // {
    //     return view('clients.edit', compact('client'));
    // }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'user_id' => 'required',
            'street' => 'required',
            'number' => 'required',
            'zip_code' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
        ]);

        $client->update($request->all());

        $this->updateCoordinates($client);

        return Redirect::route('clients');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Client deleted successfully');
    }


    public function updateCoordinates(Client $client)
{
    $address = $client->getFormattedAddress();

    $apiKey = env('GEOCODING_API_KEY');

    $guzzleClient = new GuzzleClient();

    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($address);

    try {
        $response = $guzzleClient->get($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        if ($data['status'] === 'OK') {
            $location = $data['results'][0]['geometry']['location'];
            $latitude = $location['lat'];
            $longitude = $location['lng'];

            $client->update([
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);
        }
    } catch (\Exception $e) {
        // Manejar el error de geocodificación si es necesario
    }
}

}
