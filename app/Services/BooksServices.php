<?php

namespace App\Services;

use App\Interfaces\BookInterface;
use Exception;
use Illuminate\Support\Facades\Http;

class BooksServices implements BookInterface
{


    /**
     * Sends an HTTP request using the specified method and parameters.
     *
     * @param string $url The URL to send the request to.
     * @param string $method The HTTP method to use (e.g., GET, POST).
     * @param array $params The parameters to include in the request body (for POST and PUT methods).
     * @return \Illuminate\Http\Client\Response The response from the server.
     */
    public function httpCallMethod($url, $method, $params)
    {

        return Http::withHeaders([

                    "Content-Type" => "application/json",
                    "Authorization" => "Bearer " . session('token_key'),

                ])->$method($url, $params);
    }


    public function delete($request, $Id)
    {
        $data = [];

        try {

            $url = config('royalapp.api_v2.url') . "/books/$Id";

            $response = $this->httpCallMethod($url, 'delete', []);

            if ($response->status() !== 204) {
                throw new Exception("Book Record Not Deleted !");
            }

            $data['code'] = 201;
            $data['error'] = false;
            $data['msg'] = 'Book Record Deleted successfully !';
            return $data;
        } catch (\Exception $e) {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $e->getMessage();

            return $data;
        }
    }

    public function store($request)
    {
        $data = [];
        try {

            $url = config('royalapp.api_v2.url') . "/books";
            $parms = [
                "author" => [
                    "id" => (int) $request->get("author")
                ],
                "title" => ($request->get("title") !== null) ? $request->get("title") : 0,
                "release_date" => ($request->get("release_date") !== null) ? date("Y-m-d", strtotime($request->get("release_date"))) : "",
                "description" => ($request->get("description") !== null) ? $request->get("description") : "",
                "isbn" => ($request->get("isbn") !== null) ? $request->get("isbn") : "",
                "format" => ($request->get("format") !== null) ? $request->get("format") : "",
                "number_of_pages" => ($request->get("number_of_pages") !== null) ? (int) $request->get("number_of_pages") : 0,
            ];

            $response = $this->httpCallMethod($url, 'post', $parms);

            if ($response->status() !== 200) {

                throw new Exception("Book Record Not Created !");
            }

            $data['code'] = 201;
            $data['error'] = false;
            $data['msg'] = 'Book Record Created Successfully';
            return $data;
        } catch (\Exception $e) {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $e->getMessage();

            return $data;
        }
    }
}
